<?php

namespace App\Models;

use Exception;
use App\Models\User;
use App\Mail\Mail as ProjectMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';

    public $timestamps = false;

    protected $fillable = [
        'from',
        'to',
        'subject',
        'adjunto',
        'body',
        'enviado',
        'reintentos',
        'ultimo_mensaje_error',
        'tipo',
        'fecha',
        'prioridad'
    ];

    public function __construct($to = null, $from = null, $prioridad = null, $subject = null, $body = null, $tipo = null)
    {
        $this->to = $to;
        $this->enviado = 0;
        $this->reintentos = 0;
        $this->subject = $subject;
        $this->body = $body;
        $this->tipo = $tipo;

        $this->from = $from ?? config('mail.from.address');
        $this->prioridad = $prioridad ?? constants('EMAIL.EMAIL_PRIORIDAD.PRIORIDAD_BAJA');
    }

    public static function enviar_emails_no_enviados()
    {
        // bloquear la tabla
        $emails_no_enviados = self::where('enviado', 0)
            ->where('reintentos', '<', constants('EMAIL.NUMERO_REINTENTOS'))
            ->orderBy('prioridad')
            ->limit(constants('EMAIL.NUMERO_EMAILS_ENVIO'))
            ->lockForUpdate()
            ->get();
        foreach ($emails_no_enviados as $email) {
            $email->enviar();
        }
    }

    public function marcar_como_enviado()
    {
        $this->enviado = true;

        return $this->save();
    }

    public function sumar_reintento($mensaje_error)
    {
        $this->reintentos += 1;
        $this->ultimo_mensaje_error = $mensaje_error;

        return $this->save();
    }

    public function enviar()
    {
        try {
            $mail = new ProjectMail();
            $mail->from($this->from);
            $mail->to($this->to);
            $mail->subject($this->subject);
            self::switch_tipo($mail, $this->tipo);

            Mail::send($mail->with(['body' => $this->body]));
            $this->marcar_como_enviado();
        } catch (Exception $e) {
            $this->sumar_reintento($e->getMessage());
        }
    }

    public static function switch_tipo(&$mail, $tipo)
    {
        switch ($tipo) {
            default:
                break;
            case constants('EMAIL.EMAIL_TIPOS.BIENVENIDA'):
                $mail->view('Emails.email_bienvenida');
                break;
            case constants('EMAIL.EMAIL_TIPOS.RESTAURAR_CONTRASEÑA'):
                $mail->view('Emails.email_reestablecer_contrasena');
                break;
        }
    }

    public static function nuevo_email_bienvenida(User $user)
    {
        $email = new Email(
            to: $user->email,
            subject: __('general.emails.bienvenida.subject'),
            tipo: constants('EMAIL.EMAIL_TIPOS.BIENVENIDA'),
            body: serialize([
                'nombre' => $user->nombre,
                'apellidos' => $user->apellidos
            ])
        );
        return $email->save();
    }

    public static function nuevo_email_restaurar_contasena($token, $email_user)
    {
        $email = new Email(
            to: $email_user,
            prioridad: constants('EMAIL.EMAIL_PRIORIDAD.PRIORIDAD_ALTA'),
            subject: __('general.emails.restaurar_contraseña.subject'),
            tipo: constants('EMAIL.EMAIL_TIPOS.RESTAURAR_CONTRASEÑA'),
            body: serialize([
                'token' => $token
            ])
        );
        return $email->save();
    }
}

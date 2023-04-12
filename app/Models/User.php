<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\File;
use App\Models\Email;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'email',
        'fecha_nacimiento',
        'password',
        'remember_token',
        'activo',
        'fichero_id',
        'imagen_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'activo' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors that will be always present in a model instance
     *
     * @var array
     */
    protected $appends = [
        'nombre_completo'
    ];

    /**
     * Accessors
     */
        public function getNombreCompletoAttribute()
        {
            return $this->nombre . ' ' . $this->apellidos;
        }

        public function getFechaNacimientoFormateadaAttribute()
        {
            return $this->fecha_nacimiento
                ? $this->fecha_nacimiento->format(constants('FORMATOS_FECHA.USUARIO_CORTA'))
                : '';
        }

    /**
     * Relations
     */
        public function imagen()
        {
            return $this->belongsTo(File::class, 'imagen_id');
        }

        public function fichero()
        {
            return $this->belongsTo(File::class, 'fichero_id');
        }

    /**
     * Validations
     */
        public function rules()
        {
            return [
                'username' => 'required|unique:users,username,' . $this->id,
                'password' => 'required|min:6',
                'nombre' => 'required',
                'apellidos' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->id,
            ];
        }

        public static function messages()
        {
            return [
                'username.required' => __('general.validaciones.user.username.required'),
                'username.unique' => __('general.validaciones.user.username.unique'),
                'nombre.required' => __('general.validaciones.user.nombre.required'),
                'apellidos.required' => __('general.validaciones.user.apellidos.required'),
                'email.required' => __('general.validaciones.user.email.required'),
                'email.email' => __('general.validaciones.user.email.email'),
                'email.unique' => __('general.validaciones.user.email.unique'),
                'password.required' => __('general.validaciones.user.password.required'),
                'password.min' => __('general.validaciones.user.password.min'),
            ];
        }

    /**
     * Conditions
     */
        public static function conditions(&$query, $datos)
        {
            if (isset($datos['filtro'])) {
                self::_condicionFiltro($query, $datos['filtro']);
            }
        }

        public static function _condicionFiltro(&$query, $filtro)
        {
            $query->where('nombre', 'like', '%' . $filtro . '%')
                ->orwhere('apellidos', 'like', '%' . $filtro . '%')
                ->orwhere('email', 'like', '%' . $filtro . '%');
        }

    /**
     * Model methods
     */
    public static function buscar($datos)
    {
        $query = self::query();

        self::conditions($query, $datos);

        if (filled($datos['column']) && filled($datos['order'])) {
            $query->orderBy($datos['column'], $datos['order']);
        }

        return $query;
    }

    public function guardar($datos)
    {
        $this->username = $datos['username'];
        $this->nombre = $datos['nombre'];
        $this->apellidos = $datos['apellidos'];
        $this->email = $datos['email'];
        $this->fecha_nacimiento = !empty($datos['fecha_nacimiento'])
                ? Carbon::createFromFormat(constants('FORMATOS_FECHA.USUARIO_CORTA'), $datos['fecha_nacimiento'])
                : null;
        if (isset($datos['password'])) {
            $this->password = bcrypt($datos['password']);
        }
        if (isset($datos['imagen'])) {
            if (isset($this->imagen_id)) {
                $old_imagen_id = $this->imagen_id;
            }
            $this->imagen_id = File::subir_fichero(
                $datos['imagen'],
                constants('FILE_PATH.USER.IMAGEN'),
                constants('FILE.PUBLICO')
            );
        }
        if (isset($datos['fichero'])) {
            if (isset($this->fichero_id)) {
                $old_fichero_id = $this->fichero_id;
            }
            $this->fichero_id = File::subir_fichero(
                $datos['fichero'],
                constants('FILE_PATH.USER.FICHERO'),
                constants('FILE.PRIVADO')
            );
        }
        if (isset($old_fichero_id) && !File::borrar_fichero($old_fichero_id)) {
            return false;
        }
        if (isset($old_imagen_id) && !File::borrar_fichero($old_imagen_id)) {
            return false;
        }
        return $this->save();
    }

    public function guardar_permisos_user($permisos)
    {
        return $this->syncPermissions($permisos);
    }

    public function guardar_roles_user($roles)
    {
        return $this->syncRoles($roles);
    }

    public function sendPasswordResetNotification($token)
    {
        Email::nuevo_email_restaurar_contasena($token, $this->email);
    }

    public function borrar_imagen()
    {
        $imagen_id = $this->imagen_id;
        $this->imagen_id = null;

        return $this->save() && File::borrar_fichero($imagen_id);
    }

    public function borrar_fichero()
    {
        $fichero_id = $this->fichero_id;
        $this->fichero_id = null;

        return $this->save() && File::borrar_fichero($fichero_id);
    }
}

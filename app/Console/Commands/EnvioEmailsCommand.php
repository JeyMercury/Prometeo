<?php

namespace App\Console\Commands;

use App\Models\Email;
use Illuminate\Console\Command;

class EnvioEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de emails';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tareas_rogramadas = config('tareas_programadas');
        if ($tareas_rogramadas['tarea_envio_emails']) {
            Email::enviar_emails_no_enviados();
        } else {
            echo 'Tarea desactivada';
        }
    }
}

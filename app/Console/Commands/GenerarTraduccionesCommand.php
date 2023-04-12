<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerarTraduccionesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:traducciones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sirve para generar un fichero general.php que engloba todas las traducciones de los distintos ficheros';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $array_traducciones = include(base_path(constants('PATH.FICHERO_TRADUCCIONES.IMPORT.PHP')));
        $text = '<?php ' . PHP_EOL . 'return ' . var_export($array_traducciones, true) . ';';
        file_put_contents(base_path(constants('PATH.FICHERO_TRADUCCIONES.EXPORT')), $text);
    }
}

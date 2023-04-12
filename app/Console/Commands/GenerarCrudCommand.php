<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerarCrudCommand extends Command
{
    protected $routesFile = "routes/web.php";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new CRUD operation set';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        $this->controller($name);
        $this->line(
            "Created controller:",
            "fg=green"
        );
        $this->line($this->controllerName);

        $this->model($name);
        $this->line(
            "Created model:",
            "fg=green"
        );
        $this->line($this->modelName);

        $this->resource($name);
        $this->line(
            "Created resource:",
            "fg=green"
        );
        $this->line($this->resourceName);

        $this->requests($name);
        $this->line(
            "Created create and update requests in the folder:",
            "fg=green"
        );
        $this->line($this->requestsFolder . "/");

        $this->views($name);
        $this->line(
            "Created CRUD views in the folder:",
            "fg=green"
        );
        $this->line($this->viewsFolder . "/");

        $this->routes($name);
        $this->line(
            "Generated routes for the model in the file:",
            "fg=green"
        );
        $this->line($this->routesFile);

        $this->migration($name);
        $this->line(
            "Created migration:",
            "fg=green"
        );
        $this->line($this->migrationName);


        $this->line(
            "Remember to create a translation for the singular and plural of \"" . $name . "\" in the root level of the lang/es/general.php file.",
            "fg=cyan"
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected static function replaceValues($name)
    {
        return [
            '{{modelName}}' => $name,
            '{{modelNameSingularLowerCase}}' => strtolower($name),
            '{{modelNamePlural}}' => Str::plural($name),
            '{{modelNamePluralLowerCase}}' => strtolower(Str::plural($name)),
        ];
    }

    // ----------------------------------------------------------------

    protected function model($name)
    {
        $modelTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Model')
        );

        $this->modelName = "/Models/{$name}.php";

        file_put_contents(app_path($this->modelName), $modelTemplate);
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Controller')
        );

        $this->controllerName = "/Http/Controllers/{$name}Controller.php";

        file_put_contents(app_path($this->controllerName), $controllerTemplate);
    }

    protected function resource($name)
    {
        $resourceTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Resource')
        );

        $this->resourceName = "/Http/Resources/{$name}Resource.php";

        file_put_contents(app_path($this->resourceName), $resourceTemplate);
    }

    protected function requests($name)
    {
        $this->requestsFolder = "/Http/Requests/{$name}";
        if (!file_exists(app_path($this->requestsFolder))) {
            mkdir(app_path($this->requestsFolder));
        }
        $this->createFormRequest($name);
        $this->updateFormRequest($name);
    }

    protected function createFormRequest($name)
    {
        $requestTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Requests/CreateFormRequest')
        );

        file_put_contents(app_path($this->requestsFolder . "/" . "CreateFormRequest.php"), $requestTemplate);
    }

    protected function updateFormRequest($name)
    {
        $requestTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Requests/UpdateFormRequest')
        );

        file_put_contents(app_path($this->requestsFolder . "/" . "UpdateFormRequest.php"), $requestTemplate);
    }

    protected function views($name)
    {
        $this->viewsFolder = "/views/" . Str::plural($name);
        if (!file_exists(resource_path($this->viewsFolder))) {
            mkdir(resource_path($this->viewsFolder));
        }

        $this->elementsFolder = "/views/" . Str::plural($name) . "/Elements";
        if (!file_exists(resource_path($this->elementsFolder))) {
            mkdir(resource_path($this->elementsFolder));
        }

        $this->view($name, 'create');
        $this->view($name, 'edit');
        $this->view($name, 'index');
        $this->view($name, 'show');
        $this->element($name, 'form');
    }

    protected function view($name, $view)
    {
        $requestTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Views/' . $view)
        );

        file_put_contents(resource_path($this->viewsFolder . "/" . $view . ".blade.php"), $requestTemplate);
    }

    protected function element($name, $element)
    {
        $requestTemplate = str_replace(
            array_keys(self::replaceValues($name)),
            array_values(self::replaceValues($name)),
            $this->getStub('Views/Elements/' . $element)
        );

        file_put_contents(resource_path($this->elementsFolder . "/" . $element . ".blade.php"), $requestTemplate);
    }

    protected function routes($name)
    {
        File::append(
            base_path($this->routesFile),
            PHP_EOL .
            "use App\Http\Controllers\\{$name}Controller;" . PHP_EOL .
            PHP_EOL .
            "Route::resource('" . Str::plural(strtolower($name)) . "', {$name}Controller::class);" . PHP_EOL .
            "Route::get('datatable', [{$name}Controller::class, 'getDataTable'])->name('" . Str::plural(strtolower($name)) . ".datatable');" . PHP_EOL
        );
    }

    protected function migration($name)
    {
        $this->migrationName = 'create_' . Str::plural(strtolower($name)) . '_table';
        $this->call('make:migration', ['name' => $this->migrationName]);
    }
}

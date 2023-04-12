<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerBladeExtensions();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected function registerBladeExtensions(): void
	{
		$this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
			$bladeCompiler->directive('canor', function ($arguments) {
                list($permissions, $guard) = explode(',', $arguments.',');
                $permissions = explode('|', str_replace('\'', '', $permissions));

                $expression = "<?php if(auth({$guard})->check() && ( false";
                foreach ($permissions as $permission) {
                    $expression .= " || auth({$guard})->user()->can('{$permission}')";
                }

                return $expression . ")): ?>";
			});
			$bladeCompiler->directive('endcanor', function () {
				return '<?php endif; ?>';
			});

		});
	}
}

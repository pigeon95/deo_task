<?php
namespace Users;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Users\Services\UsersService;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Users\Events\LoginAttemptEvent' => [
            'Users\Events\Listners\LoginListner',
        ],
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__ . '/../config/users.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'users.php'
        ], 'users-config');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'users-views');
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/users'),
        ], 'users-lang');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'users');
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/../database/factories');

        $this->bladeDirectives();
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/users.php', 'users'
        );

        $path = __DIR__ . '/../config/views_paths.php';
        $key = 'view.paths';
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, array_merge($config, require $path));


        $this->app->bind('users', function ($app) {
            return new UsersService($app);
        });
        $this->app->alias('users', 'Users\Services\UsersService');
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        Blade::if(
            'hasPermission',
            function($permission, ?bool $requiredAll = false): bool {
                return app()->make('users')->hasPermission($permission, $requiredAll);
            }
        );
        Blade::if(
            'hasRole',
            function($role, ?bool $requiredAll = false): bool {
                return app()->make('users')->hasRole($role, $requiredAll);
            }
        );
    }
}

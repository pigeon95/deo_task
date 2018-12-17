<?php
namespace Theme;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'theme');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'theme');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
    }
}

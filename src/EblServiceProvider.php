<?php


namespace Shipu\Ebl;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Shipu\Ebl\Managers\Ebl;

class EblServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setupConfig();
    }
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerEbl();
    }
    /**
     * Setup the config.
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/ebl.php');
        // Check if the application is a Laravel OR Lumen instance to properly merge the configuration file.
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('ebl.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('ebl');
        }
        $this->mergeConfigFrom($source, 'ebl');
    }
    /**
     * Register Talk class.
     */
    protected function registerEbl()
    {
        $this->app->bind('ebl', function (Container $app) {
            return new Ebl($app['config']->get('ebl'));
        });

        $this->app->alias('ebl', Ebl::class);
    }
}

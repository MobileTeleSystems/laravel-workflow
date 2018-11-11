<?php

namespace Workflow\Providers;


use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Workflow\Registry;
use Workflow\Parser;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('workflow', function (Application $app) {
            $registry = new Registry();
            $config   = $app->make('config')->get('workflow', []);

            (new Parser)
                ->parseArray($config)
                ->each(function ($definition, $name) use ($registry) {
                    $registry->add($name, $definition);
                });

            return $registry;
        });
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = dirname(dirname(__DIR__ )). '/config/workflow.php') ?: $raw;
        
        $this->publishes([$source => config_path('workflow.php')], 'workflow');
        $this->mergeConfigFrom($source, 'workflow');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['workflow'];
    }
}

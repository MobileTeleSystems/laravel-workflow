<?php

namespace Workflow\Providers;


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
    public function register(): void
    {
        $this->app->singleton('workflow', function ($app) {
            $registry = new Registry();
            $config   = $app->make('config')->get('workflow', []);

            (new Parser)
                ->parse($config)
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
    public function boot(): void
    {
        $source = realpath($raw = dirname(__DIR__, 2). '/config/workflow.php') ?: $raw;
        
        $this->publishes([$source => config_path('workflow.php')], 'workflow');
        $this->mergeConfigFrom($source, 'workflow');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['workflow'];
    }
}

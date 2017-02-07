<?php

namespace Rowboat\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;



class RowboatCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    	
	public function boot()
    {
        //$this->loadViewsFrom(__DIR__.'/resources/views', 'editor');
		//$this->setupRoutes();
    }
	
	public function setupRoutes() {
		$this->app->group(['namespace' => 'Rowboat\Editor\Http\Controllers'], function ($app) {
			require __DIR__ . '/routes/web.php';
		});
    }
	

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //$this->app->register(Providers\RouteServiceProvider::class);
       $this->app->bind(
            'Rowboat\Core\Models\Template\TemplateContainerInterface',
            // 'Rowboat\Core\Entities\Template\MoloquentTemplateContainer'
            'Rowboat\Core\Models\Template\DoctrineTemplateContainer'
        );
        // $this->app->bind(
        //     'Rowboat\Core\Entities\Template\TemplateContentInterface',
        //     // 'Rowboat\Core\Entities\Template\MoloquentTemplateContent'
        //     'Rowboat\Core\Entities\Template\DoctrineTemplateContent'
        // );
    }
}


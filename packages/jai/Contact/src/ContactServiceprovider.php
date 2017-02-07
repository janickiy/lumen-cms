<?php

namespace Jai\Contact;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 */
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ContactServiceprovider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot() {

        $this->loadViewsFrom(realpath(__DIR__ . '/../views'), 'contact');
		//$router = $this;
        $this->setupRoutes();//$this->app);


        // this  for conig
        /*$this->publishes([
            __DIR__ . '/config/contact.php' => config_path('contact.php'),
        ]);*/
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes() {
		$this->app->group(['namespace' => 'Jai\Contact\Http\Controllers'], function ($app) {
			require __DIR__ . '/Http/routes.php';
		});
    }

    public function register() {
        $this->registerContact();
        //$this->app->make('Jai\Contact\Http\Controllers\ContactController');
        config([
            'config/contact.php',
        ]);
    }

    private function registerContact() {
        $this->app->bind('ContactController', function($app) {
            return new Contact($app);
        });
    }

}

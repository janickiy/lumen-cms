<?php

namespace Rowboat\Editor;

//use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
//use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RowboatEditorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'editor');
		$this->setupRoutes();
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
            'Rowboat\Editor\Models\Template\TemplateEditorContainerInterface',
            // 'Rowboat\Editor\Entities\Template\MoloquentTemplateEditorContainer'
            'Rowboat\Editor\Models\Template\Doctrine\DoctrineTemplateEditorContainer'
        );
        // $this->app->bind(
        //     'Rowboat\Editor\Entities\Template\TemplateEditorContentInterface',
        //     // 'Rowboat\Editor\Entities\Template\MoloquentTemplateEditorContent'
        //     'Rowboat\Editor\Entities\Template\DoctrineTemplateEditorContent'
        // );
        $this->app->bind(
            'Rowboat\Editor\Models\Folder\FolderEditorContainerInterface',
            // 'Rowboat\Editor\Entities\Folder\MoloquentFolderEditorContainer'
            'Rowboat\Editor\Models\Folder\DoctrineFolderEditorContainer'
        );
        $this->app->bind(
            'Rowboat\Editor\Models\Folder\FolderEditorContentInterface',
            // 'Rowboat\Editor\Entities\Folder\MoloquentFolderEditorContent'
            'Rowboat\Editor\Models\Folder\DoctrineFolderEditorContent'
        );
        
    }
}

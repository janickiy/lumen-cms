<?php

namespace Mongopper;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\Mapping\Driver\YamlDriver;
use Illuminate\Support\ServiceProvider;

class MongopperServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        $configPath = app()->basePath() . '/config/' . 'mongodb.php';
        $this->publishes([
            __DIR__ . '/../config/config.php' => $configPath,
                ], 'mongo');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(DocumentManager::class, function ($app) {
            $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'mongodb');
            $config = config('mongodb');
            $server = "mongodb://" . $config['host'] . ":" . $config['port'];
            //$options = array_only($config, ['username', 'password']);
            $connection = new Connection($server);
            $configuration = new Configuration();
            $configuration->setProxyDir(storage_path('cache/MongoDbProxies'));
            $configuration->setProxyNamespace('MongoDbProxy');
            $configuration->setHydratorDir(storage_path('cache/MongoDbHydrators'));
            $configuration->setHydratorNamespace('MongoDbHydrator');
            $configuration->setDefaultDB(config('mongodb.database', 'laravel'));
            // Request whatever mapping driver is bound to the interface.
            $mapping = config('mongodb.mapping', 'yaml');
            $mappingFilesPath = config('mongodb.mapping_files_path', 'Mappings');
            switch ($mapping) {
                case 'yaml': {
                        $driver = new YamlDriver(app_path($mappingFilesPath));
                        break;
                    }
                default : {
                        $driver = AnnotationDriver::create(app()->path(config('mongodb.documentsPath')));
                        AnnotationDriver::registerAnnotationClasses();
                    }
            }
            $configuration->setMetadataDriverImpl($driver);
            return DocumentManager::create($connection, $configuration);
        });
    }

    public function provides() {
        return [DocumentManager::class];
    }

}

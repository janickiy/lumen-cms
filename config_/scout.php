<?php

return [
    /*'queue' => true,
    'driver' => env('SCOUT_DRIVER', 'angolia'),
    'prefix' =>  env('SCOUT_PREFIX', ''),
    'mysql' => [
        'mode' => 'NATURAL_LANGUAGE',
        'model_directories' => [app_path()],
        'min_search_length' => 0,
        'min_fulltext_search_length' => 4,
        'min_fulltext_search_fallback' => 'LIKE',
        'query_expansion' => false
    ],
    'angolia' => [
        'id' => env('ALGOLIA_APP_ID'),
        'secret' => env('ALGOLIA_SECRET')
    ]*/
    
    
    
    'driver' => env('SCOUT_DRIVER', 'algolia'),
    'prefix' => env('SCOUT_PREFIX', ''),
    'queue' => false,
    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
    ]
];

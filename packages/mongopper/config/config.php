<?php
return [
    'documentsPath'      => 'Documents',
    'mapping'            => 'php',
    'mapping_files_path' => 'Mappings',
    'host'               => env('MONGO_HOST', 'localhost'),
    'port'               => env('MONGO_PORT', '27017'),
    'database'           => env('MONGO_DATABASE', 'cms'),
    'username'           => env('MONGO_USERNAME', ''),
    'password'           => env('MONGO_PASSWORD', ''),
];
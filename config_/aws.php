<?php

return [
    'credentials' => [
        'key'    => env('AWS_ACCESS_KEY_ID', ''),// 'YOUR_AWS_ACCESS_KEY_ID',
        'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
    ],
    'region' => 'us-west-2',
    'version' => 'latest',

    // You can override settings for specific services
    'Ses' => [
        'region' => 'us-east-1',
    ],
];

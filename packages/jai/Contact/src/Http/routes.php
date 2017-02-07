<?php

$app->get('contact', function(){
    return 'inside package';
});


$app->get('contactsss', [
    'as' => 'contactsss', 'uses' => 'ContactController@index'
]);



$app->get('/version', function () use ($app) {
    return $app->version();
});

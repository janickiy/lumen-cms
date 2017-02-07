<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
	return view('welcome');//'nothing here';
    //return $app->version();
});

$app->get('/ss', function () use ($app) {
	return 'nothing here sss';
    //return $app->version();
});


$app->get('/haha', function () {
   $rs = new Mylib\Mytest;
   //@FIXME:Del or comment this debug script in routes/web.php
    dd($rs);
    //return view('welcome');
});

//$app->get('/hihi', 'TemplateEditorController@donothing');
$app->get('/hihi', function(){
    //return 'hihi';
   //$rs = Rowboat\Editor\Http\Controllers\TemplateEditorController;
   //dd($rs);
   return 'hihi  huhu';
});


//$app->get('contact', 'ContactController@index');

/*
$app->get('contact', function(){
    
});*/
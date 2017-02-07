<?php

Route::get('core/', 'TemplateController@index');
Route::get('core/{container_id}', 'TemplateController@show');
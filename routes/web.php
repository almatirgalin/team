<?php

Auth::routes();

Route::get('/', 'PageController@index');
Route::get('post/{id}', 'PageController@post');
Route::get('deals', 'PageController@deals');
Route::get('deal/{id}', 'PageController@deal');
Route::get('leads', 'PageController@leads');
Route::get('lead/{id}', 'PageController@lead');
Route::get('contacts', 'PageController@contacts');
Route::get('contact/{id}', 'PageController@contact');
Route::get('companies', 'PageController@companies');
Route::get('company/{id}', 'PageController@company');
Route::get('workers', 'PageController@workers');
Route::get('worker/{id}', 'PageController@worker');
Route::get('test', 'PageController@test');
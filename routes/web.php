<?php

Auth::routes();

//Basic pages
Route::get('/', 'PageController@index')->name('pages.index');
Route::get('/docs', 'PageController@docs')->name('pages.docs');
Route::get('/download', 'PageController@download')->name('pages.download');
Route::get('/profile', 'PageController@profile')->name('pages.profile');

//API pages
Route::get('/api/record/{id}', 'ApiController@getRecords')->name('api.record.get');
Route::post('/api/record/{id}', 'ApiController@addRecord')->name('api.record.create');

//Resource pages
Route::get('/app/{id}', 'AppController@show')->name('app.show');
Route::post('/app', 'AppController@store')->name('app.store');
Route::delete('/app/{id}', 'AppController@destroy')->name('app.destroy');

//Cron page
Route::get('/c/purge', 'CronController@purge');

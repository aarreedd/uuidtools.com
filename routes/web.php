<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',                   'GeneratorController@home');
Route::get('/generate',           'GeneratorController@index');
Route::get('/generate/bulk',      'GeneratorController@bulk');
Route::get('/generate/{version}', 'GeneratorController@showGenerator');

// Alternate URLs
Route::get('v1', 'GeneratorController@showV1');
Route::get('v3', 'GeneratorController@showV2');
Route::get('v3', 'GeneratorController@showV3');
Route::get('v4', 'GeneratorController@showV4');
Route::get('v5', 'GeneratorController@showV5');
Route::get('timestamp-first', 'GeneratorController@showTimestampFirst');
Route::get('minecraft', 'GeneratorController@showMinecraft');


Route::get('/generator/{anything?}', function($anything = null) {
	return redirect('/generate/' . $anything);
});

Route::get('/decode', 'GeneratorController@decode');

Route::get('/uuid-versions-explained', function() {
	return view('uuid-versions-explained');
});

Route::get('/what-is-uuid', function() {
	return view('what-is-uuid');
});

Route::get('/terms', function() {
	return view('terms');
});

Route::get('/docs', function() {
	return view('docs');
});

Route::get('/sitemap', 'SitemapController@index');

Route::get('/contact', 'ContactController@show');

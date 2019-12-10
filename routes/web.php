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

Route::get('/', 'GeneratorController@index');
Route::get('/generate/bulk', 'GeneratorController@bulk');
Route::get('/generate/{version?}', 'GeneratorController@index');

Route::get('/generator/{anything?}', function($anything = null) {
	return redirect('/generate/' . $anything);
});

Route::get('/decode', 'GeneratorController@decode');

Route::get('/docs', function() {
	return view('docs');
});

Route::get('/terms', function() {
	return view('terms');
});

Route::get('/uuid-versions-explained', function() {
	return view('uuid-versions-explained');
});

Route::get('/what-is-uuid', function() {
	return view('what-is-uuid');
});

Route::get('/sitemap', 'SitemapController@index');

Route::get('/contact', 'ContactController@show');

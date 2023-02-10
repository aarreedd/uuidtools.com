<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Generate
Route::get("generate/v1", 				'ApiController@version1');
Route::get("generate/v1/count/{count}", 'ApiController@version1');

Route::get("generate/v2/",              'ApiController@version2');
Route::get("generate/v2/count/{count}", 'ApiController@version2');

Route::get("generate/v3/namespace/{namespace}/name/{name}", 'ApiController@version3')->where('name', '(.*)');

Route::get("generate/v4", 				'ApiController@version4');
Route::get("generate/v4/count/{count}", 'ApiController@version4');

Route::get("generate/v5/namespace/{namespace}/name/{name}", 'ApiController@version5')->where('name', '(.*)');

Route::get("generate/timestamp-first", 				'ApiController@timestampFirst');
Route::get("generate/timestamp-first/count/{count}", 'ApiController@timestampFirst');

// Decode
Route::get("/decode/{uuid}", 	'ApiController@decode');


// https://www.uuidtool.com/api/generate/v1/10
// https://www.uuidtool.com/api/generate/v1/count/10.json

// https://www.uuidtool.com/api/generate/v1/count/10/namespace/ns:URL/name/http://www.google.com.json

// $ uuid -v3 8f4a283e-ffa5-4a24-a277-01c60893e493 asdf
// $ uuid -v3 ns:URL asdf
// $ uuid -v3 ns:DNS asdf
// $ uuid -v3 ns:X500 asdf
// $ uuid -v3 8f4a283e-ffa5-4a24-a277-01c60893e493 asdf
// $ uuid -v3 8f4a283e-ffa5-4a24-a277-01c60893e493 asdf
// $ uuid -v3 8f4a283e-ffa5-4a24-a277-01c60893e493 asdf

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Provide controller methods with object instead of ID
Route::model('affiliates', 'App\Models\Affiliate');
//Route::post('apply/upload', 'ApplyController@upload');
Route::model('offers', 'App\Models\Offer');
Route::model('creatives', 'App\Models\Creative');
Route::model('subjects', 'App\Models\Subject');

Route::model('servers', 'App\Models\Server');
Route::model('ips', 'App\Models\Ip');


//
Route::resource('affiliates','AffiliateController');
Route::resource('offers','OfferController');
Route::resource('offers.subjects','SubjectController');
Route::resource('offers.creatives','CreativeController');
Route::resource('offers.from_lines','FromLineController');

Route::resource('servers','ServerController');
Route::resource('servers.ips','IpController');
//Route::resource('ips','IpController');


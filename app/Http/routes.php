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
Route::model('from_lines', 'App\Models\FromLine');

Route::model('servers', 'App\Models\Server');
Route::model('ips', 'App\Models\Ip');

Route::model('campaigns', 'App\Models\Campaign');
Route::model('prepared_offers', 'App\Models\PreparedOffer');

Route::model('lists', 'App\Models\AccountList');


//
Route::resource('affiliates','AffiliateController');
Route::resource('offers','OfferController');
Route::get('offers/{id}/prepare',['as' => 'offers.prepare','uses' => 'PreparedOfferController@create']);
Route::resource('offers.subjects','SubjectController');
Route::resource('offers.creatives','CreativeController');
Route::resource('offers.from_lines','FromLineController');

Route::resource('servers','ServerController');
Route::resource('servers.ips','IpController');
Route::get('ips',['as' => 'ips.index','uses' => 'IpController@index']);
//Route::resource('ips','IpController');

Route::resource('prepared-offers','PreparedOfferController');
Route::get('campaigns',['as' => 'campaigns.index','uses' => 'CampaignController@index']);
Route::post('campaigns',['as' => 'campaigns.store','uses' => 'CampaignController@store']);
Route::delete('campaigns/{campaigns}',['as' => 'campaigns.destroy','uses' => 'CampaignController@destroy']);
Route::get('campaigns/{id}/edit',['as' => 'campaigns.edit','uses' => 'CampaignController@edit']);
Route::get('campaigns/{prepared_offers}/start',['as' => 'campaigns.start','uses' => 'CampaignController@start']);
Route::get('campaigns/{campaigns}/{prepared_offers}',['as' => 'campaigns.show','uses' => 'CampaignController@show']);



Route::resource('lists','ListController');

//not get

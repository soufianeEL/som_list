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

Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

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
//Route::model('prepared_offers', 'App\Models\PreparedOffer');

Route::model('lists', 'App\Models\AccountList');


//
Route::resource('affiliates','AffiliateController');
Route::resource('offers','OfferController');

Route::resource('offers.subjects','SubjectController');
Route::resource('offers.creatives','CreativeController');
Route::resource('offers.from_lines','FromLineController');

Route::resource('servers','ServerController');
Route::resource('servers.ips','IpController');
Route::get('ips',['as' => 'ips.index','uses' => 'IpController@index']);
//Route::resource('ips','IpController');

//Route::resource('prepared-offers','PreparedOfferController');

Route::get('offers/{id}/prepare',['as' => 'offers.prepare','uses' => 'CampaignController@prepare']);
Route::get('campaigns',['as' => 'campaigns.index','uses' => 'CampaignController@index','permission' => 'campaigns|create',/*'middleware' => ['acl']*/]);

Route::post('campaigns/status',['as' => 'campaigns.allstatus','uses' => 'CampaignController@status']);
Route::delete('campaigns/{campaigns}',['as' => 'campaigns.destroy','uses' => 'CampaignController@destroy']);
// to set post
Route::post('campaigns/{id}/pause',['as' => 'campaigns.pause','uses' => 'CampaignController@pause']);
Route::post('campaigns/{id}/resume',['as' => 'campaigns.resume','uses' => 'CampaignController@resume']);
Route::get('campaigns/{campaigns}/status',['as' => 'campaigns.status','uses' => 'CampaignController@get_status']);
Route::get('campaigns/send',['as' => 'campaigns.send','uses' => 'CampaignController@send']);

Route::post('campaigns/create',['as' => 'campaigns.create','uses' => 'CampaignController@create']);
//Route::get('campaigns/{prepared_offers}/start',['as' => 'campaigns.start','uses' => 'CampaignController@start']);
Route::post('campaigns/',['as' => 'campaigns.store','uses' => 'CampaignController@store']);
//Route::put('campaigns/{campaigns}/',['uses' => 'CampaignController@store']);
Route::get('campaigns/{campaigns}/edit',['as' => 'campaigns.edit','uses' => 'CampaignController@edit']);

Route::patch('campaigns/{campaigns}/',['uses' => 'CampaignController@update']);
Route::post('campaigns/{campaigns}/',['as' => 'campaigns.update','uses' => 'CampaignController@update']);


Route::resource('lists','ListController');


//not get


//Route::bind('user', function($value)
//{
//    return User::where('name', $value)->first();
//});
//Route::model('user', 'User', function()
//{
//    throw new NotFoundHttpException;
//});
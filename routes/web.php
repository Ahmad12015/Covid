<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('main_page');

Auth::routes(['register' => false]);

Route::post('/generate/qrcode',['as'=>'genQr','uses'=>'PlaceHolderController@store']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',[
        'uses'=>'HomeController@index',
        'as'=>'home',

    ]);
/*	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');*/
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => ['admin']], function () {
        Route::resource('user', 'UserController',['names'=>['index'=>'user_table','store'=>'user_store']]);
        Route::get('/dashboard/get_users', ['as' => '', 'uses' => 'UserController@users']);
        Route::get('/dashboard/user/search/{search}', ['as' => '', 'uses' => 'UserController@search']);
        Route::get('dashboard/places-table', ['as' => 'place_table', 'uses' => 'PlaceHolderController@index']);
        Route::get('dashboard/get_places', ['as' => '', 'uses' => 'PlaceHolderController@getPlaces']);
        Route::get('/dashboard/place/search/{search}', ['as' => '', 'uses' => 'PlaceHolderController@search']);
        Route::get('/dashboard/place/qr/{id}', ['as' => '', 'uses' => 'PlaceHolderController@getQrcode']);
    });

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::resource('patient','PatientController');
	Route::post('/patient/update',['as'=>'','uses'=>'PatientController@updatePatient']);


    Route::get('dashboard/patients-all', ['as' => 'patients', 'uses' => 'PatientController@patients']);
    Route::get('dashboard/patients-healthy', ['as' => 'patients.healthy', 'uses' => 'PatientController@healthy']);
    Route::get('dashboard/patients-contact', ['as' => 'patients.contact', 'uses' => 'PatientController@contact']);
    Route::get('dashboard/patients-injured', ['as' => 'patients.injured', 'uses' => 'PatientController@injured']);

    Route::get('dashboard/patient/gethealthy', ['as' => '', 'uses' => 'PatientController@gethealthy']);
    Route::get('dashboard/patient/getcontact', ['as' => '', 'uses' => 'PatientController@getcontact']);
    Route::get('dashboard/patient/getinjured', ['as' => '', 'uses' => 'PatientController@getinjured']);

    Route::get('/patient/search/{status}/{id}', ['as' => '', 'uses' => 'PatientController@search']);
    Route::get('/contact/map/{id}', ['as' => 'contact.map', 'uses' => 'ContactMapController@show']);
    Route::get('/patient/autocomplete/search', ['as' => '', 'uses' => 'PatientController@searchId']);

    Route::get('/getQR/{status}/{id}', ['as' => 'downloadQR', 'uses' => 'PlaceHolderController@downloadQR']);



});




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

Route::get('/', function () {
    return redirect('/login');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::resource('company', 'CompanyController');
Route::group(['prefix' => 'config'], function () {
    Route::resource('account', 'AccountController');
    Route::resource('category', 'CategoryController');
    Route::resource('supplier', 'SupplierController');
    Route::resource('typeproperty', 'TypePropertyController');
    Route::resource('quota', 'QuotaController');
    Route::resource('installation', 'InstallationController');
    Route::resource('receiptnumber', 'ReceiptNumberController');
    Route::resource('phonesite', 'PhonesiteController');
});
Route::group(['prefix' => 'properties'], function () {
    Route::resource('property', 'PropertyController');
	Route::get('/property/contact/{id?}', [
        'as' => 'properties.property.contact', 'uses' => 'PropertyController@contacts'
    ]);
	Route::resource('contact', 'ContactController');
	Route::get('/contact/list/{option?}', [
        'as' => 'properties.contact.list', 'uses' => 'ContactController@listar'
    ]);
});
Route::group(['prefix' => 'equipment'], function () {
    Route::resource('machinery', 'EquipmentController');
});
Route::group(['prefix' => 'communication'], function () {
    Route::get('/phonesite', [
        'as' => 'communication.phonesite.index', 'uses' => 'CommunicationController@phonesite'
    ]);
});
Route::get('admin', [
    'as' => 'admin.home', 'uses' => 'AdminController@index'
]);

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::resource('tvservices', 'Support\TvserviceController');
	Route::resource('situacionHabitacional', 'Support\SituacionHabitacionalController');
	Route::resource('phoneservices', 'Support\PhoneServiceController');
	Route::resource('internetservices', 'Support\InternetserviceController');
	Route::resource('waterservices', 'Support\WaterserviceController');
	Route::resource('electricservices', 'Support\ElectricserviceController');
	Route::resource('typecontacts', 'Support\TypecontactController');
	Route::resource('relationcontacts', 'Support\RelationcontactController');
	Route::resource('media', 'Support\MediaController');
});
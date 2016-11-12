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
    Route::resource('communication', 'CommunicationController');
    Route::get('/send/{id}', [
        'as' => 'communication.communication.send', 'uses' => 'CommunicationController@send'
    ]);
	Route::get('/resend/{id}', [
        'as' => 'communication.communication.resend', 'uses' => 'CommunicationController@resend'
    ]);
	Route::post('/send', [
        'as' => 'communication.communication.sendcommunication', 'uses' => 'CommunicationController@sendcommunication'
    ]);
	Route::get('/register/send', [
        'as' => 'communication.register.send', 'uses' => 'CommunicationController@registersend'
    ]);
    Route::get('/copy/{id}', [
        'as' => 'communication.communication.copy', 'uses' => 'CommunicationController@copy'
    ]);
	Route::post('/copy', [
        'as' => 'communication.communication.savecopy', 'uses' => 'CommunicationController@savecopy'
    ]);
	Route::get('/print/{id}', [
        'as' => 'communication.communication.print', 'uses' => 'CommunicationController@printcom'
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
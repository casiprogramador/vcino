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
    Route::resource('phonesite', 'PhonesiteController');
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

Route::group(['prefix' => 'transaction'], function () {

	Route::get('/accountsreceivable/generate', [
        'as' => 'transaction.accountsreceivable.generate', 'uses' => 'AccountsReceivableController@generate'
    ]);

	Route::post('/accountsreceivable/generate', [
        'as' => 'transaction.accountsreceivable.searchgenerate', 'uses' => 'AccountsReceivableController@searchgenerate'
    ]);

	Route::post('/accountsreceivable/storegenerate', [
        'as' => 'transaction.accountsreceivable.storegenerate', 'uses' => 'AccountsReceivableController@storegenerate'
    ]);

	Route::get('/accountsreceivable/send', [
        'as' => 'transaction.accountsreceivable.send', 'uses' => 'AccountsReceivableController@send'
    ]);

	Route::get('/accountsreceivable/generatenotification', [
        'as' => 'transaction.accountsreceivable.generatenotification', 'uses' => 'AccountsReceivableController@generatenotification'
    ]);

	Route::post('/accountsreceivable/sendnotification', [
        'as' => 'transaction.accountsreceivable.sendnotification', 'uses' => 'AccountsReceivableController@sendnotification'
    ]);

	Route::post('/accountsreceivable/storealertpayment', [
        'as' => 'transaction.accountsreceivable.storealertpayment', 'uses' => 'AccountsReceivableController@storealertpayment'
    ]);
	Route::get('/accountsreceivable/registernotification', [
        'as' => 'transaction.accountsreceivable.registernotification', 'uses' => 'AccountsReceivableController@registernotification'
    ]);
	//Buscar en index

	Route::post('/accountsreceivable/storealertpayment/search', [
        'as' => 'transaction.accountsreceivable.search', 'uses' => 'AccountsReceivableController@search'
    ]);
	Route::get('/copy/{id}', [
        'as' => 'transaction.accountsreceivable.copy', 'uses' => 'AccountsReceivableController@copy'
    ]);

	Route::get('/accountsreceivable/print/{id}', [
        'as' => 'transaction.accountsreceivable.print', 'uses' => 'AccountsReceivableController@printing'
    ]);

	Route::resource('accountsreceivable', 'AccountsReceivableController');
	//cobranzas Routes
	Route::resource('collection', 'CollectionController');

	Route::get('collection/{id}/pdf', [
        'as' => 'transaction.collection.pdf', 'uses' => 'CollectionController@pdf'
    ]);

	Route::post('collection/send', [
        'as' => 'transaction.collection.send', 'uses' => 'CollectionController@sendemail'
    ]);
	Route::post('cancel', [
        'as' => 'transaction.cancel', 'uses' => 'TransactionController@anular'
    ]);

	//Gastos Rutas

	Route::get('expense/{expense}/copy', [
        'as' => 'transaction.expense.copy', 'uses' => 'ExpensesController@copy'
    ]);
	Route::get('expense/{id}/pdf', [
        'as' => 'transaction.expense.pdf', 'uses' => 'ExpensesController@pdf'
    ]);
	Route::resource('expense', 'ExpensesController');

	//Traspasos
	Route::resource('transfer', 'TransferController');
	Route::get('transfer/{id}/pdf', [
        'as' => 'transaction.transfer.pdf', 'uses' => 'TransferController@pdf'
    ]);
	Route::post('search', [
        'as' => 'transaction.search', 'uses' => 'TransactionController@search'
    ]);
	Route::post('search', [
        'as' => 'transaction.transfer.search', 'uses' => 'TransferController@search'
    ]);


});
Route::get('admin', [
    'as' => 'admin.home', 'uses' => 'AdminController@index'
]);

Route::group(['prefix' => 'report'], function () {
	//Reportes Disonibilidad
	Route::get('disponibilidad', [
		'as' => 'report.disponibilidad', 'uses' => 'ReportDisponibilidadController@disponibilidad'
	]);
	Route::post('disponibilidad/show', [
		'as' => 'report.disponibilidad.show', 'uses' => 'ReportDisponibilidadController@disponibilidad_show'
	]);
	Route::get('disponibilidad/{fecha}/pdf', [
        'as' => 'report.disponibilidad.pdf', 'uses' => 'ReportDisponibilidadController@disponibilidadPdf'
    ]);
	Route::get('disponibilidad/{fecha}/excel', [
        'as' => 'report.disponibilidad.excel', 'uses' => 'ReportDisponibilidadController@disponibilidadExcel'
    ]);
	//Reporte Estado de Resultados
	Route::get('estadoresultados', [
		'as' => 'report.estadoresultados', 'uses' => 'ReportEstadoActualController@estadoresultados'
	]);
	Route::post('estadoresultados/show', [
		'as' => 'report.estadoresultados.show', 'uses' => 'ReportEstadoActualController@estadoresultados_show'
	]);
	Route::get('estadoresultados/{opcion}/excel', [
        'as' => 'report.estadoresultados.excel', 'uses' => 'ReportEstadoActualController@estadoresultadosExcel'
    ]);
	//Reporte Categoria por periodo y gestion
	Route::get('categoriaperiodogestion', [
		'as' => 'report.reportcategoriaperiodogestion', 'uses' => 'ReportCategoriaPeriodoGestionController@categoriaperiodogestion'
	]);
	Route::post('categoriaperiodogestion/show', [
		'as' => 'report.categoriaperiodogestion.show', 'uses' => 'ReportCategoriaPeriodoGestionController@categoriaperiodogestion_show'
	]);
	Route::get('categoriaperiodogestion/{gestion}/excel', [
        'as' => 'report.categoriaperiodogestion.excel', 'uses' => 'ReportCategoriaPeriodoGestionController@categoriaperiodogestion_excel'
    ]);
	//Reporte Cuentas por Cobrar
	Route::get('cuentascobrar', [
		'as' => 'report.cuentascobrar', 'uses' => 'ReportCuentasCobrarController@cuentascobrar'
	]);
	
	Route::post('cuentascobrar/show', [
		'as' => 'report.cuentascobrar.show', 'uses' => 'ReportCuentasCobrarController@cuentascobrar_show'
	]);
	Route::get('cuentascobrar/detallado/{opcion}/excel', [
        'as' => 'report.detallado.categoriaperiodogestion.excel', 'uses' => 'ReportCuentasCobrarController@categoriaperiodogestion_detallado_excel'
    ]);
	Route::get('cuentascobrar/consolidado/{opcion}/excel', [
        'as' => 'report.consolidado.categoriaperiodogestion.excel', 'uses' => 'ReportCuentasCobrarController@categoriaperiodogestion_consolidado_excel'
    ]);
	Route::get('cuentascobrar/porpropiedad/{opcion}/excel', [
        'as' => 'report.porpropiedad.categoriaperiodogestion.excel', 'uses' => 'ReportCuentasCobrarController@categoriaperiodogestion_porpropiedad_excel'
    ]);
	
	//Reporte Historico transacciones
	Route::get('historicotransacciones', [
		'as' => 'report.historicotransacciones', 'uses' => 'ReportHistoricoTransaccionesController@historicotransacciones'
	]);
	Route::post('historicotransacciones/show', [
		'as' => 'report.historicotransacciones.show', 'uses' => 'ReportHistoricoTransaccionesController@historicotransacciones_show'
	]);
	Route::get('historicotransacciones/cuentas/{opcion}/excel', [
        'as' => 'report.historicotransacciones.cuentas.excel', 'uses' => 'ReportHistoricoTransaccionesController@historicotransacciones_cuentas_excel'
    ]);
	
	Route::get('historicotransacciones/categorias/{opcion}/excel', [
        'as' => 'report.historicotransacciones.categorias.excel', 'uses' => 'ReportHistoricoTransaccionesController@historicotransacciones_categorias_excel'
    ]);
	
	Route::get('historicotransacciones/proveedores/{opcion}/excel', [
        'as' => 'report.historicotransacciones.proveedores.excel', 'uses' => 'ReportHistoricoTransaccionesController@historicotransacciones_proveedores_excel'
    ]);
	
	Route::get('historicotransacciones/propiedades/{opcion}/excel', [
        'as' => 'report.historicotransacciones.propiedades.excel', 'uses' => 'ReportHistoricoTransaccionesController@historicotransacciones_propiedades_excel'
    ]);
});
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

//AJAX
Route::post('contact/{property_id}/property', 'ContactController@contactbyproperty');
Route::post('accountsreceivable/{property_id}/property', 'AccountsReceivableController@accountsreceivablebyproperty');

Route::post('expenses/{category_id}/category', 'ExpensesController@expensesbycategory');

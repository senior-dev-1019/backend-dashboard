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
});

Auth::routes();


Route::get('/nopermission', function () {
    return view('nopermission');
}); 

Route::group(['middleware' => ['web', 'auth', 'auth.admin']], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard/password/index', 'Backend\PasswordController@index')->name('dashboard.password.index');
    Route::post('/dashboard/password/update', 'Backend\PasswordController@update')->name('dashboard.password.update');

    Route::get('/dashboard/users', 'Backend\UserController@index')->name('dashboard.users');
    Route::get('/dashboard/users/create', 'Backend\UserController@create')->name('dashboard.users.create');
    Route::post('/dashboard/users/store', 'Backend\UserController@store')->name('dashboard.users.store');
    Route::get('/dashboard/users/edit/{id}', 'Backend\UserController@edit')->name('dashboard.users.edit');
    Route::post('/dashboard/users/update/{id}', 'Backend\UserController@update')->name('dashboard.users.update');
    Route::get('/dashboard/users/delete/{id}', 'Backend\UserController@destroy')->name('dashboard.users.delete');

    Route::get('/dashboard/patients', 'Backend\PatientController@index')->name('dashboard.patients');
    Route::get('/dashboard/patients/create', 'Backend\PatientController@create')->name('dashboard.patients.create');
    Route::post('/dashboard/patients/store', 'Backend\PatientController@store')->name('dashboard.patients.store');
    Route::get('/dashboard/patients/edit/{id}', 'Backend\PatientController@edit')->name('dashboard.patients.edit');
    Route::post('/dashboard/patients/update/{id}', 'Backend\PatientController@update')->name('dashboard.patients.update');
    Route::get('/dashboard/patients/delete/{id}', 'Backend\PatientController@destroy')->name('dashboard.patients.delete');

    Route::get('/dashboard/institutions', 'Backend\InstitutionController@index')->name('dashboard.institutions');
    Route::get('/dashboard/institutions/create', 'Backend\InstitutionController@create')->name('dashboard.institutions.create');
    Route::post('/dashboard/institutions/store', 'Backend\InstitutionController@store')->name('dashboard.institutions.store');
    Route::get('/dashboard/institutions/edit/{id}', 'Backend\InstitutionController@edit')->name('dashboard.institutions.edit');
    Route::post('/dashboard/institutions/update/{id}', 'Backend\InstitutionController@update')->name('dashboard.institutions.update');
    Route::get('/dashboard/institutions/delete/{id}', 'Backend\InstitutionController@destroy')->name('dashboard.institutions.delete');

    Route::get('/dashboard/invoices', 'Backend\InvoiceController@index')->name('dashboard.invoices');
    Route::get('/dashboard/invoices/create', 'Backend\InvoiceController@create')->name('dashboard.invoices.create');
    Route::get('/dashboard/invoices/addInvoiceLine', 'Backend\InvoiceController@addInvoiceLine')->name('dashboard.invoices.addInvoiceLine');
    Route::post('/dashboard/invoices/store', 'Backend\InvoiceController@store')->name('dashboard.invoices.store');
    Route::get('/dashboard/invoices/edit/{id}', 'Backend\InvoiceController@edit')->name('dashboard.invoices.edit');
    Route::post('/dashboard/invoices/update/{id}', 'Backend\InvoiceController@update')->name('dashboard.invoices.update');
    Route::get('/dashboard/invoices/delete/{id}', 'Backend\InvoiceController@destroy')->name('dashboard.invoices.delete');
    Route::get('/dashboard/invoices/downloadInvoice/{id}', 'Backend\InvoiceController@downloadInvoice')->name('dashboard.invoices.downloadInvoice');
    Route::get('/dashboard/invoices/downloadReceipt/{id}', 'Backend\InvoiceController@downloadReceipt')->name('dashboard.invoices.downloadReceipt');

    Route::get('/dashboard/documents', 'Backend\DocumentController@index')->name('dashboard.documents');
    Route::get('/dashboard/documents/create', 'Backend\DocumentController@create')->name('dashboard.documents.create');
    Route::post('/dashboard/documents/store', 'Backend\DocumentController@store')->name('dashboard.documents.store');
    Route::get('/dashboard/documents/download/{id}', 'Backend\DocumentController@download')->name('dashboard.documents.download');
    Route::get('/dashboard/documents/edit/{id}', 'Backend\DocumentController@edit')->name('dashboard.documents.edit');
    Route::post('/dashboard/documents/update/{id}', 'Backend\DocumentController@update')->name('dashboard.documents.update');
    Route::get('/dashboard/documents/delete/{id}', 'Backend\DocumentController@destroy')->name('dashboard.documents.delete');

    Route::get('/dashboard/folders', 'Backend\FolderController@index')->name('dashboard.folders');
    Route::get('/dashboard/folders/create', 'Backend\FolderController@create')->name('dashboard.folders.create');
    Route::post('/dashboard/folders/store', 'Backend\FolderController@store')->name('dashboard.folders.store');
    Route::get('/dashboard/folders/edit/{id}', 'Backend\FolderController@edit')->name('dashboard.folders.edit');
    Route::post('/dashboard/folders/update/{id}', 'Backend\FolderController@update')->name('dashboard.folders.update');
    Route::get('/dashboard/folders/delete/{id}', 'Backend\FolderController@destroy')->name('dashboard.folders.delete');

    Route::get('/dashboard/subscriptions', 'Backend\SubscriptionController@index')->name('dashboard.subscriptions');
    Route::get('/dashboard/subscriptions/create', 'Backend\SubscriptionController@create')->name('dashboard.subscriptions.create');
    Route::post('/dashboard/subscriptions/store', 'Backend\SubscriptionController@store')->name('dashboard.subscriptions.store');
    Route::get('/dashboard/subscriptions/edit/{id}', 'Backend\SubscriptionController@edit')->name('dashboard.subscriptions.edit');
    Route::post('/dashboard/subscriptions/update/{id}', 'Backend\SubscriptionController@update')->name('dashboard.subscriptions.update');
    Route::get('/dashboard/subscriptions/delete/{id}', 'Backend\SubscriptionController@destroy')->name('dashboard.subscriptions.delete');

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for auth
Route::post('/auth/login', 'Api\AuthController@login');
Route::post('/auth/logout', 'Api\AuthController@logout');
Route::post('/auth/refresh', 'Api\AuthController@refresh');

// Routes for register
Route::post('auth/register', 'Api\RegisterController@register');

// Routes for password.
Route::post('/password/email', 'Api\ForgotPasswordController@getResetToken');
Route::post('/password/reset', 'Api\ResetPasswordController@reset');

// Routes for subscriptitons.
Route::get('/subscriptions/list', 'Api\SubscriptionController@index');

Route::group(['middleware' => ['jwt_auth']], function () {

    // Change password
    Route::post('/password/change', 'Api\PasswordController@change');
    // Get the infos related to the current user.
    Route::get('/main', 'Api\UserController@show');
    
    // Routes for Employees.
	Route::post('/employees/store', 'Api\UserController@store');
	Route::post('/employees/update/{id}', 'Api\UserController@update');
	Route::post('/employees/delete/{id}', 'Api\UserController@destroy');

    // Routes for patients
	Route::get('/patients/list', 'Api\PatientController@index');
	Route::post('/patients/update/{id}', 'Api\PatientController@update');
	Route::post('/patients/delete/{id}', 'Api\PatientController@destroy');
	Route::post('/patients/store', 'Api\PatientController@store');

    // Routes for institutions
	Route::post('/institutions/store', 'Api\InstitutionController@store');

    // Routes for timelineItems.
    Route::get('/timelines/list', 'Api\TimelineItemController@index');
    
    // Routes for folders.
    Route::get('/folders/list', 'Api\FolderController@index');
    
    // Routes for documents.
    Route::get('/documents/list', 'Api\DocumentController@index');
    Route::post('/documents/store', 'Api\DocumentController@store');
    Route::post('/documents/update/{id}', 'Api\DocumentController@update');
    Route::get('/documents/show/{id}', 'Api\DocumentController@show');
    Route::post('/documents/delete/{id}', 'Api\DocumentController@destroy');
    Route::post('/documents/share/{id}', 'Api\DocumentController@share');

    Route::get('/contacts', 'Api\DocumentController@contacts');

});

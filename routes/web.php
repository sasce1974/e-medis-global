<?php

use App\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');

//plan routes
Route::get('/plan/{plan}/{start_date}/{end_date}', 'PlanController@planPeriod');
Route::get('/plan/{next}', 'PlanController@nextBack');

//admin - user routes
Route::resource('user', 'UserController');

//Route::resource('clinic', 'ClinicController');
Route::get('/clinic/owned', 'ClinicController@showOwned');

Route::get('/clinic/departments', 'DepartmentController@clinicDepartments')->name('clinic.departments');

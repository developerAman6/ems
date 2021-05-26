<?php
use App\Http\Controllers;
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

Route::get('/', 'App\Http\Controllers\LoginController@index')->name('roots');
Route::get('/login', 'App\Http\Controllers\LoginController@login');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout');
Route::get('/register', 'App\Http\Controllers\LoginController@register');
Route::get('/reset', 'App\Http\Controllers\LoginController@resetPassword');
Route::get('/dashboard', 'App\Http\Controllers\EnquiriesController@dashboard')->name('dashboard');
Route::get('/remarks/{cust_id}', 'App\Http\Controllers\EnquiriesController@showremarks');
Route::get('/create', 'App\Http\Controllers\EnquiriesController@create');
Route::get('/today', 'App\Http\Controllers\EnquiriesController@today')->name('getenquiries');
Route::get('/total', 'App\Http\Controllers\EnquiriesController@total')->name('total');
Route::get('/pending', 'App\Http\Controllers\EnquiriesController@pending')->name('pending');

Route::get('/salesdashboard', 'App\Http\Controllers\SalesController@dashboard');
Route::get('/recoveryremarks/{cust_id}', 'App\Http\Controllers\SalesController@showremarks');
Route::get('/recoverycreate', 'App\Http\Controllers\SalesController@create');
Route::get('/recoverytoday', 'App\Http\Controllers\SalesController@today');
Route::get('/recoverytotal', 'App\Http\Controllers\SalesController@total');
Route::get('/recoverypending', 'App\Http\Controllers\SalesController@pending');


Route::post('/reset', 'App\Http\Controllers\LoginController@updatePassword');
Route::post('/create', 'App\Http\Controllers\EnquiriesController@newcustomer');
Route::post('/remark', 'App\Http\Controllers\EnquiriesController@newremark');
Route::post('/login', 'App\Http\Controllers\LoginController@newlogin');
Route::post('/register', 'App\Http\Controllers\LoginController@newuser');

Route::get('/maester', 'App\Http\Controllers\MaesterController@autho');
Route::post('/maester', 'App\Http\Controllers\MaesterController@dashboard');

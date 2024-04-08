<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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
Route::get('/hello', function (){
    //return 'Hello from data-aggregator';
    return today()->toDateString();
});
Route::get('/', function () {
    return view('welcome');
});

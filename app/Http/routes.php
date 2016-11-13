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
#require '/vendor/autoload.php';
use Carbon\Carbon;

Route::get('/', function () {
	

    return view('welcome')
    	->withTime(Carbon::now()->subMinutes(24)->diffForHumans())
    	->withAge(Carbon::createFromDate(1978,02,15)->age);
});

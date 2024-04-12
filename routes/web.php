<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Email;
use App\Http\Controllers\EmailController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/Email', function () {
    return view('Index');
});
Route::controller(EmailController::class)->group(function(){
    Route::get('getEmail','getEmail');
    Route::post('EmailCheck','EmailCheck');

});
// Route::post('/check-email', 'Email@checkEmail')->name('checkEmail');
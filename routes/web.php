<?php

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
    return view('auth/login');
});

Auth::routes(['register' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ban-member/{chat_id}/{user_id}', [App\Http\Controllers\ChatController::class, 'banMember']);

Route::get('/unban-member/{chat_id}/{user_id}', [App\Http\Controllers\ChatController::class, 'unbanMember']);

Route::get('/unban-member/{chat_id}/{user_id}', [App\Http\Controllers\ChatController::class, 'unbanMember']);

Route::post('/send-message', [App\Http\Controllers\ChatController::class, 'sendMessage']);

Route::get('/delete-chat/{id}', [App\Http\Controllers\ChatController::class, 'delete']);

Route::get('/show/{id}', [App\Http\Controllers\ChatController::class, 'showMembersChat']);



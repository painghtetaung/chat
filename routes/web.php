<?php

use App\Http\Controllers\ActivefriendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Controller\ContainerControllerResolver;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Route::get('/logout', [LoginController::class, 'unactive']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/contacts', [ContactsController::class, 'get']);
Route::get('/conversation/{id}', [ContactsController::class, 'getMessagesFor']);
Route::post('/conversation/send/{contactId}', [MessagesController::class, 'send']);
Route::post('/conversation/send', [MessagesController::class, 'send']);
Route::post('/conversation/imgsend', [MessagesController::class, 'imgsend']);
Route::post('/activefriend/add', [ActivefriendController::class, 'add']);
Route::get('/actviefriend/get', [ActivefriendController::class, 'get']);
Route::delete('/activefriend/delete/', [ActivefriendController::class, 'delete']);
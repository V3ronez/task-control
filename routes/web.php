<?php

use App\Mail\MessageEmailTest;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');
Route::resource('task', TaskController::class)->Middleware('verified');
Route::get('msgtest', function () {
    return new MessageEmailTest();
    // Mail::to('<email_destino>')->send(new MessageEmailTest());
    // return 'Email enviado com sucesso';
});

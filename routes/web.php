<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParseFileController;

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
Route::get('/', [ParseFileController::class, 'index']);
Route::get('/parseFile', [ParseFileController::class, 'index']);
Route::post('/parseFile/sendFileToParse', [ParseFileController::class, 'sendFileToParse']);
Route::post('/uploadToServer', [ParseFileController::class, 'uploadToServer']);
Route::get('/parseFile/getDataFile', [ParseFileController::class, 'getDataFile']);

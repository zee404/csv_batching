<?php

use App\Http\Controllers\CSVController;
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

Route::get('/', [CSVController::class,'index']);
Route::post('/upload',[CSVController::class,'upload'])->name('upload_csv');
Route::get('/batch/{id}', [CSVController::class,'batch'])->name('batch');


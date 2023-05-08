<?php

use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\TextController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/get_configuration', [GeneralController::class, 'get_configuration']);
Route::get('/page/{page_id}', [GeneralController::class, 'get_page']);



Route::get('/advices', [TextController::class, 'advices']);
Route::get('/steps', [TextController::class, 'steps']);


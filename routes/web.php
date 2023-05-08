<?php

use App\Http\Controllers\AdviceController;
use App\Http\Controllers\ClosureController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ImageTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\TextController;
use App\Http\Controllers\TextTypesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

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
require __DIR__.'/auth.php';

Route::get('/icons', [\App\Http\Controllers\IconsController::class,'index']);
Route::get('/test', function (){
    return Rule::unique('users','mobile')->ignore(1)->whereNull('deleted_at')->where('name','test')->__toString();
});


Route::middleware(['auth'])->group(function () {
    Route::any('/', [DashboardController::class, 'index'])->name('system.dashboard');
//    Route::post('save_token', [AdminsController::class, 'save_token'])->name('admin.save_token');

    Route::prefix('profile')->group(function (){
        Route::get('',[UserController::class,'showProfileView'])->name('system.users.profile');
        Route::post('do_update', [UserController::class,'profile'])->name('system.users.do.profile');

        Route::get('showpassword', [UserController::class,'showProfilePasswordView'])->name('system.users.profile.password');
        Route::post('updatepassword',  [UserController::class,'profilePassword'])->name('system.users.do.profile.password');

        Route::get('get_notifications',  [UserController::class,'get_notifications'])->name('system.users.get_notifications');

    });


    Route::prefix('users/')->middleware('permission:users.view')->group(function () {
        Route::get('', [UserController::class,'index'])->name('system.users.index');
        Route::post('create', [UserController::class,'create'])->middleware('permission:users.create')->name('system.users.create');
        Route::get('update/{id}', [UserController::class,'showUpdateView'])->middleware('permission:users.edit')->name('system.users.update');
        Route::post('update/{id}', [UserController::class,'update'])->middleware('permission:users.edit');
        Route::get('password/{id}',  [UserController::class,'showPasswordView'])->middleware('permission:users.edit')->name('system.users.password');
        Route::post('password/{id}',  [UserController::class,'password'])->middleware('permission:users.edit');
        Route::post('delete',  [UserController::class,'delete'])->middleware('permission:users.delete')->name('system.users.delete');
        Route::post('update-fcm-token',  [UserController::class,'saveFcmToken'])->name('system.users.update.fcm.token');
    });


//=====================================================================================================
//                   ROLE ROUTRS
//=====================================================================================================

    Route::prefix('roles/')->middleware('permission:users.edit')->group(function () {
        Route::get('',[RoleController::class, 'index'])->name('system.roles.index');
        Route::get('create',[RoleController::class, 'showCreateView'])->name('system.roles.create');
        Route::post('create',[RoleController::class, 'create']);
        Route::get('update/{id}',[RoleController::class, 'showUpdateView'])->name('system.roles.update');
        Route::post('update/{id}',[RoleController::class, 'Update']);
        Route::post('delete',[RoleController::class, 'delete'])->name('system.roles.delete');
    });



//=====================================================================================================
//                   ROLE ROUTRS
//=====================================================================================================

    Route::prefix('pages/')->middleware('permission:pages.view')->group(function () {
        Route::get('',             [PageController::class, 'index'])->name('system.pages.index');
        Route::get('update/{id}',  [PageController::class, 'showUpdateView'])->middleware('permission:pages.edit')->name('system.pages.update');
        Route::post('update/{id}', [PageController::class, 'update'])->middleware('permission:pages.edit');
    });

    Route::prefix('advices/')->middleware('permission:advices.view')->group(function () {
        Route::get('',               [AdviceController::class, 'index'])->name('system.advices.index');
        Route::get('create',        [AdviceController::class, 'create'])->name('system.advices.create');
        Route::post('create',        [AdviceController::class, 'store']);
        Route::get('update/{advice}',    [AdviceController::class, 'edit'])->name('system.advices.update');
        Route::post('update/{advice}',   [AdviceController::class, 'update']);
        Route::post('delete',        [AdviceController::class, 'delete'])->middleware('permission:advices.delete')->name('system.advices.delete');
        Route::post('activate',      [AdviceController::class,'activate'])->name('system.advices.activate');
        Route::post('deactivate',      [AdviceController::class,'deactivate'])->name('system.advices.deactivate');


    });
    Route::prefix('steps/')->middleware('permission:steps.view')->group(function () {
        Route::get('',               [StepController::class, 'index'])->name('system.steps.index');
        Route::get('create',        [StepController::class, 'create'])->name('system.steps.create');
        Route::post('create',        [StepController::class, 'store']);
        Route::get('update/{step}',    [StepController::class, 'edit'])->name('system.steps.update');
        Route::post('update/{step}',   [StepController::class, 'update']);
        Route::post('delete',        [StepController::class, 'delete'])->middleware('permission:steps.delete')->name('system.steps.delete');
        Route::post('activate',      [StepController::class,'activate'])->name('system.steps.activate');
        Route::post('deactivate',      [StepController::class,'deactivate'])->name('system.steps.deactivate');


    });

});



//======================================================================================================
//                   Others ROUTES
//======================================================================================================
Route::post('uploadFile', [MediaController::class,'saveFileJson']);
Route::post('uploadFiles', [MediaController::class,'saveMultiFileJson']);
Route::post('uploadFilesDZ', [MediaController::class,'saveMultiFileJsonDZ']);
Route::post('uploadFilesNew', [MediaController::class,'saveMultiFileJsonNew']);

Route::prefix('commands/')->middleware(['auth'])->group(function () {
    Route::get('migrate', [ClosureController::class,'migrate']);
    Route::get('generate_models', [ClosureController::class,'generate_models']);
    Route::get('generate_docs', [ClosureController::class,'generate_docs']);
    Route::get('restart_queue', [ClosureController::class,'restart_queue']);

    Route::get('clear', [ClosureController::class,'clearView']);
    Route::get('changeKey', [ClosureController::class,'changeKey']);
    Route::get('ChangeToProduction', [ClosureController::class,'ChangeToProduction']);
    Route::get('ChangeToDevelopment', [ClosureController::class,'ChangeToDevelopment']);


});

<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
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


//splash page
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//admin routes-------------------------------------
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/findusers/{search}', [AdminController::class, 'findUsers']);
Route::get('/editusers', [AdminController::class, 'edit'])->name('editusers');
Route::get('/permissions/{id}', [AdminController::class, 'permissions'])->name('permissions');
Route::post('/editpermissions/{id}', [AdminController::class, 'editPermissions'])->name('editpermissions');


//admin emails-------------------------------------
Route::get('/findemail/{search}', [AdminController::class, 'findEmails']);
Route::get('/testmail', [AdminController::class, 'sendEmail']);


//user routes-------------------------------------
Route::middleware(['redirect'])->group(function() {
    Route::get('/home', [UserController::class, 'index']);
});
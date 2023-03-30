<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;
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

//admin routes----------------------------------------------------

//home
Route::get('/admin', [AdminController::class, 'index']);

//edit users
Route::get('/findusers/{search}', [AdminController::class, 'findUsers']);
Route::get('/editusers', [AdminController::class, 'edit'])->name('editusers');
Route::get('/permissions/{id}', [AdminController::class, 'permissions'])->name('permissions');
Route::post('/editpermissions/{id}', [AdminController::class, 'editPermissions'])->name('editpermissions');

//edit schedules
Route::get('/editschedules', [AdminController::class, 'editSchedules']);
Route::get('/findvolunteers/{search}', [AdminController::class, 'findVolunteers']);
Route::get('/findvolunteers2/{search}', [AdminController::class, 'findVolunteers2'])->name('findvolunteers2');
Route::get('/findlocations/{search}', [AdminController::class, 'findLocations'])->name('findlocations');
Route::get('/findshifts/{search}', [AdminController::class, 'findShifts']);
Route::get('/editvolschedule/{id}', [AdminController::class, 'editVolSchedule'])->name('editvolschedule');

//admin emails
Route::get('/findemail/{search}', [AdminController::class, 'findEmails']);
Route::post('/emailall', [AdminController::class, 'sendEmail']);

//create
Route::post('/createsection', [AdminController::class, 'createSection'])->name('createsection');
Route::post('/createlocation', [AdminController::class, 'createLocation'])->name('createlocation');
Route::post('/createshift', [AdminController::class, 'createShift'])->name('createshift');
Route::get('/registervol/{shiftid}/{volid}', [AdminController::class, 'registerVol'])->name('registerVol');

//delete
Route::get('/unregistervol/{shiftid}/{volid}', [AdminController::class, 'unregisterVol'])->name('unregisterVol');

//refresh values
Route::get('/refreshsections', [AdminController::class, 'refreshSections'])->name('refreshsections');
Route::get('/refreshlocations', [AdminController::class, 'refreshLocations'])->name('refreshlocations');
Route::get('/refreshvolshifts/{volid}', [AdminController::class, 'refreshVolShifts'])->name('refreshvolshifts');


//user routes-------------------------------------------------------
Route::middleware(['redirect'])->group(function() {
    Route::get('/home', [UserController::class, 'index']);
});
Route::get('/emailsupervisor', [UserController::class, 'emailSupervisor']);
Route::get('/riverbendmap', [UserController::class, 'riverbendMap']);
Route::get('/viewgroup', 'UserController@findGroupByID')->name('viewgroup');
Route::get('/sectionlead', [UserController::class, 'sectionLead'])->name('sectionlead');


//waiver------------------------------------------------------------
Route::get('/view-waiver', function() {
    $file = storage_path('/app/pdfs/waiver.pdf');
    return response()->file($file);
})->name('view-waiver');
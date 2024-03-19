<?php

use App\Http\Controllers\CdrController;
use App\Models\Complaint;
use App\Http\Livewire\ComplaintStep;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\DanAuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;

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
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/complaint', ComplaintController::class);
    Route::resource('/user', UserController::class);
    Route::get('complaintSteps', ComplaintStep::class);
    Route::get('/complaintStatus/{id}', [ComplaintController::class, 'complaintStatus'])->name('complaintStatus');
    Route::put('/updateComplaintStatus/{id}', [ComplaintController::class, 'updateComplaintStatus']);
    Route::post('/getOrg', [ComplaintController::class, 'getOrg']);
    Route::get('/getTypeSummary', [ComplaintController::class, 'getTypeSummary']);
    Route::get('/getUserDataByCode', [ComplaintController::class, 'getUserDataByCode']);
    Route::get('/addComplaint', [ComplaintController::class, 'addComplaint'])->name('addComplaint');
    Route::get('/getOrgByEnergyTypeId', [ComplaintController::class, 'getOrgByEnergyTypeId']);
    Route::get('/exportReportExcel', [ComplaintController::class, 'exportReportExcel'])->name('exportReportExcel');
    Route::resource('cdr', CdrController::class);
});
Route::get('/complaints', [ComplaintController::class, 'complaints'])->name('complaints');
Route::get('/userComplaints', [ComplaintController::class, 'userComplaints'])->name('userComplaints');
Route::get('/showComplaint/{id}', [ComplaintController::class, 'showComplaint'])->name('showComplaint');

// Дан системээр нэвтрэх
Route::get('auth/redirect', [DanAuthController::class, 'redirectToDan']);
Route::get('auth/callback', [DanAuthController::class, 'handleDanCallback']);

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
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrgNumberController;
use App\Http\Controllers\SourceComplaintController;

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

Route::get('/complaints', [ComplaintController::class, 'complaints'])->name('complaints');
Route::get('/showComplaint/{id}', [ComplaintController::class, 'showComplaint'])->name('showComplaint');

// Дан систем Иргэнээр нэвтрэх
Route::get('auth/redirect', [DanAuthController::class, 'redirectToDan'])->name('danlogin');
Route::get('auth/callback', [DanAuthController::class, 'handleDanCallback']);

// Дан систем Байгууллагаар нэвтрэх
Route::get('auth/redirectOrg', [DanAuthController::class, 'redirectToDanOrg'])->name('orglogin');
// Route::get('auth/callbackOrg', [DanAuthController::class, 'handleDanOrgCallback']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::post('/getOrg', [ComplaintController::class, 'getOrg']);
    Route::get('/getTypeSummary', [ComplaintController::class, 'getTypeSummary']);
    Route::get('/getUserDataByCode', [ComplaintController::class, 'getUserDataByCode']);
    Route::get('/getOrgByEnergyTypeId', [ComplaintController::class, 'getOrgByEnergyTypeId']);
    Route::resource('/complaint', ComplaintController::class);
});

Route::middleware([
    'auth:sanctum', 'role:dan',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/addComplaint', [ComplaintController::class, 'addComplaint'])->name('addComplaint');
    Route::get('/userComplaints', [ComplaintController::class, 'userComplaints'])->name('userComplaints');
    Route::get('complaintSteps', ComplaintStep::class);
});

Route::middleware([
    'auth:sanctum', 'role:admin,ehzh,tze',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboardEhzh', [DashboardController::class, 'dashboardEhzh'])->name('dashboardEhzh');
    Route::get('/dashboardTze', [DashboardController::class, 'dashboardTze'])->name('dashboardTze');
    Route::get('/dashboardEhs', [DashboardController::class, 'dashboardEhs'])->name('dashboardEhs');
    Route::get('/dashboardTzeShow', [DashboardController::class, 'dashboardTzeShow'])->name('dashboardTzeShow');
    Route::get('/adminProfile', [UserController::class, 'adminProfile'])->name('adminProfile');
    Route::post('/update-admin-profile', [UserController::class, 'updateAdminProfile'])->name('updateAdminProfile');
    // Route::get('complaintSteps', ComplaintStep::class);
    Route::get('/complaintStatus/{id}', [ComplaintController::class, 'complaintStatus'])->name('complaintStatus');
    Route::put('/updateComplaintStatus/{id}', [ComplaintController::class, 'updateComplaintStatus']);
    Route::get('/exportReportExcel', [ComplaintController::class, 'exportReportExcel'])->name('exportReportExcel');
    // Route::resource('/complaint', ComplaintController::class);
    Route::resource('/user', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('/cdr', CdrController::class);
    Route::resource('/orgNumber', OrgNumberController::class);
    Route::post('/orgNumber/{id}', [OrgNumberController::class, 'save'])->name('orgNumber.save');
    Route::resource('/organization', OrganizationController::class);

    // 1111 ээс санал хүсэлт авах
    Route::resource('/sourceComplaint', SourceComplaintController::class);
    Route::get('/fetchComplaints', [SourceComplaintController::class, 'fetchComplaints'])->name('fetchComplaints');
});
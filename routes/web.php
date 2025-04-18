<?php

use App\Models\Complaint;
use App\Http\Livewire\ComplaintStep;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CdrController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DanAuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrgNumberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SourceComplaintController;
use App\Http\Controllers\OrgUserDataImportController;
use App\Http\Controllers\OrganizationServiceAreaController;

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

Route::get('/tze-contacts', [HomeController::class, 'showTable'])->name('tze-contacts');
Route::get('/download-app', [HomeController::class, 'showQrCode'])->name('download-app');

// Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/complaints', [ComplaintController::class, 'complaints'])->name('complaints');
Route::get('/showComplaint/{id}', [ComplaintController::class, 'showComplaint'])->name('showComplaint');

// Дан систем Иргэнээр нэвтрэх
Route::get('auth/redirect', [DanAuthController::class, 'redirectToDan'])->name('danlogin');
Route::get('auth/callback', [DanAuthController::class, 'handleDanCallback']);

// Дан систем Байгууллагаар нэвтрэх
Route::get('auth/redirectOrg', [DanAuthController::class, 'redirectToDanOrg'])->name('orglogin');
// Route::get('auth/callbackOrg', [DanAuthController::class, 'handleDanOrgCallback']);

Route::get('/postDetail/{post}', [PostController::class, 'detail'])->name('postDetail');
Route::get('/postList', [PostController::class, 'list'])->name('postList');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::post('/getOrg', [ComplaintController::class, 'getOrg']);
    Route::get('/getTypeSummary', [ComplaintController::class, 'getTypeSummary']);
    Route::get('/getUserDataByCode', [ComplaintController::class, 'getUserDataByCode']);
    Route::get('/getOrgByEnergyTypeId', [ComplaintController::class, 'getOrgByEnergyTypeId']);
    Route::get('/soum-districts', [ComplaintController::class, 'getSoumDistricts'])->name('soum.districts');
    Route::get('/bag-khoroos', [ComplaintController::class, 'getBagKhoroos'])->name('bag.khoroos');
    Route::get('/complaint', [ComplaintController::class, 'index'])->name('complaint.index');
    Route::resource('/complaint', ComplaintController::class);

    Route::get('/user-guide', function () {
        return view('user-guide');
    })->name('user-guide');

    Route::get('/banner-detail', function () {
        return view('banner-detail'); // Load the details page view
    })->name('banner-detail');
});

// Энгийн хэрэглэгчид
Route::middleware([
    'auth:sanctum',
    'role:dan',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/addComplaint', [ComplaintController::class, 'addComplaint'])->name('addComplaint');
    Route::get('/userComplaints', [ComplaintController::class, 'userComplaints'])->name('userComplaints');
    Route::get('complaintSteps', ComplaintStep::class);
});

// ЭХЗХ, ТЗЭ
Route::middleware([
    'auth:sanctum',
    'role:admin,udirdlaga,ehzh,tze',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
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
    Route::post('/org-number/forward', [OrgNumberController::class, 'forward']);
    Route::patch('/org-numbers/{id}/clear-forwarded', [OrgNumberController::class, 'clearForwarded'])->name('orgNumber.clearForwarded');
    Route::resource('/organization', OrganizationController::class);
    Route::get('/report1', [ReportController::class, 'showReport'])->name('report1.show');
    Route::get('/energyReport', [ReportController::class, 'energyReport'])->name('energyReport');
    Route::get('/reportDetail', [ReportController::class, 'reportDetail'])->name('reportDetail');
    Route::get('/reportStatus', [ReportController::class, 'reportStatus'])->name('reportStatus');

    // 1111 ээс санал хүсэлт авах
    Route::resource('/sourceComplaint', SourceComplaintController::class);
    Route::get('/fetchComplaints', [SourceComplaintController::class, 'fetchComplaints'])->name('fetchComplaints');
    Route::get('/unreceipt/{id}', [SourceComplaintController::class, 'unreceipt'])->name('unreceipt');
    Route::get('/create/{id}', [SourceComplaintController::class, 'create'])->name('create');

    Route::get('/tze-guide', function () {
        return view('tze-guide');
    })->name('tze-guide');

    Route::resource('posts', PostController::class);
    Route::get('/orguserdata', [OrgUserDataImportController::class, 'index'])->name('orguserdata.index');
    Route::post('/orguserdata/import', [OrgUserDataImportController::class, 'import'])->name('orguserdata.import');

    Route::get('organizations/{id}/service-area', [OrganizationServiceAreaController::class, 'add'])->name('organization.service-area.create');
    Route::post('organizations/{id}/service-area', [OrganizationServiceAreaController::class, 'save'])->name('organization.service-area.store');

    // Route::get('organization-service-area', [OrganizationServiceAreaController::class, 'index'])->name('organization.service-area.index');
    // Route::delete('organization-service-area/{id}', [OrganizationServiceAreaController::class, 'destroy'])->name('organization-service-area.destroy');
    Route::resource('organizationServiceArea', OrganizationServiceAreaController::class);
    Route::get('/organizations', [OrganizationController::class, 'getOrganizations']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BagKhorooController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\SoumDistrictController;
use App\Http\Controllers\Api\ComplaintStepController;
use App\Http\Controllers\Api\ComplaintTypeController;
use App\Http\Controllers\Api\ComplaintTypeSummaryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::post('loginEmail', [AuthController::class, 'loginEmail']);
Route::post('loginTze', [AuthController::class, 'loginTze']);

Route::get('/soum_districts', [SoumDistrictController::class, 'getSoums']);
Route::get('/bag_khoroos', [BagKhorooController::class, 'getBags']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::apiResource('complaints', ComplaintController::class);
    Route::post('/upload/{complaint_id}', [ComplaintController::class, 'upload']);
    Route::post('/update', [AuthController::class, 'update']);
    Route::post('/create-complaint', [ComplaintController::class, 'storeTze']);
    Route::get('/complaintsByUser/{regnum}', [ComplaintController::class, 'getComplaintByUser']);
    Route::apiResource('complaintSteps', ComplaintStepController::class);
    Route::get('/steps/{complaint_id}', [ComplaintStepController::class, 'getStepsByComplaintId']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('organizations', [OrganizationController::class, 'index']);
    Route::get('complaintTypes', [ComplaintTypeController::class, 'index']);
    Route::get('complaintTypeSummaries', [ComplaintTypeSummaryController::class, 'index']);
});

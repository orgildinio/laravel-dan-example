<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ComplaintStep;
use App\Models\Complaint;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('/complaint', ComplaintController::class);
    Route::resource('/user', UserController::class);
    Route::get('complaintSteps', ComplaintStep::class);
    Route::get('/addComplaint', [ComplaintController::class, 'addComplaint'])->name('addComplaint');
    Route::get('/complaintStatus/{id}', [ComplaintController::class, 'complaintStatus'])->name('complaintStatus');
    // Route::post('/upload', [ComplaintController::class, 'upload'])->name('upload');
});
Route::get('/complaints', [ComplaintController::class, 'complaints'])->name('complaints');
Route::get('/showComplaint/{id}', [ComplaintController::class, 'showComplaint'])->name('showComplaint');

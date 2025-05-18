<?php


use App\Http\Controllers\User\InspectionRequestController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware(['web','role:qc|segment qc|supervisor'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/inspections-list/{type}', [InspectionRequestController::class, 'inspectionsList'])->name('inspections.list');
    Route::get('/inspection-create', [InspectionRequestController::class, 'inspectionCreate'])->name('inspection.create');
    Route::post('/inspection-store', [InspectionRequestController::class, 'inspectionStore'])->name('inspection.store');
    Route::post('/inspection-update/{id}', [InspectionRequestController::class, 'inspectionUpdate'])->name('inspection.update');
    Route::get('/inspection-edit/{id}', [InspectionRequestController::class, 'inspectionEdit'])->name('inspection.edit');
    Route::get('/inspection-view/{id}', [InspectionRequestController::class, 'inspectionView'])->name('inspection.view');
    Route::post('/inspections-filter', [InspectionRequestController::class, 'inspectionsFilter'])->name('inspections.filter');
    Route::get('/get-tests/{type}', [InspectionRequestController::class, 'getTests'])->name('get-tests');
    Route::get('/get-cities/{state_id}', [InspectionRequestController::class, 'getCities'])->name('get-cities');

    Route::post('comment-store', [InspectionRequestController::class, 'commentStore'])->name('comment.store');

    Route::get('download/{fileName}', [InspectionRequestController::class, 'download'])->name('download');
    Route::post('upload-files', [InspectionRequestController::class, 'uploadFiles'])->name('upload-files');
});

Route::middleware(['web', 'role:admin|super admin|qc|segment qc|supervisor|inspector'])->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
});

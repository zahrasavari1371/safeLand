<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InspectionRequestController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['web','role:admin|super admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/inspections-list/{type}', [InspectionRequestController::class, 'inspectionsList'])->name('inspections.list');
    Route::post('/inspection-update/{id}', [InspectionRequestController::class, 'inspectionUpdate'])->name('inspection.update');
    Route::get('/inspection-view/{id}', [InspectionRequestController::class, 'inspectionView'])->name('inspection.view');
    Route::post('/inspections-filter', [InspectionRequestController::class, 'inspectionsFilter'])->name('inspections.filter');
    Route::post('upload-files', [InspectionRequestController::class, 'uploadFiles'])->name('upload-files');
    Route::get('download/{fileName}', [InspectionRequestController::class, 'download'])->name('download');


    Route::post('comment-store', [InspectionRequestController::class, 'commentStore'])->name('comment.store');

});

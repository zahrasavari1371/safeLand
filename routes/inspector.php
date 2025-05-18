<?php


use App\Http\Controllers\Inspector\InspectionRequestController;
use App\Http\Controllers\Inspector\InspectorController;
use Illuminate\Support\Facades\Route;

// Inspector Routes
Route::prefix('inspector')->name('inspector.')->middleware(['web','role:inspector'])->group(function () {
    Route::get('/dashboard', [InspectorController::class, 'dashboard'])->name('dashboard');

    Route::get('/inspections-list/{type}', [InspectionRequestController::class, 'inspectionsList'])->name('inspections.list');
    Route::get('/inspection-view/{id}', [InspectionRequestController::class, 'inspectionView'])->name('inspection.view');
    Route::get('download/{fileName}', [InspectionRequestController::class, 'download'])->name('download');
});

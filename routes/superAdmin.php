<?php

use App\Http\Controllers\SuperAdmin\CompanyController;
use App\Http\Controllers\SuperAdmin\InspectionRequestController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/auth-check', function () {
    if (auth()->check()) {
        return 'User is logged in: ' . auth()->user()->name;
    }
    return 'User is not logged in.';
});

Route::prefix('super-admin')->middleware(['web','role:super admin'])->name('super-admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/companies-list', [CompanyController::class, 'companiesList'])->name('companies.list');
    Route::get('/create-company', [CompanyController::class, 'createCompany'])->name('companies.create');
    Route::post('/store-company', [CompanyController::class, 'storeCompany'])->name('companies.store');
    Route::get('/edit-company/{id}', [CompanyController::class, 'editCompany'])->name('companies.edit');
    Route::post('/update-company/{id}', [CompanyController::class, 'updateCompany'])->name('companies.update');
    Route::get('/delete-company/{id}', [CompanyController::class, 'deleteCompany'])->name('companies.delete');
    Route::get('/companies/search', [CompanyController::class, 'search'])->name('companies.search');
    Route::post('/delete-unit/{id}', [CompanyController::class, 'deleteCompanyUnit'])->name('companies.unit.delete');
    Route::post('/add-units', [CompanyController::class, 'addUnits'])->name('companies.units.add');
    Route::get('/get-information/{id}', [CompanyController::class, 'getCompanyInfo'])->name('companies.get-information');
    Route::get('/get-cities/{state_id}', [CompanyController::class, 'getCities'])->name('get-cities');

    Route::get('/users-list/{type}', [UserController::class, 'usersList'])->name('users.list');
    Route::get('/create-user/{type}', [UserController::class, 'createUser'])->name('users.create');
    Route::post('/store-user', [UserController::class, 'storeUser'])->name('users.store');
    Route::get('/edit-user/{id}/{type}', [UserController::class, 'editUser'])->name('users.edit');
    Route::post('/update-user/{id}', [UserController::class, 'updateUser'])->name('users.update');


    Route::get('/inspections-list', [InspectionRequestController::class, 'inspectionsList'])->name('inspections.list');
    Route::get('/inspection-create', [InspectionRequestController::class, 'inspectionCreate'])->name('inspection.create');
    Route::post('/inspection-store', [InspectionRequestController::class, 'inspectionStore'])->name('inspection.store');
    Route::get('/get-tests', [InspectionRequestController::class, 'getTests'])->name('get-tests');
});

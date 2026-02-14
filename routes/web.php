<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\PromoterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampaignController::class, 'index'])->name('home');

Route::prefix('campaigns')->name('campaigns.')->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('index');
    Route::get('/create', [CampaignController::class, 'create'])->name('create');
    Route::post('/', [CampaignController::class, 'store'])->name('store');
    Route::get('/{campaign}', [CampaignController::class, 'show'])->name('show');
    Route::get('/{campaign}/edit', [CampaignController::class, 'edit'])->name('edit');
    Route::put('/{campaign}', [CampaignController::class, 'update'])->name('update');
    Route::get('/{campaign}/apply', [CampaignController::class, 'apply'])->name('apply');
    Route::post('/{campaign}/apply', [CampaignController::class, 'storeApplication'])->name('apply.store');
    Route::get('/{campaign}/applicants', [CampaignController::class, 'applicants'])->name('applicants');
    Route::patch(
        '/{campaign}/applications/{application}/status',
        [CampaignController::class, 'updateApplicationStatus']
    )->name('applications.status');
});

Route::prefix('creator')->name('creator.')->group(function () {
    Route::get('/register', [CreatorController::class, 'register'])->name('register');
    Route::post('/register', [CreatorController::class, 'store'])->name('store');
    Route::post('/switch', [CreatorController::class, 'switch'])->name('switch');
    Route::get('/applications', [CreatorController::class, 'applications'])->name('applications');
    Route::get('/profile/{creator}', [CreatorController::class, 'profile'])->name('profile');
});

Route::prefix('promoter')->name('promoter.')->group(function () {
    Route::get('/register', [PromoterController::class, 'register'])->name('register');
    Route::post('/register', [PromoterController::class, 'store'])->name('store');
    Route::post('/switch', [PromoterController::class, 'switch'])->name('switch');
    Route::get('/campaigns', [PromoterController::class, 'campaigns'])->name('campaigns');
    Route::get('/profile/{promoter}', [PromoterController::class, 'profile'])->name('profile');
});

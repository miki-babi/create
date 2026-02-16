<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\MiniappController;
use App\Http\Controllers\PromoterController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


Route::post('webhook/promoter', [PromoterController::class, 'handleWebhook'])->name('webhook')->withoutMiddleware([VerifyCsrfToken::class]);


// Receive initData from Telegram
Route::get('/promoter/miniapp', function () {
    Log::info('Mini app launched');
    return view('miniapp-init');
})->name('miniapp.init');

Route::post('/miniapp/init', [MiniappController::class, 'handleInit'])
    ->name('miniapp.init');


// Handle promoter onboarding from Telegram Web App
Route::post('/miniapp/promoter-onboard', [MiniappController::class, 'promoterOnboard'])
    ->name('miniapp.promoter.onboard');





// Main Mini App page after init
Route::get('/miniapp', function () {
    return view('miniapp-main');
})->name('miniapp.main');

Route::get('/', [CampaignController::class, 'index'])->name('home');

Route::prefix('campaigns')->name('campaigns.')->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('index');
    Route::get('/create', [CampaignController::class, 'create'])->name('create');
    Route::post('/', [CampaignController::class, 'store'])->name('store');
    Route::get('/{campaign}', [CampaignController::class, 'show'])->name('show');
    Route::get('/{campaign}/edit', [CampaignController::class, 'edit'])->name('edit');
    Route::put('/{campaign}', [CampaignController::class, 'update'])->name('update');
    Route::delete('/{campaign}', [CampaignController::class, 'delete'])->name('delete');
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

<?php

use Illuminate\Support\Facades\Route;
use Theharisshah\StatamicSeo\Http\Controllers\CP\SettingsController;


Route::middleware('statamic.cp.authenticated')->group(function () {
    Route::get('/seo-settings', [SettingsController::class, 'index'])->name('seo.settings');
    Route::post('/seo-settings', [SettingsController::class, 'store'])->name('seo.settings.store');
});

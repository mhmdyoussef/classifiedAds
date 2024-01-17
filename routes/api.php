<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ClientFollowController;
use App\Http\Controllers\Auth\ClientProfileController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use App\Http\Controllers\V1\AdsAttributeController;
use App\Http\Controllers\V1\AdsCategoryController;
use App\Http\Controllers\V1\AdsCommentController;
use App\Http\Controllers\V1\AdsCommercialController;
use App\Http\Controllers\V1\AdsController;
use App\Http\Controllers\V1\AdsLastseenController;
use App\Http\Controllers\V1\AdsPackageController;
use App\Http\Controllers\V1\AdsTrendController;
use App\Http\Controllers\V1\CityController;
use App\Http\Controllers\V1\CountryController;
use App\Http\Controllers\V1\CurrencyController;
use App\Http\Controllers\V1\CustomPageController;
use App\Http\Controllers\V1\FavoriteController;
use App\Http\Controllers\V1\LanguageController;
use App\Http\Controllers\V1\MessageController;
use App\Http\Controllers\V1\ReviewController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::group(['prefix' => 'users'], function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    // Verification
    Route::group(['name' => 'verification', 'prefix' => 'verification'], function () {
        Route::post('/', [VerifyPhoneController::class, 'validateCode']);
        Route::post('resend', [VerifyPhoneController::class, 'resendValidateCode']);

    });

    // updating account endpoints
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::put('update', [AuthController::class, 'update']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::delete('destroy', [AuthController::class, 'destroy']);
        Route::get('profile', [ClientProfileController::class, 'profile']);
        Route::put('setLanguage', [ClientProfileController::class, 'storeDefaultLanguage']);

    });
});

// version 1
Route::group(['prefix' => 'v1'], function () {

    // Public endpoints
    Route::apiResource('cities', CityController::class)->only(['index', 'show']);
    Route::apiResource('countries', CountryController::class)->only(['index', 'show']);
    Route::apiResource('currencies', CurrencyController::class)->only(['index', 'show']);
    Route::apiResource('languages', LanguageController::class)->only(['index', 'show']);
    Route::get('adsCategories', [AdsCategoryController::class, 'index']);
    Route::get('packages', [AdsPackageController::class, 'index']);
    Route::get('attribute', [AdsAttributeController::class, 'index']);

    // Custom pages endpoints
    Route::get('pages', [CustomPageController::class, 'index']);
    Route::get('pages/{page}', [CustomPageController::class, 'show']);

    // Ads endpoints
    Route::apiResource('commercials', AdsCommercialController::class)->only(['index', 'show']);
    Route::apiResource('trends', AdsTrendController::class)->only(['index', 'show']);
    Route::apiResource('ads', AdsController::class)->only(['index', 'show']);

    // require authentication endpoints
    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::apiResource('commercials', AdsCommercialController::class)->except(['index', 'show']);
        Route::apiResource('trends', AdsTrendController::class)->except(['index', 'show']);
        Route::apiResource('ads', AdsController::class)->except(['index', 'show']);
        Route::apiResource('favorite', FavoriteController::class);

        // user addons
        Route::get('seen', [AdsLastseenController::class, 'index']);
        Route::post('comment', [AdsCommentController::class, 'store']);
        Route::post('rate', [ReviewController::class, 'store']);
        Route::post('follow', [ClientFollowController::class, 'store']);

        // messaging routes
        Route::post('newChat', [MessageController::class, 'createNewChat']);
        Route::post('replayMessage', [MessageController::class, 'replayMessage']);
        Route::get('threads', [MessageController::class, 'threads']);
        Route::get('threads/{chat}', [MessageController::class, 'showThread']);

    });
});

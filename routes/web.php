<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisconnectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageClientsController;
use App\Http\Controllers\ManageLinesController;
use App\Http\Controllers\ManageSubscriptionsController;
use Faker\Guesser\Name;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client/email-verification/{id_}', EmailVerificationController::class);

Route::prefix('/admin')->group(function () {
    Route::post('/start-session', LoginController::class)->name('start-session');
    Route::view('/login-page', 'admin.loginview')->name('login');
    Route::get('/current-admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
    Route::get('/current', function () {
        return 'this is other enpoint authenticated';
    })->middleware('auth');
    Route::get('/current-admin/client', [ManageClientsController::class, 'clientdetails'])->name('admin.clientdetails')->middleware('auth');
    Route::get('/current-admin/logout', DisconnectController::class)->name('admin.logout')->middleware('auth');
    Route::post('/current-admin/client/wallet-growth', [ManageClientsController::class, 'addtowallet'])->name('addtowallet')->middleware('auth');
    Route::get('/current-admin/subscriptions', [ManageSubscriptionsController::class, 'index'])->name('subscription.index')->middleware('auth');
    Route::get('/current-admin/lines', [ManageLinesController::class, 'index'])->name('line.index')->middleware('auth');
    Route::get('/current-admin/subscription/details', [ManageSubscriptionsController::class, 'show'])->name('subscription.show')->middleware('auth');
    Route::post('/current-admin/subscription/day', [ManageSubscriptionsController::class, 'toggleday'])->name('subscription.toggleday')->middleware('auth');
    // add line to subscription details
    Route::post('/current-admin/subscription/line-add/{subscription_id}', [ManageSubscriptionsController::class, 'addLineToSubscriptionDetail'])->name('subscription.addline')->middleware('auth');


    // subscription related actions (add, update)
    Route::get('/current-admin/subscription-form', [ManageSubscriptionsController::class, 'addSubscriptionShow'])->name('subscription.add.show')->middleware('auth');

    Route::post('/current-admin/subscription-store', [ManageSubscriptionsController::class, 'storeSubscriptionDetails'])->name('subscription.add.store')->middleware('auth');


    // line related actions
    Route::post('/current-admin/line-store', [ManageLinesController::class, 'addLine'])->name('line.add.store')->middleware('auth');
    Route::post('/current-admin/subscription-disable-line', [ManageSubscriptionsController::class, 'disableLineFromSubscription'])->name('subscription.line.disable')->middleware('auth');
    Route::post('/current-admin/line-delete', [ManageLinesController::class, 'deleteLine'])->name('line.delete')->middleware('auth');
});

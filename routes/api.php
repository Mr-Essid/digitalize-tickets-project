<?php

use App\Http\Controllers\api\ClientSubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\RegisterController as ClientRegisterContoller;
use App\Http\Controllers\api\LoginController as ClientLoginController;
use App\Http\Controllers\api\SubscriptionController;
use App\Http\Controllers\api\ClientManageSubscription as SubscriptionManagement;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ManageClientsController;
use App\Http\Controllers\ManageSubscriptionsController;
use App\Http\Middleware\MailVerifiedMiddleWare;
use App\Models\SubscriptionDetail;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/v1/client/register', ClientRegisterContoller::class);
Route::post('/v1/client/access-token', ClientLoginController::class)->middleware(MailVerifiedMiddleWare::class);
Route::post('/subscriptions/subscribtion/{id_sub}', ClientSubscribeController::class)->middleware('auth:sanctum');
Route::get('/subscriptions/current-client', [SubscriptionManagement::class, 'subscriptions'])->middleware('auth:sanctum');
Route::get('/subscriptions/current-client/subscription/{subscription_id}', [SubscriptionManagement::class, 'index_subscription'])->middleware('auth:sanctum');
Route::delete('/subscriptions/current-client/subscription/{subscription_id}', [SubscriptionManagement::class, 'delete_subscription'])->middleware('auth:sanctum');
Route::apiResource('subscriptions', SubscriptionController::class)->middleware('auth:sanctum');
// lines fetch
Route::get('/subscriptions/lines-available/others', [ManageSubscriptionsController::class, 'fetchLinesNotAssociatedWithSD']);
// client search
Route::get('/search-client', [ManageClientsController::class, 'searchforclient']);

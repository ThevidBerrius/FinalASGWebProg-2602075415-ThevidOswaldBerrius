<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.master');
// });


Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/payment', [PaymentController::class, 'show'])->name('auth.payment');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('auth.payment.process');

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::post('/send-friend-request/{friendId}', [HomeController::class, 'sendFriendRequest'])->name('sendFriendRequest');

Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.index');
Route::post('/notifications/{id}/{action}', [NotificationController::class, 'handleNotification'])->name('notifications.handle');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('set-locale');
<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layouts.master');
// });


Auth::routes();

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/payment', [PaymentController::class, 'show'])->name('auth.payment');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('auth.payment.process');
Route::post('/top-up', [PaymentController::class, 'topUp'])->name('topUp');


Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::post('/send-friend-request/{friendId}', [HomeController::class, 'sendFriendRequest'])->name('sendFriendRequest');

Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.index');
Route::post('/notifications/{id}/{action}', [NotificationController::class, 'handleNotification'])->name('notifications.handle');
Route::get('/messages/{friendId}/notification/{notificationId}', [MessageController::class, 'showAndDeleteNotification'])->name('messages.show.notification');



Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::delete('/profile/remove-friend/{id}', [ProfileController::class, 'removeFriend'])->name('profile.removeFriend');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');
});

Route::get('/friends', [FriendController::class, 'friends'])->name('friends.index');

Route::get('/messages/{friendId}', [MessageController::class, 'showMessages'])->name('messages.show');
Route::post('/messages/send/{friend_id}', [MessageController::class, 'sendMessage'])->name('messages.send');

Route::get('/avatars', [AvatarController::class, 'index'])->name('avatars.index');
Route::post('/avatars/select', [AvatarController::class, 'select'])->name('avatars.select');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('set-locale');
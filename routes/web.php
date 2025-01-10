<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NavigationController::class, 'showHomePage'])->name('home');
Route::get('/set-locale/{locale}', function($locale){
    if(in_array($locale, ['en','id'])){
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('set-locale');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/process-payment', [AuthController::class, 'showProcessPaymentPage'])->name('processPayment');
    Route::post('/process-payment', [AuthController::class, 'processPayment'])->name('processPayment');
    Route::post('/confirm-overpayment', [AuthController::class, 'confirmOverpayment'])->name('confirmOverpayment');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/friends', [NavigationController::class, 'showFriendsPage'])->name('friends');
    Route::post('/add-friend/{id}', [FriendController::class, 'addFriend'])->name('addFriend');
    Route::post('/accept-friend/{id}', [FriendController::class, 'acceptFriend'])->name('acceptFriend');
    Route::post('/decline-friend/{id}', [FriendController::class, 'declineFriend'])->name('declineFriend');
    Route::get('/chatroom', [NavigationController::class, 'showChatPage'])->name('chat');
    Route::get('/chatroom/{id}', [ChatController::class, 'showChatDetail'])->name('showChat');
    Route::post('/chatroom/send', [ChatController::class, 'sendMessage'])->name('sendMessage');
    Route::get('/notifications', [NavigationController::class, 'showNotifications'])->name('notifications');
    Route::get('/topup-coins', [NavigationController::class, 'showTopUpPage'])->name('showTopUpPage');
    Route::post('/topup-coins', [CoinController::class, 'topupCoins'])->name('topupCoins');
});
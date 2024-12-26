<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WalletController;

Route::middleware(['auth'])->group(function () {
    Route::get('wallet', [WalletController::class, 'showWallet'])->name('wallet.show');

    Route::post('wallet/add', [WalletController::class, 'addToWallet'])->name('wallet.add');
    Route::get('game/start', [WalletController::class, 'startGame'])->name('game.start');

    Route::get('game/play', [WalletController::class, 'play'])->name('game.play');

    Route::get('/game/entrance', [WalletController::class, 'showGameEntrancePage'])->name('game.entrance');
    Route::post('/game/entrance', [WalletController::class, 'storeEntranceFee'])->name('game.entrance.store');

    Route::post('/wallet/add-amount', [WalletController::class, 'addAmountToWallet'])->name('wallet.addAmount');

});

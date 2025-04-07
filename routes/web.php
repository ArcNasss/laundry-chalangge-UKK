<?php

use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransactionController;

Route::get('/',function(){
    return view ('pages.app');
});

Route::group(['prefix' => 'login', 'middleware' => 'guest'], function() {
    Route::get('/', [App\Http\Controllers\Auth\MemberLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/', [App\Http\Controllers\Auth\MemberLoginController::class, 'login']);
});

// Logout Route
Route::post('/logout', [App\Http\Controllers\Auth\MemberLoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth:member');

// Protected Routes
Route::middleware('auth:member')->group(function() {
    Route::get('/member/dashboard', function() {
        return view('member.dashboard');
    })->name('member.dashboard');
    
    Route::middleware(['auth:member'])->group(function () {
    Route::get('/member/transaction', [TransactionController::class, 'index'])->name('member.transaction.index');
});
});
Route::get('/transactions/{id}/download-proof', [TransactionController::class, 'downloadProof'])
    ->name('transactions.download-proof')
    ->middleware('auth:member');


Route::get('/transactions/download/{transaction}', [TransactionController::class, 'downloadSingle'])
    ->name('transaction.download');

Route::get('/transactions/download-all', [TransactionController::class, 'downloadAll'])
    ->name('transaction.download.all');


Route::middleware(['auth'])->group(function () {
    // Route untuk member
    Route::prefix('member')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('member.transactions');
        Route::get('/transactions/download/{transaction}', [TransactionController::class, 'downloadSingle'])->name('transactions.download.single');
        Route::get('/transactions/download-proof/{id}', [TransactionController::class, 'downloadProof'])->name('transactions.download.proof');
        Route::get('/transactions/download-form', [TransactionController::class, 'downloadForm'])->name('transactions.download.form');
        Route::get('/transactions/download-all', [TransactionController::class, 'downloadAll'])->name('transactions.download.all');
    });
});


// Routes untuk admin
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Routes untuk download transaksi
        Route::get('/transactions/download/{transaction}', [TransactionController::class, 'downloadSingle'])
            ->name('admin.transactions.download.single');
            
        Route::get('/transactions/download-form', [TransactionController::class, 'downloadForm'])
            ->name('admin.transactions.download.form');
            
        Route::get('/transactions/download-all', [TransactionController::class, 'downloadAll'])
            ->name('admin.transactions.download.all');
    });
});

// Routes untuk member
Route::middleware(['auth:member'])->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('member.transactions');
        Route::get('/transactions/download-proof/{id}', [TransactionController::class, 'downloadProof'])
            ->name('member.transactions.download.proof');
    });
});
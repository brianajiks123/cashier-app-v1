<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\User;
use App\Livewire\Product;
use App\Livewire\Transaction;
use App\Livewire\Report;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/user', User::class)->name('user');
    Route::get('/product', Product::class)->name('product');
    Route::get('/transaction', Transaction::class)->name('transaction');
    Route::get('/report', Report::class)->name('report');
});

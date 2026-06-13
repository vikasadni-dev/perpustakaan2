<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::resource('books', BookController::class);
Route::resource('members', MemberController::class);
Route::resource('loans', LoanController::class);
// route khusus pengembalian
Route::get('loans/{id}/return', [LoanController::class, 'returnBook'])->name('loans.return');

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

Route::get('/', [LibraryController::class, 'index'])->name('home');
Route::get('/health', [LibraryController::class, 'health']);

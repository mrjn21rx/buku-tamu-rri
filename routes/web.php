<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// === ROUTE PUBLIK ===
Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/registrasi', [GuestController::class, 'registrasi'])->name('registrasi');
Route::post('/registrasi', [VisitorController::class, 'store'])->name('visitor.store');

// === ROUTE AUTENTIKASI (Hanya untuk tamu / belum login) ===
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// === ROUTE ADMIN (Wajib Login) ===
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Rute Dashboard & Fitur Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/admin/visitor/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.visitor.status');
});

// Fitur Export
    Route::get('/admin/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
    Route::get('/admin/export/pdf', [AdminController::class, 'exportPdf'])->name('admin.export.pdf');
    

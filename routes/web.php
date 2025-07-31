<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendaController;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Dashboard protegido por login e verificação de e-mail
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas autenticadas
Route::middleware(['auth'])->group(function () {
    // Rotas do perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas da venda
    Route::resource('vendas', VendaController::class);
    Route::get('/vendas/{venda}/pdf', [VendaController::class, 'downloadPdf'])->name('vendas.pdf');
});

// Rotas de autenticação (login, registro etc)
require __DIR__.'/auth.php';

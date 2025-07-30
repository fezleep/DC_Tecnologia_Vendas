<?php

use App\Http\Controllers\VendaController;
use App\Http\Controllers\ProfileController; // <-- ADICIONE ESTA LINHA
use Illuminate\Support\Facades\Route;

// Página inicial: mostra o login se não autenticado
Route::get('/', function () {
    return view('welcome');
});

// Rota dashboard (após login)
Route::get('/dashboard', function () {
    return redirect('/vendas');
})->middleware(['auth'])->name('dashboard');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    Route::resource('vendas', VendaController::class);
    Route::get('/vendas/{venda}/pdf', [VendaController::class, 'downloadPdf'])->name('vendas.pdf');

    // ROTAS DE PERFIL (adicione estas linhas)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas de autenticação (login, register, etc.)
require __DIR__.'/auth.php';
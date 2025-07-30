<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('vendas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->nullable()->constrained()->onDelete('set null'); // Cliente opcional
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Vendedor (obrigatório)
        $table->string('forma_pagamento'); // Ex: "cartao", "pix", "boleto"
        $table->decimal('valor_total', 10, 2); // 10 dígitos, 2 casas decimais
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};

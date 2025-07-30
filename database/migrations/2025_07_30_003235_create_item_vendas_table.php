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
    Schema::create('itens_venda', function (Blueprint $table) {
        $table->id();
        $table->foreignId('venda_id')->constrained()->onDelete('cascade'); // Vincula à venda
        $table->string('produto'); // Nome do produto (ou use foreignId se tiver tabela de produtos)
        $table->integer('quantidade');
        $table->decimal('preco_unitario', 10, 2);
        $table->decimal('subtotal', 10, 2); // Calculado (quantidade * preco_unitario)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_vendas');
    }
};

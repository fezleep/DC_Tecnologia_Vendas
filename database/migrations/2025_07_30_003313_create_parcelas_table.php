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
    Schema::create('parcelas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('venda_id')->constrained()->onDelete('cascade'); // Vincula à venda
        $table->integer('numero_parcela'); // Ex: 1, 2, 3...
        $table->decimal('valor', 10, 2);
        $table->date('data_vencimento');
        $table->boolean('paga')->default(false); // Status de pagamento
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelas');
    }
};

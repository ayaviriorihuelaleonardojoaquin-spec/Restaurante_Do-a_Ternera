<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade'); // Relación con Pedido
            $table->string('cliente')->nullable(); // Nombre del cliente
            $table->decimal('monto_total', 10, 2);
            $table->string('metodo_pago')->default('Efectivo'); // efectivo, tarjeta, etc
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};

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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');//Entrada o Salida | Compra o Venta
            //$table->foreignId('persona_id')->nullable()->constrained('personas');
            $table->date('fecha');
            $table->string('nombre_comprobante')->nullable();
            $table->string('numero_comprobante')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->decimal('total');
            $table->string('estado')->default('Activo');
            $table->boolean('eliminado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};

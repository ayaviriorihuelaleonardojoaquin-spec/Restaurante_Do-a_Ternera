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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->default('mesa'); // mesa | llevar
            $table->string('nombre')->nullable();    // nombre del cliente
            $table->foreignId('mesa_id')->constrained()->onDelete('cascade');
            $table->foreignId('mesero_id')->constrained('users')->onDelete('cascade');
            $table->string('estado')->default('pendiente'); // pendiente, en preparación, servido, cancelado
            $table->decimal('total', 10, 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
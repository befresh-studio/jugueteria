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
        Schema::create('estados_ventas_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estado_ventas_id')->references('id')->on('estado_ventas')->onDelete('cascade');
            $table->foreignId('ventas_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados_ventas_ventas');
    }
};

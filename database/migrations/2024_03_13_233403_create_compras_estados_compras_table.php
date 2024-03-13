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
        Schema::create('compras_estados_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compras_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreignId('estados_compras_id')->references('id')->on('estados_compras')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_estados_compras');
    }
};

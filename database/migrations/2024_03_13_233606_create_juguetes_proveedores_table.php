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
        Schema::create('juguetes_proveedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juguetes_id')->references('id')->on('juguetes')->onDelete('cascade');
            $table->foreignId('proveedores_id')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juguetes_proveedores');
    }
};

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
        Schema::create('compras_juguetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compras_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreignId('juguetes_id')->references('id')->on('juguetes')->onDelete('cascade');
            $table->decimal('precio_unitario', 10, 2);
            $table->tinyinteger('cantidad');
            $table->decimal('importe_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_juguetes');
    }
};

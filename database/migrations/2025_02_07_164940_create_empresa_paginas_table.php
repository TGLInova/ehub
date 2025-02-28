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
        Schema::create('empresa_paginas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 80);
            $table->string('slug')->index();
            $table->string('descricao', 200)->nullable();
            $table->foreignId('empresa_id')->constrained('empresas');
            $table->json('dados')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_paginas');
    }
};

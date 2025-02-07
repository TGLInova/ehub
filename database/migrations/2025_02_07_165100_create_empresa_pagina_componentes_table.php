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
        Schema::create('empresa_pagina_componentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_pagina_id')->constrained('empresa_paginas');
            $table->string('componente')->index();
            $table->json('dados')->nullable();
            $table->unsignedInteger('ordem')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_pagina_componentes');
    }
};

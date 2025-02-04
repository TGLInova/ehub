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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->char('uf', 2)->nullable()->index();
            $table->string('cidade')->nullable();
            $table->string('ibge', 10)->nullable()->index();
            $table->string("cep", 12)->nullable();
            $table->string("logradouro", 255)->nullable();
            $table->string("numero", 30)->nullable();
            $table->string("bairro", 255)->nullable();
            $table->string("complemento", 255)->nullable();
            $table->nullableMorphs('model');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};

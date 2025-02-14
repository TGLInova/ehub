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
        Schema::table('midias', function (Blueprint $table) {
            $table->enum('proporcao', ['1:1', '3:4', '4:3', '16:9', '21:9'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('midias', function (Blueprint $table) {
            $table->dropColumn('proporcao');
        });
    }
};

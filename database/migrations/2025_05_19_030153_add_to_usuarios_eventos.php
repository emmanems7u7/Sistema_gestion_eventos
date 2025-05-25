<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios_evento', function (Blueprint $table) {
            $table->date('fecha')->after('rol');
            $table->time('hora_inicio')->after('fecha')->after('fecha');
            $table->time('hora_fin')->after('hora_inicio')->after('hora_inicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios_eventos', function (Blueprint $table) {
            //
        });
    }
};

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
        Schema::table('tipo__servicios', function (Blueprint $table) {
            $table->integer('cantidad_personal')->nullable()->after('precio');
            $table->integer('cantidad_equipo')->nullable()->after('cantidad_personal');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo__servicios', function (Blueprint $table) {
            $table->dropColumn('cantidad_personal');
            $table->dropColumn('cantidad_equipo');
        });
    }
};

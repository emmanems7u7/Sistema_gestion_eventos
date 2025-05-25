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
        Schema::table('servicio_solicituds', function (Blueprint $table) {

            $table->unsignedBigInteger('tipo_servicio_id')->after('solicitud_id');


            $table->foreign('tipo_servicio_id')
                ->references('id')
                ->on('tipo__servicios')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicio_solicituds', function (Blueprint $table) {
            //
        });
    }
};

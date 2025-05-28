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

            $table->string('catalogo_id')->nullable();
            //  $table->foreign('catalogo_id')->references('catalogo_codigo')->on('catalogos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo_servicios', function (Blueprint $table) {
            //
        });
    }
};

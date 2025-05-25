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
            $table->unsignedBigInteger('inventario_id')->nullable()->after('id');
            $table->foreign('inventario_id')->references('id')->on('inventarios')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tipo__servicios', function (Blueprint $table) {
            //
        });
    }
};

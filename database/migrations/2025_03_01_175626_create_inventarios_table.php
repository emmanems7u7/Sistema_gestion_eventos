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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('cantidad_disponible')->default(1);
            $table->string('categoria');
            $table->string('frecuencia_mantenimiento');
            $table->date('fecha_adquisicion');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });

        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventario_id')->constrained()->onDelete('cascade');  // Relación con el inventario
            $table->string('ruta');  // Ruta de la imagen
            $table->string('tipo')->nullable();  // Tipo de la imagen (thumbnail, principal, etc.)
            $table->timestamps();
        });

        Schema::create('inventario_evento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade'); // Evento relacionado
            $table->foreignId('inventario_id')->constrained('inventarios')->onDelete('cascade'); // Evento relacionado
            $table->integer('cantidad')->default(1);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};

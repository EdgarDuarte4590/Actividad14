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
    Schema::create('detalle_receta_ingredientes', function (Blueprint $table) {
        $table->id('id_detalleReceta'); // PK según tu DER
        
        // Llaves foráneas (FK)
        $table->foreignId('id_receta')->constrained('recetas', 'id_receta')->cascadeOnDelete();
        $table->foreignId('id_ingrediente')->constrained('ingredientes', 'id_ingrediente')->cascadeOnDelete();
        
        // Atributos de la clase de asociación
        $table->string('unidadMedida');
        $table->float('cantidadRequerida');
        $table->timestamps();
    });
}

};

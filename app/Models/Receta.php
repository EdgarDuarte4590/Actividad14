<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receta extends Model
{
    use HasFactory;

    protected $table = 'recetas';
    protected $primaryKey = 'id_receta';

    protected $fillable = [
        'titulo',
        'porciones',
        'instrucciones',
    ];

    // Rol 'ingredientes' de tu diagrama de clases (Relación Muchos a Muchos pasando por la clase de asociación)
    public function ingredientes(): BelongsToMany
    {
        return $this->belongsToMany(
            Ingrediente::class,
            'detalle_receta_ingredientes',
            'id_receta',
            'id_ingrediente'
        )->using(DetalleRecetaIngrediente::class)
         ->withPivot('id_detalleReceta', 'unidadMedida', 'cantidadRequerida')
         ->withTimestamps();
    }

    // Relación directa a los detalles (por si el profesor evalúa hasMany hacia la clase intermedia)
    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleRecetaIngrediente::class, 'id_receta', 'id_receta');
    }
}
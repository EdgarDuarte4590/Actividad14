<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';
    protected $primaryKey = 'id_ingrediente';

    protected $fillable = [
        'nombre',
    ];

    // Rol 'recetas' de tu diagrama de clases
    public function recetas(): BelongsToMany
    {
        return $this->belongsToMany(
            Receta::class,
            'detalle_receta_ingredientes',
            'id_ingrediente',
            'id_receta'
        )->using(DetalleRecetaIngrediente::class)
         ->withPivot('id_detalleReceta', 'unidadMedida', 'cantidadRequerida')
         ->withTimestamps();
    }
}
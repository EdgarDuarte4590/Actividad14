<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DetalleRecetaIngrediente extends Pivot
{
    protected $table = 'detalle_receta_ingredientes';
    protected $primaryKey = 'id_detalleReceta';
    public $incrementing = true;

    protected $fillable = [
        'id_receta',
        'id_ingrediente',
        'unidadMedida',
        'cantidadRequerida',
    ];

    public function receta(): BelongsTo
    {
        return $this->belongsTo(Receta::class, 'id_receta', 'id_receta');
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class, 'id_ingrediente', 'id_ingrediente');
    }
}
<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecetaTest extends TestCase
{
    use RefreshDatabase;

    public function test_instanciar_receta_con_ingredientes(): void
    {
        
        $receta = Receta::create([
            'titulo' => 'Gallo Pinto',
            'porciones' => 4,
            'instrucciones' => 'Sofreír olores, agregar frijoles y arroz, revolver bien.'
        ]);

       
        $arroz = Ingrediente::create(['nombre' => 'Arroz']);
        $frijoles = Ingrediente::create(['nombre' => 'Frijoles']);

        
        $receta->ingredientes()->attach($arroz->id_ingrediente, [
            'unidadMedida' => 'tazas',
            'cantidadRequerida' => 2.5
        ]);

        $receta->ingredientes()->attach($frijoles->id_ingrediente, [
            'unidadMedida' => 'tazas',
            'cantidadRequerida' => 2.0
        ]);

        
        $this->assertEquals('Gallo Pinto', $receta->titulo);
        $this->assertCount(2, $receta->ingredientes);
        $this->assertEquals('tazas', $receta->ingredientes->first()->pivot->unidadMedida);
        $this->assertEquals(2.5, $receta->ingredientes->first()->pivot->cantidadRequerida);
    }
}
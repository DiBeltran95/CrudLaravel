<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Departamento;

class DepartamentoTest extends TestCase
{
    use RefreshDatabase;

    public function test_creacion_departamento()
    {
        $data = [
            'name' => 'Nuevo Departamento',
        ];
        $this->artisan('migrate');        
        $departamento = Departamento::create($data);
        $this->assertDatabaseHas('departamentos', $data);
    }
    
}

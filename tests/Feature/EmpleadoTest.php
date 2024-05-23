<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empleado;
use App\Models\Departamento;

class EmpleadoTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_creacion_empleado()
    {
       // Crear un departamento
    $departamento = Departamento::create([
        'name' => 'Departamento de Prueba',
    ]);

    $data = [
        'identification' => '123456789',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'phone' => '1234567890',
        'email' => 'john@example.com',
        'fk_department' => $departamento->id,
    ];

    // Crear un nuevo empleado
    $empleado = Empleado::create($data);

    // Verificar que el empleado fue creado correctamente
    $this->assertDatabaseHas('empleados', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Departamento;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index(){
        $empleados = Empleado::select('empleados.*', 'departamentos.name as department_name')
                         ->join('departamentos', 'empleados.fk_department', '=', 'departamentos.id')
                         ->orderBy('empleados.id', 'desc')
                         ->paginate(10);

        $departamentos = Departamento::pluck('name', 'id');
        return view('empleados.index', compact('empleados', 'departamentos'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|min:4|max:200',
            'last_name' => 'required|string|min:4|max:200'
        ]);
        $identifications = $request->input('identification');
        $identificationExistente = Empleado::where('identification', 'like', $identifications)->exists();    
        if ($identificationExistente) {
            return redirect()->route('empleados.index')->with('warning', 'La identificación ya existe.');
        }
        Empleado::create($request->all());
        return redirect()->route('empleados.index')->with('success', 'Departamento creado correctamente.');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|min:4|max:200',
            'last_name' => 'required|string|min:4|max:200'
        ]);        
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->update($request->all()); 
            return redirect()->route('empleados.index')->with('success', 'El empleado se actualizo correctamente.');
        } catch (\Throwable $th) {
            return redirect()->route('empleados.index')->with('warning', 'La identificación ya existe.');
        } 
    }

    public function destroy(string $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', '¡El empleado ha sido eliminado correctamente!');
    }
    
    public function buscar(Request $request)
    {
        $response = [
            "success" => false,
            "message" => "Hubo un error"
        ];
        if ($request->ajax()) {
            $query = $request->input('text');    
            $data = Empleado::select('empleados.*', 'departamentos.name as department_name')
                            ->join('departamentos', 'empleados.fk_department', '=', 'departamentos.id')
                            ->where('empleados.first_name', 'like', "%{$query}%")
                            ->orWhere('departamentos.name', 'like', "%{$query}%")
                            ->orderBy('empleados.id', 'desc')
                            ->paginate(10);
    
            $response = [
                "success" => true,
                "message" => "Consulta Correcta",
                "data" => $data->items(),
                "total" => $data->total(),
                "links" => $data->links('pagination::bootstrap-4')->render(),
            ];
        }
        return response()->json($response);
    }
    

}

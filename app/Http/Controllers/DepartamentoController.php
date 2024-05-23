<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::orderBy('id', 'desc')->paginate(10);
        return view('departamentos.index', compact('departamentos'));
    }

    public function create()
    {      
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:200'
        ]);
        $nombre = $request->input('name');
        $departamentoExistente = Departamento::where('name', 'like',$nombre)->exists();    
        if ($departamentoExistente) {
            return redirect()->route('departamentos.index')->with('warning', 'El nombre ya existe.');
        }
        Departamento::create($request->all());
        return redirect()->route('departamentos.index')->with('success', 'Departamento creado correctamente.');
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
            'name' => 'required|string|min:4|max:200'
        ]);        
        $nombre = $request->input('name');
        $departamentoExistente = Departamento::where('name', 'like',$nombre)->exists();
        if ($departamentoExistente) {
            return redirect()->route('departamentos.index')->with('warning', 'El nombre ya existe.');
        }
        $departamento = Departamento::findOrFail($id);
        $departamento->update($request->all());        
        return redirect()->route('departamentos.index')->with('success', 'El dato se actualizo correctamente.');
    }

    public function destroy(string $id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();
        return redirect()->route('departamentos.index')->with('success', '¡El departamento ha sido eliminado correctamente!');
    }

    public function buscar(Request $request)
    {
        $response=[
            "success"=>false,
            "message"=>"Hubo un error"
        ];
        if($request->ajax()){
            $data = Departamento::where("name","like", $request->text."%")->take(10)->get();
            $response=[
                "success"=>true,
                "message"=>"Consulta Correcta",
                "data"=>$data
            ];
        }
        return response()->json($response);
    }
}
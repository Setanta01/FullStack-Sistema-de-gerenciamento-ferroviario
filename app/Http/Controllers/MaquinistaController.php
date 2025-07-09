<?php

namespace App\Http\Controllers;

use App\Models\Maquinista;
use Illuminate\Http\Request;

class MaquinistaController extends Controller
{
    public function index()
    {
        return response()->json(Maquinista::with('funcionario')->get());
    }

    public function show($id)
    {
        $maquinista = Maquinista::with('funcionario')->find($id);

        if (!$maquinista) {
            return response()->json(['message' => 'Maquinista não encontrado'], 404);
        }

        return response()->json($maquinista);
    }

    public function store(Request $request)
    {
        $request->validate([
            'funcionario_id' => 'required|exists:funcionarios,id',
            'licenca' => 'required|string',
            'tempo_experiencia' => 'required|integer',
            'data_validade' => 'sometimes|nullable|date',
            'categoria_licenca' => 'sometimes|nullable|string',
        ]);

        $maquinista = Maquinista::create($request->all());

        return response()->json($maquinista, 201);
    }

    public function update(Request $request, $id)
    {
        $maquinista = Maquinista::find($id);

        if (!$maquinista) {
            return response()->json(['message' => 'Maquinista não encontrado'], 404);
        }

        $request->validate([
            'funcionario_id' => 'sometimes|exists:funcionarios,id',
            'licenca' => 'sometimes|string',
            'tempo_experiencia' => 'sometimes|integer',
            'data_validade' => 'sometimes|nullable|date',
            'categoria_licenca' => 'sometimes|nullable|string',
        ]);

        $maquinista->update($request->all());

        return response()->json($maquinista);
    }

    public function destroy($id)
    {
        $maquinista = Maquinista::find($id);

        if (!$maquinista) {
            return response()->json(['message' => 'Maquinista não encontrado'], 404);
        }

        $maquinista->delete();

        return response()->json(null, 204);
    }
}

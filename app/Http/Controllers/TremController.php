<?php

namespace App\Http\Controllers;

use App\Models\Trem;
use Illuminate\Http\Request;

class TremController extends Controller
{
    public function index()
    {
        return Trem::all();
    }

    public function show($id)
    {
        $trem = Trem::find($id);
        if (!$trem) {
            return response()->json(['message' => 'Trem não encontrado'], 404);
        }
        return $trem;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'ano_fabricacao' => 'nullable|integer',
            'velocidade_maxima' => 'nullable|numeric',
        ]);

        $trem = Trem::create($validated);
        return response()->json($trem, 201);
    }

    public function update(Request $request, $id)
    {
        $trem = Trem::find($id);
        if (!$trem) {
            return response()->json(['message' => 'Trem não encontrado'], 404);
        }

        $validated = $request->validate([
            'codigo' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|string|max:255',
            'ano_fabricacao' => 'nullable|integer',
            'velocidade_maxima' => 'nullable|numeric',
        ]);

        $trem->update($validated);
        return response()->json($trem);
    }

    public function destroy($id)
    {
        $trem = Trem::find($id);
        if (!$trem) {
            return response()->json(['message' => 'Trem não encontrado'], 404);
        }

        $trem->delete();
        return response()->json(['message' => 'Trem deletado com sucesso']);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use Illuminate\Http\Request;

class BilheteController extends Controller
{
    public function index()
    {
        $bilhetes = Bilhete::with(['passageiro', 'viagem'])->get();
        return response()->json($bilhetes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'passageiro_id' => 'required|exists:passageiros,id',
            'viagem_id' => 'required|exists:viagems,id',
            'assento' => 'required|string|max:10',
            'data_compra' => 'required|date',
            'preco' => 'nullable|numeric|min:0',
            'tipo' => 'sometimes|nullable|string|max:255',
        ]);

        $bilhete = Bilhete::create($request->all());
        return response()->json($bilhete, 201);
    }

    public function show($id)
    {
        $bilhete = Bilhete::with(['passageiro', 'viagem'])->find($id);

        if (!$bilhete) {
            return response()->json(['message' => 'Bilhete não encontrado'], 404);
        }

        return response()->json($bilhete);
    }

    public function update(Request $request, $id)
    {
        $bilhete = Bilhete::find($id);

        if (!$bilhete) {
            return response()->json(['message' => 'Bilhete não encontrado'], 404);
        }

        $request->validate([
            'passageiro_id' => 'sometimes|required|exists:passageiros,id',
            'viagem_id' => 'sometimes|required|exists:viagems,id',
            'assento' => 'sometimes|required|string|max:10',
            'data_compra' => 'sometimes|required|date',
            'preco' => 'sometimes|nullable|numeric|min:0',
            'tipo' => 'sometimes|nullable|string|max:255',
        ]);

        $bilhete->update($request->all());
        return response()->json($bilhete);
    }

    public function destroy($id)
    {
        $bilhete = Bilhete::find($id);

        if (!$bilhete) {
            return response()->json(['message' => 'Bilhete não encontrado'], 404);
        }

        $bilhete->delete();
        return response()->json(['message' => 'Bilhete excluído com sucesso']);
    }
}

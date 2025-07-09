<?php

namespace App\Http\Controllers;

use App\Models\Viagem;
use Illuminate\Http\Request;

class ViagemController extends Controller
{
    public function index()
    {
        $viagens = Viagem::with(['estacaoOrigem', 'estacaoDestino', 'trem'])->get();
        return response()->json($viagens);
    }

    public function store(Request $request)
    {
        $request->validate([
            'data_partida' => 'required|date',
            'data_chegada' => 'required|date|after_or_equal:data_partida',
            'estacao_origem_id' => 'required|exists:estacaos,id',
            'estacao_destino_id' => 'required|exists:estacaos,id|different:estacao_origem_id',
            'trem_id' => 'required|exists:trems,id',
        ]);

        $viagem = Viagem::create($request->all());
        return response()->json($viagem, 201);
    }

    public function show($id)
    {
        $viagem = Viagem::with(['estacaoOrigem', 'estacaoDestino', 'trem'])->find($id);

        if (!$viagem) {
            return response()->json(['message' => 'Viagem não encontrada'], 404);
        }

        return response()->json($viagem);
    }

    public function update(Request $request, $id)
    {
        $viagem = Viagem::find($id);

        if (!$viagem) {
            return response()->json(['message' => 'Viagem não encontrada'], 404);
        }

        $request->validate([
            'data_partida' => 'sometimes|required|date',
            'data_chegada' => 'sometimes|required|date|after_or_equal:data_partida',
            'estacao_origem_id' => 'sometimes|required|exists:estacaos,id',
            'estacao_destino_id' => 'sometimes|required|exists:estacaos,id|different:estacao_origem_id',
            'trem_id' => 'sometimes|required|exists:trems,id',
        ]);

        $viagem->update($request->all());
        return response()->json($viagem);
    }

    public function destroy($id)
    {
        $viagem = Viagem::find($id);

        if (!$viagem) {
            return response()->json(['message' => 'Viagem não encontrada'], 404);
        }

        $viagem->delete();
        return response()->json(['message' => 'Viagem excluída com sucesso']);
    }
}

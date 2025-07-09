<?php

namespace App\Http\Controllers;

use App\Models\ViagemOperacao;
use Illuminate\Http\Request;

class ViagemOperacaoController extends Controller
{
    public function index()
    {
        $operacoes = ViagemOperacao::with(['viagem', 'trem', 'maquinista'])->get();
        return response()->json($operacoes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'viagem_id' => 'required|exists:viagems,id',
            'trem_id' => 'required|exists:trems,id',
            'maquinista_id' => 'required|exists:maquinistas,id',
            'turno' => 'required|string|max:50',
            'observacoes' => 'nullable|string',
        ]);

        $operacao = ViagemOperacao::create($request->all());
        return response()->json($operacao, 201);
    }

    public function show($id)
    {
        $operacao = ViagemOperacao::with(['viagem', 'trem', 'maquinista'])->find($id);

        if (!$operacao) {
            return response()->json(['message' => 'Operação não encontrada'], 404);
        }

        return response()->json($operacao);
    }

    public function update(Request $request, $id)
    {
        $operacao = ViagemOperacao::find($id);

        if (!$operacao) {
            return response()->json(['message' => 'Operação não encontrada'], 404);
        }

        $request->validate([
            'viagem_id' => 'sometimes|exists:viagems,id',
            'trem_id' => 'sometimes|exists:trems,id',
            'maquinista_id' => 'sometimes|exists:maquinistas,id',
            'turno' => 'sometimes|string|max:50',
            'observacoes' => 'nullable|string',
        ]);

        $operacao->update($request->all());
        return response()->json($operacao);
    }

    public function destroy($id)
    {
        $operacao = ViagemOperacao::find($id);

        if (!$operacao) {
            return response()->json(['message' => 'Operação não encontrada'], 404);
        }

        $operacao->delete();
        return response()->json(['message' => 'Operação excluída com sucesso']);
    }
}

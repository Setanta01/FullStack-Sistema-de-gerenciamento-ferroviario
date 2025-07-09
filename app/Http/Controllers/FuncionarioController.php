<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index()
    {
        return response()->json(Funcionario::all());
    }

    public function show($id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        return response()->json($funcionario);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'cpf' => 'required|string|unique:funcionarios,cpf',
            'telefone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $funcionario = Funcionario::create($request->all());

        return response()->json($funcionario, 201);
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $request->validate([
            'nome' => 'sometimes|required|string',
            'cpf' => "sometimes|required|string|unique:funcionarios,cpf,{$id}",
            'telefone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $funcionario->update($request->all());

        return response()->json($funcionario);
    }

    public function destroy($id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json(['message' => 'Funcionário não encontrado'], 404);
        }

        $funcionario->delete();

        return response()->json(null, 204);
    }
}

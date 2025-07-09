<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Passageiro;
use Illuminate\Http\Request;

class PassageiroController extends Controller
{
    public function index()
    {
        return response()->json(Passageiro::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'documento' => 'required|string|unique:passageiros,documento',
            'telefone' => 'nullable|string',
            'email' => 'nullable|email'
        ]);

        $passageiro = Passageiro::create($request->all());
        return response()->json($passageiro, 201);
    }

    public function show($id)
    {
        $passageiro = Passageiro::find($id);

        if (!$passageiro) {
            return response()->json(['message' => 'Passageiro não encontrado'], 404);
        }

        return response()->json($passageiro);
    }

    public function update(Request $request, $id)
    {
        $passageiro = Passageiro::find($id);

        if (!$passageiro) {
            return response()->json(['message' => 'Passageiro não encontrado'], 404);
        }

        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'documento' => "sometimes|required|string|unique:passageiros,documento,$id",
            'telefone' => 'nullable|string',
            'email' => 'nullable|email'
        ]);

        $passageiro->update($request->all());
        return response()->json($passageiro);
    }

    public function destroy($id)
    {
        $passageiro = Passageiro::find($id);

        if (!$passageiro) {
            return response()->json(['message' => 'Passageiro não encontrado'], 404);
        }

        $passageiro->delete();
        return response()->json(['message' => 'Passageiro excluído com sucesso']);
    }



    public function inserirPassageiro(Request $request)
{
    $nome = $request->input('nome');
    $documento = $request->input('documento');
    $telefone = $request->input('telefone');
    $email = $request->input('email');

    DB::insert('INSERT INTO passageiros (nome, documento, telefone, email) VALUES (?, ?, ?, ?)', [
        $nome, $documento, $telefone, $email
    ]);

    return "Passageiro inserido com sucesso!";
}

public function removerPassageiro($id)
{
    DB::delete('DELETE FROM passageiros WHERE id = ?', [$id]);

    return "Passageiro removido com sucesso!";
}

public function atualizarPassageiro(Request $request, $id)
{
    $nome = $request->input('nome');
    $documento = $request->input('documento');
    $telefone = $request->input('telefone');
    $email = $request->input('email');

    DB::update('UPDATE passageiros SET nome = ?, documento = ?, telefone = ?, email = ? WHERE id = ?', [
        $nome, $documento, $telefone, $email, $id
    ]);

    return "Passageiro atualizado com sucesso!";
}

public function listarPassageiros()
{
    $passageiros = DB::select('SELECT * FROM passageiros');
    return response()->json($passageiros);
}

public function buscarPassageiro($id)
{
    $passageiro = DB::select('SELECT * FROM passageiros WHERE id = ?', [$id]);

    return response()->json($passageiro);
}

public function inserirPassageirosEmMassa(Request $request)
{
    $passageiros = $request->input('passageiros'); // deve ser um array de objetos

    foreach ($passageiros as $p) {
        DB::insert('INSERT INTO passageiros (nome, documento, telefone, email) VALUES (?, ?, ?, ?)', [
            $p['nome'],
            $p['documento'],
            $p['telefone'],
            $p['email']
        ]);
    }

    return response()->json(['mensagem' => 'Passageiros inseridos com sucesso!']);
}

public function buscarPorNome(Request $request)
{
    $substring = strtolower($request->input('nome'));

    $resultados = DB::select('
        SELECT * FROM passageiros 
        WHERE LOWER(nome) LIKE ?', ['%' . $substring . '%']
    );

    return response()->json($resultados);
}
}

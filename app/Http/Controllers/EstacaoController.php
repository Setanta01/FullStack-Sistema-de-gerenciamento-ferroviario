<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstacaoController extends Controller
{
    // Listar todas as estações
    public function index()
    {
        $estacoes = DB::select("SELECT * FROM estacaos");
        return response()->json($estacoes);
    }

    // Criar uma nova estação
    public function store(Request $request)
    {
        DB::insert(
            "INSERT INTO estacaos (nome, cidade, codigo_postal, capacidade_plataformas, created_at, updated_at)
             VALUES (?, ?, ?, ?, NOW(), NOW())",
            [
                $request->nome,
                $request->cidade,
                $request->codigo_postal,
                $request->capacidade_plataformas ?? 1
            ]
        );

        return response()->json(['message' => 'Estação criada com sucesso']);
    }

    // Mostrar uma estação específica
    public function show($id)
    {
        $estacao = DB::select("SELECT * FROM estacaos WHERE id = ?", [$id]);

        if (!$estacao) {
            return response()->json(['message' => 'Estação não encontrada'], 404);
        }

        return response()->json($estacao[0]);
    }

    // Atualizar uma estação existente
    public function update(Request $request, $id)
    {
        DB::update(
            "UPDATE estacaos SET nome = ?, cidade = ?, codigo_postal = ?, capacidade_plataformas = ?, updated_at = NOW()
             WHERE id = ?",
            [
                $request->nome,
                $request->cidade,
                $request->codigo_postal,
                $request->capacidade_plataformas ?? 1,
                $id
            ]
        );

        return response()->json(['message' => 'Estação atualizada com sucesso']);
    }

    // Remover uma estação
    public function destroy($id)
    {
        DB::delete("DELETE FROM estacaos WHERE id = ?", [$id]);

        return response()->json(['message' => 'Estação removida com sucesso']);
    }

    // Buscar estações por substring no nome (case-insensitive)
    public function search(Request $request)
    {
        $substring = strtolower($request->query('q'));

        $estacoes = DB::select(
            "SELECT * FROM estacaos WHERE LOWER(nome) LIKE ?",
            ["%$substring%"]
        );

        return response()->json($estacoes);
    }

    // Inserção em massa
    public function storeBatch(Request $request)
    {
        foreach ($request->estacoes as $estacao) {
            DB::insert(
                "INSERT INTO estacaos (nome, cidade, codigo_postal, capacidade_plataformas, created_at, updated_at)
                 VALUES (?, ?, ?, ?, NOW(), NOW())",
                [
                    $estacao['nome'],
                    $estacao['cidade'],
                    $estacao['codigo_postal'] ?? null,
                    $estacao['capacidade_plataformas'] ?? 1
                ]
            );
        }

        return response()->json(['message' => 'Estações inseridas em lote com sucesso']);
    }
}

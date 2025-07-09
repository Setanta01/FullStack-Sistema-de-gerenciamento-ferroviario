<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
  
    public function mediaPrecoPorPassageiro()
    {
        $dados = DB::select("
            SELECT p.id, p.nome, ROUND(AVG(b.preco), 2) AS media_preco
            FROM passageiros p
            JOIN bilhetes b ON b.passageiro_id = p.id
            GROUP BY p.id, p.nome
            HAVING AVG(b.preco) > 0
        ");

        return response()->json($dados);
    }

   
    public function listarBilhetesComPassageiros()
    {
        $dados = DB::select("
            SELECT b.id AS bilhete_id, p.nome AS passageiro, v.id AS viagem_id, b.assento, b.preco
            FROM bilhetes b
            JOIN passageiros p ON b.passageiro_id = p.id
            JOIN viagems v ON b.viagem_id = v.id
            ORDER BY b.id ASC
        ");

        return response()->json($dados);
    }

   
    public function viagensComBilhetesMaisCaros()
    {
        $dados = DB::select("
            SELECT v.id, v.data_partida, v.data_chegada
            FROM viagems v
            WHERE EXISTS (
                SELECT 1 FROM bilhetes b1
                WHERE b1.viagem_id = v.id
                  AND b1.preco > ALL (
                      SELECT b2.preco FROM bilhetes b2
                      WHERE b2.viagem_id != v.id
                  )
            )
        ");

        return response()->json($dados);
    }

    
    public function passageirosComBilhetesMaisBaratos()
    {
        $dados = DB::select("
            SELECT DISTINCT p.id, p.nome
            FROM passageiros p
            JOIN bilhetes b ON b.passageiro_id = p.id
            WHERE b.preco < ANY (
                SELECT preco FROM bilhetes WHERE passageiro_id != p.id
            )
        ");

        return response()->json($dados);
    }

    
    public function listarViagensOrdenadas(Request $request)
    {
        $ordem = $request->query('ordem', 'asc'); // padrão asc
        $ordem = strtolower($ordem) === 'desc' ? 'desc' : 'asc';

        $dados = DB::select("
            SELECT id, data_partida, data_chegada
            FROM viagems
            ORDER BY data_partida $ordem
        ");

        return response()->json($dados);
    }

     public function bilhetesMaisCarosPorViagem()
    {
        $bilhetes = DB::select("
            SELECT b1.*
            FROM bilhetes b1
            WHERE b1.preco > ALL (
                SELECT b2.preco
                FROM bilhetes b2
                WHERE b2.viagem_id = b1.viagem_id
                  AND b2.id != b1.id
            )
        ");

        return response()->json($bilhetes);
    }


    public function passageirosComBilheteMaisBarato()
    {
        $passageiros = DB::select("
            SELECT DISTINCT p.*
            FROM passageiros p
            JOIN bilhetes b1 ON b1.passageiro_id = p.id
            WHERE b1.preco < ANY (
                SELECT b2.preco
                FROM bilhetes b2
                WHERE b2.viagem_id = b1.viagem_id
                  AND b2.id != b1.id
            )
        ");

        return response()->json($passageiros);
    }

    public function passageirosComMaisDeUmBilhete()
{
    $resultados = DB::select("
        SELECT p.nome, COUNT(b.id) AS total_bilhetes
        FROM passageiros p
        JOIN bilhetes b ON b.passageiro_id = p.id
        GROUP BY p.nome
        HAVING COUNT(b.id) > 1
    ");

    return response()->json($resultados);
}

public function ordenarTrensPorQtdViagens($ordem = 'desc')
{
    $ordem = strtolower($ordem) === 'asc' ? 'ASC' : 'DESC';

    $resultados = DB::select("
        SELECT t.codigo, COUNT(v.id) AS total_viagems
        FROM trems t
        LEFT JOIN viagems v ON v.trem_id = t.id
        GROUP BY t.codigo
        ORDER BY total_viagems $ordem
    ");

    return response()->json($resultados);
}

 public function criarTriggerLogBilhetes()
    {
        $sqlTabelaLog = "
            CREATE TABLE IF NOT EXISTS log_bilhetes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                bilhete_id INT,
                passageiro_id INT,
                data_compra DATE,
                criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";

        $sqlTrigger = "
            DROP TRIGGER IF EXISTS trg_log_bilhetes_insercao;

            CREATE TRIGGER trg_log_bilhetes_insercao
            AFTER INSERT ON bilhetes
            FOR EACH ROW
            BEGIN
                INSERT INTO log_bilhetes (bilhete_id, passageiro_id, data_compra)
                VALUES (NEW.id, NEW.passageiro_id, NEW.data_compra);
            END;
        ";

        try {
            DB::unprepared($sqlTabelaLog);
            DB::unprepared($sqlTrigger);
            return response()->json(['mensagem' => 'Trigger criada com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['erro' => $e->getMessage()], 500);
        }
    }

    
}

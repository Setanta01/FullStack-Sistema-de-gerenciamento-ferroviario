<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstacaoController;
use App\Http\Controllers\TremController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MaquinistaController;
use App\Http\Controllers\PassageiroController;
use App\Http\Controllers\ViagemController;
use App\Http\Controllers\BilheteController;
use App\Http\Controllers\ViagemOperacaoController;
use App\Http\Controllers\RelatorioController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/estacoes', [EstacaoController::class, 'index']);
Route::get('/estacoes/{id}', [EstacaoController::class, 'show']);
Route::post('/estacoes', [EstacaoController::class, 'store']);
Route::put('/estacoes/{id}', [EstacaoController::class, 'update']);
Route::delete('/estacoes/{id}', [EstacaoController::class, 'destroy']);
Route::get('/estacoes-search', [EstacaoController::class, 'search']);
Route::post('/estacoes-batch', [EstacaoController::class, 'batchInsert']);
Route::get('/trems', [TremController::class, 'index']);
Route::get('/trems/{id}', [TremController::class, 'show']);
Route::post('/trems', [TremController::class, 'store']);
Route::put('/trems/{id}', [TremController::class, 'update']);
Route::delete('/trems/{id}', [TremController::class, 'destroy']);
Route::get('/funcionarios', [FuncionarioController::class, 'index']);
Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show']);
Route::post('/funcionarios', [FuncionarioController::class, 'store']);
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update']);
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy']);
Route::apiResource('maquinistas', MaquinistaController::class);
Route::apiResource('passageiros', PassageiroController::class);
Route::apiResource('viagens', ViagemController::class);
Route::apiResource('bilhetes', BilheteController::class);
Route::apiResource('viagem-operacoes', ViagemOperacaoController::class);
Route::get('/relatorio/media-preco-por-passageiro', [RelatorioController::class, 'mediaPrecoPorPassageiro']);
Route::get('/relatorio/media-preco-por-passageiro', [RelatorioController::class, 'mediaPrecoPorPassageiro']);
Route::get('/relatorio/bilhetes-com-passageiros', [RelatorioController::class, 'listarBilhetesComPassageiros']);
Route::get('/relatorio/viagens-bilhetes-caros', [RelatorioController::class, 'viagensComBilhetesMaisCaros']);
Route::get('/relatorio/passageiros-baratos', [RelatorioController::class, 'passageirosComBilhetesMaisBaratos']);
Route::get('/relatorio/viagens-ordenadas', [RelatorioController::class, 'listarViagensOrdenadas']);
Route::get('/relatorio/passageiros-com-varios-bilhetes', [RelatorioController::class, 'passageirosComMaisDeUmBilhete']);
Route::get('/relatorio/ordenar-trens/{ordem?}', [RelatorioController::class, 'ordenarTrensPorQtdViagens']);
Route::get('/criar-trigger-log-bilhetes', [RelatorioController::class, 'criarTriggerLogBilhetes']);

Route::get('/passageiros/nome/buscar', [PassageiroController::class, 'buscarPorNome']);
Route::get('/passageiros/buscarid/{id}', [PassageiroController::class, 'buscarPassageiro']);
Route::post('/passageiros/inserir', [PassageiroController::class, 'inserirPassageiro']);
Route::put('/passageiros/atualizar/{id}', [PassageiroController::class, 'atualizarPassageiro']);
Route::delete('/passageiros/remover/{id}', [PassageiroController::class, 'removerPassageiro']);
Route::post('/passageiros/insercao-massa', [PassageiroController::class, 'inserirPassageirosEmMassa']);
Route::get('/passageiros', [PassageiroController::class, 'listarPassageiros']);
Route::apiResource('passageiros', PassageiroController::class);
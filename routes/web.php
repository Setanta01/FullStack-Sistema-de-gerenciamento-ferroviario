<?php

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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('painel');
});
Route::get('/estacoes', [EstacaoController::class, 'index']);
Route::get('/estacoes/{id}', [EstacaoController::class, 'show']);
Route::post('/estacoes', [EstacaoController::class, 'store']);
Route::put('/estacoes/{id}', [EstacaoController::class, 'update']);
Route::delete('/estacoes/{id}', [EstacaoController::class, 'destroy']);
Route::get('/estacoes-search', [EstacaoController::class, 'search']);
Route::post('/estacoes-batch', [EstacaoController::class, 'storeBatch']);
Route::get('/trems', [TremController::class, 'index'])->name('trems.index');
Route::get('/trems/{id}', [TremController::class, 'show'])->name('trems.show');
Route::post('/trems', [TremController::class, 'store'])->name('trems.store');
Route::put('/trems/{id}', [TremController::class, 'update'])->name('trems.update');
Route::delete('/trems/{id}', [TremController::class, 'destroy'])->name('trems.destroy');
Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show'])->name('funcionarios.show');
Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');
Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');
Route::resource('maquinistas', MaquinistaController::class);
Route::resource('passageiros', PassageiroController::class);
Route::resource('viagens', ViagemController::class);
Route::resource('bilhetes', BilheteController::class);
Route::resource('viagem-operacoes', ViagemOperacaoController::class);

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

// ✅ DEPOIS DISSO, PODE VIR O RESOURCE
Route::resource('passageiros', PassageiroController::class);




Route::view('/relatorios', 'relatorios');
Route::view('/passageiros', 'passageiros');
Route::view('/paineldois', 'paineldois');
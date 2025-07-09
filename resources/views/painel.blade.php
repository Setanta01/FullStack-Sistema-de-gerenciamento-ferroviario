<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador Ferroviário</title>
</head>
<body>
    <h1>🚆 Painel de Gerenciamento Ferroviário</h1>

    <section>
        <h2>Estações</h2>
        <form action="/estacoes" method="POST">
            @csrf
            Nome: <input type="text" name="nome"><br>
            Cidade: <input type="text" name="cidade"><br>
            Código Postal: <input type="text" name="codigo_postal"><br>
            Capacidade Plataformas: <input type="number" name="capacidade_plataformas"><br>
            <button type="submit">Criar Estação</button>
        </form>
        <a href="/estacoes">Listar Estações</a>
    </section>

    <section>
        <h2>Trens</h2>
        <form action="/trems" method="POST">
            @csrf
            Código: <input type="text" name="codigo"><br>
            Tipo: <input type="text" name="tipo"><br>
            Ano de Fabricação: <input type="number" name="ano_fabricacao"><br>
            Velocidade Máxima: <input type="number" name="velocidade_maxima"><br>
            <button type="submit">Criar Trem</button>
        </form>
    </section>

    <section>
        <h2>Funcionários</h2>
        <form action="/funcionarios" method="POST">
            @csrf
            Nome: <input type="text" name="nome"><br>
            CPF: <input type="text" name="cpf"><br>
            Telefone: <input type="text" name="telefone"><br>
            Email: <input type="email" name="email"><br>
            <button type="submit">Criar Funcionário</button>
        </form>
        <a href="/funcionarios">Listar Funcionários</a>
    </section>

    <section>
        <h2>Maquinistas</h2>
        <form action="/maquinistas" method="POST">
            @csrf
            ID Funcionário: <input type="number" name="funcionario_id"><br>
            Licença: <input type="text" name="licenca"><br>
            Experiência (anos): <input type="number" name="tempo_experiencia"><br>
            Data de validade: <input type="datetime-local" name="data_validade"><br>
            Licença: <input type="text" name="categoria_licenca"><br>
            <button type="submit">Criar Maquinista</button>
        </form>
        <a href="/maquinistas">Listar Maquinistas</a>
    </section>

    <section>
        <h2>Passageiros</h2>
        <form action="/passageiros" method="POST">
            @csrf
            Nome: <input type="text" name="nome"><br>
            Documento: <input type="text" name="documento"><br>
            Telefone: <input type="text" name="telefone"><br>
            Email: <input type="email" name="email"><br>
            <button type="submit">Criar Passageiro</button>
        </form>
        <a href="/passageiros">Painel Passageiros</a>
    </section>

    <section>
        <h2>Viagens</h2>
        <form action="/viagens" method="POST">
            @csrf
            Data Partida: <input type="datetime-local" name="data_partida"><br>
            Data Chegada: <input type="datetime-local" name="data_chegada"><br>
            Estação Origem ID: <input type="number" name="estacao_origem_id"><br>
            Estação Destino ID: <input type="number" name="estacao_destino_id"><br>
            Trem ID: <input type="number" name="trem_id"><br>
            <button type="submit">Criar Viagem</button>
        </form>
        <a href="/viagens">Listar Viagens</a>
    </section>

    <section>
        <h2>Bilhetes</h2>
        <form action="/bilhetes" method="POST">
            @csrf
            Passageiro ID: <input type="number" name="passageiro_id"><br>
            Viagem ID: <input type="number" name="viagem_id"><br>
            Assento: <input type="text" name="assento"><br>
            Data Compra: <input type="date" name="data_compra"><br>
            Preço: <input type="number" name="preco" step="0.01"><br>
            Tipo: <input type="text" name="tipo"><br>
            <button type="submit">Emitir Bilhete</button>
        </form>
        <a href="/bilhetes">Listar Bilhetes</a>
    </section>

    <section>
        <h2>Operações de Viagem</h2>
        <form action="/viagem-operacoes" method="POST">
            @csrf
            Viagem ID: <input type="number" name="viagem_id"><br>
            Trem ID: <input type="number" name="trem_id"><br>
            Maquinista ID: <input type="number" name="maquinista_id"><br>
            Turno: <input type="text" name="turno"><br>
            Observações: <input type="text" name="observacoes"><br>
            <button type="submit">Registrar Operação</button>
        </form>
        <a href="/viagem-operacoes">Listar Operações</a>
    </section>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatórios da Malha Ferroviária</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        h1, h2 { color: #333; }
        button { margin: 5px 0; padding: 8px 16px; border: none; background: #007BFF; color: white; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        pre { background: #f0f0f0; padding: 12px; border-radius: 6px; max-height: 500px; overflow: auto; }
    </style>
</head>
<body>

    <h1>Relatórios da Malha Ferroviária</h1>

    <section>
        <h2>Consultas</h2>

        <button onclick="buscar('/api/relatorio/media-preco-por-passageiro')">Média de preço por passageiro</button>
        <button onclick="buscar('/api/relatorio/bilhetes-com-passageiros')">Bilhetes com passageiros</button>
        <button onclick="buscar('/api/relatorio/viagens-bilhetes-caros')">Viagens com bilhetes mais caros</button>
        <button onclick="buscar('/api/relatorio/passageiros-baratos')">Passageiros com bilhetes mais baratos</button>
        <button onclick="buscar('/api/relatorio/viagens-ordenadas?ordem=desc')">Viagens ordenadas por data (DESC)</button>
        <button onclick="buscar('/api/relatorio/viagens-ordenadas?ordem=asc')">Viagens ordenadas por data (ASC)</button>
        <button onclick="buscar('/api/relatorio/passageiros-com-varios-bilhetes')">Passageiros com vários bilhetes</button>
        <button onclick="buscar('/api/relatorio/ordenar-trens/desc')">Trens por número de viagens (DESC)</button>
        <button onclick="buscar('/api/relatorio/ordenar-trens/asc')">Trens por número de viagens (ASC)</button>
    </section>

    <section>
        <h2>Outras Ações</h2>
        <button onclick="criarTrigger()">Criar Trigger de Log de Bilhetes</button>
    </section>

    <h2>Resultado:</h2>
    <pre id="resultado">Clique em um botão para ver o resultado aqui.</pre>

    <script>
        async function buscar(endpoint) {
            try {
                const resposta = await fetch(endpoint);
                const dados = await resposta.json();
                document.getElementById('resultado').textContent = JSON.stringify(dados, null, 2);
            } catch (erro) {
                document.getElementById('resultado').textContent = 'Erro: ' + erro.message;
            }
        }

        async function criarTrigger() {
            try {
                const resposta = await fetch('/api/criar-trigger-log-bilhetes');
                const dados = await resposta.json();
                document.getElementById('resultado').textContent = JSON.stringify(dados, null, 2);
            } catch (erro) {
                document.getElementById('resultado').textContent = 'Erro ao criar trigger: ' + erro.message;
            }
        }
    </script>

</body>
</html>

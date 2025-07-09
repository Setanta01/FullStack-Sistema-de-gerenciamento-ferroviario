<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Passageiros</title>
    <script>
        const apiUrl = 'http://localhost:8000/api/passageiros';

        async function listarPassageiros() {
            const res = await fetch(`${apiUrl}`);
            const passageiros = await res.json();
            document.getElementById('resultado').textContent = JSON.stringify(passageiros, null, 2);
        }

        async function inserirPassageiro() {
            const body = {
                nome: document.getElementById('nome').value,
                documento: document.getElementById('documento').value,
                telefone: document.getElementById('telefone').value,
                email: document.getElementById('email').value,
            };

            const res = await fetch(`${apiUrl}/inserir`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body)
            });

            const data = await res.text();
            alert(data);
            listarPassageiros();
        }

        async function removerPassageiro() {
            const id = document.getElementById('id').value;
            const res = await fetch(`${apiUrl}/remover/${id}`, {
                method: 'DELETE'
            });

            const data = await res.text();
            alert(data);
            listarPassageiros();
        }

        async function atualizarPassageiro() {
            const id = document.getElementById('id').value;
            const body = {
                nome: document.getElementById('nome').value,
                documento: document.getElementById('documento').value,
                telefone: document.getElementById('telefone').value,
                email: document.getElementById('email').value,
            };

            const res = await fetch(`${apiUrl}/atualizar/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body)
            });

            const data = await res.text();
            alert(data);
            listarPassageiros();
        }

        async function buscarPorId() {
            const id = document.getElementById('id').value;
            const res = await fetch(`${apiUrl}/buscarid/${id}`);
            const passageiro = await res.json();
            document.getElementById('resultado').textContent = JSON.stringify(passageiro, null, 2);
        }

        async function buscarPorNome() {
            const nome = document.getElementById('nome').value;
            const res = await fetch(`${apiUrl}/nome/buscar?nome=${nome}`);
            const resultados = await res.json();
            document.getElementById('resultado').textContent = JSON.stringify(resultados, null, 2);
        }

        async function inserirEmMassa() {
            try {
                const jsonText = document.getElementById('jsonMassa').value;
                const passageiros = JSON.parse(jsonText);

                const res = await fetch(`${apiUrl}/insercao-massa`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ passageiros })
                });

                const data = await res.json();
                alert(data.mensagem);
                listarPassageiros();
            } catch (e) {
                alert("Erro ao interpretar o JSON! Verifique o formato.");
            }
        }
    </script>
</head>
<body>
    <h1>Gerenciador de Passageiros</h1>

    <label>ID: <input type="number" id="id" /></label><br>
    <label>Nome: <input type="text" id="nome" /></label><br>
    <label>Documento: <input type="text" id="documento" /></label><br>
    <label>Telefone: <input type="text" id="telefone" /></label><br>
    <label>Email: <input type="text" id="email" /></label><br><br>

    <label>JSON Passageiros em Massa:</label><br>
    <textarea id="jsonMassa" rows="6" cols="80">[
        { "nome": "Ana", "documento": "111", "telefone": "111111", "email": "ana@email.com" },
        { "nome": "Bruno", "documento": "222", "telefone": "222222", "email": "bruno@email.com" }
    ]</textarea><br><br>


    <button onclick="listarPassageiros()">Listar Passageiros</button>
    <button onclick="inserirPassageiro()">Inserir Passageiro</button>
    <button onclick="removerPassageiro()">Remover Passageiro</button>
    <button onclick="atualizarPassageiro()">Atualizar Passageiro</button>
    <button onclick="buscarPorId()">Buscar por ID</button>
    <button onclick="buscarPorNome()">Buscar por Nome</button>
    <button onclick="inserirEmMassa()">Inserir Em Massa</button>

    <h2>Resultado:</h2>
    <pre id="resultado"></pre>
</body>
</html>

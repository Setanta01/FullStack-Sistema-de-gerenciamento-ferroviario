<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gerenciador Ferroviário - CRUD</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    h2 { margin-top: 40px; }
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { background-color: #f4f4f4; }
    input { width: 95%; }
    button { margin: 4px; padding: 6px 12px; }
  </style>
</head>
<body>
  <h1>Gerenciador Ferroviário</h1>
  <div id="containers"></div>

  <script>
    const entidades = [
      { key: 'estacoes', name: 'Estações', fields: ['nome','cidade','codigo_postal','capacidade_plataformas'] },
      { key: 'trems', name: 'Trens', fields: ['codigo','tipo','ano_fabricacao','velocidade_maxima'] },
      { key: 'funcionarios', name: 'Funcionários', fields: ['nome','cpf','telefone','email'] },
      { key: 'maquinistas', name: 'Maquinistas', fields: ['funcionario_id','licenca','tempo_experiencia', 'data_validade', 'categoria_licenca'] },
      { key: 'passageiros', name: 'Passageiros', fields: ['nome','documento','telefone','email'] },
      { key: 'viagens', name: 'Viagens', fields: ['data_partida','data_chegada','estacao_origem_id','estacao_destino_id','trem_id'] },
      { key: 'bilhetes', name: 'Bilhetes', fields: ['passageiro_id','viagem_id','assento','data_compra','preco','tipo'] },
      { key: 'viagem-operacoes', name: 'Operações de Viagem', fields: ['viagem_id','trem_id','maquinista_id','turno','observacoes'] },
    ];

    async function init() {
      const container = document.getElementById('containers');
      for (const ent of entidades) {
        const div = document.createElement('div');
        div.innerHTML = `<h2>${ent.name}</h2><table id="${ent.key}-table"><thead></thead><tbody></tbody></table>`;
        container.appendChild(div);
        await loadEntity(ent);
      }
    }

    async function loadEntity(ent) {
      const res = await fetch(`/api/${ent.key}`);
      const data = await res.json();
      const table = document.getElementById(`${ent.key}-table`);
      const thead = table.querySelector('thead');
      const tbody = table.querySelector('tbody');

      thead.innerHTML = `
        <tr>
          <th>ID</th>
          ${ent.fields.map(f => `<th>${f}</th>`).join('')}
          <th>Ações</th>
        </tr>`;

      tbody.innerHTML = '';
      for (const item of data) {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.id}</td>
          ${ent.fields.map(f => `<td><input name="${f}" value="${item[f] ?? ''}"></td>`).join('')}
          <td>
            <button onclick="atualizar('${ent.key}', ${item.id}, this)">Atualizar</button>
            <button onclick="excluir('${ent.key}', ${item.id})">Excluir</button>
          </td>`;
        tbody.appendChild(tr);
      }
    }

    async function atualizar(key, id, btn) {
      const tr = btn.closest('tr');
      const inputs = Array.from(tr.querySelectorAll('input'));
      const payload = {};
      inputs.forEach(input => payload[input.name] = input.value);
      const res = await fetch(`/api/${key}/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type':'application/json' },
        body: JSON.stringify(payload)
      });
      if (res.ok) {
        alert(`${key} (ID ${id}) atualizado com sucesso!`);
        loadEntity(entidades.find(e => e.key === key));
      } else {
        const err = await res.json();
        alert(`Erro ao atualizar: ${err.message || res.statusText}`);
      }
    }

    async function excluir(key, id) {
      if (!confirm(`Confirma exclusão de ${key} ID ${id}?`)) return;
      const res = await fetch(`/api/${key}/${id}`, { method: 'DELETE' });
      if (res.ok) {
        alert(`${key} (ID ${id}) excluído com sucesso!`);
        loadEntity(entidades.find(e => e.key === key));
      } else {
        const err = await res.json();
        alert(`Erro ao excluir: ${err.message || res.statusText}`);
      }
    }

    document.addEventListener('DOMContentLoaded', init);
  </script>
</body>
</html>

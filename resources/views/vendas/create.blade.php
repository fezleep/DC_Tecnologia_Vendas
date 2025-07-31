@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cadastrar Nova Venda</h2>

    <form action="{{ route('vendas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" class="form-select">
                <option value="">-- Nenhum --</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <input type="text" name="forma_pagamento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Itens da Venda</label>
            <div id="itens">
                <div class="row mb-2">
                    <div class="col"><input type="text" name="itens[0][descricao]" class="form-control" placeholder="Descrição" required></div>
                    <div class="col"><input type="number" name="itens[0][quantidade]" class="form-control" placeholder="Qtd" required></div>
                    <div class="col"><input type="number" step="0.01" name="itens[0][preco]" class="form-control" placeholder="Preço" required></div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addItem()">Adicionar Item</button>
        </div>

        <div class="mb-3">
            <label>Parcelas (opcional)</label>
            <div id="parcelas"></div>
            <button type="button" class="btn btn-secondary" onclick="addParcela()">Adicionar Parcela</button>
        </div>

        <div class="mb-3">
            <label for="valor_total" class="form-label">Valor Total</label>
            <input type="number" name="valor_total" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>

<script>
let itemIndex = 1;
function addItem() {
    const container = document.getElementById('itens');
    container.innerHTML += `
    <div class="row mb-2">
        <div class="col"><input type="text" name="itens[${itemIndex}][descricao]" class="form-control" placeholder="Descrição" required></div>
        <div class="col"><input type="number" name="itens[${itemIndex}][quantidade]" class="form-control" placeholder="Qtd" required></div>
        <div class="col"><input type="number" step="0.01" name="itens[${itemIndex}][preco]" class="form-control" placeholder="Preço" required></div>
    </div>`;
    itemIndex++;
}

let parcelaIndex = 0;
function addParcela() {
    const container = document.getElementById('parcelas');
    container.innerHTML += `
    <div class="row mb-2">
        <div class="col"><input type="number" step="0.01" name="parcelas[${parcelaIndex}][valor]" class="form-control" placeholder="Valor" required></div>
        <div class="col"><input type="date" name="parcelas[${parcelaIndex}][data_vencimento]" class="form-control" required></div>
    </div>`;
    parcelaIndex++;
}
</script>
@endsection

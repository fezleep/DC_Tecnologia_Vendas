@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Venda</h2>

    <form action="{{ route('vendas.update', $venda) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Cliente</label>
            <select name="cliente_id" class="form-select">
                <option value="">-- Nenhum --</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $venda->cliente_id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Forma de Pagamento</label>
            <input type="text" name="forma_pagamento" class="form-control" value="{{ $venda->forma_pagamento }}" required>
        </div>

        <div class="mb-3">
            <label>Itens</label>
            @foreach ($venda->itens as $i => $item)
                <div class="row mb-2">
                    <div class="col"><input type="text" name="itens[{{ $i }}][descricao]" class="form-control" value="{{ $item->descricao_produto }}" required></div>
                    <div class="col"><input type="number" name="itens[{{ $i }}][quantidade]" class="form-control" value="{{ $item->quantidade }}" required></div>
                    <div class="col"><input type="number" name="itens[{{ $i }}][preco]" class="form-control" value="{{ $item->preco_unitario }}" required></div>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Parcelas</label>
            @foreach ($venda->parcelas as $i => $parcela)
                <div class="row mb-2">
                    <div class="col"><input type="number" name="parcelas[{{ $i }}][valor]" class="form-control" value="{{ $parcela->valor }}" required></div>
                    <div class="col"><input type="date" name="parcelas[{{ $i }}][data_vencimento]" class="form-control" value="{{ $parcela->data_vencimento }}" required></div>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Valor Total</label>
            <input type="number" step="0.01" name="valor_total" class="form-control" value="{{ $venda->valor_total }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection

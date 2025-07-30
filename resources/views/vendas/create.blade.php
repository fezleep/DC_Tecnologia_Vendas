@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Venda</h1>

    <form method="POST" action="{{ route('vendas.store') }}">
        @csrf

        <!-- Cliente -->
        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente (opcional)</label>
            <input type="text" name="cliente_nome" class="form-control" placeholder="Nome do cliente">
        </div>

        <!-- Forma de pagamento -->
        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <select name="forma_pagamento" class="form-control">
                <option value="Dinheiro">Dinheiro</option>
                <option value="Pix">Pix</option>
                <option value="Cartão de Crédito">Cartão de Crédito</option>
            </select>
        </div>

        <!-- Itens e parcelas entrarão depois -->

        <button type="submit" class="btn btn-success">Salvar Venda</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Vendas</h2>

    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Nova Venda</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Forma de Pagamento</th>
                <th>Valor Total</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->cliente->nome ?? 'N/A' }}</td>
                    <td>{{ $venda->forma_pagamento }}</td>
                    <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                    <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('vendas.edit', $venda) }}" class="btn btn-sm btn-warning">Editar</a>
                        <a href="{{ route('vendas.pdf', $venda) }}" class="btn btn-sm btn-secondary" target="_blank">PDF</a>
                        <form action="{{ route('vendas.destroy', $venda) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Tem certeza?')" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $vendas->links() }}
</div>
@endsection

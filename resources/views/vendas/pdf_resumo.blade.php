<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resumo da Venda</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td, th { border: 1px solid #000; padding: 5px; }
    </style>
</head>
<body>
    <h2>Resumo da Venda #{{ $venda->id }}</h2>

    <p><strong>Cliente:</strong> {{ $venda->cliente->nome ?? 'N/A' }}</p>
    <p><strong>Forma de Pagamento:</strong> {{ $venda->forma_pagamento }}</p>
    <p><strong>Data:</strong> {{ $venda->created_at->format('d/m/Y') }}</p>
    <p><strong>Vendedor:</strong> {{ $venda->user->name }}</p>

    <h4>Itens</h4>
    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Preço</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venda->itens as $item)
                <tr>
                    <td>{{ $item->descricao_produto }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Parcelas</h4>
    <table>
        <thead>
            <tr>
                <th>Valor</th>
                <th>Vencimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($venda->parcelas as $parcela)
                <tr>
                    <td>R$ {{ number_format($parcela->valor, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($parcela->data_vencimento)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total:</strong> R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</p>
</body>
</html>

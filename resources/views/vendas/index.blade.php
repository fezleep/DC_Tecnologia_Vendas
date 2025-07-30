@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vendas</h1>
    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-3">Nova Venda</a>

    <!-- Aqui vai a tabela futuramente -->
    <p>Listagem de vendas vai aqui.</p>
</div>
@endsection

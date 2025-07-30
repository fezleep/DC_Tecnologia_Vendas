<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\ItemVenda;
use App\Models\Parcela;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $vendas = Venda::with(['cliente', 'user'])
            ->when($request->cliente_id, fn($q) => $q->where('cliente_id', $request->cliente_id))
            ->when($request->data_inicio && $request->data_fim, fn($q) => $q->whereBetween('created_at', [$request->data_inicio, $request->data_fim]))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        return view('vendas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'forma_pagamento' => 'required|string',
            'valor_total' => 'required|numeric',
            'itens' => 'required|array',
            'itens.*.descricao' => 'required|string',
            'itens.*.quantidade' => 'required|integer',
            'itens.*.preco' => 'required|numeric',
            'parcelas' => 'nullable|array',
        ]);

        $venda = Auth::user()->vendas()->create([
            'cliente_id' => $request->cliente_id,
            'forma_pagamento' => $request->forma_pagamento,
            'valor_total' => $request->valor_total,
        ]);

        foreach ($request->itens as $item) {
            ItemVenda::create([
                'venda_id' => $venda->id,
                'descricao_produto' => $item['descricao'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
                'subtotal' => $item['quantidade'] * $item['preco'],
            ]);
        }

        if ($request->has('parcelas')) {
            foreach ($request->parcelas as $parcela) {
                Parcela::create([
                    'venda_id' => $venda->id,
                    'valor' => $parcela['valor'],
                    'data_vencimento' => $parcela['data_vencimento'],
                    'pago' => false,
                ]);
            }
        }

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso.');
    }

    public function edit(Venda $venda)
    {
        $clientes = Cliente::all();
        $venda->load('itens', 'parcelas');
        return view('vendas.edit', compact('venda', 'clientes'));
    }

    public function update(Request $request, Venda $venda)
    {
        $venda->update($request->only(['cliente_id', 'forma_pagamento', 'valor_total']));

        $venda->itens()->delete();
        foreach ($request->itens as $item) {
            ItemVenda::create([
                'venda_id' => $venda->id,
                'descricao_produto' => $item['descricao'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
                'subtotal' => $item['quantidade'] * $item['preco'],
            ]);
        }

        $venda->parcelas()->delete();
        foreach ($request->parcelas as $parcela) {
            Parcela::create([
                'venda_id' => $venda->id,
                'valor' => $parcela['valor'],
                'data_vencimento' => $parcela['data_vencimento'],
                'pago' => false,
            ]);
        }

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso.');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda excluída.');
    }

    public function downloadPdf(Venda $venda)
    {
        $venda->load('cliente', 'user', 'itens', 'parcelas');
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('vendas.pdf_resumo', compact('venda'));
        return $pdf->download('resumo_venda_' . $venda->id . '.pdf');
    }
}

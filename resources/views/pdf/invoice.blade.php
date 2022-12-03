@extends('layouts.pdf')

@section('style')
    <style>
        .header-invoice{
            margin: 5px 0;
        }
        .header-content{
            padding: 3px;
            margin-bottom: 3px;
        }
    </style>
@endsection

@section('title', "FACTURA")
    
@section('content')
<header class="header-invoice">
    <div class="header-date">
        <small>
            <i>Data da compra: {{ date('d-m-Y H:m', strtotime($invoice->created_at)) }}</i>
        </small>
    </div>
    <div class="header-content mb-3 border p-3">
        <p><strong>Cliente:</strong> {{ $invoice->user->name }}</p>
        <p>
            <strong>Endereco:</strong> 
            {{ $invoice->address->province->name }} | {{ $invoice->address->muni }} | {{ $invoice->address->bairro }} | Rua: {{ $invoice->address->rua }}
        </p>
        <p>
            <strong>Telefone - 1:</strong>
            <span>+244 {{ $invoice->user->phones[0]->number }}</span>&nbsp;|&nbsp;
            <strong>Telefone - 2:</strong>
            <span>+244 {{ $invoice->user->phones[1]->number }}</span>
        </p>
    </div>
</header>

<table border style="width: 100%; text-align:left;">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Preco Unitario</th>
            <th>Quantidade</th>
            <th>Preco total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoice->shop as $invoice)
            <tr>
                <td>{{ $invoice->product->name }} {{ $invoice->product->brand }}</td>
                <td>{{ $invoice->product->price }} kz(s)</td>
                <td>{{ $invoice->quantity }}</td>
                <td>{{ $invoice->total }} kz(s)</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><h3>Total pago</h3></td>
            <td>{{ $total }} kz(s)</td>
        </tr>
    </tbody>
</table>
@endsection
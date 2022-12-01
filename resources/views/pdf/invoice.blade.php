@extends('layouts.pdf')

@section('style')
    <style>
        .header-invoice{
            margin: 5px 0;
        }
        .header-content h3 span{
            font-size: 1.25rem;
        }
    </style>
@endsection

@section('title', "FACTURA . {$invoice->user->name}")
    
@section('content')
<header class="header-invoice">
    <div class="header-content">
        <small>
            <i>Data da compra: {{ date('d-m-Y H:m', strtotime($invoice->created_at)) }}</i>
        </small>
    </div>
</header>

<table border style="width: 100%; text-align:left;">
    <thead>
        <th>Produto</th>
        <th>Preco Unitario</th>
        <th>Quantidade</th>
        <th>Preco total</th>
    </thead>
    <tbody>
        @foreach ($invoice->shop as $item)
            <tr>
                <td>{{ $item->product->name }} {{ $item->product->brand }}</td>
                <td>{{ $item->product->price }} kz(s)</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->total }} kz(s)</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3"><h3>Total pago</h3></td>
            <td>{{ $total }} kz(s)</td>
        </tr>
    </tbody>
</table>
@endsection
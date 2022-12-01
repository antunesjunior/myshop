@extends('layouts.app')

@section('content')
    <div class="container">
       <header class="d-flex align-items-center justify-content-between">
            <div class="header__content">
                <h2 class="h3 my-3">Fatura . <span class="h5">{{ $invoice->user->name }}</span></h2>
                <small>
                    <i>Data da compra: {{ date('d-m-Y H:m', strtotime($invoice->created_at)) }}</i>
                </small>
            </div>
            <div class="btn-wrap">
                <a href="{{ route('pdf.invoice', $invoice->id) }}" class="btn btn-primary">
                    Baixar fatura
                </a>
            </div>
       </header>
       <hr>
        <table class="table text-center" border>
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
                        <td>{{ $item->product->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="h4">
                        Total pago
                    </td>
                    <td style="color: #f7f7f7; background-color:#333">{{ $total }} kz(s)</td>
                </tr>
            </tbody>
        </table>
    </div>
    
@endsection
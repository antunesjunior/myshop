@extends('layouts.app')

@section('content')
    <div class="container">
       <header class="d-flex align-items-end justify-content-between">
            <div class="header__content">
                <h2 class="h3 my-3">Fatura</h2>
                <h6>
                    <i>Data da compra: {{ date('d-m-Y H:i', strtotime($invoice->created_at)) }}</i>
                </h6>

                <div class="header-content border p-3" style="color: black">
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
            </div>
            <div class="btn-wrap">
                <a href="{{ route('pdf.invoice', $invoice->id) }}" class="btn btn-primary">
                    Baixar fatura
                </a>
            </div>
       </header>
       <hr>
        <table class="table text-center" style="color: black" border>
            <thead>
                <th>Produto</th>
                <th>Preço Unitario</th>
                <th>Quantidade</th>
                <th>Preço total</th>
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
@extends('layouts.pdf')

@section('title', 'Relatório de Stock')

@section('description')
    <p class="p-desc">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam maxime repellendus odio minus reprehenderit esse molestias provident
    </p>
@endsection
    

@section('content')
    <table border style="width: 100%; text-align:left;">
        <tr>
            <td><b>Total de produtos em stock</b></td>
            <td>{{ $datas['all_stock'] }}</td>
        </tr>
        <tr>
            <td><b>Produto com maior quantidade em stock</b></td>
            <td>
                {{ $datas['max_stock']['prod']->product->name }} {{ $datas['max_stock']['prod']->product->brand }}
                | Total: {{ $datas['max_stock']['qtd'] }}
            </td>
        </tr>
        <tr>
            <td><b>Produto com menor quantidade em stock</b></td>
            <td>
                {{ $datas['min_stock']['prod']->product->name }} {{ $datas['min_stock']['prod']->product->brand }}
                | Total: {{ $datas['min_stock']['qtd'] }}</td>
        </tr>
        <tr>
            <td><b>Produto mais abastecido</b></td>
            <td>
                {{ $datas['max_prod']->product->name }} {{ $datas['max_prod']->product->brand }} 
                | Abstecimentos: {{ $datas['max_prod_feed'] }}
            </td>
        </tr>
        <tr>
            <td><b>Produto menos abastecido</b></td>
            <td>
                {{ $datas['min_prod']->product->name }} {{ $datas['min_prod']->product->brand }} 
                | Abstecimentos: {{ $datas['min_prod_feed'] }}
            </td>
        </tr>
        <tr>
            <td><b>Data do último abastecimento</b></td>
            <td>{{ date('d/m/Y', strtotime($datas['last_feed']->created_at)) }}</td>
        </tr>
        <tr>
            <td><b>Total de productos diferentes fornecidos no último abastecimento</b></td>
            <td>{{ $datas['last_feed_prods'] }}</td>
        </tr>
        <tr> 
            <td><b>Quantidade total de produtos fornecidos no último abastecimento</b></td>
            <td>{{ $datas['last_feed_qtd'] }}</td>
        </tr>
        <tr>
            <td><b>Producto em maior quantidade no último abastecimento</b></td>
            <td>
                {{ $datas['last_feed_max_prod']['prod']->product->name }} {{ $datas['last_feed_max_prod']['prod']->product->brand }} 
                | Total: {{ $datas['last_feed_max_prod']['qtd'] }}
            </td>
        </tr>
        <tr>
            <td><b>Producto em menor quantidade no último abastecimento</b></td>
            <td>
                {{ $datas['last_feed_min_prod']['prod']->product->name }} {{ $datas['last_feed_min_prod']['prod']->product->brand }}
                | Total: {{ $datas['last_feed_min_prod']['qtd'] }}
            </td>
        </tr>
    </table>
@endsection
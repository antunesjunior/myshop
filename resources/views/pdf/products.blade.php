@extends('layouts.pdf')

@section('title', 'Relatório de Produtos')

@section('description')
    <p class="p-desc">
        Relatório dos produtos de forma independende, sem os dados de suas estatísticas de venda ou qualquer outra atividade que os envolve.
    </p>
@endsection

@section('content')
    <table border style="width: 100%; text-align:left;">
        <tr>
            <td><b>Total de produtos já fornecidos</b></td>
            <td>{{ $datas['all_products'] }}</td>
        </tr>
        <tr>
            <td><b>Total de produtos em venda</b></td>
            <td>{{ $datas['selling'] }}</td>
        </tr>
        <tr>
            <td><b>Total de produtos descontinuados</b></td>
            <td>{{ $datas['not_selling'] }}</td>
        </tr>
        <tr>
            <td><b>Produto mais caro</b></td>
            <td>
                {{ $datas['max_price']->name }} {{ $datas['max_price']->brand }} | Preço: {{ $datas['max_price']->price }} kz(s)
            </td>
        </tr>
        <tr>
            <td><b>Produto mais barato</b></td>
            <td>
                {{ $datas['min_price']->name }} {{ $datas['min_price']->brand }} | Preço: {{ $datas['min_price']->price }} kz(s)
            </td>
        </tr>
    </table>
@endsection
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
            <td><b>Total de Vendas</b></td>
            <td>{{ $datas['all_products'] }}</td>
        </tr>
        <tr>
            <td><b>Produto mais Vendido</b></td>
            <td>{{ $datas['selling'] }}</td>
        </tr>
        <tr>
            <td><b>Produto menos Vendido</b></td>
            <td>{{ $datas['not_selling'] }}</td>
        </tr>
    </table>
@endsection
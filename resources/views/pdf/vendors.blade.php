@extends('layouts.pdf')

@section('title', 'Relatório de Fornecedores')

@section('description')
    <p class="p-desc">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam maxime repellendus odio minus reprehenderit esse molestias provident
    </p>
@endsection
    

@section('content')
    <table border style="width: 100%; text-align:left;">
        <tr>
            <td><b>Total de Fornecedores</b></td>
            <td>{{ $datas['all_vendors'] }}</td>
        </tr>
        <tr>
            <td><b>Total de fornecedores activos</b></td>
            <td>{{ $datas['active'] }}</td>
        </tr>m
        <tr>
            <td><b>Total de fornecedores descontinuados</b></td>
            <td>{{ $datas['not_active'] }}</td>
        </tr>
        <tr>
            <td><b>Maior Fornecedor</b></td>
            <td>
                {{ $datas['max_vendor']->vendor->name }} 
            </td>
        </tr>
        <tr>
            <td><b> Total de abastecimentos do maior fornecedor</b></td>
            <td>
                {{ $datas['max_vendor_prod'] }}
            </td>
        </tr>
        <tr>
            <td><b>Menor fornecedor</b></td>
            <td>
                {{ $datas['min_vendor']->vendor->name }}
            </td>
        </tr>
        <tr>
            <td><b>Total de abastecimentos do menor fornecedor</b></td>
            <td>
                {{ $datas['min_vendor_prod'] }}
            </td>
        </tr>
    </table>
@endsection
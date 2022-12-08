@extends('layouts.admin')

@section('content')
<div class="container-lg">
   <header class="my-3" style="border-bottom: 1px dashed #ccc">
        <h2>Relatórios</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias unde vitae dignissimos sapiente doloremque labore sint molestias deleniti nihil dolor libero qui, corrupti modi quo inventore recusandae sed totam assumenda.</p>
   </header>

    <div class="row mt-3">
        <div class="col-md-3 mb-4">
            <a href="{{ route('reports.caixa') }}" class="btn btn-dark">
                Relatório de Caixa
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('reports.sale') }}" class="btn btn-dark">
                Relatório de de vendas
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('pdf.products') }}" target="_blank" class="btn btn-dark">
                Relatório de Produtos
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('pdf.vendors') }}" target="_blank" class="btn btn-dark">
                Relatório de Fornecedores
            </a>
        </div>
        <div class="col-md-3 mb-4">
            <a href="{{ route('pdf.stock') }}" target="_blank" class="btn btn-dark">
                Relatório de Stock
            </a>
        </div>
    </div>
</div>
@endsection
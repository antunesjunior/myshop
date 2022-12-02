@extends('layouts.admin')

@section('content')
<div class="container-lg">
    <header class="my-3" style="border-bottom: 1px dashed #ccc">
         <h2>Relatórios | Venda</h2>
    </header>
 
     <div class="row mt-3">
         <div class="col-md-3 mb-4">
             <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#year">
                Relatorio Anual
             </button>
         </div>
         <div class="col-md-3 mb-4">
             <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#month">
                Relatorio Mensal
             </button>
         </div>
         <div class="col-md-3 mb-4">
             <a href="{{ route('pdf.caixa.day') }}" class="btn btn-dark">
                 Relatório do Dia
             </a>
         </div>
         <div class="col-md-3 mb-4">
             <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#period">
                 Relatório por periodo
             </button>
         </div>
     </div>
</div>
@endsection
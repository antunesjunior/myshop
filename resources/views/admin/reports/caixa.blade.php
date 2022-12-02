@extends('layouts.admin')

@section('content')
<div class="container-lg">
    <header class="my-3" style="border-bottom: 1px dashed #ccc">
         <h2>Relatórios | Caixa</h2>
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

<div class="modal fade" id="year" tabindex="-1" aria-labelledby="yearLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            Relatorio Anual do Caixa
        </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pdf.caixa.year') }}" method="POST">
                @csrf
                @method('POST')
                <div>
                    <label for="#" class="form-label">Selecione o ano</label>
                    <select name="year" class="form-control">
                        @for ($i = (count($years) - 1) ; $i >= 0; $i--)
                            <option value="{{ $years[$i] }}">{{ $years[$i] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="controls pt-4">
                    <input type="submit" value="Confirmar" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>
              </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="month" tabindex="-1" aria-labelledby="monthLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            Relatorio Anual do Caixa
        </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pdf.caixa.month') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div>
                        <label for="#" class="form-label">Selecione o ano</label>
                        <select name="year" class="form-control">
                            @for ($i = (count($years) - 1) ; $i >= 0; $i--)
                                <option value="{{ $years[$i] }}">{{ $years[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label for="#" class="form-label">Selecione o mes</label>
                        <select name="month" class="form-control">
                            @for ($i = 0 ; $i < 12; $i++)
                                <option value="{{ $i + 1 }}">{{ $months[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="controls pt-4">
                    <input type="submit" value="Confirmar" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="period" tabindex="-1" aria-labelledby="periodLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            Relatorio Anual do Caixa
        </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pdf.caixa.period') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div>
                        <label for="#" class="form-label">Desde</label>
                        <input type="date" name="from" class="form-control">
                    </div>
                    <div>
                        <label for="#" class="form-label">Ate</label>
                        <input type="date" name="to" class="form-control">
                    </div>
                </div>
                <div class="controls pt-4">
                    <input type="submit" value="Confirmar" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
@endsection
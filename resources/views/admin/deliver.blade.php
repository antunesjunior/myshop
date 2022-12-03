@extends('layouts.admin')

@section('content')
<div class="container-lg">
    <div class="row mt-3">
        <nav class="col-md-8">
            <h2 class="mb-4">Gestao de Entregas</h2>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Pedentes</button>
                  <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Despachados</button>
                </div>
              </nav>
              <div class="tab-content pt-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                   @if (!$pending->isEmpty())
                    @foreach ($pending as $item)
                        <div class="mb-3 border p-3">
                            <h5><strong class="badge bg-dark">codigo:# {{ $item->id + 100 }}</strong></h5>
                            <p><strong>Cliente:</strong> {{ $item->user->name }}</p>
                            <p>
                                <strong>Endereco:</strong> 
                                {{ $item->address->province->name }} | {{ $item->address->muni }} | {{ $item->address->bairro }} | Rua: {{ $item->address->rua }}
                            </p>
                            <p>
                                <strong>Telefone - 1:</strong>
                                <span>+244 {{ $item->user->phones[0]->number }}</span>&nbsp;|&nbsp;
                                <strong>Telefone - 2:</strong>
                                <span>+244 {{ $item->user->phones[1]->number }}</span>
                            </p>
                            <p><strong>Data:</strong> {{ date('d-m-Y H:i', strtotime($item->created_at)) }}</p>
                            <hr>
                            <span class="btn btn-sm btn-success" style="cursor: default">
                                <strong>
                                    Status - Pendente
                                </strong>
                            </span>&nbsp;&nbsp;
                            <a href="{{ route('pdf.deliver', $item->id) }}" target="_blank" class="btn btn-sm btn-secondary">Visualizar</a>&nbsp;&nbsp;
                            <a href="{{ route('deliver.show', $item->id) }}" class="btn btn-sm btn-warning">Despachar entrega</a>
                        </div>
                        @endforeach
                   @else
                       <p class="h6" style="color: #ddd"><i>Nao ha nenhuma entrega pendente</i></p>
                   @endif
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    @if (!$dispatched->isEmpty())
                        @foreach ($dispatched as $key => $item)
                            <div class="mb-3 border p-3">
                                <h5><strong class="badge bg-dark">codigo:# {{ $item->id + 100 }}</strong></h5>
                                <p><strong>Cliente:</strong> {{ $item->user->name }}</p>
                                <p>
                                    <strong>Endereco:</strong> 
                                    {{ $item->address->province->name }} | {{ $item->address->muni }} | {{ $item->address->bairro }} | Rua: {{ $item->address->rua }}
                                </p>
                                <p>
                                    <strong>Telefone - 1:</strong>
                                    <span>+244 {{ $item->user->phones[0]->number }}</span>&nbsp;|&nbsp;
                                    <strong>Telefone - 2:</strong>
                                    <span>+244 {{ $item->user->phones[1]->number }}</span>
                                </p>
                                <p><strong>Data:</strong> {{ date('d-m-Y H:i', strtotime($item->created_at)) }}</p>
                                <hr>
                                <span class="btn btn-sm btn-success" style="cursor: default">
                                    <strong>
                                        Status - Despachado para entrega
                                    </strong>
                                </span>&nbsp;&nbsp;
                                <a href="{{ route('pdf.deliver', $item->id) }}" target="_blank" class="btn btn-sm btn-secondary">Imprimir</a>&nbsp;&nbsp;
                                <a href="{{ route('deliver.edit', $item->id) }}" class="btn btn-sm btn-warning">Resolver</a>
                            </div>
                        @endforeach
                    @else
                        <p class="h5" style="color: #ddd"><i>Nao ha nenhuma entrega despachada</i></p>
                    @endif
                </div>
              </div>
            </nav>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-5">
                <header>
                    <h1>{{ $vendor->name }}</h1>
                    <h3 class="h6">Desde: {{ date('d/m/Y', strtotime($vendor->created_at)) }}</h3>
                    <hr>
                    <div>
                        <h3 class="h6">Telefone 1: {{ $vendor->phone[0]->number }}</h3>
                        <h3 class="h6">Telefone 2: {{ $vendor->phone[1]->number }}</h3>
                    </div>
                </header>

                <div class="controls d-flex mt-4">
                    <div>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit">
                            Editar
                        </button>
                    </div>
                    <div class="px-3">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="col-6 me-3">
                <h2>Histórico</h2>
                <table class="table text-center">
                    <thead>
                        <th>Data</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                    </thead>
                    <tbody>
                        @if (!$vendor->feeds->isEmpty())
                            @foreach ($vendor->feeds as $item)
                                @if (isset($item->product))
                                    <tr>
                                        <td>
                                            {{ date('d/m/Y h:m', strtotime($item->created_at)) }}
                                        </td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->qtd_prod }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Editar: {{ $vendor->name }}
            </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('vendors.update', $vendor->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="pb-2">
                        <input type="text" name="name" class="form-control"
                            placeholder="Nome" value="{{ $vendor->name }}">
                    </div>
                    <div class="row pb-2">
                        <div class="col-6">
                            <label class="form-label">Telefone 1</label>
                            <input type="text" name="phone_1" class="form-control"
                                    placeholder="+244 xxx xxx xxx" value="{{ $vendor->phone[0]->number }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Telefone 2</label>
                            <input type="text" name="phone_2" class="form-control" 
                                placeholder="+244 xxx xxx xxx" value="{{ $vendor->phone[1]->number }}">
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

      <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                {{ $vendor->name }}
            </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('vendors.destroy', $vendor->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <h4 class="alert alert-danger">
                        Deseja realmente apagar este fornecedor?
                    </h4>
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
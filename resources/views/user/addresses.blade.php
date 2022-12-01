@extends('layouts.app')

@section('content')

<div class="container-sm">
    <div class="row">
        <div class="col-12">
            <h3>Meus Enderecos</h3>

            <a class="d-block btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                <h5> + Novo Endereco</h3>
            </a>
                    
            <table class="table text-center">
                <thead>
                    <th>#</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Accao</th>
                </thead>
                <tbody>
                    @foreach ($addresses as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->province->name }}</td>
                            <td>{{ $item->muni }}</td>
                            <td>{{ $item->bairro }}</td>
                            <td>{{ $item->rua }}</td>
                            <td>
                                <a href="{{ route('address.edit', $item->id) }}" class="btn btn-sm btn-dark">Editar</a>
                                
                                <form class="d-inline" action="{{ route('address.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Remover
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Criar Endereco</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('address.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Provincia</label>
                    <select name="prov" class="form-control">
                        @foreach ($provinces as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-label">Municipio</label>
                   <input type="text" name="muni" class="form-control">
                </div>
            </div>

            <div class="row my-4">
                <div class="col-6">
                    <label class="form-label">Bairro</label>
                   <input type="text" name="bairro" class="form-control">
                </div>
                <div class="col-6">
                    <label class="form-label">Rua</label>
                   <input type="text" name="rua" class="form-control">
                </div>
            </div>
            <div class="modal-footer border-none">
                <button class="btn btn-primary">submeter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
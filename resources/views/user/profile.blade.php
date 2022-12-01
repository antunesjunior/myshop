@extends('layouts.app')

@section('content')

<div class="container-sm">
    <div class="row">
        <div class="col-4">
            <h2>Perfil</h2>
            <p><strong>Nome: </strong>{{ $user->name }}</p>
            <p><strong>email: </strong>{{ $user->email }}</p>
            <p><strong>Telefone - 1: </strong>{{ $user->phones[0]->number }}</p>
            <p><strong>Telefone - 2: </strong>{{ $user->phones[1]->number }}</p>

            <div class="my-3">
                <a href="#" class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                    Actualizar Perfil
                </a>
                <a href="{{ route('address.index') }}" class="btn btn-primary">Meus Enderecos</a>
            </div>
        </div>

        <div class="col-8">
            <h2>Historico de Facturas</h2>
           <table class="table text-center" border>
                <thead class="table-head table-dark">
                    <th>Data</th>
                    <th>Produtos diferentes</th>
                    <th>Montante Pago</th> 
                    <th>#</th>                                       
                </thead>
                <tbody>
                    @foreach ($invoices as $item)
                        <tr>
                            <td>{{ date('d-m-Y H:m', strtotime($item->created_at)) }}</td>
                            <td>{{ $item->shop->count() }}</td>
                            <td>{{ $item->shop->sum('total')}} kz(s)</td>
                            <td>
                                <a href="{{ route('invoice.show', $item->id) }}" class="btn btn-dark">
                                    ver
                                </a>
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
          <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="my-4">
                <label class="form-label">Email</label>
               <input type="text" name="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div>
                <label class="form-label">Sexo</label>
                <select name="gender" class="form-control">
                    <option 
                    @php
                        echo $user->gender == 'm' ? 'selected':''
                    @endphp
                    value="m"
                    >Masculino</option>

                    <option 
                    @php
                        echo $user->gender == 'f' ? 'selected':''
                    @endphp
                    value="f"
                    >Feminino</option>
                </select>
            </div>
            <div class="row my-4">
                <div class="col-6">
                    <label class="form-label">Telefone - 1</label>
                   <input type="text" name="phone_1" class="form-control" value="{{ $user->phones[0]->number }}">
                </div>
                <div class="col-6">
                    <label class="form-label">Telefone - 2</label>
                   <input type="text" name="phone_2" class="form-control" value="{{ $user->phones[1]->number }}">
                </div>
            </div>
            <div class="modal-footer border-none">
                <button class="btn btn-primary">Submeter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
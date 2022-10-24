@extends('layouts.admin')

@section('content')
<div class="container-lg">
    <div class="row mt-3">
        <div class="col-md-4">
            <h2 class="mb-3">Fornecedor</h2>
            <form action="{{ route('vendors.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="pb-2">
                    <input type="text" name="name" class="form-control"
                        placeholder="Nome">
                </div>
                <div class="row pb-2">
                    <div class="col-6">
                        <label class="form-label">Telefone 1</label>
                        <input type="text" name="phone_1" class="form-control"
                                placeholder="+244 xxx xxx xxx">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Telefone 2</label>
                        <input type="text" name="phone_2" class="form-control" 
                            placeholder="+244 xxx xxx xxx">
                    </div>
                </div>

                <input type="submit" value="Cadastrar Fornecedor" class="btn btn-secondary">
            </form>
        </div>

        <div class="col-md-7 offset-1">
            <form action="#" method="get" class="my-2">
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="search" class="form-control"
                                placeholder="pesquisar...">
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <label for="select" class="form-label">Por:</label>
                        <select name="by" id="select" class="form-control mx-2">
                            <option value="#">Código</option>
                            <option value="#">Nome</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="submit" value="pesquisar" class="btn btn-light">
                    </div>
                </div>
            </form>

            <table class="table text-center">
                <thead class="thead-dark">
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Telefone-1</th>
                    <th>Telefone-2</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @foreach ($vendors as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone[0]->number }}</td>
                        <td>{{ $item->phone[1]->number }}</td>
                        <td>
                            <a href="{{ route('vendors.show', $item->id) }}"
                                class="btn btn-light">
                            Ver detalhes
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')

<div class="container-lg">
    <div class="row mt-3">
        <div class="col-md-6">
            <h2 class="mb-4">Categorias</h2>

            <form action="{{ route('categories.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
    
                <div class="row pb-2">
                    <div class="col-5">
                        <label for="" class="form-label">Nome da Categoria</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Super Categoria</label>
                        <select name="sup_category_id" class="form-control">
                            <option value="0">Nenhuma</option>
                            @if (!$supCategs->isEmpty())
                                @foreach ($supCategs as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <input type="submit" value="Criar categoria" class="btn btn-secondary">
            </form>
            <table class="table text-center">
                <thead class="thead-dark">
                    <th>codigo</th>
                    <th>Nome</th>
                    <th>Qtd Produtos</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @if (!$categs->isEmpty())
                        @foreach ($categs as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->products()->count() }}</td>
                            <td>
                                <a href="{{ route('categories.show', $item->id) }}"
                                    class="btn btn-light">
                                Detalhes
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="col-md-5 offset-1">
            <h2 class="mb-4">Super Categoria</h2>
            <form action="{{ route('supcategs.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                
                <div class="mb-2">
                    <label for="" class="form-label">Nome da Super Categoria</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div>
                    <input type="submit" value="Criar super categoria" 
                        class="btn btn-secondary">
                </div>
            </form>
            <table class="table text-center">
                <thead class="thead-dark">
                    <th>codigo</th>
                    <th>Nome</th>
                    <th>Qtd de Categorias</th>
                </thead>
                <tbody>
                    @if (!$supCategs->isEmpty())
                        @foreach ($supCategs as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->categories()->count() }}</td>
                            <td>
                                <a href="{{ route('categories.show', $item->id) }}"
                                    class="btn btn-light">
                                Detalhes
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
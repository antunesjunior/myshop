@extends('layouts.admin')

@section('content')

<div class="container-lg">
    <div class="row mt-3">
        <div class="col-md-4">
            <h2 class="mb-3">Produto</h2>
            <form action="{{ route('products.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="pb-2">
                    <input type="text" name="name" class="form-control"
                        placeholder="Produto">
                </div>
                <div class="row pb-2">
                    <div class="col-6">
                        <input type="text" name="brand" class="form-control"
                                placeholder="Marca">
                    </div>
                    <div class="col-6">
                        <input type="number" name="price" class="form-control" 
                            placeholder="Preço(kz)">
                    </div>
                </div>

                <div class="pb-2">
                    <label class="form-label">Categoria</label>
                    <select name="category_id" class="form-control">
                        <option value="0">Nenhuma</option>
                        @if (!$categs->isEmpty())
                            @foreach ($categs as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>


                <div>
                    <label for="" class="form-label">Foto</label>
                    <input type="file" name="cover" class="form-control">
                </div>
                
                <div class="py-2">
                    <label for="" class="form-label">Descrição do produto</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="3"></textarea>
                </div>

                <input type="submit" value="Cadastrar producto" class="btn btn-secondary">
            </form>
        </div>

        <div class="col-md-7 offset-1">
            <form action="{{ route('products.search') }}" method="POST" class="my-2">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <input type="text" name="value" class="form-control"
                                placeholder="pesquisar...">
                    </div>
                    <div class="col-4 d-flex align-items-center">
                        <label for="select" class="form-label">Por:</label>
                        <select name="key" id="select" class="form-control mx-2">
                            <option value="code">Código</option>
                            <option value="name">Nome</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="submit" value="pesquisar" class="btn btn-light">
                    </div>
                </div>
            </form>

            @if (session()->get('message'))
                <div class="alert alert-warning" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif

            <table class="table text-center mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Marca</th>
                        <th>Preço(kz)</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$products->isEmpty())
                        @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a href="{{ route('products.show', $item->id) }}"
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
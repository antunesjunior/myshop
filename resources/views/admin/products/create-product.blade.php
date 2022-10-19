@extends('layouts.admin')

@section('content')

<div class="container-lg">
    <div class="row mt-5">
        <div class="col-md-4">
            <h2 class="mt-2">Cadastrar produto</h2>
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                <div class="row pb-3">
                    <div class="col">
                        <label for="" class="form-label">Produto</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Preço(kz)</label>
                        <input type="number" name="price" class="form-control" >
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="" class="form-label">Marca</label>
                        <input type="text" name="brand" class="form-control">
                    </div>
                    
                    <div class="col">
                        <label for="" class="form-label">Quantidade em stock</label>
                        <input type="number" name="stock" class="form-control">
                    </div>
    
                </div>
                
                <div class="py-2">
                    <label for="" class="form-label">Descrição do produto</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="8"></textarea>
                </div>

                <input type="submit" value="Cadastrar producto" class="btn btn-primary">
            </form>
        </div>

        <div class="col-md-7 offset-1">
            <table class="table table-striped">
                <thead>
                    <th>Produto</th>
                    <th>Preço(kz)</th>
                    <th>Marca</th>
                    <th>Qtd em stock</th>
                    <th>#</th>
                </thead>
                <tbody>
                    @if (!$products->isEmpty())
                        @foreach ($products as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->stock }}</td>
                            <td><a href="#">Ver detalhes</a></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection
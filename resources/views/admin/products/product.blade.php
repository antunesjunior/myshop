@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 border rounded" style="width: 300px; height:350px">
                <img src="{{ asset("storage/products/cover/{$product->cover}") }}" 
                    alt="{{ $product->name }}" class="img-fluid">
            </div>
            <div class="col-lg-6 offset-1">
                <h2 class="pb-3">{{ $product->name }} {{ $product->brand }}</h2>
                
                <table class="table text-center">
                    <thead>
                        <th>Código</th>
                        <th>Marca</th>
                        <th>Preço (kz)</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    </tbody>
                </table>
                <article>
                    <header>
                        <h3 class="h6">Descrição</h3>
                    </header>
                    <p class="py-2">
                        {{ $product->description }}
                    </p>
                </article>

                <div class="controls d-flex">
                    <div>
                        <a href="#" class="btn btn-success">Editar</a>
                    </div>
                    <div class="px-3">
                        <a href="#" class="btn btn-danger ml-5">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
                    <thead class="table-dark">
                        <th>Código</th>
                        <th>Marca</th>
                        <th>Preço (kz)</th>
                        <th>stock</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock->qtd_prod }}</td>
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
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Abastecer
                        </button>
                    </div>
                    <div class="px-3">
                        <a href="#" class="btn btn-success ml-5">Editar</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-danger ">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Abastercer: {{ $product->name }} {{ $product->brand }}
            </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('feeds.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="product" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label">Fornecedor</label>
                            <select name="vendor" class="form-control">
                                <option value="0">Selecionar</option>
                                @if (!$vendors->isEmpty())
                                    @foreach ($vendors as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Quantidade</label>
                            <input type="number" name="quantity" class="form-control">
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

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Abastercer: {{ $product->name }} {{ $product->brand }}
            </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('feeds.store') }}" method="post">
                    @csrf
                    @method('POST')
                    
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
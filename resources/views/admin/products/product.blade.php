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
                        <th>Montra</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock->qtd_prod }}</td>
                            <td>Sim</td>
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
                <hr>
                <div class="controls d-flex">
                    <div>
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fill">
                            Relatorio
                        </button>
                    </div>
                    <div class="px-3">
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fill">
                            Historico de alteracao
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#fill">
                            Abastecer
                        </button>
                    </div>
                    <div class="px-3">
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#edit">
                            Editar
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <div class="modal fade" id="fill" tabindex="-1" aria-labelledby="fillLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Abastercer: {{ $product->name }} {{ $product->brand }}
            </h1>
              <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('feeds.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="product" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-8">
                            <label class="form-label">Fornecedor</label>
                            <select name="vendor" class="form-select">
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

                    @if (!$product->stockFeed->isEmpty())
                        <p class="pt-3">
                            <small>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#fill-edit">
                                    Editar o último carregamento
                                </a>
                            </small>
                        </p>
                    @endif
                    
                    <div class="controls pt-5">
                        <input type="submit" value="Confirmar" class="btn btn-sm btn-primary">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>

      @if (!$product->stockFeed->isEmpty())
        <div class="modal fade" id="fill-edit" tabindex="-1" aria-labelledby="fillLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Ultimo carregamento de: {{ $product->name }} {{ $product->brand }}
                </h1>
                <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('feeds.update', $lastFeed->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="product" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-8">
                                <label class="form-label">Fornecedor</label>
                                <select name="vendor" class="form-select">
                                    <option value="0">Selecionar</option>
                                    @if (!$vendors->isEmpty())
                                        @foreach ($vendors as $item)
                                            <option 
                                            @php
                                                echo $item->id == $lastFeed->vendor_id ? 'selected':''
                                            @endphp
                                            value="{{ $item->id }}"
                                            >
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>


                            <div class="col-4">
                                <label class="form-label">Quantidade</label>
                                <input type="number" value="{{ $lastFeed->qtd_prod }}" name="quantity" class="form-control">
                            </div>
                        </div>
                        
                        <div class="controls pt-5">
                            <input type="submit" value="Editar" class="btn btn-sm btn-primary">
                            <button type="button" 
                                class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#fill">
                                Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
      @endif

      <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Editar: {{ $product->name }} {{ $product->brand }}
            </h1>
              <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" 
                    enctype="multipart/form-data"  method="post">
                    @csrf
                    @method('PUT')
                    <div class="pb-2">
                        <input type="text" name="name" class="form-control"
                            placeholder="Produto" value="{{ $product->name }}">
                    </div>
                    <div class="row pb-2">
                        <div class="col-6">
                            <input type="text" name="brand" class="form-control"
                                    placeholder="Marca"  value="{{ $product->brand }}">
                        </div>
                        <div class="col-6">
                            <input type="number" name="price" class="form-control" 
                                placeholder="Preço(kz)"  value="{{ $product->price }}">
                        </div>
                    </div>
    
                    <div class="pb-2">
                        <label class="form-label">Categoria</label>
                        <select name="category_id" class="form-control">
                            <option value="0">Nenhuma</option>
                            @if (!$categs->isEmpty())
                                @foreach ($categs as $item)
                                    <option 
                                    @php
                                        echo $item->id == $product->category_id ? 'selected':''
                                    @endphp
                                    value="{{ $item->id }}"
                                    >
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
                        <textarea class="form-control" 
                            name="description" cols="30" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="controls pt-4">
                        <input type="submit" value="Confirmar" class="btn btn-sm btn-primary">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
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
                {{ $product->name }} {{ $product->brand }}
            </h1>
              <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <h4 class="alert alert-danger">
                        Deseja realmente apagar este produto?
                    </h4>
                    <div class="controls pt-4">
                        <input type="submit" value="Confirmar" class="btn btn-sm btn-primary">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                  </form>
            </div>
          </div>
        </div>
      </div>

@endsection
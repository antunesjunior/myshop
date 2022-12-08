@extends('layouts.admin')

@section('content')

<div class="container-sm">
    <div class="row">
        <div class="col-8">
            <h3 class="my-4">Categoria | {{ $category->name }} | Produtos: {{ $category->products->count() }} </h3>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <label for="" class="form-label">Nome da Categoria</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Super Categoria</label>
                        <select name="sup_category_id" class="form-control">
                            <option value="0">Nenhuma</option>
                            @if (!$supCategs->isEmpty())
                                @foreach ($supCategs as $item)
                                    <option 
                                    @php
                                        echo $item->id == $category->sup_category_id ? 'selected':''
                                    @endphp
                                    value="{{ $item->id }}"
                                    >
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="my-3">
                    <label for="" class="form-label">Imagem (não obrigatório)</label>
                    <input type="file" name="cover" class="form-control">
                </div>
                <input type="submit" class="btn btn-secondary" value="Actualizar">
                <button onclick="event.preventDefault()" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">
            {{ $category->name }}
        </h1>
          <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                @csrf
                @method('DELETE')
                <h4 class="alert alert-danger">
                    Deseja realmente apagar esta categoria?
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
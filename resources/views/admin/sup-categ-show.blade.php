@extends('layouts.admin')

@section('content')

<div class="container-sm">
    <div class="row">
        <div class="col-8">
            <h3 class="my-4">Super Categoria: {{ $category->name }} | Categorias: {{ $category->categories->count() }} </h3>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="" class="form-label">Nome:</label>
                        <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                    </div>
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
            <form action="{{ route('supcategs.destroy', $category->id) }}" method="post">
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
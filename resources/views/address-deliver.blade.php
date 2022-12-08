@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Compras</a>
                    <span class="breadcrumb-item active">Endereco de entrega</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-10 offset-1">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Escolha o endereco de entrega</span></h5>
                <a class="d-block btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModal">
                    <h5> + Novo Endereco</h3>
                </a>
                @foreach ($addresses as $item)
                    <a href="{{ route('user.checkout', $item->id) }}" class="d-block mb-3">
                        <div class="bg-light p-30">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="h6"><strong>Provincia:</strong> {{ $item->province->name }}</p>
                                <p class="h6 mx-3">|</p>
                                <p class="h6"><strong>Municipio:</strong> {{ $item->muni }}</p>
                                <p class="h6 mx-3">|</p>
                                <p class="h6"><strong>Bairro:</strong> {{ $item->bairro }}</p>
                                <p class="h6 mx-3">|</p>
                                <p class="h6"><strong>Rua:</strong> {{ $item->rua }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Criar Endereco</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('address.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Provincia</label>
                        <select name="prov" class="form-control">
                            @foreach ($provinces as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Municipio</label>
                       <input type="text" name="muni" class="form-control">
                    </div>
                </div>
    
                <div class="row my-4">
                    <div class="col-6">
                        <label class="form-label">Bairro</label>
                       <input type="text" name="bairro" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Rua</label>
                       <input type="text" name="rua" class="form-control">
                    </div>
                </div>
                <div class="modal-footer border-none">
                    <button class="btn btn-primary">submeter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    
@endsection
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
@endsection
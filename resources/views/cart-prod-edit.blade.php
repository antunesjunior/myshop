@extends('layouts.app')

@section('content')
     <!-- Breadcrumb Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Comprar</a>
                    <span class="breadcrumb-item active">Editar Produto</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div class=" position-relative overflow-hidden" style="border: 1px solid black; width: 400px; height:450px">
                    <img class="img-fluid w-100" src="{{ asset('storage/products/cover/'.$cart->product->cover) }}" alt="Produto">
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $cart->product->name }} {{ $cart->product->brand }}</h3>
                    <hr>
                    <h3 class="font-weight-semi-bold mb-4">{{ $cart->product->price }} kz(s)</h3>
                    <p class="mb-4">
                        {{ $cart->product->description }}
                    </p>

                    <hr>
                    
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="mr-3">
                            <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-3">
                                        <label for="#" class="form-label">Quantidade</label>
                                        <input type="number" name="number" class="form-control bg-secondary border-0 text-center"
                                        min="1" value="{{ $cart->quantity }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="#" class="form-label" style="visibility: hidden">submeter</label>
                                        <button class="btn btn-primary px-3">
                                            <i class="fa fa-shopping-cart mr-1"></i>Confirmar alteracao
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
@endsection
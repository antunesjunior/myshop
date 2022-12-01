@extends('layouts.app')

@section('content')
     <!-- Breadcrumb Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Comprar</a>
                    <span class="breadcrumb-item active">Detalhes do Produto</span>
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
                    <img class="img-fluid w-100" src="{{ asset('storage/products/cover/'.$product->cover) }}" alt="Produto">
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product->name }} {{ $product->brand }}</h3>
                    <hr>
                    <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} kz(s)</h3>
                    <p class="mb-4">
                        {{ $product->description }}
                    </p>

                    <hr>
                    
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="mr-3">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="product" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="#" class="form-label">Quantidade</label>
                                        <input type="number" name="number" class="form-control bg-secondary border-0 text-center"
                                        min="1" value="1">
                                    </div>
                                    <div class="col-6">
                                        <label for="#" class="form-label" style="visibility: hidden">submeter</label>
                                        <button class="btn btn-primary px-3">
                                            <i class="fa fa-shopping-cart mr-1"></i>Adicionar no carrinho
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

     <!-- Products Start -->
     <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Relacionados</span>
        </h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@extends('layouts.app')

@section('content')
     <!-- Breadcrumb Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('index.home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('products.categs', $product->category->id) }}">Comprar</a>
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
                <div class=" position-relative border overflow-hidden" style="width: 450px; height:450px">
                    <img class="img-fluid w-100" style="height: 100%" src="{{ asset('storage/products/cover/'.$product->cover) }}" alt="Produto">
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
                    
                    @if (Auth::user())
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
                    @endif

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
                    @foreach ($product->category->products as $item)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden" style="height: 280px">
                                <img class="img-fluid w-100" style="height: 100%" src="{{ asset('storage/products/cover/'.$item->cover) }}" alt="Produto">
                            </div>
                            <div class="text-center py-4">
                                <a href="{{ route('products.detail', $item->id) }}" class="d-block">
                                    <span class="h6 text-decoration-none text-truncate">
                                        {{ $item->name }} {{ $item->brand }}
                                    </span>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5><i class="fas fa-money-bill"></i> {{ $item->price }} kz(s)</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection
@extends('layouts.app')

@section('content')
 <!-- Breadcrumb Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Compras</a>
                <span class="breadcrumb-item active">Lista de Produtos</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

 <!-- Shop Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Product Start -->
        <div class="col-lg-10 col-md-8 offset-1">
            <div class="row pb-3">
                <div class="col-12 pb-1 border-b">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h3>{{ mb_strtoupper($catName) }}</h3>
                            <hr>
                        </div>
                    </div>
                </div>
                @foreach ($products as $product)
                        <div class="col-lg-4 col-md-4 col-sm-6 pb-1">
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden" style="height: 300px">
                                    <img class="img-fluid w-100" style="height: 100%" src="{{ asset('storage/products/cover/'.$product->cover) }}" alt="Produto">
                                </div>
                                <div class="text-center py-4">
                                    <a href="{{ route('product.detail', $product->id) }}" class="d-block">
                                        <span class="h6 text-decoration-none text-truncate">
                                            {{ $product->name }} {{ $product->brand }}
                                        </span>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5><i class="fas fa-money-bill"></i> {{ $product->price }} kz(s)</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>
    </div>
</div>
<!-- Shop End -->    
@endsection
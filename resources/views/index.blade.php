@extends('layouts.app')

@section('content')
     <!-- Carousel Start -->
     <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('img/carousel-1.jpg') }}" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Os Melhores Produtos</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">
                                        Comprar Agora
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('img/carousel-1.jpg') }}" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Os Melhores Preços</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">
                                        Comprar Agora
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="{{ asset('img/carousel-1.jpg') }}" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">O melhor Atendimento</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">
                                        Comprar Agora
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Produtos de Qualidade</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Entregas em até 1 hora</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Suporte 24/7</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->

     <!-- Categories Start -->
     <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Categorias</span>
        </h2>
        <div class="row px-xl-5 pb-3">
            @foreach ($categories as $category)
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="{{ route('products.catalogue.category', $category->id) }}">
                    <div class="cat-item d-flex align-items-center mb-4">
                        <div class="overflow-hidden" style="width: 150px; height: 100px">
                            <img class="img-fluid" src="{{ asset('storage/categories/cover/'.$category->cover) }}">
                        </div>
                        <div class="flex-fill pl-3">
                            <h6>{{ $category->name }}</h6>
                            <small class="text-body">{{ $category->products->count() }} Produtos</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Categories End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Produtos em Destaque</span>
        </h2>
        <div class="row px-xl-5">
            @foreach ($featuredProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden" style="height: 280px">
                            <img class="img-fluid w-100" style="height: 100%" src="{{ asset('storage/products/cover/'.$product->cover) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate d-block" href="{{ route('product.detail', $product->id) }}">
                                <span>{{ $product->name }} {{ $product->brand }}</span>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5><i class="fas fa-money-bill"></i> {{ $product->price }} kz(s)</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->

    <!-- Offer Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-md-12">
                <div class="product-offer mb-30" style="height: 300px;">
                    <img class="img-fluid" src="{{ asset('img/desconto.jpg') }}" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Poupe até 20%</h6>
                        <h3 class="text-white mb-3">Diversos produtos em Promoçao</h3>
                        <a href="" class="btn btn-primary">Ver Agora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->

    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Produtos Recentes</span></h2>
        <div class="row px-xl-5">
            @foreach ($recentProducts as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden" style="height: 280px; cursor: pointer;">
                            <img class="img-fluid w-100" style="height: 100%" src="{{ asset('storage/products/cover/'.$item->cover) }}" alt="Produto">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square shop-product" data-action="{{ route('cart.store') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                </a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a href="{{ route('product.detail', $item->id) }}" class="d-block">
                                <span class="h6 text-decoration-none text-truncate">
                                    {{ $item->name }} {{ $item->brand }}
                                </span>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h6><i class="fas fa-money-bill"></i> {{ $item->price }} kz(s)</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->
@endsection


@section('script')
    <script>
        $(function(){
            $('.shop-product').click(function(event){
                event.preventDefault()
                let route = $(this).attr('data-action')

                /*$.ajax({
                    url: "http://127.0.0.1:8000/cart",
                    methode: "POST",
                    dataType: "json",
                    data: {
                        product: id,
                        number: 1
                    },

                    success: function(response) {
                        console.log(response);
                    }
                })*/
                
                alert(route);

                
            })
        })
    </script>
@endsection
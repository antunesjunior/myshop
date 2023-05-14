@extends('layouts.app')

@section('content')
     <!-- Breadcrumb Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Compras</a>
                    <span class="breadcrumb-item active">Carrinho de compras</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-9 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover mb-0">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Produtos</th>
                            <th>Preco</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>
                                <img src="{{ asset("storage/products/cover/{$item->product->cover}") }}" 
                                alt="{{ $item->product->name }}" style="width: 50px;">
                                {{ $item->product->name }} 
                            </td>
                            <td class="align-middle text-center">{{ $item->product->price }} kz(s)</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $item->quantity }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle text-center">
                                {{ $item->total }} kz(s)
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5><strong>Total:</strong></h5>
                            <h5>{{ $total }} kz(s)</h5>
                        </div>
                        <a href="{{ route('user.address') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Prosseguir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection


@section('script')
    <script>
        $(function(){
            alert('Estou funcionando');
        })
    </script>
@endsection
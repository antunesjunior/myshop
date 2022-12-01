@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Compras</a>
                    <span class="breadcrumb-item active">Verificacao</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

     <!-- Checkout Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-6">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Entrega</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Nome</label>
                            <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Telefone - 1</label>
                            <input class="form-control" type="text" value="{{ $user->phones[0]->number }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Telefone - 2</label>
                            <input class="form-control" type="text" value="{{ $user->phones[1]->number }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Provincia</label>
                            <input class="form-control" type="text" value="{{ $address->province->name }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Municipio</label>
                            <input class="form-control" type="text" value="{{ $address->muni }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Bairro</label>
                            <input class="form-control" type="text" value="{{ $address->bairro }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Rua</label>
                            <input class="form-control" type="text" value="{{ $address->rua }}" readonly>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="col-lg-6">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Pedido Total</span></h5>
                <div class="bg-light p-30 mb-5">

                    <div class="border-bottom">
                        <h6 class="mb-3">Produtos</h6>

                        @foreach ($user->cart as $item)
                            <div class="d-flex justify-content-between">
                                <p>{{ $item->product->name }}</p>
                                <p>{{ $item->total }} kz(s)</p>
                            </div>
                        @endforeach
                       
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ $user->cart()->sum('total') }} kz(s)</h5>
                        </div>
                    </div>
                </div>
                
                <div class="mt-5">
                    <div class="bg-light p-10">
                        <a href="{{ route('user.shop', $address->id) }}" class="btn btn-block btn-primary font-weight-bold py-3">
                            Realizar Pagamento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->

    
@endsection
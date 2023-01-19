<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>NossaLoja</title>
</head>
<body>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fas fa-user-plus"></i> Criar Conta
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="{{ route('user.store') }}" method="POST">
                @csrf
                @method('POST')
    
                <div>
                    <label class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control">
                </div>
    
                <div class="my-4">
                    <label class="form-label">Email</label>
                   <input type="text" name="email" class="form-control">
                </div>
    
                <div>
                    <label class="form-label">Sexo</label>
                    <select name="gender" class="form-control">
                       <option value="m">Masculino</option>
                       <option value="f">Feminino</option>
                    </select>
                </div>
                <div class="row my-4">
                    <div class="col-6">
                        <label class="form-label">Telefone - 1</label>
                       <input type="text" name="phone_1" class="form-control">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Telefone - 2</label>
                       <input type="text" name="phone_2" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-4">
                        <input type="password" name="password" 
                            class="form-control" placeholder="Sua senha">
                    </div>
        
                    <div class="col-6 mb-4">
                        <input type="password" name="password_confirmation" 
                        class="form-control" placeholder="Confirmar senha">
                    </div>
                </div>
                <div class="modal-footer border-none">
                    <button class="btn btn-primary">Submeter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fas fa-sign-in-alt"></i> Login
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('user.login') }}" method="POST">
                @csrf
                @method('POST')
                <div class="my-4">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                   <input type="text" name="email" class="form-control">
                </div>
                <div class="my-4">
                    <label class="form-label"><i class="fas fa-lock"></i> Senha</label>
                    <input type="password" name="password" class="form-control">
                </div>
               
                <div class="modal-footer border-none">
                    <button class="btn btn-primary">Submeter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">
                <i class="fas fa-user-lock"></i> Administrador
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                @method('POST')
                <div class="my-4">
                    <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                   <input type="email" name="email" class="form-control">
                </div>
                <div class="my-4">
                    <label class="form-label"><i class="fas fa-lock"></i> Senha</label>
                    <input type="password" name="password" class="form-control">
                </div>
               
                <div class="modal-footer border-none">
                    <button class="btn btn-primary">Submeter</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">Ajuda</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>

            <div class="col-lg-6 text-center text-lg-right">
                @if (Auth::user())
                <div class="d-inline-flex align-items-center h-100 mx-2">
                    <p class="h6">
                        <i class="fas fa-user"></i>
                        <b>
                            {{ Auth::user()->name }}
                        </b>
                    </p>
                </div>
                @endif

                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Minha conta</button>

                        <div class="dropdown-menu dropdown-menu-right">
                            @if (Auth::user())
                            <a href="{{ route('user.profile') }}" class="dropdown-item" type="button">
                               <i class="fas fa-user"></i> Perfil
                            </a>
                                <a href="{{ route('user.logout') }}" class="dropdown-item" type="button">
                                   <i class="fas fa-sign-out-alt"></i> Sair
                                </a>
                            @else
                                <a href="#" class="dropdown-item" type="button" data-toggle="modal" data-target="#login">
                                  <i class="fas fa-sign-in-alt"></i> Login
                                </a>
                                <a href="#" class="dropdown-item" type="button" data-toggle="modal" data-target="#create">
                                   <i class="fas fa-user-plus"></i> Criar Conta
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="btn-group mx-2">
                        <a href="#" target="_blank" type="button" class="btn btn-sm btn-light" type="button" data-toggle="modal" data-target="#admin">
                            Admin
                        </a>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">PT</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <button class="dropdown-item" type="button">FR</button>
                            <button class="dropdown-item" type="button">EN</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            @if (session()->get('alert'))
                @include('shared.alert', [
                    'type' => session()->get('alert')['type'],
                    'message' => session()->get('alert')['message']
                ])
            @endif
            
            <div class="col-lg-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Nossa</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Loja</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="{{ route('user.search.products') }}" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="value" class="form-control" placeholder="Pesquisar por Produtos">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Apoio ao Cliente</p>
                <h5 class="m-0">+244 930 036 767</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                        @php
                            $categories = \App\Models\Category::whereNull('sup_category_id')->get();
                            $supCategories = \App\Models\SupCategory::all();
                        @endphp

                        <a href="{{ route('products.catalogue') }}" class="nav-item nav-link">Todos</a>

                        @foreach ($supCategories as $supCategory)

                            @if (!$supCategory->categories->isEmpty())

                                <div class="nav-item dropdown dropright">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                        {{ $supCategory->name }} <i class="fa fa-angle-right float-right mt-1"></i>
                                    </a>
                                    <div class="dropdown-menu position-absolute rounded-0 border-0 m-0">
                                        <a href="{{ route('products.catalogue.supcategory', $supCategory->id) }}" class="dropdown-item">Todos</a>
                                        @foreach ($supCategory->categories as $category)
                                            <a href="{{ route('products.catalogue.category', $category->id) }}" class="dropdown-item">
                                                {{ $category->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                            @endif

                        @endforeach
                        
                        @foreach ($categories as $category)
                            <a href="{{ route('products.catalogue.category', $category->id) }}" class="nav-item nav-link">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Nossa</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Loja</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('home') }}" class="nav-item nav-link">
                               <i class="fas fa-home"></i> Home
                            </a>
                            <a href="{{ route('products.catalogue') }}" class="nav-item nav-link">
                                <i class="fas fa-shopping-bag"></i> Comprar
                            </a>

                            @if (Auth::user())
                                <a href="{{ route('cart.index') }}" class=" nav-item nav-link">
                                    <i class="fas fa-shopping-cart"></i> Carrinho
                                    <span class="badge badge-light">{{ Auth::user()->cart->count() }}</span>
                                </a>
                            @endif

                            <a href="contact.html" class="nav-item nav-link">
                               Sobre nós
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

   
    <main>
        @yield('content')
    </main>

     <!-- Footer Start -->
     <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; 
                    <a class="text-primary" href="https://www.facebook.com/antunesjunior.junior" target="_blank">
                        Antunes Domingos
                    </a>
                    . Todos Direitos Reservados
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->
    
    <script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
    
    <script src="{{ asset('js/JQuery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
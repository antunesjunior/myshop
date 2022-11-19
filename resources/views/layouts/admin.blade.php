<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">

    <title>NossaLoja</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light py-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
                MinhaLoja
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
              <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('products.create') }}" class="nav-link active" aria-current="page" href="#">Produtos</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('categories.create') }}" class="nav-link active" 
                    aria-current="page" href="#">
                  Categorias
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('vendors.create') }}" class="nav-link active" 
                    aria-current="page" href="#">
                  Fornecedores
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pdf.reports') }}" class="nav-link active" 
                    aria-current="page" href="#">
                  Relatórios 
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.logout') }}" class="nav-link">Sair</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <main>
        @yield('content')
    </main>
    

    <script src="{{ asset('bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap/bootstrap.min.css') }}">

    <title>NossaLoja | admin</title>
</head>
<body>

    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-5 bg-dark" style="height: 100vh; padding: 0;">
                <img src="{{ asset('img/photo-capa-2.jpg') }}" class="img-fluid" style="height: 100%">
            </div>
            <div class="col-lg-4 offset-1">
            
                <h1 class="mt-4 mb-3">NossaLoja | Admin</h1>

                @if (session()->get('alert'))
                    <div class="alert alert-danger my-2" role="alert">
                        {{ session()->get('alert') }}
                    </div>
                @endif

                <form action="{{ route('user.auth') }}" method="Post">
                    @csrf
                    <div class="mb-3 mb-4">
                        <input type="email" name="email" 
                                class="form-control" placeholder="Seu email">
                    </div>
                
                    <div class="mb-3">
                        <input type="password" name="password" 
                                class="form-control" placeholder="Sua senha">
                    </div>

                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="flexCheckChecked">
                          <small>Manter-se conectado</small>
                        </label>
                    </div>

                    <input type="submit" value="entrar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
     
    
    <script src="{{ asset('bootstrap/bootstrap.min.css') }}"></script>
</body>
</html>
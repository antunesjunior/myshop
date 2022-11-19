@extends('layouts.app')

@section('content')
    @if (session()->get('alert'))
        <div class="alert alert-danger my-2" role="alert">
            {{ session()->get('alert') }}
        </div>
    @endif
    
    <div class="container-sm">
        <header>
            <h2>Login</h2>
        </header>

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
@endsection
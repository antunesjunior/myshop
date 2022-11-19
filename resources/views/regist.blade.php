@extends('layouts.app')

@section('content')
    <div class="container-sm">
        <header>
            <h2>Criar conta</h2>
        </header>

        @if (session()->get('alert'))
            <div class="alert alert-danger my-2" role="alert">
                {{ session()->get('alert') }}
            </div>
        @endif
        
        <form action="{{ route('user.store') }}" method="Post">
            @csrf
            <div class="row">
                <div class="col-4 mb-4">
                    <input type="text" name="name" 
                            class="form-control" placeholder="Seu nome">
                </div>
    
                <div class="col-4 mb-4">
                    <input type="email" name="email" 
                            class="form-control" placeholder="Seu email">
                </div>

                <div class="col-4 mb-4">
                    <label for="">Sexo:</label>
                    <select name="gender" class="form-select">
                        <option value="m">Masculino</option>
                        <option value="f">Feminino</option>
                    </select>
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

            <input type="submit" value="Criar Conta" class="btn btn-primary">
        </form>
    </div>
@endsection
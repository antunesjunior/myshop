@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="h6 pt-5">Bem-vindo ✨🎉</h2>
        <h2 class="h6 pb-3"><strong>Admin:</strong> {{ $admin->name }}</h2>

        <h2>Notificacoes</h2>
        <hr>
    </div>
@endsection
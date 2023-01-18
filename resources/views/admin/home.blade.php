@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="h6 pt-5">Bem-vindo ✨🎉</h2>
        <h2 class="h6 pb-3"><strong>Admin:</strong> {{ $admin->name }}</h2>

        <h2 class="bg-primary p-2" style="color: white">Notificacoes</h2>
        <hr>

        @if (!$stock->isEmpty())
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading"> <i class="fas fa-exclamation-triangle"></i> Produtos em Baixa quantidade</h4>
            <p>Verifique todos os produtos em baixa quantidade (inferior a 10 unidades) no stock na lista que se segue...</p>

        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Produto</th>
                    <th>Marca</th>
                    <th>Acção</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stock as $item)
                <tr>
                    <td>{{ $item->product->id }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->brand }}</td>
                    <td>
                        <form action="{{ route('feeds.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="product" value="{{ $item->product->id }}">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label">Fornecedor</label>
                                    <select name="vendor" class="form-select">
                                        <option value="0">Selecionar</option>
                                        @if (!$vendors->isEmpty())
                                            @foreach ($vendors as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Quantidade</label>
                                    <input type="number" min="1" value="{{ 550 }}" name="quantity" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="" style="visibility: hidden">Submeter</label>
                                    <input type="submit" class="form-control btn btn-secondary" value="Abastecer">
                                </div>
                            </div>
                          </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            {{ $stock->links() }}
        </div>
        @endif

       
@endsection
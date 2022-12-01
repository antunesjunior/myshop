@extends('layouts.app')

@section('content')

<div class="container-sm">
    <div class="row">
        <div class="col-10">
            <h3>Meus enderecos | Editar</h3>
            <form action="{{ route('address.update', $address->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row my-2">
                    <div class="col-6">
                        <label class="form-label">Provincia</label>
                        <select name="prov" class="form-control">
                            @if (!$provinces->isEmpty())
                                @foreach ($provinces as $item)
                                    <option 
                                    @php
                                        echo $item->id == $address->province_id ? 'selected':''
                                    @endphp
                                    value="{{ $item->id }}"
                                    >
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Municipio</label>
                       <input type="text" name="muni" class="form-control" value="{{ $address->muni }}">
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Bairro</label>
                       <input type="text" name="bairro" class="form-control" value="{{ $address->bairro }}">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Rua</label>
                       <input type="text" name="rua" class="form-control" value="{{ $address->rua }}">
                    </div>
                </div>
                <div class="modal-footer border-none">
                    <button class="btn btn-primary">Editar endereco</button>
                </div>
              </form>
        </div>
    </div>
</div>

@endsection
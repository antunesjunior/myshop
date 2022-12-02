@extends('layouts.pdf')

@section('title', "Relatório de Caixa de {$month} de {$year}")

@section('description')
    <p class="p-desc">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum aliquam a laudantium sed vel quod officiis, repellat quos dolores delectus! Pariatur blanditiis aliquam numquam aperiam consequuntur facilis quae explicabo quidem.
    </p>
@endsection

@section('content')
    <table border style="width: 100%; text-align:left;">
       <thead>
            <tr>
                <th>Mes</th>
                <th>Montante Arrecadado</th>
            </tr>
       </thead>
       <tbody>
            <tr>
                <td>{{ $month }}</td>
                <td>{{ $ammount }} kz(s)</td>
            </tr>
       </tbody>
    </table>
@endsection
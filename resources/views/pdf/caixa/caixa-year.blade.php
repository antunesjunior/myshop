@extends('layouts.pdf')

@section('title', "Relatório de Caixa de {$year}")

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
            @foreach ($months as $key => $month)
                <tr>
                    <td>{{ $month }}</td>
                    <td>{{ $values[$key] }} kz(s)</td>
                </tr>
            @endforeach
            <tr>
                <td style="background-color: black; color: #fff">
                    <h4>Total do caixa em {{ $year }}</h3>
                </td>
                <td>
                    <h4>{{ $yearTotal }} kz(s)</h3>
                </td>
            </tr>
       </tbody>
    </table>
@endsection
@extends('layouts.pdf')

@section('title', "Relatório de caixa desde {$from} à {$to}")

@section('description')
    <p class="p-desc">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum aliquam a laudantium sed vel quod officiis, repellat quos dolores delectus! Pariatur blanditiis aliquam numquam aperiam consequuntur facilis quae explicabo quidem.
    </p>
@endsection

@section('content')
    <table border style="width: 100%; text-align:center;">
       <thead>
            <tr>
                <th>Data</th>
                <th>Montante em caixa</th>
            </tr>
       </thead>
       <tbody>
            <tr>
                <td>{{ $from }} à {{ $to }}</td>
                <td>{{ $ammount }} kz(s)</td>
            </tr>
       </tbody>
    </table>
@endsection
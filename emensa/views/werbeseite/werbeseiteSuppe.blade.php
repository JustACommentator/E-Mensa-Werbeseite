@extends('werbeseite.app')

@section('content')
    <customselect>
        <table id="mealtable">
            <tr>
                <td><b>Bild</b></td>
                <td><b>Bezeichnung</b></td>
                <td><b>Preis intern</b></td>
                <td><b>Preis extern</b></td>
            </tr>

            @foreach($soup as $s)
                <tr>
                    <td>
                        @if($s['bild'] != null && file_exists("./img/gerichte/" . $s['bild']))
                            <img width="150" height="100" src="./img/gerichte/{{$s['bild']}}">
                        @else
                            <img width="150" height="100" src="./img/gerichte/00_image_missing.jpg">
                        @endif
                    </td>
                    <td> {{ $s['name'] }} </td>
                    <td style="text-align: right"> {{ number_format($s['preis_intern'], 2) }}€</td>
                    <td style="text-align: right"> {{ number_format($s['preis_extern'], 2) }}€</td>
                </tr>
            @endforeach

        </table>
        <br>
    </customselect>
@endsection
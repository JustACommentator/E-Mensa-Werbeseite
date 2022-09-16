@extends('werbeseite.app')

@section('content')

    <review>
        <form method="post" action="/bewertung?gerichtid={{$meal['id']}}">
            <table>
                <tr>
                    <td>
                        @if($meal['bild'] != null && file_exists("./img/gerichte/" . $meal['bild']))
                            <img width="150" height="100" src="./img/gerichte/{{$meal['bild']}}">
                        @else
                            <img width="150" height="100" src="./img/gerichte/00_image_missing.jpg">
                        @endif

                    </td>
                    <td>{{$meal['name']}}</td>
                </tr>

                <tr>
                    <td><label for="bewertung">Bewertung:</label></td>
                    <td><label for="kommentar">Kommentar:</label><br></td>
                </tr>
                <tr>
                    <td><select name="bewertung" id="bewertung">
                            <option value="4" selected>sehr gut</option>
                            <option value="3">gut</option>
                            <option value="2">schlecht</option>
                            <option value="1">sehr schlecht</option>
                        </select><br></td>
                    <td><textarea required maxlength="140" cols="30" rows="5"
                                  style="height: 75px; width: 250px; resize: none;"
                                  placeholder="Kommentar (min. 5 Zeichen)" id="kommentar" name="kommentar"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit"></td>
                </tr>

            </table>
        </form>

        </reviewselect>
    </review>
    <a style="display:flex; justify-content: center; color: red">
        {{$message}}
    </a>
@endsection
@extends('werbeseite.app')

@section('content')
    <review>
        <table id="reviews">
            @foreach($data as $review)
                @if($user != null)
                    @if($review['benutzerid'] == $user['id'])
                        <tr class="{{$review['hervorgehoben'] ? "highlighted" : ""}}">
                            <td style="border: none">
                                <a style="text-decoration: none" title="Review löschen"
                                   href="/deletereview?gerichtid={{$review['gerichtid']}}">
                                    {{"\u{1F5D1}"}}
                                </a>
                            </td>
                            <td>
                                @for($i = 0; $i < sizeof($meal); $i++)
                                    @if($meal[$i]['id'] == $review['gerichtid'])

                                        @if($meal[$i]['bild'] != null && file_exists("./img/gerichte/" . $meal[$i]['bild']))
                                            <img width="150" height="100" src="./img/gerichte/{{$meal[$i]['bild']}}">
                                        @else
                                            <img width="150" height="100" src="./img/gerichte/00_image_missing.jpg">
                                        @endif

                                        @break
                                    @endif
                                @endfor
                            </td>

                            <td style="max-width: 250px; word-wrap: break-word">
                                @for($i = 0; $i < sizeof($meal); $i++)
                                    @if($meal[$i]['id'] == $review['gerichtid'])
                                        {{$meal[$i]['name']}}
                                    @endif
                                @endfor
                            </td>

                            <td>
                                @for($i = 1; $i <= $review['bewertung']; $i++)
                                    {{"\u{2B50}"}}
                                @endfor
                            </td>

                            <td style="max-width: 250px; word-wrap: break-word">
                                "{{$review['kommentar']}}"
                            </td>

                            <td>
                                {{$review['verfasst_am']}}
                            </td>
                        </tr>
                    @endif
                @endif
            @endforeach
        </table>

        </reviewselect>
    </review>
@endsection
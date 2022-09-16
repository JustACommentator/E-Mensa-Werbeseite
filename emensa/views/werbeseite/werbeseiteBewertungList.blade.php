@extends('werbeseite.app')

@section('content')
    <review>
        <table id="reviews">
            @foreach($data as $review)
                {{-- @php($num = -1) /sadly doesn't work --}}
                <tr class="{{$review['hervorgehoben'] ? "highlighted" : ""}}">
                    @if($user != null && $user['admin'])
                        <td style="border:none">
                            @if($review['hervorgehoben'])
                                <a style="text-decoration: none"
                                   href="/highlight?highlight={{0}}&benutzerid={{$review['benutzerid']}}&gerichtid={{$review['gerichtid']}}">
                                    {{"\u{2796}"}}
                                </a>
                            @else
                                <a style="text-decoration: none"
                                   href="/highlight?highlight={{1}}&benutzerid={{$review['benutzerid']}}&gerichtid={{$review['gerichtid']}}">
                                    {{"\u{2795}"}}
                                </a>
                            @endif
                        </td>
                    @endif
                    <td>
                        @for($i = 0; $i < sizeof($meal); $i++)
                            @if($meal[$i]['id'] == $review['gerichtid'])
                                {{-- @php($num = $i) /sadly doesn't work --}}

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
                        {{-- {{$meal[$num]['name']}} /sadly doesn't work --}}
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
                        @if($user != null)
                            @if($review['benutzerid'] == $user['id'])
                                {{" *"}}
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

        </reviewselect>
    </review>

    @if($user != null)
        <div style="text-align: center">* = selbst verfasst</div>
        <a class="link" href="meinebewertungen">
            <div style="text-align: center">Meine Bewertungen</div>
        </a>
    @endif
@endsection
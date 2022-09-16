@extends('werbeseite.app')

@section('content')
    <customselect>

        <img src="./img/banner.png" alt="requiredField" width="1000" height="350">
        <h1 id="headline1">Bald gibt es Essen auch online ;)</h1>

        <div style="position:relative; width: 0; height: 0;">
            <img id="cat" src="./img/cat.png" style="position: absolute; top: 5px; left: 260px;">
        </div>

        <p id="loremtext">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
            invidunt ut labore<br>
            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut<br>
            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum<br>
            dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui<br>
            officia deserunt mollit anim id est laborum.<br><br>
            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque daudantium,<br>
            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae<br>
            dicta sunt explicabo. Nemo enim ipsam voluptatem quia volptas sit aspernatur aut odit aut fugit,<br>
            sed quia consequuntur magni dolores eos qui ratione volptatem sequi nesciunt.</p>

        <h1 id="headline2">Köstlichkeiten, die Sie erwarten</h1>
        <table id="mealtable">
            <tr>
                <td><b>Bild</b></td>
                <td><b>Bezeichnung</b></td>
                <td><b>Preis intern</b></td>
                <td><b>Preis extern</b></td>
            </tr>

            @foreach($meal as $m)
                @break($loop->index == 5)
                <tr>
                    <td>
                        @if($m['bild'] != null && file_exists("./img/gerichte/" . $m['bild']))
                            <img width="150" height="100" src="./img/gerichte/{{$m['bild']}}">
                        @else
                            <img width="150" height="100" src="./img/gerichte/00_image_missing.jpg">
                        @endif
                    </td>
                    <td> {{ $m['name'] }}
                        @if(isset($_SESSION['login']) && $_SESSION['login'])
                            <span title="Gericht bewerten">
                            <a style="text-decoration: none"
                               href="/bewertung?gerichtid={{$m['id']}}">{{"\u{2B50}"}}
                            </a>
                            </span>
                            <!-- Star-emoji -->
                        @endif </td>
                    <td style="text-align: right"> {{ $m['preis_intern'] }}€</td>
                    <td style="text-align: right"> {{ $m['preis_extern'] }}€</td>
                </tr>
            @endforeach

        </table>
        <br>

        <!-- reviews-->
        @if(!empty($highlighted))
            <h3>Hervorgehobene Reviews!</h3>
            <ul style="list-style-type: none; line-height: 2">
                @foreach($highlighted as $review)
                    <li>"{{$review['kommentar']}}" -
                        @for($i = 0; $i < $review['bewertung']; $i++)
                            {{"\u{2B50}"}}
                        @endfor
                        -
                        @foreach($meal as $m)
                            @if($m['id'] == $review['gerichtid'])
                                {{$m['name']}}</li>
                    @endif
                @endforeach
                @endforeach
            </ul>
        @endif

        <a class="link" href="/bewertungen">Alle Bewertungen</a>

        <!-- Wunschgericht-->
        <h2>Nichts für Sie dabei?</h2>
        <a class="link" href="/wunschgericht">Reichen Sie Anfragen für Ihre Wunschgerichte ein!</a>
        <br>

        <h1 id="headline4">Interesse geweckt? Wir informieren Sie!</h1>

        <!--Newsletteranmeldung-->
        <form method="post" action="/newsletter">
            <table id="newsletter">
                <tr>
                    <td><label for="newsletter_vorname">Ihr Name:</label></td>
                    <td><label for="newsletter_mail">Ihre E-Mail:</label></td>
                    <td><label for="newsletter_lang">Newsletter bitte in:</label><br></td>
                </tr>
                <tr>
                    <td><input required type="text" placeholder="Vorname" id="newsletter_vorname"
                               name="newsletter_vorname"></td>
                    <td><input required type="email" placeholder="g.hoever@mathe.de" id="newsletter_mail"
                               name="newsletter_mail"
                               value="{{isset($_SESSION['login']) && $_SESSION['login'] == true ? $_SESSION['email'] : ""}}">
                    </td>
                    <td><select name="newsletter_lang" id="newsletter_lang">
                            <option value="1" selected>Deutsch</option>
                            <option value="2">English</option>
                            <option value="3">한국인</option>
                            <option value="4">蘇格瑪</option>
                        </select><br></td>
                </tr>
                <tr>
                    <td colspan="3"><input required type="checkbox" id="newsletter_datenschutz"
                                           name="newsletter_datenschutz">
                        <label for="newsletter_datenschutz">Den Datenschutzbestimmungen stimme ich zu</label>
                        <input type="submit" id="newsletter_submit" name="newsletter_submit"></td>
                </tr>
            </table>
        </form>


        <h1 id="headline5">Das ist uns wichtig</h1>
        <ul style="text-align: center">
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>

        <h1 style="text-align: center">Wir freuen uns auf Ihren Besuch!</h1>
    </customselect>
@endsection
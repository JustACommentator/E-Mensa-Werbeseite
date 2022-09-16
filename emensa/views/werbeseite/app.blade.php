<!DOCTYPE html>
<!--
    - Praktikum DBWT. Autoren:
    - Tim Bering, 3281627
    - Tarik Glasmacher, 3277950
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Die E-Mensa</title>
    <link rel="stylesheet" href="{{ './css/emensastyle.css' }}">
</head>
<body>

<span class="top">
    <a id="logo" href="/"><abbr title="Die E-Mensa"><img
                    src="./img/mensa_logo.png" width="150" height="50" alt="Die E-Mensa"></abbr></a>
  @if(isset($_SESSION['login']) && $_SESSION['login'] == true)
        <a>angemeldet als {{$_SESSION['email']}}</a> &nbsp &nbsp
        <a class="link" href="/logout">abmelden</a>
    @else
        nicht angemeldet &nbsp &nbsp
        <a class="link" href="/login">anmelden</a>
    @endif
    <nav id="linklist">
  <a class="link" href="#headline1">Ankündigung</a>
        |
  <a class="link" href="#headline2">Speisen</a>
        |
  <a class="link" href="#headline3">Zahlen</a><br>
        |
  <a class="link" href="#headline4">Kontakt</a>
        |
  <a class="link" href="#headline5">Wichtig für uns</a>
  </nav>
</span>


<hr class="line">

@yield('content')

<hr class="line">
<footer>
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Tim Bering & Tarik Glasmacher</li>
        <li><a class="link" href="http://eelslap.com/">Impressum</a></li>
    </ul>
</footer>
</body>
</html>
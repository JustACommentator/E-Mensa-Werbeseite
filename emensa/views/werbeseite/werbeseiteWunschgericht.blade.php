@extends('werbeseite.app')

@section('content')
    <customselect>
        <form method="post" action="/wunschgericht">
            <fieldset id="#wunschgericht" >
                <legend><h2>Zeigen Sie uns Ihr Wunschgericht!</h2></legend>
                <label for="wunschgericht_vorname">Vorname</label>
                <br>
                <input id="wunschgericht_vorname" name="wunschgericht_vorname"type="text" placeholder="Vorname">
                <br><br>
                <label for="wunschgericht_email">e-Mail*</label>
                <br>
                <input required id="wunschgericht_email" name="wunschgericht_email" type="text" placeholder="e-Mail">
                <br><br>
                <label for="wunschgericht_name" type="text">Name des Gerichts*</label>
                <br>
                <input required id="wunschgericht_name" name="wunschgericht_name" type="text" placeholder="Name des Gerichts">
                <br><br>
                <label for="wunschgericht_beschreibung" type="text">Beschreibung des Gerichts*</label>
                <br>
                <textarea required id="wunschgericht_beschreibung" name="wunschgericht_beschreibung" type="textarea" placeholder="Beschreibung des Gerichts (ggf. mit Zubereitungsanweisungen)" style="height: 100px; width: 500px; resize: none"></textarea>
                <br>
                <input type="submit" value="Einreichen">
            </fieldset>
        </form>
        @if($success)
            Ihre Anfrage wird bearbeitet!
        @endif
    </customselect>
@endsection
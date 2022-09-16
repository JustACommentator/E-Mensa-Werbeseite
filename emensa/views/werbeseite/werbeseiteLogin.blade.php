@extends('werbeseite.app')

@section('content')
    <parent>
        <loginselect>
            <form method="post" action="/login">
                <label for="login_email">e-Mail:</label><br>
                <input type="email" id="login_email" name="email"><br>
                <label for="login_passwort">Passwort:</label><br>
                <input type="password" id="login_passwort" name="passwort"><br>
                <input type="submit" value="Anmelden">
            </form>
            <customselect>
                @if(!is_null($success) AND $success != 'success')
                    <a style="color: crimson;">Inkorrekte Angaben!</a>
                @endif
            </customselect>
        </loginselect>
    </parent>
@endsection
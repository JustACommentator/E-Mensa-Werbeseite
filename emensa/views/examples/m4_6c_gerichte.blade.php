<!DOCTYPE html>
<html lang="de">
<head>
    <title>Gerichte</title>
</head>
<body>
@forelse($gericht as $meal)
    @if($meal['preis_intern'] > 2)
        <ul>
            <li>{{ $meal['name'] }}</li>
        </ul>
    @endif
@empty
    Es sind keine Gerichte vorhanden
@endforelse
</body>
</html>
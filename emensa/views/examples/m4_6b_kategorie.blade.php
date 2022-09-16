<!DOCTYPE html>
<html lang="de">
<head>
    <title>kategorieliste</title>
    <style>
        .odd {
            font-weight: bold;
        }
    </style>
</head>
<body>
@foreach($kategorie as $kat)
    <ul>
        <li class="{{ $loop->odd ? "odd" : ""}}"> {{ $kat['name'] }} </li>
    </ul>
@endforeach
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Reis Resultaat</title>
</head>
<body>
    <h1>Reis Resultaat</h1>

    <p>Reistijd: {{ $reistijd }}</p>
    <p>Afstand: {{ $afstand }} km</p>
    <p>Kosten: €{{ $kosten }}</p>

    <a href="{{ route('reis.form') }}">Bereken een andere reis</a>
</body>
</html>

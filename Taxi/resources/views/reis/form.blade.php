<!DOCTYPE html>
<html>
<head>
    <title>Reis Berekenen</title>
</head>
<body>
    <h1>Voer uw bestemming in</h1>

    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reis.bereken') }}" method="POST">
        @csrf
        <label for="bestemming">Bestemming:</label>
        <input type="text" name="bestemming" id="bestemming" required>
        <button type="submit">Bereken Reis</button>
    </form>
</body>
</html>

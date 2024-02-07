<!-- resources/views/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Subdomain</title>
</head>
<body>
    <h1>Informasi Subdomain:</h1>

    @if (isset($subdomain))
        <p>Subdomain Sekarang: {{ $subdomain }}</p>
    @else
        <p>URL Sekarang: {{ url('/') }}</p>
    @endif

    {{-- @if (isset($subdomain))
        <p><a href="{{ route('root') }}">Kembali ke Root</a></p>
    @endif

    <form action="{{ route('process.query.post') }}" method="POST">
        @csrf
        <label for="query">Masukkan Query:</label>
        <input type="text" id="query" name="query" placeholder="Contoh: subdomain1" required>
        <button type="submit">Submit</button>
    </form> --}}
</body>
</html>

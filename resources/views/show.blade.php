<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Query</title>
</head>
<body>
    <h1>Form Input Query</h1>

    <form action="{{ route('process.query') }}" method="POST">
        @csrf
        <label for="query">Masukkan Query:</label>
        <input type="text" id="query" name="query" placeholder="Contoh: subdomain1" required>
        <button type="submit">Submit</button>
    </form>

    @if (request()->has('query'))
        <p>Hasil Query: {{ request()->query('query') }}</p>
        <p>URL Sekarang: {{ url('/') }}</p>
    @endif
</body>
</html>

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
        <p>URL Sekarang: {{ url()->current() }}</p>
    @else
        <p>URL Sekarang: {{ url('/') }}</p>
    @endif


    <form action="{{ route('process.query.post') }}" method="POST">
        @csrf
        <label for="query">Masukkan Query:</label>
        <input type="text" id="query" name="query" placeholder="Contoh: subdomain1" required>
        <button type="submit">Submit</button>
    </form>
</body>

<script>
    // Ambil nilai hasil query dari localStorage saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        var storedResult = localStorage.getItem('storedResult');
        if (storedResult) {
            document.getElementById('result').innerText = storedResult;
        }
    });

    // Fungsi untuk menyimpan hasil query ke localStorage
    function saveResult(result) {
        localStorage.setItem('storedResult', result);
    }
</script>
</html>

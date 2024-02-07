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

    <!-- Tambahkan hasil query di sini -->
    @if (isset($text))
        <h2>Hasil Query:</h2>
        <pre id="resultText">{{ $text }}</pre>
    @elseif (isset($subdomain))
        <h2>Hasil Query:</h2>
        <p>File JSON tidak ditemukan untuk subdomain {{ $subdomain }}.</p>
    @else
        <p>Terjadi kesalahan dalam mendapatkan hasil dari API.</p>
    @endif

    <form action="{{ route('process.query.post') }}" method="POST">
        @csrf
        <label for="query">Masukkan Query:</label>
        <input type="text" id="query" name="query" placeholder="Contoh: subdomain1" required>
        <button type="submit">Submit</button>
    </form>

    <script>


        // Fungsi untuk mengirim permintaan AJAX saat halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            submitForm();
        });

        function submitForm() {
        // Ambil URL lengkap dari browser

            var fullUrl = window.location.href;

            // Hapus protokol dari URL
            var urlWithoutProtocol = fullUrl.replace(/(^\w+:|^)\/\//, '');

            // Ambil protokol dari URL
            var protocol = window.location.protocol + '//';

            // Pisahkan URL berdasarkan titik (.)
            var urlParts = urlWithoutProtocol.split('.');

            // Ambil subdomain yang pertama (indeks 0)
            var subdomain = urlParts[0];
            var rootDomain = urlParts.length > 2 ? urlParts[1] + '.' + urlParts[2] : urlParts[0];
            // Persiapkan path untuk file JSON
            var jsonFilePath = protocol +rootDomain+'/responses/' + subdomain + '.json';

            // Menggunakan AJAX untuk memuat file JSON
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // File JSON berhasil dimuat, tampilkan hasil pada elemen dengan id 'resultText'
                        document.getElementById('resultText').innerText = JSON.parse(xhr.responseText).candidates[0].content.parts[0].text;
                    } else {
                        // File JSON tidak ditemukan, tampilkan pesan
                        document.getElementById('resultText').innerText = 'File JSON tidak ditemukan untuk subdomain ' + subdomain + '.';
                    }
                }
            };
            xhr.open('GET', jsonFilePath, true);
            xhr.send();
        }
    </script>
</body>
</html>

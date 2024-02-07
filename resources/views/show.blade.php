<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Subdomain</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <!-- Tambahkan hasil query di sini -->
       <div id="resultContainer">
        <h2>Hasil Query:</h2>
        <div id="resultText"></div>
    </div>

    <form action="{{ route('process.query.post') }}" method="POST">
        @csrf
        <label for="query">Masukkan Query:</label>
        <input type="text" id="query" name="query" placeholder="Contoh: subdomain1" required>
        <button type="submit">Submit</button>
    </form>

    <script>
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
        // Ambil protokol dan path untuk file JSON
        var protocol = window.location.protocol;
        var jsonFilePath = protocol + '//' + rootDomain + '/responses/' + subdomain + '.json';

        // Lakukan permintaan AJAX
        $.ajax({
            url: jsonFilePath,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Tampilkan hasil di elemen dengan id 'resultText'
                $('#resultText').html(response.candidates[0].content.parts[0].text);
            },
            error: function() {
                // Tangani kesalahan jika permintaan gagal
                $('#resultText').text('Terjadi kesalahan dalam mendapatkan hasil dari API.');
            }
        });
    </script>
</body>
</html>

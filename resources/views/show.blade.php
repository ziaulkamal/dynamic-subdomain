<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Subdomain</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Tambahkan hasil query di sini -->
    <div id="resultContainer">
        <h2>Hasil Query:</h2>

        @php

            $currentUrl = url()->current();

            // Menggunakan parse_url untuk mendapatkan bagian host dari URL
            $host = parse_url($currentUrl, PHP_URL_HOST);

            // Menggunakan explode untuk memisahkan host berdasarkan titik (.)
            $hostParts = explode('.', $host);

            // Mengambil subdomain, yang merupakan bagian pertama dari array hasil explode
            $subdomain = $hostParts[0];
            $subdomain = str_replace('-', ' ', $subdomain);
            $prefixQuery = str_replace('-', '%2520', $subdomain);
            $prefixSearch = str_replace('-', '%20', $subdomain);

        @endphp
        <iframe frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" scrolling="no" width="100%" name="{&quot;name&quot;:&quot;master-1&quot;,&quot;master-a-1&quot;:{&quot;fexp&quot;:&quot;21404,17301374,17301375,17301383,71847096&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;google-coop&quot;,&quot;query&quot;:&quot;{{ $subdomain }}&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;columns&quot;:1,&quot;horizontalAlignment&quot;:&quot;left&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_top&quot;},&quot;master-b-1&quot;:{&quot;fexp&quot;:&quot;21404,17301374,17301375,17301383,71847096&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;google-coop&quot;,&quot;query&quot;:&quot;{{ $subdomain }}&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;columns&quot;:1,&quot;horizontalAlignment&quot;:&quot;left&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_top&quot;},&quot;master-1&quot;:{&quot;cx&quot;:&quot;d51b528743bae2bed&quot;,&quot;fexp&quot;:&quot;20606,17301374,17301375,17301383,71847096&quot;,&quot;gcsc&quot;:true,&quot;masterNumber&quot;:1,&quot;number&quot;:null,&quot;pubId&quot;:&quot;google-coop&quot;,&quot;query&quot;:&quot;{{ $subdomain }}&quot;,&quot;role&quot;:&quot;m&quot;,&quot;source&quot;:&quot;gcsc&quot;,&quot;sct&quot;:&quot;ID=32370a6f3f908ab1:T=1707203224:RT=1707203224:S=ALNI_MZQdAYOAI3ZD6gOsPTtsto3BGN2qg&quot;,&quot;sc_status&quot;:6,&quot;hl&quot;:&quot;en&quot;,&quot;ivt&quot;:false,&quot;position&quot;:&quot;top&quot;,&quot;cseGoogleHosting&quot;:&quot;partner&quot;,&quot;columns&quot;:1,&quot;horizontalAlignment&quot;:&quot;left&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:4,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_top&quot;}}" id="master-1" src="https://www.adsensecustomsearchads.com/cse_v2/ads?adsafe=high&amp;cx=d51b528743bae2bed&amp;fexp=20606%2C17301374%2C17301375%2C17301383%2C71847096&amp;client=google-coop&amp;q={{ $prefixSearch }}&amp;r=m&amp;sct=ID%3D32370a6f3f908ab1%3AT%3D1707203224%3ART%3D1707203224%3AS%3DALNI_MZQdAYOAI3ZD6gOsPTtsto3BGN2qg&amp;sc_status=6&amp;hl=en&amp;ivt=0&amp;type=0&amp;oe=UTF-8&amp;ie=UTF-8&amp;format=p4&amp;ad=p4&amp;nocache=5021707290308710&amp;num=0&amp;output=uds_ads_only&amp;source=gcsc&amp;v=3&amp;bsl=10&amp;pac=0&amp;u_his=1&amp;u_tz=420&amp;dt=1707290308711&amp;u_w=1920&amp;u_h=1080&amp;biw=1918&amp;bih=993&amp;psw=1918&amp;psh=993&amp;frm=0&amp;cl=603129119&amp;uio=-&amp;drt=0&amp;jsid=csa&amp;nfp=1&amp;jsv=603129119&amp;rurl=https%3A%2F%2Fwww.backlinkahrefs.com%2Fp%2Fsearchh.html%3Fs%3D{{ $prefixQuery }}%23gsc.tab%3D0%26gsc.q%3D{{ $prefixQuery }}%26gsc.page%3D1&amp" style="visibility: visible; height: 471px; display: block;" title="Ads by Google"></iframe>
        <div id="resultText"></div>


    </div>
    <form id="searchForm" action="{{ url('search') }}" method="get" class="hidden">
        <input type="text" name="query" id="queryInput" >
        <input type="hidden" name="anchorText" id="anchorTextInput">
    </form>

    <form action="{{ route('process.query.post') }}" method="POST">
        @csrf
        <label for="query">Masukkan Query:</label>
        <input type="text" id="query" name="query" placeholder="Contoh: subdomain1" required>
        <button type="submit">Submit</button>
    </form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var anchorContainer = document.getElementById('resultContainer');

        anchorContainer.addEventListener('click', function(event) {
            var clickedElement = event.target;

            // Periksa apakah elemen yang diklik adalah anchor text
            if (clickedElement.classList.contains('searchAnchor')) {
                var anchorText = clickedElement.innerText;

                // Pastikan elemen ditemukan sebelum mengatur nilai
                var queryInput = document.getElementById('queryInput');
                var anchorTextInput = document.getElementById('anchorTextInput');

                if (queryInput && anchorTextInput) {
                    queryInput.value = anchorText;
                    anchorTextInput.value = anchorText;

                    // Mensubmit formulir
                    document.getElementById('searchForm').submit();

                    // Log ke konsol
                    console.log('Anchor Text yang diklik:', anchorText);
                }
            }
        });
    });
</script>

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

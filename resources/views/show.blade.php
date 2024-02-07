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

    @if (isset($subdomain))
        <p>URL Sekarang: {{ url()->current() }}</p>
    @else
        <p>URL Sekarang: {{ url('/') }}</p>
    @endif
        <iframe frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" scrolling="no" width="100%" name="{&quot;name&quot;:&quot;master-1&quot;,&quot;master-a-1&quot;:{&quot;fexp&quot;:&quot;21404,17301374,17301375,17301383,71847096&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;google-coop&quot;,&quot;query&quot;:&quot;dedicated server&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;columns&quot;:1,&quot;horizontalAlignment&quot;:&quot;left&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_top&quot;},&quot;master-b-1&quot;:{&quot;fexp&quot;:&quot;21404,17301374,17301375,17301383,71847096&quot;,&quot;masterNumber&quot;:1,&quot;number&quot;:0,&quot;pubId&quot;:&quot;google-coop&quot;,&quot;query&quot;:&quot;dedicated server&quot;,&quot;role&quot;:&quot;s&quot;,&quot;adLoadedCallback&quot;:null,&quot;columns&quot;:1,&quot;horizontalAlignment&quot;:&quot;left&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:0,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_top&quot;},&quot;master-1&quot;:{&quot;cx&quot;:&quot;d51b528743bae2bed&quot;,&quot;fexp&quot;:&quot;20606,17301374,17301375,17301383,71847096&quot;,&quot;gcsc&quot;:true,&quot;masterNumber&quot;:1,&quot;number&quot;:null,&quot;pubId&quot;:&quot;google-coop&quot;,&quot;query&quot;:&quot;dedicated server&quot;,&quot;role&quot;:&quot;m&quot;,&quot;source&quot;:&quot;gcsc&quot;,&quot;sct&quot;:&quot;ID=32370a6f3f908ab1:T=1707203224:RT=1707203224:S=ALNI_MZQdAYOAI3ZD6gOsPTtsto3BGN2qg&quot;,&quot;sc_status&quot;:6,&quot;hl&quot;:&quot;en&quot;,&quot;ivt&quot;:false,&quot;position&quot;:&quot;top&quot;,&quot;cseGoogleHosting&quot;:&quot;partner&quot;,&quot;columns&quot;:1,&quot;horizontalAlignment&quot;:&quot;left&quot;,&quot;resultsPageQueryParam&quot;:&quot;query&quot;,&quot;ie&quot;:&quot;UTF-8&quot;,&quot;maxTop&quot;:4,&quot;minTop&quot;:0,&quot;oe&quot;:&quot;UTF-8&quot;,&quot;type&quot;:&quot;ads&quot;,&quot;linkTarget&quot;:&quot;_top&quot;}}" id="master-1" src="https://www.adsensecustomsearchads.com/cse_v2/ads?adsafe=high&amp;cx=d51b528743bae2bed&amp;fexp=20606%2C17301374%2C17301375%2C17301383%2C71847096&amp;client=google-coop&amp;q=dedicated%20server&amp;r=m&amp;sct=ID%3D32370a6f3f908ab1%3AT%3D1707203224%3ART%3D1707203224%3AS%3DALNI_MZQdAYOAI3ZD6gOsPTtsto3BGN2qg&amp;sc_status=6&amp;hl=en&amp;ivt=0&amp;type=0&amp;oe=UTF-8&amp;ie=UTF-8&amp;format=p4&amp;ad=p4&amp;nocache=5021707290308710&amp;num=0&amp;output=uds_ads_only&amp;source=gcsc&amp;v=3&amp;bsl=10&amp;pac=0&amp;u_his=1&amp;u_tz=420&amp;dt=1707290308711&amp;u_w=1920&amp;u_h=1080&amp;biw=1918&amp;bih=993&amp;psw=1918&amp;psh=993&amp;frm=0&amp;cl=603129119&amp;uio=-&amp;drt=0&amp;jsid=csa&amp;nfp=1&amp;jsv=603129119&amp;rurl=https%3A%2F%2Fwww.backlinkahrefs.com%2Fp%2Fsearchh.html%3Fs%3Ddedicated%2520server%23gsc.tab%3D0%26gsc.q%3Ddedicated%2520server%26gsc.page%3D1&amp;referer=https%3A%2F%2Fwww.backlinkahrefs.com%2F2023%2F07%2Fdont-waste-time-9-facts-until-you-get.html" style="visibility: visible; height: 271px; display: block;" title="Ads by Google"></iframe>
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

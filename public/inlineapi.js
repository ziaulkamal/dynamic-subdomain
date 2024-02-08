// main.js

// Function untuk memeriksa apakah jQuery sudah ada
function isjQueryLoaded() {
    return (typeof window.jQuery !== 'undefined');
}

// Function untuk memuat jQuery jika belum ada
function loadjQuery(callback) {
    var script = document.createElement('script');
    script.src = 'https://code.jquery.com/jquery-3.5.1.min.js';
    script.type = 'text/javascript';
    script.onload = function() {
        callback();
    };
    document.head.appendChild(script);
}

// Memeriksa apakah jQuery sudah ada
if (isjQueryLoaded()) {
    // Jika sudah ada, jalankan skrip langsung
    submitAjaxRequest();
} else {
    // Jika belum ada, muat jQuery terlebih dahulu
    loadjQuery(function() {
        // Setelah jQuery dimuat, jalankan skrip
        submitAjaxRequest();
    });
}

function submitAjaxRequest() {
    const fullPath = window.location.pathname;
    const pathSegments = fullPath.split('/');

    // Memeriksa apakah ada segment
    if (pathSegments.length > 1) {
        let lastSegment = pathSegments[pathSegments.length - 1];

        // Jika segment terakhir kosong, ambil segment sebelumnya
        if (!lastSegment) {
            lastSegment = pathSegments[pathSegments.length - 2];
        }

        const [fileName, fileExtension] = lastSegment.split('.');
        const modifiedQuery = fileName.replace(/ /g, '-');

        if (modifiedQuery != ' ') {
            // Lakukan apa yang perlu Anda lakukan dengan modifiedQuery
            console.log(modifiedQuery);
            const apiUrl = 'https://sample.mindkreativ.com/api/blogspot-endpoint/xhr';
            const requestData = {
                query: modifiedQuery,
                // Tambahan data lain yang mungkin ingin Anda kirim
            };

            $.ajax({
                url: apiUrl,
                type: 'POST',
                dataType: 'json',
                crossDomain: true,
                data: requestData,
                success: function(response) {
                    console.log('Berhasil mengirim permintaan:', response);
                },
                error: function(error) {
                    console.error('Gagal mengirim permintaan:', error);
                }
            });
            console.log('tidak ada yang di kirim');
        }
    } else {
        // Tidak ada segment, kembalikan false atau lakukan apa yang diperlukan
        console.log('tidak ada yang di kirim');
    }
}

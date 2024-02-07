<?php
use Illuminate\Support\Facades\DB;
use App\Models\Query;

// Load Laravel
require_once __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
// Ambil query dari penyimpanan sementara (contoh: menggunakan tabel 'queries')
// $queries = DB::table('queries')->get();
$queries = Query::all();
// dd($queries->count());
// Proses setiap query
foreach ($queries as $query) {
    // Lakukan sesuatu dengan query (contoh: panggil metode di SubdomainController)
    // Pastikan bahwa 'subdomain.processQuery' adalah route yang benar
    // \Illuminate\Support\Facades\Http::post(route('subdomain.processQuery'), ['query' => $query->query]);

        $getQuery = $query->query;
           // Ganti spasi dengan tanda hubung
        $subdomain = Str::slug($getQuery);

        // Persiapkan path untuk file JSON
        $jsonFilePath = public_path("responses/{$subdomain}.json");

        // Cek apakah file JSON sudah ada
        if (File::exists($jsonFilePath)) {
            // Jika sudah ada, baca isi file JSON dan tampilkan teks
            $jsonContent = File::get($jsonFilePath);
            $responseData = json_decode($jsonContent, true);
            $text = $responseData['candidates'][0]['content']['parts'][0]['text'];

            // Kirim hasil sebagai variabel ke blade show di subdomain
            // return redirect()->route('subdomain.show', ['subdomain' => $subdomain])->with(compact('text', 'query'));
            DB::table('queries')->where('id', $query->id)->delete();
            return 'ini sudah ada dengan nama file  :' . $jsonFilePath;
        }
        $basePrompt = "buatkan saya artikel dengan bahasa menarik, memiliki opening dan closing, setiap awalan tag heading memiliki kalimat penjelasan 1 pargraph dan di lanjutkan dengan narasi berikutnya, dengan format ada tag <h1>,<h2>,<h3> sampai <h6>, jika memang ada list maka sesuaikan tag nya, untuk gambar gunakan tag <img> ,dan jika ada gambar terapkan ke img src sesuai dengan tautan gambar berdasarkan prompt yang saya berikan, saya ingin gambar di tambahkan unik sesuai dengan prompt, untuk peletakan gambar di setiap subheading, artikel di buat dengan panjang kata 1900 kata, prompt nya ";
        $closePrompt = ". pastikan compatible dengan format html";
        // Jika file JSON belum ada, jalankan permintaan API
        $apiData = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => $basePrompt . $query->query .$closePrompt
                        ]
                    ]
                ]
            ],
            "generationConfig" => [
                "temperature" => 0.9,
                "topK" => 1,
                "topP" => 1,
                "maxOutputTokens" => 2048,
                "stopSequences" => []
            ],
            "safetySettings" => [
                [
                    "category" => "HARM_CATEGORY_HARASSMENT",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ],
                [
                    "category" => "HARM_CATEGORY_HATE_SPEECH",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ],
                [
                    "category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ],
                [
                    "category" => "HARM_CATEGORY_DANGEROUS_CONTENT",
                    "threshold" => "BLOCK_MEDIUM_AND_ABOVE"
                ]
            ]
        ];

        // Set API Key
        $apiKey = "AIzaSyDxNHLoyaBLdmS5odu_oO7gSXB_cVmubU0"; // Ganti dengan API Key Anda

        // URL API
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=" . $apiKey;

        // Konfigurasi request
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($apiData)
        ];

        // Inisialisasi cURL
        $ch = curl_init();
        curl_setopt_array($ch, $options);

        // Eksekusi request
        $response = curl_exec($ch);


        // Tutup koneksi cURL
        curl_close($ch);

        // Ambil nilai bookmark dari form
        $bookmark = $request->input('bookmark');

        // Simpan nilai bookmark di session
        $request->session()->put('storedBookmark', $bookmark);

        // Jika tidak ada subdomain dari root domain, atur sebagai default
        // $currentSubdomain = ->subdomain ?: 'default';

    // Hapus query dari penyimpanan sementara
        DB::table('queries')->where('id', $query->id)->delete();
        return 'berhasil di proses id :' . $query->id;
}

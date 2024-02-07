<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogspotApiController extends Controller
{
    public function handleRequest(Request $request)
    {
        // Proses permintaan dari Blogspot
        $data = $request->all();

        // Lakukan logika bisnis atau manipulasi data jika diperlukan
        // dd($data['query']);


        // Ambil nilai query dari form
        $query = $data['query'];

        // Ganti spasi dengan tanda hubung
        $subdomain = Str::slug($query);

        // Persiapkan path untuk file JSON
        $jsonFilePath = public_path("responses/{$subdomain}.json");

        // Cek apakah file JSON sudah ada
        if (File::exists($jsonFilePath)) {
            // Jika sudah ada, baca isi file JSON dan tampilkan teks
            $jsonContent = File::get($jsonFilePath);
            $responseData = json_decode($jsonContent, true);
            $text = $responseData['candidates'][0]['content']['parts'][0]['text'];

            // Kirim hasil sebagai variabel ke blade show di subdomain
            return redirect()->route('subdomain.show', ['subdomain' => $subdomain])->with(compact('text', 'query'));
        }
        $basePrompt = "buatkan saya artikel dengan bahasa menarik, memiliki opening dan closing, setiap awalan tag heading memiliki kalimat penjelasan 1 pargraph dan di lanjutkan dengan narasi berikutnya, dengan format ada tag <h1>,<h2>,<h3> sampai <h6>, jika memang ada list maka sesuaikan tag nya, untuk gambar gunakan tag <img> ,dan jika ada gambar terapkan ke img src sesuai dengan tautan gambar berdasarkan prompt yang saya berikan, saya ingin gambar di tambahkan unik sesuai dengan prompt, untuk peletakan gambar di setiap subheading, artikel di buat dengan panjang kata 1900 kata, prompt nya ";
        $closePrompt = ". pastikan compatible dengan format html";
        // Jika file JSON belum ada, jalankan permintaan API
        $apiData = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => $basePrompt . $query .$closePrompt
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

        // Tangani response
        if ($response === false) {
            // Gagal melakukan request
            echo "Error: " . curl_error($ch);
        } else {
            // Berhasil mendapatkan response
            $responseData = json_decode($response, true);

            // Simpan hasil query dalam file JSON
            File::put($jsonFilePath, json_encode($responseData));

            // Ambil teks dari hasil response
            $text = $responseData['candidates'][0]['content']['parts'][0]['text'];

            // Kirim hasil sebagai variabel ke blade show di subdomain
            return redirect()->route('subdomain.show', ['subdomain' => $subdomain])->with(compact('text', 'query'));
        }

        // Tutup koneksi cURL
        curl_close($ch);

        // Ambil nilai bookmark dari form
        $bookmark = $request->input('bookmark');

        // Simpan nilai bookmark di session
        $request->session()->put('storedBookmark', $bookmark);

        // Jika tidak ada subdomain dari root domain, atur sebagai default
        $currentSubdomain = $request->subdomain ?: 'default';

        // Redirect ke subdomain dengan query
        return redirect()->route('subdomain.show', ['subdomain' => $subdomain ?: $currentSubdomain]);
        // Berikan respons
        // return response()->json(['message' => $data]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SubdomainController extends Controller
{
    public function showSubdomain(Request $request, $subdomain = null)
    {
        // Jika ada subdomain, tampilkan view subdomain
        if ($subdomain) {
            return view('show', compact('subdomain'));
        }

        // Jika tidak ada subdomain, tampilkan posisi sekarang
        $currentSubdomain = $request->subdomain;
        return view('show', compact('currentSubdomain'));
    }


    public function processQuery(Request $request)
    {
        // Ambil nilai query dari form
        $query = $request->input('query');

        // Ganti spasi dengan tanda hubung
        $subdomain = Str::slug($query);

        // Simpan nilai query di session
        $request->session()->put('storedQuery', $query);

        // Persiapkan data untuk dikirim ke API
        $apiData = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => $query
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
        $apiKey = "AIzaSyDxNHLoyaBLdmS5odu_oO7gSXB_cVmubU0";

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

            // Simpan hasil query dalam file JSON di direktori public
            $filePath = public_path("responses/{$subdomain}.json");
            File::put($filePath, json_encode($responseData));

            // Kirim hasil sebagai variabel ke blade show
            return view('show', compact('subdomain', 'responseData', 'query'));
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
    }

    function defaultRoot() {
        return "Maintenance";
    }


}

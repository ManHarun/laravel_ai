<?php

namespace App\Http\Controllers;

use App\Models\GeminiModel;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GeminiController extends Controller
{
    public function geminiQuestion(Request $request)
    {
        // Kondisi 1: User baru masuk ke halaman input, belum ada request
        if (!$request->has('message')) {
            return view('/chat', ['answer' => '']);
        }
        // Dapatkan pesan dari query string
        $message = $request->input('message');
        // Kondisi 2: User menekan tombol submit, mengirim request string yang ditampung $message
        if ($message) {
            // Buat instance baru dari model Gemini
            $geminiModel = new GeminiModel();
            $response = $geminiModel->geminiGenerating($message);
            return response()->json($response);
            // return view('/chat', ['answer' => $response]);
        }
        // Kondisi 3: User menekan tombol submit, tetapi request dikirim null, munculkan pesan error inputan tidak boleh kosong
        else {
            return response()->json(['error' => 'Input tidak boleh kosong'], 422);
        }
    }
    
    public function getKeywords(){
        $keyword = Keyword::all();
        return response()->json($keyword);
    }
}


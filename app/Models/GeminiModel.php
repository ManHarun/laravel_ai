<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class GeminiModel extends Model
{
    public function geminiGenerating($search)
    {
        $cacheKey = 'gemini_generating_' . md5($search);
        return Cache::remember($cacheKey, 60, function () use ($search) {
            try {
                $result = Gemini::geminiPro()->generateContent($search);
                return $result->text();
            } catch (\Exception $e) {
                Log::error('Error generating content: ' . $e->getMessage());
                throw new \RuntimeException('Error generating content');
            }
        });
    
    }
    

    
}
// // public function geminiGenerating (){
//     $answer = "";
//     if(request('search')){
//         $result = Gemini::geminiPro()->generateContent(request('search'));
//         $answer = $result->text();
//     }
//     return $answer;
// // }
// return $answer;

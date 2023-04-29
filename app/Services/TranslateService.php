<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TranslateService 
{
    /**
     * Get trans
     *
     * @return string
     */
    public function getTranslate($text, $from, $to)
    {
        try {
            $response = Http::get('https://translate.googleapis.com/translate_a/single', [
                'client' => 'gtx',
                'sl' => $from,
                'tl' => $to,
                'dt' => 't',
                'q' => $text,
            ]);
            if($response->ok())
            {
                $data = $response->json();
                return isset($data[0][0][0]) ? $data[0][0][0] : null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
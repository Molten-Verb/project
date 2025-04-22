<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

Class F1Info
{
    public static function getDrivers($sessionKey = 'latest')
    {
        $response = Http::acceptJson()->get(config('api-open-f1.drivers'), [
            'session_key' => $sessionKey,
        ]);

        if ($response->successful()) {
            return $response->body();
        } else {
            return response()->json(['error' => 'Не удалось получить данные'], 500);
        }
    }
}

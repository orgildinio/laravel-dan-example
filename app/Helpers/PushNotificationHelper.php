<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class PushNotificationHelper
{
    public static function sendExpoNotification($expoToken, $title, $body)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post('https://exp.host/--/api/v2/push/send', [
            'to' => $expoToken,
            'sound' => 'default',
            'title' => $title,
            'body' => $body,
        ]);

        return $response->json();
    }
}

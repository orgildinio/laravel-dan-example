<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

if (!function_exists('sendTo1111API')) {
    function sendTo1111API($complaint, $isClose, $comment)
    {
        if ($complaint->channel_id == 7 && $complaint->source_number != null) {
            $params = [
                'action' => 'create-log',
                'u' => env('1111_API_USERNAME'),
                'p' => env('1111_API_PASSWORD'),
                'api_key' => '-',
                'number' => $complaint->source_number,
                'is_close' => $isClose ? 'true' : 'false',
                'created_by' => Auth::user()->name,
                'comment' => $comment,
            ];

            $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
            $result = $response->json();

            if ($result['isValid'] && $result['smart']['isValid']) {
                Log::channel('1111_log')->info('Successfully sent to 1111. user_id: ' . Auth::user()->id . ' complaint_serial_number: ' . $complaint->serial_number);
                return true;
            } else {
                Log::channel('1111_log')->error('Failed to send create-log action to 1111.');
                return false;
            }
        }
        return false;
    }
}

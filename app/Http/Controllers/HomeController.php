<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function showTable()
    {
        // Retrieve the JSON file contents
        $json = Storage::get('files/tze-contacts.json');

        // Decode the JSON data into an associative array
        $contacts = json_decode($json, true);

        // Ensure each contact has all required keys
        $contacts = array_map(function ($contact) {
            return array_merge([
                'org_name' => 'N/A',
                'phone_number' => 'N/A',
                'email' => 'N/A',
                'address' => 'N/A',
            ], $contact);
        }, $contacts);

        // Pass data to the view
        return view('tze-contacts', compact('contacts'));
    }

    public function showQrCode()
    {
        $ios = 'https://apps.apple.com/us/app/econsumer/id6670529456';
        $android = 'https://play.google.com/store/apps/details?id=mn.consumer.energy';

        // Generate the QR code
        $iosQrCode = QrCode::size(200)->generate($ios);
        $androidQrCode = QrCode::size(200)->generate($android);

        // // Define the file path for saving the QR code image
        // $qrCodePathIos = storage_path('app/public/qr_code_ios.png');
        // $qrCodePathAndroid = storage_path('app/public/qr_code_android.png');

        // // Save the generated QR code image to the specified path
        // file_put_contents($qrCodePathIos, $iosQrCode);
        // file_put_contents($qrCodePathAndroid, $androidQrCode);

        return view('download-app', compact('iosQrCode', 'androidQrCode'));
    }
}

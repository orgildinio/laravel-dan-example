<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function showTable()
    {
        // Define the path to the JSON file in the public/images folder
        $filePathDulaan = public_path('image/tze-dulaan.json');
        $filePathTsahilgaan = public_path('image/tze-tsahilgaan.json');

        // Check if the file exists
        if (!file_exists($filePathDulaan) && !file_exists($filePathTsahilgaan)) {
            // Handle file not found error
            return response()->json(['error' => 'File not found'], 404);
        }

        // Retrieve the contents of the JSON file
        $jsonDulaan = file_get_contents($filePathDulaan);
        $jsonTsahilgaan = file_get_contents($filePathTsahilgaan);

        // Decode the JSON data into an associative array
        $contactsDulaan = json_decode($jsonDulaan, true);
        $contactsTog = json_decode($jsonTsahilgaan, true);

        // Ensure each contact has all required keys
        $contactsDulaan = array_map(function ($contact) {
            return array_merge([
                'org_name' => 'N/A',
                'phone_number' => 'N/A',
                'email' => 'N/A',
                'address' => 'N/A',
            ], $contact);
        }, $contactsDulaan);

        $contactsTog = array_map(function ($contact) {
            return array_merge([
                'org_name' => 'N/A',
                'phone_number' => 'N/A',
                'email' => 'N/A',
                'address' => 'N/A',
            ], $contact);
        }, $contactsTog);

        // Pass data to the view
        return view('tze-contacts', compact('contactsDulaan', 'contactsTog'));
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

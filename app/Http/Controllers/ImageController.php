<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('images', 'public'); // Save image in the 'public/images' directory

            return response()->json(['location' => Storage::url($path)]); // Return the image URL
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}

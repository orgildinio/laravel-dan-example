<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\SourceComplaint;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class FetchSourceComplaints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fetch-source-complaint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '1111 ээс Эрчим хүчтэй холбоотой өргөдөл, гомдлыг авах';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $params = [
            'action' => 'get-tickets',
            'count' => 30,
            'u' => 'smart_42',
            'p' => 'OYGNvAnwZ',
            'api_key' => 0
        ];
        $response = Http::get('https://www.11-11.mn/GStest/APIa', $params);
        $result = $response->json();

        // Check if API request was successful (status code 200)
        if ($result['smart']['isValid']) {

            // API request success
            Log::channel('1111_log')->info('Data fetched successfully.');

            $responseData = $response->getBody()->getContents();

            // Convert the JSON response to an array
            $dataArray = json_decode($responseData, true);
            $data = $dataArray['smart'];

            // Initialize an empty array for the converted data
            $complaints = [];

            // Iterate through the 'smart' array to create the desired format
            foreach ($data['smart']['created_at'] as $key => $value) {
                $complaints[] = [
                    "created_date" => Carbon::createFromFormat('M d, Y h:i:s A', $data['smart']['created_at'][$key]),
                    "source" => $data['smart']['source'][$key],
                    "quarter" => $data['smart']['quarter'][$key],
                    "assigned_at" => $data['smart']['assigned_at'][$key],
                    "number" => $data['smart']['number'][$key],
                    "city" => $data['smart']['city'][$key],
                    "register_no" => $data['smart']['register_no'][$key],
                    "phone" => $data['smart']['phone'][$key],
                    "content" => $data['smart']['content'][$key],
                    "email" => $data['smart']['email'][$key],
                    "type" => $data['smart']['type'][$key],
                    "address" => $data['smart']['address'][$key],
                    "district" => $data['smart']['district'][$key],
                    "fullname" => $data['smart']['fullname'][$key],
                    "path" => $data['smart']['path'][$key],
                ];
            }

            // Loop through the data and check if each item already exists in the database
            foreach ($complaints as $item) {
                // Check if data already exists based on a unique identifier (e.g., ID, email, etc.)
                $existingItem = SourceComplaint::where('number', $item['number'])->first();

                if (!$existingItem) {
                    // Data doesn't exist, so create a new record in the database
                    SourceComplaint::create($item);
                    Log::channel('1111_log')->info('Data stored successfully.');
                }
            }
        } else {
            // API request failed
            Log::channel('1111_log')->error('Failed to fetch data.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SourceComplaint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SourceComplaintController extends Controller
{
    public function fetchComplaints()
    {
        $params = [
            'action' => 'get-tickets',
            'count' => 200,
            'orderBy' => 'asc',
            'u' => env('1111_API_USERNAME'),
            'p' => env('1111_API_PASSWORD'),
            'api_key' => 0
        ];
        $response = Http::withoutVerifying()->get('https://www.11-11.mn/GStest/APIa', $params);
        $result = $response->json();
        // dd($result);

        // Check if API request was successful (isValid = true)
        if ($result['isValid'] && $result['smart']['isValid']) {

            $data = $result['smart'];
            // dd($data);

            // Initialize an empty array for the converted data
            $complaints = [];

            // Iterate through the 'smart' array to create the desired format
            foreach ($data['smart']['created_at'] as $key => $value) {
                $complaints[] = [
                    "created_date" => Carbon::createFromFormat('M d, Y, h:i:s A', $data['smart']['created_at'][$key]),
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
                }
            }

            // Update closed status for removed data
            SourceComplaint::whereNotIn('number', collect($complaints)->pluck('number'))
                ->update(['is_modified' => true]);

            Log::channel('1111_log')->info('Data manually fetched and modified successfully.');
            // dd($complaints);

            return response()->json(['message' => 'Data manually fetched and stored successfully.']);
        } else {
            // API request failed
            Log::channel('1111_log')->error('Failed to manually fetch data from API.');
            return response()->json(['error' => 'Failed to manually fetch data from API.'], 500);
        }
    }

    public function index(Request $request)
    {
        $daterange = $request->query('daterange');
        $search_text = $request->query('search_text');
        $selected_year = $request->query('year');
        $serial_number = $request->query('serial_number');

        $query = SourceComplaint::query();

        if (!empty($selected_year)) {
            $query->whereYear('created_date', $selected_year);
        } else {
            $currentYear = now()->year;
            $query->whereYear('created_date', $currentYear);
        }

        if (!empty($search_text)) {
            $query->where('content', 'LIKE', '%' . $search_text . '%');
        }
        if (!empty($serial_number)) {
            $query->where('number', 'LIKE', '%' . $serial_number . '%');
        }

        if (!empty($daterange)) {
            $dates = explode(' to ', $daterange);
            $start_date = $dates[0];
            $end_date = $dates[1];

            $query->whereBetween('created_date', [$start_date, $end_date]);
        }

        $query->whereNull('complaint_id');
        $query->where('is_modified', false);

        $complaints = $query->orderBy('created_date', 'desc')->paginate(15);

        // Append filter parameters to pagination links
        $complaints->appends($request->query());

        // $complaints = SourceComplaint::paginate(15);
        // dd($complaints);

        $currentYear = date('Y');
        $years = range($currentYear, $currentYear - 5, -1);

        return view('source.index', compact('complaints', 'serial_number', 'selected_year', 'daterange', 'search_text', 'years'));
    }

    public function create($id)
    {
        $sourceComplaint = SourceComplaint::findOrFail($id);

        return view('source.unreceipt', compact('sourceComplaint'));
    }

    public function unreceipt(Request $request, $id)
    {
        // Validate that 'desc' is provided
        $request->validate([
            'desc' => 'required|string|max:255', // Ensures 'desc' is not null and is a string
        ]);

        // Retrieve description and source complaint
        $desc = $request->desc;
        $sourceComplaint = SourceComplaint::findOrFail($id);

        // Extract API credentials
        $apiCredentials = [
            'u' => env('1111_API_USERNAME'),
            'p' => env('1111_API_PASSWORD'),
            'api_key' => '-'
        ];

        // Create reusable API request function
        $sendApiRequest = function ($action, $params) use ($apiCredentials) {
            try {
                $params = array_merge($params, $apiCredentials, ['action' => $action]);
                $response = Http::withoutVerifying()->get('https://www.11-11.mn/GStest/APIa', $params);
                return $response->json();
            } catch (\Exception $e) {
                Log::channel('1111_log')->error("API request failed: {$e->getMessage()}");
                return false;
            }
        };

        // Send description log before un-receipting
        $logResponse = $sendApiRequest('create-log', [
            'number' => $sourceComplaint->number,
            'is_close' => 'false',
            'created_by' => Auth::user()->name,
            'comment' => $desc,
        ]);

        if ($logResponse && $logResponse['isValid'] && $logResponse['smart']['isValid']) {
            Log::channel('1111_log')->info("create-log action successful for complaint {$sourceComplaint->number} by user " . Auth::user()->id);
        } else {
            Log::channel('1111_log')->error("create-log action failed for complaint {$sourceComplaint->number}.");
        }

        // Update source complaint as modified
        $sourceComplaint->is_modified = true;
        $sourceComplaint->save();

        // Proceed with un-receipting the complaint
        $unreceiptResponse = $sendApiRequest('un-receipt', [
            'number' => $sourceComplaint->number
        ]);

        if ($unreceiptResponse && $unreceiptResponse['isValid'] && $unreceiptResponse['smart']['isValid']) {
            Log::channel('1111_log')->info("un-receipt action successful for complaint {$sourceComplaint->number} by user " . Auth::user()->id);
            return redirect()->route('sourceComplaint.index')->with('success', '1111 ээс ирсэн гомдлыг амжилттай буцаав.');
        } else {
            Log::channel('1111_log')->error("un-receipt action failed for complaint {$sourceComplaint->number}.");
            return redirect()->route('sourceComplaint.index')->with('error', '1111 ээс ирсэн гомдлыг буцаахад алдаа гарлаа.');
        }
    }
}

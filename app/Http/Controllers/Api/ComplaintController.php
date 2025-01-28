<?php

namespace App\Http\Controllers\Api;

use Log;
use Exception;
use Carbon\Carbon;
use App\Models\File;
use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::latest()->take(10)->get();
        return ComplaintResource::collection($complaints);
    }

    public function getComplaintByUser($regnum)
    {
        $complaints = Complaint::where("registerNumber", $regnum)->orderBy("complaint_date", "desc")->get();
        return ComplaintResource::collection($complaints);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function upload(Request $request, $complaint_id)
    {
        try {


            // Find the complaint
            $complaint = Complaint::find($complaint_id);

            if (!$complaint) {
                return response()->json(['error' => 'Өргөдөл, гомдол олдсонгүй'], 404);
            }

            // Validate file upload
            $request->validate([
                'file' => 'required|mimes:pdf,jpeg,jpg,png,mp3,wav,ogg|max:20480', // Allow PDF, images, and audio files (max size: 20MB)
            ], [
                'file.mimes' => 'The file must be a PDF, image (jpeg, jpg, png), or audio (mp3, wav, ogg) file.',
                'file.max' => 'The file size must not exceed 20MB.',
            ]);

            if ($file = $request->file('file')) {
                $name = time() . '_' . $file->getClientOriginalName();

                // Move file to the 'files' directory
                $file->move('files', $name);

                // Save file record
                $newfile = File::create(['filename' => $name]);

                // Check if the file is an audio file by its extension
                $extension = strtolower($file->getClientOriginalExtension());
                if (in_array($extension, ['mp3', 'wav', 'ogg'])) {
                    // If the file is audio, store it in audio_file_id
                    $complaint->audio_file_id = $newfile->id;
                } else {
                    // Otherwise, store it in file_id
                    $complaint->file_id = $newfile->id;
                }

                // Save the complaint
                $complaint->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'File uploaded successfully',
                    'file_id' => $newfile->id,
                    'complaint_id' => $complaint_id
                ], 200);
            }

            return response()->json(['error' => 'File not uploaded', 'id' => $complaint_id], 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return the validation errors in JSON format
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation error occurred',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json([
                'status' => 'failed',
                'message' => 'File upload failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $input['complaint_date'] = Carbon::now();
            $register_date = Carbon::parse($input['complaint_date']);
            $input['expire_date'] = $register_date->addDays(7);

            $complaint = Complaint::create($input);

            // Return the newly created complaint using a resource
            return response()->json([
                'status' => 'success',
                'message' => 'Өргөдөл, гомдол амжилттай бүртгэлээ',
                'data' => new ComplaintResource($complaint)
            ], 201);
        } catch (Exception $e) {
            // Handle any exceptions that occur during the complaint creation
            return response()->json([
                'status' => 'failed',
                'message' => 'Өргөдөл, гомдол бүртгэхэд алдаа гарлаа',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        // return response()->json([
        //     'complaint' => $complaint
        // ]);
        return new ComplaintResource($complaint);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        $complaint->update($request->all());

        return new ComplaintResource($complaint);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return response(null, 204);
    }

    public function storeTze(Request $request)
    {
        try {

            // Custom validation rules
            $request->validate([
                'lastname' => 'required|string|min:2|max:50',
                'firstname' => 'required|string|min:2|max:50',
                // 'registerNumber' => 'required|string|min:8|max:12|regex:/^[0-9]+$/',
                'country' => 'required|string|max:100',
                'district' => 'required|string|max:100',
                'khoroo' => 'required|string|max:100',
                // 'addressDetail' => 'required|string|max:255',
                'phone' => [
                    'required',
                    'regex:/^(\+976|976)?([89]{1}[0-9]{7})$/'
                ],
                // 'email' => 'required|email|max:255',
                'complaint' => 'required',
            ]);

            // If validation passes, proceed
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Нэвтрээгүй хэрэглэгч байна. Токеныг шалгана уу.'
                ], 401);
            }

            // Continue with the rest of the logic
            $input = $request->all();
            $input['complaint_date'] = Carbon::now();
            $input['expire_date'] = Carbon::now()->addDays(7);
            $input['created_user_id'] = $user->id;
            $input['organization_id'] = $user->org->id;
            $input['energy_tyoe_id'] = $user->org->plant_id;
            $input['status_id'] = 0; // Шинээр ирсэн
            $input['channel_id'] = 2; // Утас

            if (empty($input['complaint_maker_type_id'])) {
                $input['complaint_maker_type_id'] = 1; // Иргэн
            }


            if (empty($input['complaint_maker_type_id'])) {
                $input['complaint_maker_type_id'] = 1; // Иргэн
            }

            $complaint = Complaint::create($input);

            return response()->json([
                'status' => 'success',
                'message' => 'Өргөдөл, гомдол амжилттай бүртгэлээ',
                // 'data' => new ComplaintResource($complaint)
                'complaint' => [
                    'id' => $complaint->id,
                    'serial_number' => $complaint->serial_number,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return the validation errors in JSON format
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation errors occurred',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            // Handle other exceptions
            return response()->json([
                'status' => 'failed',
                'message' => 'Өргөдөл, гомдол бүртгэхэд алдаа гарлаа',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

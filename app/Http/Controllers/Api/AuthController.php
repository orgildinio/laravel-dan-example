<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginApiRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate request data
        // $request->validate([
        //     'regnum' => 'required|string',
        //     'firstname' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255'
        // ], [
        //     'regnum.required' => 'Registration number is required.',
        //     'firstname.required' => 'First name is required.',
        //     'lastname.required' => 'Last name is required.',
        // ]);

        // $user = User::where('danRegnum', $request->regnum)->first();
        $user = User::where('danRegnum', $request->regnum)
            ->where('danFirstname', $request->firstname)
            ->where('danLastname', $request->lastname)
            ->where('name', $request->firstname)
            ->where('role_id', 5)
            ->first();

        // If user does not exist, create a new user
        if (!$user) {
            $user = User::create([
                'name' => $request->firstname,
                'danImage' => $request->image,
                'danFirstname' => $request->firstname,
                'danLastname' => $request->lastname,
                'danRegnum' => $request->regnum,
                'danAimagCityName' => $request->aimagCityName,
                'danSoumDistrictName' => $request->soumDistrictName,
                'danBagKhorooName' => $request->bagKhorooName,
                'danPassportAddress' => $request->passportAddress,
                "danGender" => $request->gender,
                'password' => Hash::make(123456),
                'role_id' => 5
            ]);
        }

        // Generate an authentication token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the response with the token and user data
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Revoke the token that was used to authenticate the current request
        $user->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        try {
            $user = auth()->user();

            // Validate request inputs
            $validated = $request->validate([
                'danAimagCityName' => 'required|string|max:255',
                'danSoumDistrictName' => 'required|string|max:255',
                'danBagKhorooName' => 'required|string|max:255',
                'danPassportAddress' => 'required|string|max:255',
                'email' => 'nullable|email:rfc,dns|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'password' => 'nullable|string|min:8', // Password with confirmation
            ]);

            // Assign validated data to the user model
            $user->fill($validated);

            // Hash password if provided
            if (!empty($validated['password'])) {
                $user->password = bcrypt($validated['password']);
            }

            // Save updated user details
            $user->save();

            return response()->json([
                'message' => 'Профайл мэдээлэл амжилттай хадгалагдлаа',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            // Log and return error response
            Log::error('User update error: ' . $e->getMessage());
            return response()->json([
                'message' => 'Шинэчлэх явцад алдаа гарлаа: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function loginEmail(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the email and password match any user
        if (!Auth::attempt($credentials)) {
            // Check if email exists
            $user = User::where('email', $request->email)->first();
            if ($user && !Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'Нууц үг буруу'], 401);
            }

            return response()->json(['error' => 'Мэйл хаяг эсвэл нууц үг буруу байна.'], 401);
        }

        // Generate token and return response
        $user = Auth::user();

        // Check if the user has the role 'dan'
        if (!$user->role || $user->role?->name !== 'dan') {
            return response()->json(['error' => 'ТЗЭ-ийн эрхээр нэвтрэх боломжгүй!'], 403);
        }

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function loginTze(Request $request)
    {
        // 1️⃣ Validate request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // $credentials = $request->only('email', 'password');

        // // Check if the email and password match any user
        // if (!Auth::attempt($credentials)) {
        //     // Check if email exists
        //     $user = User::where('email', $request->email)->first();
        //     if ($user && !Hash::check($request->password, $user->password)) {
        //         return response()->json(['error' => 'Нууц үг буруу'], 401);
        //     }

        //     return response()->json(['error' => 'Мэйл хаяг эсвэл нууц үг буруу байна.'], 401);
        // }

        // // Generate token and return response
        // $user = Auth::user();

        // 2️⃣ Check if user exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Хэрэглэгчийн мэдээлэл олдсонгүй.'], 401);
        }

        // 3️⃣ Check password
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Нууц үг буруу байна.'], 401);
        }

        // 4️⃣ Authenticate the user
        Auth::login($user); // Нэвтрэх хэрэглэгчийг session-д хадгалах

        $token = $user->createToken('Personal Access Token')->plainTextToken;

        return response()->json([
            'message' => 'Амжилттай нэвтэрлээ!',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'division' => $user->division,
                'phone' => $user->phone,
                'organization' => $user->org?->name,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]);
    }
}

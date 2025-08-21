<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\RegisterUser;
use Illuminate\Validation\ValidationException;   // ✅ add this
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{
    // Step 1: send OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile' => 'required|string|max:15',
        ]);

        $otp = rand(100000, 999999); // 6-digit OTP

        // Store OTP in cache for 15 minutes
        Cache::put('otp_'.$request->mobile, $otp, now()->addMinutes(15));

        // Send mail
        Mail::to($request->email)->send(new OtpMail($request->name, $otp));

        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
        ]);
    }

    // Step 2: verify OTP
    public function verifyOtp(Request $request)
    {
        \Log::info('📥 Verify OTP request:', $request->all());
        $request->validate([
            'mobile' => 'required|string|max:20',
            'otp' => 'required|string|size:6',
        ]);


        $cachedOtp = Cache::get('otp_'.$request->mobile);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired OTP'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully'
        ]);
    }

    // Step 3: set password & register user
public function setPassword(Request $request)
{
    \Log::info('Incoming setPassword request', $request->all());

    try {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|unique:final_register_user,email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        RegisterUser::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password set successfully!',
        ], 200);

    } catch (QueryException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ], 500);
    } catch (\Exception $e) {
        \Log::error('SetPassword Error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }
}
}



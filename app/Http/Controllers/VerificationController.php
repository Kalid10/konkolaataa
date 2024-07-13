<?php

namespace App\Http\Controllers;

use App\Helpers\SMS;
use App\Models\OTP;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VerificationController extends Controller
{
    public function phone(): Response
    {
        $user = auth()->user();
        $OTP = $this->generateAndStoreOTP($user);

        SMS::send($user->phone_number, "Your OTP is: $OTP");

        $userOtp = $this->getUserOtp($user);

        $expiresIn = $userOtp ? 120 - $userOtp->updated_at->diffInSeconds(now()) : 120;

        return Inertia::render('Verify/PhoneNumber', [
            'expires_in' => $expiresIn
        ]);
    }

    public function sendOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        $user = auth()->user();
        $userOtp = $this->getUserOtp($user);

        if (!$userOtp || $userOtp->updated_at->diffInMinutes(now()) > 2) {
            return redirect()->back()->with('error', 'OTP expired');
        }

        if ($userOtp->otp != $request->integer('otp')) {
            return redirect()->back()->with('error', 'Invalid OTP');
        }

        $user->phone_verified_at = now();
        $user->save();

        return redirect()->route('cars.index')->with('success', 'Phone number verified');
    }

    private function generateAndStoreOTP($user)
    {
        $OTP = mt_rand(100000, 999999);
        $userOtp = $this->getUserOtp($user);

        if ($userOtp) {
            $isOtpExpired = $userOtp->updated_at->diffInMinutes(now()) > 2;
            if ($isOtpExpired) {
                $userOtp->update(['otp' => $OTP]);
            }
        } else {
            OTP::create([
                'user_id' => $user->id,
                'otp' => $OTP
            ]);
        }

        return $OTP;
    }

    private function getUserOtp($user)
    {
        return OTP::where('user_id', $user->id)->first();
    }
}

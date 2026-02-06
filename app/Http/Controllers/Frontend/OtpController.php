<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Rate limit: chỉ cho phép gửi 1 lần/phút cho mỗi email
        $recent = Otp::where('email', $email)
            ->where('created_at', '>', Carbon::now()->subMinute())
            ->first();
        if ($recent) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đợi 1 phút trước khi gửi lại OTP.',
            ], 429);
        }

        // Dọn dẹp OTP đã hết hạn
        Otp::where('expires_at', '<', Carbon::now())->delete();

        $otp = rand(100000, 999999);

        // Xóa OTP cũ nếu có
        Otp::where('email', $email)->delete();

        // Tạo OTP mới (hết hạn sau 5 phút)
        Otp::create([
            'email' => $email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5),
            'verified' => false,
        ]);

        // Gửi email
        try {
            Mail::raw("Mã xác thực (OTP) của bạn là: $otp\n\nMã này có hiệu lực trong 5 phút. Vui lòng không chia sẻ mã này với bất kỳ ai.\n\nTrầm Hương Tiên Phước", function ($message) use ($email) {
                $message->to($email)
                    ->subject('Mã xác thực OTP - Trầm Hương Tiên Phước');
            });

            return response()->json([
                'success' => true,
                'message' => 'OTP đã được gửi đến email của bạn. Vui lòng kiểm tra email để lấy mã OTP.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi gửi email: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp');

        // Dọn dẹp OTP đã hết hạn
        Otp::where('expires_at', '<', Carbon::now())->delete();

        $otpRecord = Otp::where('email', $email)
            ->where('otp', $otp)
            ->first();

        if (!$otpRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Mã OTP không chính xác hoặc đã hết hạn',
            ], 400);
        }

        // Kiểm tra hết hạn
        if (Carbon::now()->isAfter($otpRecord->expires_at)) {
            $otpRecord->delete();
            return response()->json([
                'success' => false,
                'message' => 'Mã OTP đã hết hạn. Vui lòng gửi lại mã mới.',
            ], 400);
        }

        // Đánh dấu là đã xác thực
        $otpRecord->update(['verified' => true]);

        // Lưu vào session (5 phút)
        session(['otp_verified_' . $email => true, 'otp_verified_at_' . $email => Carbon::now()]);

        return response()->json([
            'success' => true,
            'message' => 'Xác thực OTP thành công',
        ]);
    }

    public function checkOtpVerified(Request $request)
    {
        $email = $request->input('email');
        $verified = session('otp_verified_' . $email, false);
        $verifiedAt = session('otp_verified_at_' . $email);

        // Nếu đã xác thực nhưng quá 5 phút thì coi như hết hạn
        if ($verified && $verifiedAt && Carbon::now()->diffInMinutes($verifiedAt) >= 5) {
            session()->forget('otp_verified_' . $email);
            session()->forget('otp_verified_at_' . $email);
            $verified = false;
        }

        return response()->json([
            'verified' => $verified,
        ]);
    }
}

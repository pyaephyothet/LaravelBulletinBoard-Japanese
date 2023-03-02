<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgetPwd()
    {
        return view('/auth/forget_password');
    }

    public function storeResets(ForgetPasswordRequest $request)
    {

        $token = Str::random(20);
        $data = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $action_link = route('user#reset', ['token' => $token, 'email' => $request->email]);
        $body = "氏名　：" . $request->email . "<br>" . "パスワード　：";
        $mail = Mail::send(
            'emails.forget_password',
            ['action_link' => $action_link, 'body' => $body],
            function ($message) use ($request) {
                $message->from('pyaephyothet1602@gmail.com', 'Pyae Phyo Thet');
                $message->to($request->email)
                    ->subject('Reset Password Confirmation Email');
            }
        );
        return back()->with(['data' => $data, 'mail' => $mail])
            ->with('message', 'メールアドレス宛にパスワードを送信しました。');

    }

    public function reset(Request $request, $token = null)
    {
        return view('auth.reset_password')->with(['token' => $token, 'email' => $request->email]);
    }

    public function resetUpdate(ResetPasswordRequest $request)
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();
        //dd($updatePassword);
        if (!$updatePassword) {
            return false;
        } else {
            $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
            $data = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->delete();
        }

        if ($data) {
            return redirect()->route('user#login')->with('message', 'パスワードリセットしました。');
        } else {
            return back();
        }
    }
}
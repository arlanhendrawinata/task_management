<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;



use Illuminate\Support\Str;
use App\Mail\Email;
use App\Mail\EmailAttach;
use App\Notifications\ForgetPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index()
    {
        $title = "Forgot Password";

        return view('auth.passwords.reset', compact('title'));
    }



    public function send(Request $request)
    {
        // $id, $nama


        $user = User::where('email', $request->email)->first();

        if ($user->email == $request->email) {


            $genPass = Str::random(5);
            $this->goUpdate($user->id, $genPass);


            $data = [
                'id' => $user->id,
                'newPassword' => "New Password : " . $genPass,
                'address' => 'admin@balinet.co.id',
                'emailTo' => $user->email,
                'FromTitle' => 'Admin',
                'subject' => 'Taskmanagement Forget Password',
                'line1' => $user->nama,
                'line2' => 'Click tombol dibawah untuk Login',
                'line3' => "Harap ganti password anda dengan yang baru !",


                'action' => 'Login',

            ];

            $user->notify(new ForgetPasswordMail($data));
        }        // Mail::to($email)->send(new EmailAttach($text));

        return redirect('/');
    }


    public function goUpdate($id, $genPass)
    {
        $findusers = User::where('id', $id)->first();
        $currenttime = Carbon::now();
        $genPass = Hash::make($genPass);

        $datausers = array(
            'password' => $genPass,
        );

        $findusers->update($datausers);

        auth()->user($findusers);
    }

    public function goLogin()
    {
        return redirect('go-reset-password');
    }
}

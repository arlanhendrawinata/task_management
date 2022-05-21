<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Mail\EmailAttach;
use App\Notifications\Informasi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class EmailController extends Controller
{
    //

    // public function kirim($email)
    // {

    //     Mail::to($email)->send(new Email());
    //     // return new Email();
    // }

    // public function attach()
    // {

    //     $text = [
    //         'subject' => 'Pengiriman Dari Controller'
    //     ];

    //     Mail::to('akuntumbal3339@gmail.com')->send(new EmailAttach($text));
    //     // return new Email();
    // }

    public function notif()
    {
        // $id, $nama
        $user = User::orderBy('id', 'desc')->first();



        $data = [
            'id' => $user->id,
            'address' => 'admin@balinet.co.id',
            'FromTitle' => 'Admin',
            'subject' => 'Taskmanagement Verify Account',
            'line1' => $user->nama,
            'action' => 'Verify',
            'line2' => 'Click tombol diatas untuk melakukan Verified'
        ];
        $user->notify(new Informasi($data));

        // Mail::to($email)->send(new EmailAttach($text));
    }

    public function goVerify($id)
    {
        $findusers = User::where('id', $id)->first();
        $currenttime = Carbon::now();

        $datausers = array(
            'email_verified_at' => $currenttime,
            'status' => 1
        );

        $findusers->update($datausers);

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

// use App\Models\Companies;
use App\Models\Divisions;
use App\Models\User;
use App\Models\UserDetail;

use App\Models\Users;
use Infotech\ImgBB\ImgBB;
use Illuminate\Http\Request;
use Faker\Provider\ar_EG\Companies;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //cara lama
        // $user_details = DB::table('user_details')
        // ->join('users', 'users.id', '=', 'user_details.user_id')
        // ->Join('companies', 'companies.id', '=', 'user_details.perusahaan_id')
        // ->Join('divisions', 'divisions.id', '=', 'user_details.divisi_id')
        // ->where('user_details.id', '=', 1)
        // ->first();
        // $user_details = User_details::where('id', 6)->first();
        // echo"sr";

        $userDetail = UserDetail::with('users', 'companies', 'divisions')->where('user_id', auth()->user()->id)->first();
        $title = "Profile";

        return view('profile.profile', compact('userDetail', 'title'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $userDetail = UserDetail::with('users', 'companies', 'divisions')->where('user_id', auth()->user()->id)->first();

        $title = " Edit Profile";
        return view('profile.profile', ['userDetail' => $userDetail, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $user_details = User_details::with('users', 'companies', 'divisions')->where('user_id',auth()->user()->id)->first();     

        // $passDecrypt = Crypt::decryptString($request->password);
        // $passEncrypt = Crypt::encryptString($request->password);


        $passEncrypt = Hash::make($request->password);
        $userDetail = UserDetail::where('user_id', auth()->user()->id)->first();
        $data = array(
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'nip' => $request->nip,


            // 'foto' => $request->file('foto')->store('users'), 
        );
        if ($request->file('foto')) {
            $namaasli = $request->file('foto')->getClientOriginalName();
            $image = ImgBB::image($request->file('foto'), $namaasli);
            $data['foto'] =  $image["data"]["url"];
        }
        $userDetail->update($data);
        // DB::table('companies')->where('id', auth()->user()->user_details->perusahaan_id)->update([
        //     'nama_perusahaan' => $request->nama_perusahaan,
        // ]);
        $users = User::where('id', auth()->user()->id)->first();
        $data2 = array(
            'email' => $request->email,
            // 'password' => $request->password,
            'nama' => $request->nama,
        );

        if ($request->input('oldPassword')) {                                                
            if(password_verify($request->oldPassword, auth()->user()->password)){
                $data2['password'] = $passEncrypt;                                    
            }else{
                return redirect()->route('profile-profile')->with('errors', 'Password Wrong');                
            }                
        }
        $users->update($data2);
        // DB::table('divisions')->where('id', auth()->user()->user_details->divisi_id)->update([
        //     'nama_divisi' => $request->nama_divisi,
        // ]);       

        auth()->user($users);
        
        return redirect()->route('profile-profile')->with('success', 'Berhasil Edit Profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

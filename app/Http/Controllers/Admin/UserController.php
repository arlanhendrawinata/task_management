<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;

use App\Models\Company;
use App\Models\Division;
use App\Models\User;
use App\Models\user_details;
use App\Models\UserDetail;
use App\Models\users;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Infotech\ImgBB\ImgBB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        // $array = DB::table('users')->get();
        // return view('/admin/user/user', ['array' => $array]);

        $array = User::with('userDetail')->OrderByDesc('id')->where('is_member', 0)->get();

        // $array = User::with('userDetail')->get();

        $title = "User";
        $tableTitle = "All User";
        return view('/admin/user/user', ['array' => $array, 'title' => $title, 'tableTitle' => $tableTitle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return view('admin/user/user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $title = "User";
        $passEncrypt = Hash::make($request->password);
        $status = 0;

        $roleTeamLeader = 3;
        $roleAdmin = 1;
        $roleManajemen = 2;
        $roleAnggota = 4;
        $divisiManajemen = 1;

        $objEmail = new EmailController;


        if ($request->id_divisi == 1 && $request->role > 2) {
            return redirect()->route('goto-showinsert-dbusers')->with('errors', 'Roles are not allowed to be part of Management');
        } else {


            // User::create([
            // 'nama' => $request->nama,
            // 'email' => $request->email,
            // 'status' => $status,
            // 'password' => $passEncrypt
            // // ]);
            $array = array(
                'nama' => $request->nama,
                'email' => $request->email,
                'status' => $status,
                'password' => $passEncrypt,
            );


            $data = array(
                // 'user_id' => intval($id->id),
                'user_id' => 0,
                'perusahaan_id' => intval($request->id_perusahaan),
                'divisi_id' => $request->id_divisi,
                'role' => intval($request->role),
                'no_telp' => $request->notelp,
                'alamat' => $request->alamat,
                'nip' => $request->nip,
                'foto' => '',
                'status' => 1,
            );

            if ($request->file('foto')) {
                $namaasli = $request->file('foto')->getClientOriginalName();
                $image = ImgBB::image($request->file('foto'), $namaasli);
                $data['foto'] =  $image["data"]["url"];
            }

            if ($request->role == $roleManajemen || $request->role == $roleAdmin) {
                $data['divisi_id'] = $divisiManajemen;
            }


            if ($request->role == $roleTeamLeader) {
                if ($this->checkTeamLeader($request->id_divisi) == true) {
                    // dd("this->checkTeamLeader(request->id_divisi) == true");
                    $user = User::create($array);

                    if (auth()->user($user)) {
                        $objEmail->notif();
                    }

                    $id = User::orderBy('id', 'desc')->first();

                    $data['user_id'] = $id->id;

                    UserDetail::create($data);


                    return redirect()->route('goto-show-dbusers', ['title' => $title])->with('success', 'Data Added');
                } else {

                    $data = Division::where('id', $request->id_divisi)->first();
                    // dd("this->checkTeamLeader(request->id_divisi) == false");

                    return redirect()->route('goto-insert-dbusers')->with('errors', 'The team already has a team leader');
                }
            } else {

                $user = User::create($array);
                if (auth()->user($user)) {
                    $objEmail->notif();
                }


                $id = User::orderBy('id', 'desc')->first();
                $data['user_id'] = $id->id;

                if ($request->id_divisi == 1 && $request->id_divisi == 0) {
                    $data['divisi_id'] = $divisiManajemen;
                } else {
                    $data['divisi_id'] = intval($request->id_divisi);
                }
                UserDetail::create($data);

                return redirect()->route('goto-show-dbusers', ['title' => $title])->with('success', 'Data Added');
            }
        }
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
    public function edit($id)
    {
        //
        // $edit['users'] = DB::table('users')->where('id', $id)->first();
        // $edit['user_details'] = DB::table('user_details')->where('user_id', $id)->first();



        // $callDataDivisions = DB::table('divisions')->get();
        // $callDataCompanys = DB::table('companys')->get();

        // $callrowDivisions = DB::table('divisions')->where('id', $edit['user_details']->divisi_id)->first();

        // $callrowCompanys = DB::table('companys')->where('id', $edit['user_details']->perusahaan_id)->first();

        $title = "Edit User";

        $edit['users'] = User::where('id', $id)->first();
        $edit['user_details'] = UserDetail::where('user_id', $id)->first();


        $callDataDivisions = Division::get();
        $callDataCompanys = Company::get();

        $callrowDivisions = Division::where('id', $edit['user_details']->divisi_id)->first();
        $callrowCompanys = Company::where('id', $edit['user_details']->perusahaan_id)->first();

        // dd($callDataCompanys[0]->id);
        // dd($callDataDivisions);
        // dd($callrowCompanys);
        // dd($callrowDivisions);


        return view('admin/user/edituser', [
            'title' => $title,
            'data' => $edit,
            'dataDivisions' => $callDataDivisions,
            'dataCompanys' => $callDataCompanys,
            'datarowDivisions' => $callrowDivisions,
            'datarowCompanys' => $callrowCompanys
        ]);
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

        //

        $status  = 1;
        $findusers = User::where('id', $request->user_id)->first();
        $finduser_details = UserDetail::where('id', $request->id)->first();

        $title = "User";
        $roleAdmin = 1;
        $roleManajemen = 2;
        $roleTeamLeader = 3;

        $divisiManajemen = 1;

        // $finduser_details = UserDetail::find($request->id);
        $currenttime = Carbon::now();
        $passEncrypt = Hash::make($request->password);
        // $finduser_details = UserDetail::find($request->id);
        $currenttime = Carbon::now();
        $passEncrypt = Hash::make($request->password);


        $datausers = array(
            'nama' => $request->nama,
            'email' => $request->email,
            'updated_at' => $currenttime,
        );
        $datauser_details = array(
            'user_id' => intval($request->user_id),
            'perusahaan_id' => intval($request->id_perusahaan),
            'divisi_id' => intval($request->id_divisi),
            'role' => intval($request->role),
            'no_telp' => $request->notelp,
            'alamat' => $request->alamat,
            'nip' => $request->nip,

            'status' => $status,
        );


        if ($request->file('foto')) {
            $namaasli = $request->file('foto')->getClientOriginalName();
            $image = ImgBB::image($request->file('foto'), $namaasli);
            $datauser_details['foto'] =  $image["data"]["url"];
        }

        if ($request->role == $roleManajemen || $request->role == $roleAdmin) {
            $datauser_details['divisi_id'] = $divisiManajemen;
        }


        $checkTeamLeader = UserDetail::where('divisi_id', $request->id_divisi)->where('role', $roleTeamLeader)->get();
        $checkUserisTeamLeader = UserDetail::where('user_id', $request->user_id)->where('divisi_id', $request->id_divisi)->where('role', $roleTeamLeader)->first();



        if ($request->id_divisi == 1) {
            if ($request->role > 2) {
                return redirect()->route('goto-show-dbusers')->with('errors', 'The team is only for Management');
            } else {
                $findusers->update($datausers);
                // auth()->user($findusers);

                $finduser_details->update($datauser_details);
                return redirect()->route('goto-show-dbusers')->with('sucess', 'Data Updated');
            }
        } elseif ($request->id_divisi > 1) {
            if ($request->role == 3) {
                if ($checkTeamLeader != null) {
                    if ($checkTeamLeader->count() > 0) {
                        if ($checkUserisTeamLeader != null) {
                            if ($checkTeamLeader->count() > 1) {
                                return redirect()->route('goto-show-dbusers')->with('errors', 'The team already has a team leader');
                                // dd("Divisi tersebut sudah memiliki team leader");
                            } else {
                                $findusers->update($datausers);
                                // auth()->user($findusers);
                                $finduser_details->update($datauser_details);
                                return redirect()->route('goto-show-dbusers')->with('success', 'Data Updated');
                                // dd("Success");
                            }
                        } else {
                            return redirect()->route('goto-show-dbusers')->with('errors', 'The team already has a team leader');
                            // dd("checkUserisTeamLeader = null");
                        }
                    } else {
                        // dd("checkTeamLeader->count() > 0 = false");
                        if ($checkTeamLeader->count() == 0) {

                            $findusers->update($datausers);
                            // auth()->user($findusers);
                            $finduser_details->update($datauser_details);

                            return redirect()->route('goto-show-dbusers')->with('success', 'Data Updated');
                        } else {
                            return redirect()->route('goto-show-dbusers')->with('errors', 'The team already has a team leader');
                        }
                    }
                } else {
                    dd("checkTeamLeader = null  divisi->" . $request->id_divisi);
                }
            } elseif ($request->role == 1 || $request->role == 2) {

                return redirect()->route('goto-show-dbusers')->with('errors', 'Management can only be Team Management');
            } else {
                $findusers->update($datausers);
                // auth()->user($findusers);
                $finduser_details->update($datauser_details);
                return redirect()->route('goto-show-dbusers')->with('success', 'Data Updated');
            }
        } else {
            dd($request->id_divisi);

            // if ($request->role == $roleTeamLeader) {
            // if ($this->checkTeamLeader($request->id_divisi) == true) {

            // dd("this->checkTeamLeader(request->id_divisi) == true");

            // $user = User::create($datausers);


            // $id = User::orderBy('id', 'desc')->first();

            // $datauser_details['user_id'] = $id->id;

            // UserDetail::create($datauser_details);

            // return redirect()->route('goto-show-dbusers', ['title' => $title])->with('success', 'Data Added');
            // } else {

            //     $data = Division::where('id', $request->id_divisi)->first();
            //     // dd("this->checkTeamLeader(request->id_divisi) == false");

            //     return redirect()->route('goto-show-dbusers')->with('errors', 'Divisi tersebut sudah memiliki team leader');
            // }
            // } else {


            // $id = User::orderBy('id', 'desc')->first();
            // $datauser_details['user_id'] = $id->id;

            $findusers->update($datausers);
            // auth()->user($findusers);
            $finduser_details->update($datauser_details);

            return redirect()->route('goto-show-dbusers', ['title' => $title])->with('success', 'Data Added');
            // }

        }
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
        $findusers = User::find($id);
        $finduser_details = UserDetail::all()->where('user_id', $id)->first();
        // $finduser_details = DB::table('user_details')->where('user_id', $id)->first();
        $path =  public_path('users/' . $finduser_details->foto);

        if (File::exists($path)) {
            File::delete($path);
        }

        $findusers->delete();
        $finduser_details->delete();

        return redirect()->route('goto-show-dbusers')->with('success', 'User Deleted');
    }

    public function updateStatus(Request $request)
    {

        $data = User::where('id', $request->id)->first();

        $currenttime = Carbon::Now();

        $data->update([
            'status' => $request->status,
            'updated_at' => $currenttime,
        ]);

        return redirect()->route('goto-show-dbusers');
    }

    public function canAddTask(Request $request)
    {
        $data = User::with('userdetail')->where('id', $request->id)->first();
        $currenttime = Carbon::Now();
        $userRole = $data->userdetail->role;
        if ($userRole != 3) {
            return redirect()->route('goto-show-dbusers')->with('errors', 'The user must be the team leader');
        } else {
            $data->update([
                'can_add_task' => $request->can_add_task,
                'updated_at' => $currenttime,
            ]);
            return redirect()->route('goto-show-dbusers');
        }
    }


    public function showInsertUsers()
    {
        //
        $title = "Add User";
        $data = $this->callData();
        $dataCompanys = $data['dataCompanys'];
        $dataDivisions = $data['dataDivisions'];

        return view('/admin/user/tambahuser', ['title' => $title, 'dataCompanys' => $dataCompanys, 'dataDivisions' => $dataDivisions]);
    }

    public function callData()
    {
        //

        $arrayDivisions = Division::where('status', 1)->get();
        $arrayCompanys = Company::get();


        $array["dataDivisions"] = $arrayDivisions;
        $array["dataCompanys"] = $arrayCompanys;

        return $array;
    }

    public function index2($id)
    {
        $array = UserDetail::with('users', 'companies', 'divisions')->where('user_id', $id)->first();


        return view('/admin/user/detailuser', [
            'array' => $array,
        ]);
    }

    public function checkTeamLeader($divisi_id)
    {
        // $dataUserDetail = UserDetail::all();

        // $flag = 0;
        $role = 3;

        $tester = UserDetail::where('divisi_id', $divisi_id)->where('role', $role)->get();

        if ($tester->count() < 2) {
            return true;
        } else {
            return false;
        }
    }

    // public function checkManajemenAdmin($id,$divisi_id)
    // {
    //     // $dataUserDetail = UserDetail::all();

    //     // $flag = 0;
    //     $roleAdmin = 1;
    //     $roleManajemen = 2;

    //     $tester = UserDetail::with()->where->where('id',$id)->where('divisi_id', $divisi_id)->where('role', $roleAdmin)->get();

    //     if ($tester->count() < 2) {

    //         $tester = UserDetail::where->where('id',$id)->where('divisi_id', $divisi_id)->where('role', $roleAdmin)->get();
    //         if($tester2->count() < 2){
    //             return true;
    //         }
    //     } else {
    //         return false;
    //     }
    // }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Division;
use App\Models\Company;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        // $array = Division::get();
        $array = Division::OrderByDesc('id')->get();
        $title = "Team";
        $tableTitle = "All Team";

        return view('/admin/divisi/divisi', ['array' => $array, 'title' => $title, 'tableTitle' => $tableTitle]);
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
        $default = 1;
        Division::create([
            'nama_divisi' => $request->nama_divisi,
            'keterangan' => $request->keterangan,
            'status' => $default
        ]);

        return redirect()->route('goto-show-dbdivisions');
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
        $edit = Division::where('id', $id)->first();

        return view('admin/divisi/editdivisi', ['data' => $edit]);
    }

    public function editStatus($id)
    {
        //
        $edit = Division::where('id', $id)->first();


        return redirect()->route('goto-status-dbdivisions', ['data' => $edit]);
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

        $data = Division::where('id', $request->id)->first();

        $currenttime = Carbon::Now();

        $data->update([
            'nama_divisi' => $request->nama_divisi,
            'keterangan' => $request->keterangan,
            'updated_at' => $currenttime,
        ]);

        return redirect()->route('goto-show-dbdivisions')->with('success', 'Update Successs');
    }

    public function updateStatus(Request $request)
    {
        //
        $data = Division::where('id', $request->id)->first();

        $currenttime = Carbon::Now();

        $data->update([
            'status' => $request->status,
            'updated_at' => $currenttime,
        ]);


        return redirect()->route('goto-show-dbdivisions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Division::where('id', $id)->first();

        $data->delete();

        return redirect()->route('goto-show-dbdivisions')->with('success', 'Delete Successs');
    }

    public function index2($id)
    {
        //
        $edit = Division::where('id', $id)->first();

        return view('admin/divisi/editdivisi', ['data' => $edit]);
    }

    public function insertModal()
    {
        //
        return view('admin/divisi/editdivisi');
    }



    public function infoModal($divisi_id)
    {
        $LeaderRole = 3;
        $MemberRole = 4;

        //--------------------------------------------------------------------
        $getDivisions = Division::where('id', $divisi_id)->first();

        $getteamLeader = UserDetail::with('users', 'divisions')->where('role', $LeaderRole)->where('divisi_id', $divisi_id)->first();

        $getteammate = UserDetail::with('users', 'divisions')->where('role', $MemberRole)->where('divisi_id', $divisi_id)->get();

        return view('/admin/divisi/detaildivisi', ['teammate' => $getteammate, 'division' => $getDivisions, 'teamLeader' => $getteamLeader]);
    }

    public function isiTeam($id)
    {
        $divisi = Division::where('id', $id)->first();
        // return $divisi->nama_divisi;
        // $mydata = DB::table('user_details')->where('user_id', $id)->first();
        // if ($divisi->id == 1) {
        //     $isiTeam = UserDetail::with('users')->where('divisi_id', $id)->orderby('role')->get();
        // } else {
        //     $isiTeam = UserDetail::with('users')->where('divisi_id', $id)->orderby('role')->get();
        // }

        $isiTeam = UserDetail::with('users')->where('divisi_id', $id)->orderby('role')->get();

        // return $isiTeam;
        // $nama_divisi = DB::table('divisions')->select('id', 'nama_divisi')->where('id', $mydata->divisi_id)->first();

        return view('/admin/divisi/isiteam', compact('divisi', 'isiTeam'));
    }

    public function listMyTeam($id)
    {
        //
        $title = "List Team";
        $LeaderRole = 3;
        $MemberRole = 4;

        $mydata = DB::table('user_details')->where('user_id', $id)->first();
        $divisi = Auth::user()->userDetail->divisi_id;

        $getteammate = DB::table('user_details')->where('divisi_id', $mydata->divisi_id)->where('role', $MemberRole)->get();

        $nama_divisi = DB::table('divisions')->select('id', 'nama_divisi')->where('id', $mydata->divisi_id)->first();

        // dd($getteammate);
        $getteamLeaderId = DB::table('user_details')->select('user_id')->where('role', $LeaderRole)->where('divisi_id', $nama_divisi->id)->first();

        $getteamLeaderName = DB::table('users')->select('nama')->where('id', $getteamLeaderId->user_id)->first();


        // $myteammate["Data"] = ["Id" => '1'];

        $myteammate = [];
        $i = 0;
        $usersData = User::with('userdetail')->whereRelation('userdetail', 'role', $MemberRole)->whereRelation('userdetail', 'divisi_id', $mydata->divisi_id)->get();

        // foreach ($getteammate as $row) {

        //     $user = User::where('id', $i)->first();


        //     $myteammate[$i]["id"] = $usersData->id;
        //     $myteammate[$i]["nama"] = $usersData->nama;
        //     $i++;
        // }
        return view('/leadtim/listdivisi/listdivisi', ['title' => $title, 'data' => $usersData, 'divisi_id' => $divisi, 'nama_divisi' => $nama_divisi->nama_divisi, 'teamLeader_name' => $getteamLeaderName->nama,]);
    }
}

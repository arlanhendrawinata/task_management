<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Client;
use App\Models\Companyclient;
use App\Models\companies;
use App\Models\User;
use App\Models\User_details;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Infotech\ImgBB\ImgBB;

class CompanyclientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cclients = Companyclient::OrderByDesc('id')->get();

        $title = 'Company Client';

        $tableTitle = "All Company Client";
        return view('admin.companyclient.index', compact('cclients', 'title', 'tableTitle'));
    }

    public function index2($id)
    {
        $cclient = DB::table('companyclients')->where('id', $id)->first();
        return view('admin.companyclient.detail', ['cclient' => $cclient]);
    }

    public function index3()
    {
        $cclient = DB::table('companyclients')->get();
        $title = 'Add Company Client';
        return view('admin.companyclient.tambah', compact('cclient', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companyclient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getname = Companyclient::where('name', $request->name)->exists();
        if ($getname != 1) {
            Companyclient::create([
                'name' => $request->name,
                'description' => $request->description,
                'alamat' => $request->alamat,
                'status' => 1,
            ]);
        } else {
            return redirect()->back()->with('errors', 'This name already exists');
        }
        return redirect()->route('index-cc')->with('success', 'Successfully Adding Company Client Data');
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

        $company_clients = Companyclient::where('id', $id)->first();
        $title = 'Edit Company Client';
        return view('admin.companyclient.edit', ['company_clients' => $company_clients,  'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company_clients = Companyclient::find($request->id);
        $data = array(
            'name' => $request->name,
            'description' => $request->description,
            'alamat' => $request->alamat
        );
        $company_clients->update($data);
        return redirect()->route('index-cc');
    }

    public function status(Request $request)
    {
        $company_clients = Companyclient::find($request->id);
        $data = array(
            'status' => $request->status
        );
        $company_clients->update($data);
        // DB::table('clients')->where('id', $request->id)->update([
        //     'status'=>$request->status
        // ]);
        return redirect()->route('index-cc');
        //return dd($request); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $clients = Client::find($id);
        // $imgPath = public_path('img-client/' . $clients->logo);
        // if (File::exists($imgPath)) {
        //     File::delete($imgPath);
        // }        
        // $clients->delete();        
        // return redirect('/client')->with('success', 'Berhasil Hapus Data Client');;
    }
}

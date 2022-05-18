<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Models\Client;
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

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $clients = Client::with('category_clients', 'companyclients')->OrderByDesc('id')->get();

        $title = 'Client';
        // $clients = Client::with('companies')->get();
        //$user_details = User_details::with('users', 'companies', 'divisions')->where('id', 1)->first();
        // $clients = $clients->paginate(10);
        $tableTitle = "All Client";
        return view('admin.client.client', compact('clients', 'title', 'tableTitle'));
    }
    public function index2($id)
    {
        $clients = DB::table('clients')->where('id', $id)->first();
        $users = DB::table('users')->where('id', $clients->user_id)->first();
        $cclient = DB::table('companyclients')->where('id', $clients->companyclient_id)->first();
        $category_clients = DB::table('category_clients')->where('id', $clients->kategori_client_id)->first();
        return view('admin.client.detailclient', ['clients' => $clients, 'users' => $users, 'category_clients' => $category_clients, 'cclient' => $cclient]);
    }

    public function index3()
    {
        $companies = DB::table('companies')->get();
        $category_clients = DB::table('category_clients')->get();
        $cclient = DB::table('companyclients')->get();
        $title = 'Add Client';
        return view('admin.client.tambahclient', compact('companies', 'category_clients', 'cclient', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$companies = DB::table("companies")->where('id', $request->perusahaan_id)->first();
        $currentime = Carbon::now();


        $passEncrypt = Hash::make(12345);
        $dataclient = array(
            'nama' => $request->nama_client,
            'email' => $request->email,
            'password' => $passEncrypt,
            'status' => 1,
            'is_member' => 1,
        );


        User::create($dataclient);
        auth()->user($dataclient);


        $data = array(
            'perusahaan_id' => 1,
            'kategori_client_id' => $request->kategori_client_id,
            'nama_client' => $request->nama_client,
            'companyclient_id' => $request->companyclient_id,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'status' => 1,
            'logo' => '',
            'created_at' => $currentime,
        );

        if ($request->file('logo')) {
            $namaasli = $request->file('logo')->getClientOriginalName();
            $image = ImgBB::image($request->file('logo'), $namaasli);
            $data['logo'] =  $image["data"]["url"];
        }

        $id = User::orderBy('id', 'desc')->first();
        $data['user_id'] = $id->id;
        Client::create($data);

        // dd($data);
        //return redirect()->route('index')->with('status', 'Message Telah dikirim');
        return redirect('/client')->with('success', 'Successfully Adding Client Data');
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

        $clients = DB::table('clients')->where('id', $id)->first();
        //$clients = Client::with('users')->where('id', $id)->first();
        $companies = DB::table('companies')->get();
        $companies_id = DB::table('companies')->where('id', $clients->perusahaan_id)->first();
        $cclient = DB::table('companyclients')->get();
        $cclient_id = DB::table('companyclients')->where('id', $clients->companyclient_id)->first();
        $category_clients = DB::table('category_clients')->get();
        $category_clients_id = DB::table('category_clients')->where('id', $clients->kategori_client_id)->first();
        $users = DB::table('users')->where('id', $clients->user_id)->first();
        // dd($clients->users->email);
        $title = 'Edit Client';
        return view(
            'admin.client.editclient',
            [
                'clients' => $clients,
                'companies' => $companies,
                'category_clients' => $category_clients,
                'category_clients_id' => $category_clients_id,
                'companies_id' => $companies_id,
                'cclient' => $cclient,
                'cclient_id' => $cclient_id,
                'users' => $users,
                'title' => $title
            ]
        );
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
        $currentime = Carbon::now();

        $users = DB::table('users')->where('id', $request->id);
        $dataclient = array(
            'nama' => $request->nama_client,
            'email' => $request->email,
            'status' => 1,
        );

        $users->update($dataclient);

        $data = array(
            'perusahaan_id' => 1,
            'kategori_client_id' => $request->kategori_client_id,
            'nama_client' => $request->nama_client,
            'companyclient_id' => $request->companyclient_id,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'status' => 1,
            'updated_at' => $currentime,
        );


        if ($request->file('logo')) {
            $namaasli = $request->file('logo')->getClientOriginalName();
            $image = ImgBB::image($request->file('logo'), $namaasli);
            $data['logo'] =  $image["data"]["url"];
        }

        $clients = Client::find($id);
        $clients->update($data);


        // if($request->file('logo')){
        //     $validatedData['logo'] = $request->file('logo')->store('img-client');
        // }
        return redirect('/client')->with('success', 'Successfully Changed Client Data');
    }

    public function status(Request $request)
    {
        $clients = Client::find($request->id);
        $data = array(
            'status' => $request->status
        );
        $clients->update($data);
        // DB::table('clients')->where('id', $request->id)->update([
        //     'status'=>$request->status
        // ]);
        return redirect()->route('admin-client-client');
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

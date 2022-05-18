<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Category_clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $clients = Client::All();
    
        $title = ' Client';
     
        $tableTitle = "All Client";
        return view('admin.client.client', compact('clients', 'title', 'tableTitle'));
    }
    public function index2($id)
    {
        $clients = DB::table('clients')->where('id', $id)->first();
        $users = DB::table('users')->where('id', $clients->user_id)->first();
        
        $category_clients = DB::table('category_clients')->where('id', $clients->kategori_client_id)->first();
        return view('admin.client.detailclient', ['clients' => $clients, 'users' => $users, 'category_clients' => $category_clients]);
        
    }

    public function index3()
    {
        $companies = DB::table('companies')->get();
        $category_clients = DB::table('category_clients')->get();
        $title = 'Add Client';
        return view('admin.client.tambahclient', compact('companies', 'category_clients', 'title'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
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
        //// return $request;
        Category_clients::create([
            'nama_kategori' => $request->nama_kategori,
            'status' => 1,

        ]);
        //return redirect()->route('index')->with('status', 'Message Telah dikirim');
        return redirect('/tambahcategory')->with('success', 'Successfully added client category');
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

        $category_clients = Category_clients::where('id', $id)->first();

        return view('admin.client.editcategory', ['category_clients' => $category_clients]);
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
        $category_clients = Category_clients::find($request->id);
        $data = array(
            'nama_kategori' => $request->nama_kategori
        );
        $category_clients->update($data);
        return redirect()->route('admin-category-index')->with('success', 'Successfully changed client category');
    }

    public function status(Request $request)
    {
        $category_clients = Category_clients::find($request->id);
        $data = array(
            'status' => $request->status
        );
        $category_clients->update($data);
        // DB::table('clients')->where('id', $request->id)->update([
        //     'status'=>$request->status
        // ]);
        return redirect()->route('admin-category-index');
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
        //
    }
}

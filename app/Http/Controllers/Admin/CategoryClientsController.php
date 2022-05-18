<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category_clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_clients = DB::table('category_clients');
        $title = 'Category';
        $category_clients = $category_clients->paginate(10);
        return view('admin.client.tambahcategory', compact('category_clients', 'title'));
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
        //// return $request;
        Category_clients::create([
            'nama_kategori' => $request->nama_kategori,
            'status' => 1,

        ]);
        //return redirect()->route('index')->with('status', 'Message Telah dikirim');
        return redirect('/tambahcategory')->with('success', 'Successfully Added Client Category Data');
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
        return redirect()->route('admin-category-index');
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

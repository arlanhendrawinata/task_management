<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finances = Finance::OrderByDesc('id')->get();

        $title = 'Finance';

        $tableTitle = "All Finance";
        return view('admin.finance.index', compact('finances', 'title', 'tableTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add finance';
        return view('admin.finance.finance_create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'name' => ucwords($request->name),
            'detail' => ucfirst($request->detail),
            'img' => $request->foto,
            'value' => $request->value,
            'type' => ucwords($request->type),
            'offices_id' => $request->offices_id,
            'users_id' => Auth::id(),
            'status' => 1,
        );
        Finance::create($data);
        return redirect()->route('admin-finance-index')->with('success', 'New finance has been stored');
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
        $finance = Finance::where('id', $id)->get();
        return view('admin.finance.edit', compact('finance'));
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
        //
    }

    public function status(Request $request)
    {
        $finance = Finance::find($request->id);
        $data = array(
            'status' => $request->status
        );
        $finance->update($data);
        // DB::table('clients')->where('id', $request->id)->update([
        //     'status'=>$request->status
        // ]);
        return redirect()->route('admin-finance-index');
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

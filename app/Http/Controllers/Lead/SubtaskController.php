<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Pic;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $pics = Pic::with('projects', 'users')->get();
        $getpics = Pic::with('projects')->whereRelation('projects', 'id', $id)->exists();
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $divisions = Division::where('status', 1)->get();
        $title = $project->judul_project;
        $title2 = 'Subtask';
        $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id', $id)->get();
        $countsubprojects = Project::where('project_id', $id)->count();

        return view('leadtim/task/subsingletasklead', compact('getpics', 'picbydivisi', 'project', 'countsubprojects', 'subprojects', 'divisions', 'pics', 'title', 'title2'));
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
        // return $request;
        // return $data;
        $type_parent = Project::where('id', $request->project_id)->first()->type;
        if ($type_parent == "Group") {
            $project_arr = array(
                'client_id' => $request->client,
                'divisi_id' => $request->division,
                'user_id' => $request->userid,
                'perusahaan_id' => $request->company,
                'judul_project' => ucwords($request->judul_project),
                'detail_project' => ucwords($request->detail_project),
                'tgl_input' => Carbon::now(),
                'estimasi' => $request->estimasi,
                'status' => 1,
                'prioritas' => $request->prioritas,
                'total_revisi' => 0,
                'type' => $request->type,
                'is_parent' => 0,
                'project_id' => $request->project_id
            );
        } elseif ($type_parent == "Sub1") {
            $project_arr = array(
                'client_id' => $request->client,
                'divisi_id' => $request->division,
                'user_id' => $request->userid,
                'perusahaan_id' => $request->company,
                'judul_project' => ucwords($request->judul_project),
                'detail_project' => ucwords($request->detail_project),
                'tgl_input' => Carbon::now(),
                'estimasi' => $request->estimasi,
                'status' => 1,
                'prioritas' => $request->prioritas,
                'total_revisi' => 0,
                'type' => $request->type,
                'is_parent' => 0,
                'project_id_2' => $request->project_id
            );
        }
        Project::create($project_arr);

        return redirect()->back()->with('success', 'New subtask has been created');
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

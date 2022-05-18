<?php

namespace App\Http\Controllers\Lead;

use App\Models\Client;
use App\Models\Company;
use App\Models\Division;
use App\Models\Pic;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $days = Carbon::now()->daysInMonth;
        $dateNowFrom = Carbon::createFromDate($year, $month, 0);
        $dateNowTo = Carbon::createFromDate($year, $month, $days + 1);

        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            ->where("tgl_input", ">=", $dateNowFrom)
            ->where("tgl_input", "<=", $dateNowTo)
            ->where("divisi_id", Auth::user()->userDetail->divisi_id)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc');

        $projects = $projects->paginate(10);
        $pics = Pic::with('projects', 'users')->get();
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $users = User::all();
        $clients = Client::all();
        $linkback = '';
        
        $countActive = Project::WhereIn('status', [1])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countProses = Project::whereIn('status', [2])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countUnApproved = Project::whereIn('status', [3])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countApproved = Project::whereIn('status', [4])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countSuccess = Project::WhereIn('status', [5])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $title = "Task Leader";


        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');

        return view('leadtim/task/leadtask', compact('picbydivisi', 'aprojects', 'projects', 'users', 'pics', 'clients', 'title', 'countActive', 'countProses', 'countUnApproved', 'countApproved', 'countSuccess', 'linkback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $divisions = Division::all();
        $users = User::all();
        $companies = Company::all();
        $pics = Pic::all();
        $title = "Add Task";
        return view('leadtim/task/tambahleadtask', compact('clients', 'divisions', 'users', 'companies', 'pics', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Project::create([
            'client_id' => $request->client,
            'divisi_id' => $request->division,
            'user_id' => Auth::user()->id,
            'perusahaan_id' => 1,
            'judul_project' => ucwords($request->judul),
            'detail_project' => ucwords($request->detail),
            // 'tgl_mulai' => $request->tgl_mulai,
            'tgl_input' => Carbon::now()->format('Y-m-d'),
            'estimasi' => $request->estimasi,
            'status' => 1,
            'prioritas' => $request->prioritas,
            'total_revisi' => $request->total_revisi,
            'debet' => $request->debet,
            'kredit' => $request->kredit,
        ]);
        return redirect()->route('lead-task-index')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pics = Pic::all();
        $getpics = Pic::with('projects')->whereRelation('projects', 'id', $id)->exists();
        $projects = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        return view('leadtim/task/isifieldtask2', compact('projects', 'pics', 'getpics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::all();
        $divisions = Division::all();
        $users = User::all();
        $companies = Company::all();
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $title = "Edit Task";
        return view('leadtim/task/editleadtask', compact('project', 'companies', 'clients', 'divisions', 'users', 'title'));
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
        $projects = Project::find($request->id)->update([
            'client_id' => $request->client,
            'divisi_id' => $request->division,
            'user_id' => $request->user,
            'perusahaan_id' => $request->company,
            'judul_project' => $request->judul,
            'detail_project' => $request->detail,
            'tgl_input' => $request->tgl_input,
            'tgl_mulai' => $request->tgl_mulai,
            'estimasi' => $request->estimasi,
            'tgl_selesai' => $request->tgl_selesai,
            'prioritas' => $request->prioritas,
            // 'total_revisi' => $request->total_revisi,
            // 'laporan_project' => $request->laporan,
            'debet' => $request->debet,
            'status' => $request->status,
            'kredit' => $request->kredit,
            // 'foto_hasil' => $request->hasil,
        ]);
        return redirect()->route('lead-task-index')->with('success', 'Task has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->route('lead-task-index')->with('success', 'Task has been deleted');
    }
    public function searchDateLead(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        if ($request->input('from_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'from_date' => $fromDate,
            ]);
        }
        if ($request->input('to_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'to_date' => $toDate,
            ]);
        }
        if ($request->input('client') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("client_id", $request->client)
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'client' => $request->client,
            ]);
        }
        if ($request->input('from_date') && $request->input('to_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ]);
        }
        
        $linkback = '/leadtim/tasksearch';
        $countActive = Project::WhereIn('status', [1])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countProses = Project::whereIn('status', [2])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countUnApproved = Project::whereIn('status', [3])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countApproved = Project::whereIn('status', [4])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countSuccess = Project::WhereIn('status', [5])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
            
        $clients = Client::all();
        $pics = Pic::with('projects', 'users')->get();
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $users = User::all();
        // return $pics;
        $title = 'Task';
        
        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        return view('leadtim/task/leadtask', compact('aprojects', 'projects', 'picbydivisi', 'pics', 'users', 'clients', 'title', 'countActive', 'countProses', 'countUnApproved', 'countApproved', 'countSuccess',  'linkback'));
    }

    public function detailTask($id)
    {
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $pics = Pic::all();
        $getpics = Pic::with('projects')->where('project_id', $id)->exists();
        $title = "Detail Task";
        return view('leadtim/task/detailleadtask', compact('project', 'title', 'pics', 'getpics'));
    }
    
    public function approveTask(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->tgl_selesai = Carbon::now();
        $project->save();
        return redirect()->route('lead-task-index')->with('success', 'Task has been approved');
    }
    public function revisiTask(Request $request)
    {
        $project = Project::find($request->id);
        $project->total_revisi = $request->total_revisi + 1;
        $project->laporan_project = $request->laporan;
        $project->status = 1;
        $project->tgl_selesai = null;
        $project->save();
        return redirect()->route('lead-task-index')->with('success', 'Revision successfully added');
    }

    public function dashboardlead(Request $request)
    {

        if ($request->input('status') == 1) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [1])
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Active";
        }
        if ($request->input('status') == 2) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [2])
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Proccess";
        }
        if ($request->input('status') == 3) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [3])
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task UnApproved";
        }
        if ($request->input('status') == 4) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [4])
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Approved";
        }
        if ($request->input('status') == 5) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [5])
                ->where('divisi_id',Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Success";
        }
        
            
        $pics = Pic::with('projects', 'users')->get();
        $clients = Client::all();
        $title = 'Dashboard Task Leader';
        $users = User::all();
        $linkback = '/dashleadsearch';
        
        $countActive = Project::WhereIn('status', [1])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countProses = Project::whereIn('status', [2])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countUnApproved = Project::whereIn('status', [3])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countApproved = Project::whereIn('status', [4])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
        $countSuccess = Project::WhereIn('status', [5])
            ->where('divisi_id',Auth::user()->userDetail->divisi_id)
            ->count();
            
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');

        return view('leadtim/task/leadtask', compact('aprojects', 'picbydivisi', 'projects', 'users', 'pics', 'title', 'clients', 'countActive', 'countProses', 'countUnApproved', 'countApproved', 'countSuccess',  'linkback'));
    }

    public function storepic(Request $request)
    {
        // return $request;
        $projectid = Pic::where('project_id', $request->project_id)->get();
        // return $projectid;
        $searchpic = Pic::where('project_id', $request->project_id)
            ->where('user_id', $request->user_id)
            ->exists();
        // return $searchpic;
        if ($projectid == null) {
            Pic::create([
                'project_id' => $request->project_id,
                'user_id' => $request->user_id,
                'status' => 1,
            ]);
            return redirect()->back()->with('success', 'Pic successfully added');
        } else {
            // return $searchpic;
            if ($searchpic == 1) {
                return redirect()->back()->with('errors', 'Pic already exists');
            } else {
                Pic::create([
                    'project_id' => $request->project_id,
                    'user_id' => $request->user_id,
                    'status' => 1,
                ]);
                return redirect()->back()->with('success', 'Pic successfully added');
            }
        }
    }


    public function destroypic($id)
    {
        $pic = Pic::find($id);
        $pic->delete();
        return redirect()->route('lead-task-index')->with('success', 'Pic has been removed');
    }
    
    // public function estimasi(Request $request)
    // {
    //     $estimasi = Project::find($request->project_id);

    //     $estimasi->update([
    //         'estimasi' => $request->estimasi,
    //     ]);
    //     return redirect()->route('lead-task-index')->with('success', 'Estimasi successfully added');
    // }
    
    public function leadstartDate(Request $request)
    {
        $startdate = Project::find($request->project_id);

        $startdate->update([
            'tgl_mulai' => $request->tgl_mulai,
            'status' => 2,
        ]);
        return redirect()->route('lead-task-index')->with('success', 'Task dimulai');
    }
}

<?php

namespace App\Http\Controllers\Lead;

use App\Models\Client;
use App\Models\Company;
use App\Models\Division;
use App\Models\Pic;
use App\Models\Project;
use App\Models\User;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;
use Infotech\ImgBB\ImgBB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $year = Carbon::now()->year;
        // $month = Carbon::now()->month;
        // $days = Carbon::now()->daysInMonth;
        // $dateNowFrom = Carbon::createFromDate($year, $month, 0);
        // $dateNowTo = Carbon::createFromDate($year, $month, $days + 1);

        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            // ->where("tgl_input", ">=", $dateNowFrom)
            // ->where("tgl_input", "<=", $dateNowTo)
            ->where("divisi_id", Auth::user()->userDetail->divisi_id)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc');

        $projects = $projects->paginate(10);
        $pics = Pic::with('projects', 'users')->get();
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $users = User::all();
        $clients = Client::all();

        $countActive = Project::WhereIn('status', [1])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countProses = Project::whereIn('status', [2])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countUnApproved = Project::whereIn('status', [3])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countApproved = Project::whereIn('status', [4])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countSuccess = Project::WhereIn('status', [5])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $title = "Team Task";


        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        // $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id', $id)->get();
        $divisions = Division::all();
        $currentUrl = " ";
        return view('leadtim/task/leadtask', compact('divisions', 'picbydivisi', 'aprojects', 'projects', 'users', 'pics', 'clients', 'title', 'countActive', 'countProses', 'countUnApproved', 'countApproved', 'countSuccess', 'currentUrl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can_add_task == 1) {
            $clients = Client::all();
            $divisions = Division::all();
            $users = User::all();
            $companies = Company::all();
            $pics = Pic::all();
            $title = "Add Task";
            return view('leadtim/task/tambahleadtask', compact('clients', 'divisions', 'users', 'companies', 'pics', 'title'));
        } else {
            return redirect()->route('lead-task-index')->with('errors', "You don't have permission");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->can_add_task == 1) {

            $data = array(
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
                'type' => $request->type,
                'is_parent' => 0,
                'project_id' => $request->project_id,
                'project_id_2' => $request->project_id_2,
                'debet' => $request->debet,
                'kredit' => $request->kredit,
            );

            if ($request->type == "Single" || $request->type == "Sub1" || $request->type == "Sub2") {
                $data['is_parent'] = 0;
            } elseif ($request->type == "Group") {
                $data['is_parent'] = 1;
            }

            Project::create($data);

            return redirect()->route('lead-task-index')->with('success', 'Task has been added');
        } else {
            return redirect()->route('lead-task-index')->with('errors', "You don't have permission");
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
        if (auth()->user()->can_add_task == 1) {

            $clients = Client::all();
            $divisions = Division::all();
            $users = User::all();
            $companies = Company::all();
            $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
            $title = "Edit Task";

            return view('leadtim/task/editleadtask', compact('project', 'companies', 'clients', 'divisions', 'users', 'title'));
        } else {
            return redirect()->route('lead-task-index')->with('errors', "You don't have permission");
        }
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

        if (auth()->user()->can_add_task == 1) {
            // $test =  Project::where('id', $request->id)->first()->project_id;
            // return $test;
            $data = array(
                'client_id' => $request->client,
                'divisi_id' => $request->division,
                'user_id' => $request->user,
                'perusahaan_id' => $request->company,
                'judul_project' => ucwords($request->judul_project),
                'detail_project' => ucwords($request->detail_project),
                'tgl_input' => $request->tanggal_input,
                'tgl_mulai' => $request->tanggal_mulai,
                'estimasi' => $request->estimasi,
                // 'tgl_selesai' => $request->tanggal_selesai,
                'status' => $request->status,
                'prioritas' => $request->prioritas,
                // 'total_revisi' => $request->revisi,
                // 'laporan_project' => ucwords($request->laporan_project),
                // 'foto_hasil' => $request->foto_hasil,
                'type' => $request->type,
                'is_parent' => 0,
                // 'project_id' => $request->project_id,
                // 'project_id_2' => $request->project_id_2,
                // 'kredit' => $request->kredit,
                // 'debet' => $request->debet,
            );

            if ($request->type == "Single" || $request->type == "Sub1" || $request->type == "Sub2") {
                $data['is_parent'] = 0;
            } elseif ($request->type == "Group") {
                $data['is_parent'] = 1;
            }

            $project = Project::find($request->id)->update($data);

            // return $request->id;

            if ($request->type == "Group" || $request->type == "Single") {
                return redirect()->route('lead-task-single', $request->id)->with('success', 'Task has been updated');
            } elseif ($request->type == "Sub1") {
                $parentid = Project::select('project_id')->where('id', $request->id)->first();
                return redirect()->route('lead-task-single', $parentid->project_id)->with('success', 'Task has been updated');
            } elseif ($request->type == "Sub2")
                $parentid = Project::select('project_id_2')->where('id', $request->id)->first();
            return redirect()->route('lead-task-single', $parentid->project_id_2)->with('success', 'Task has been updated');
        } else {
            return redirect()->route('lead-task-index')->with('errors', "You don't have permission");
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
        if (auth()->user()->can_add_task == 1) {

            $project = Project::find($id);
            $project->delete();
            return redirect()->route('lead-task-index')->with('success', 'Task has been deleted');
        } else {
            return redirect()->route('lead-task-index')->with('errors', "You don't have permission");
        }
    }
    public function searchDateLead(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        if ($request->input('from_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'from_date' => $fromDate,
            ]);
        }
        if ($request->input('to_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'to_date' => $toDate,
            ]);
        }
        if ($request->input('client') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("client_id", $request->client)
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'client' => $request->client,
            ]);
        }
        if ($request->input('from_date') && $request->input('to_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ]);
        }

        $currentUrl = "search";
        $countActive = Project::WhereIn('status', [1])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countProses = Project::whereIn('status', [2])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countUnApproved = Project::whereIn('status', [3])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countApproved = Project::whereIn('status', [4])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countSuccess = Project::WhereIn('status', [5])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();

        $clients = Client::all();
        $pics = Pic::with('projects', 'users')->get();
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $users = User::all();
        // return $pics;
        $title = 'Task';
        $divisions = Division::all();

        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        return view('leadtim/task/leadtask', compact('divisions', 'aprojects', 'projects', 'picbydivisi', 'pics', 'users', 'clients', 'title', 'countActive', 'countProses', 'countUnApproved', 'countApproved', 'countSuccess',  'currentUrl'));
    }

    public function singleLeadTask($id)
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

        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $pics = Pic::with('projects', 'users')->get();
        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $getpics = Pic::with('projects')->whereRelation('projects', 'id', $id)->exists();
        $users = User::all();
        $divisions = Division::where('status', 1)->get();
        $title = $project->judul_project;
        $title2 = 'Primary Task';
        // $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id', $id)->get();
        // $countsubprojects = Project::where('project_id', $id)->count();

        if ($project->type == "Group") {
            $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id', $id)->get();
            $countsubprojects = Project::where('project_id', $id)->count();
            // return $countsubprojects;
        } elseif ($project->type == "Sub1") {
            $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id_2', $id)->get();
            $countsubprojects = Project::where('project_id_2', $id)->count();
            $title2 = 'Sub 1 Task';
            $title3 = 'Sub 2 Task';
            // return $countsubprojects;
        } else {
            $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id', $id)->get();
            $countsubprojects = Project::where('project_id', $id)->count();
        }

        $projects = Project::all();

        return view('leadtim/task/singletasklead', compact('projects', 'picbydivisi', 'project', 'countsubprojects', 'subprojects', 'divisions', 'pics', 'title', 'title2', 'getpics', 'picbydivisi'));
    }

    public function detailTask($id)
    {
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $pics = Pic::all();
        $getpics = Pic::with('projects')->where('project_id', $id)->exists();
        $title = "Detail Task";
        $notes = Note::with('projects', 'users')->whereRelation('projects', 'id', $id)->get();
        return view('leadtim/task/detailleadtask', compact('notes', 'project', 'title', 'pics', 'getpics'));
    }

    public function approveTask(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = 4;
        $project->tgl_selesai = Carbon::now();
        $project->save();
        return redirect()->route('lead-task-index')->with('success', 'Task has been approved');
    }

    public function approveTask2($id)
    {
        $project = Project::find($id);
        $project->status = 4;
        $project->tgl_selesai = Carbon::now();
        $project->save();
        return redirect()->back()->with('success', 'Task has been approved');
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
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Active";
        }
        if ($request->input('status') == 2) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [2])
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Process";
        }
        if ($request->input('status') == 3) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [3])
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task UnApproved";
        }
        if ($request->input('status') == 4) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [4])
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Approved";
        }
        if ($request->input('status') == 5) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [5])
                ->where('divisi_id', Auth::user()->userDetail->divisi_id)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Success";
        }

        $pics = Pic::with('projects', 'users')->get();
        $clients = Client::all();
        $title = 'Dashboard Team Task';
        $users = User::all();
        $currentUrl = "search";

        $countActive = Project::WhereIn('status', [1])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countProses = Project::whereIn('status', [2])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countUnApproved = Project::whereIn('status', [3])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countApproved = Project::whereIn('status', [4])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();
        $countSuccess = Project::WhereIn('status', [5])
            ->where('divisi_id', Auth::user()->userDetail->divisi_id)
            ->count();

        $picbydivisi = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        $divisions = Division::all();

        return view('leadtim/task/leadtask', compact('currentUrl', 'divisions', 'aprojects', 'picbydivisi', 'projects', 'users', 'pics', 'title', 'clients', 'countActive', 'countProses', 'countUnApproved', 'countApproved', 'countSuccess'));
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
        return redirect()->back()->with('success', 'Pic has been removed');
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
        return redirect()->back()->with('success', 'Task started');
    }

    public function showpic($id)
    {
        $projectDivisi = Project::select('divisi_id')->where('id', $id)->first();
        $users = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', $projectDivisi->divisi_id)->get();
        $pics = Pic::all();
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        return view('leadtim.task.leadtaskpic', compact('project', 'pics', 'users'));
    }

    public function leadSubmit(Request $request)
    {

        if ($request->foto_hasil != NULL) {
            $namaasli = $request->file('foto_hasil')->getClientOriginalName();
            $image = ImgBB::image($request->file('foto_hasil'), $namaasli);

            Project::find($request->id)
                ->update([
                    'laporan_project' => $request->keterangan,
                    'tgl_selesai' => date('Y-m-d'),
                    'status' => 4,
                    'foto_hasil' => $image["data"]["url"],
                ]);
        } else {
            Project::find($request->id)
                ->update([
                    'laporan_project' => $request->keterangan,
                    'tgl_selesai' => date('Y-m-d'),
                    'status' => 4,
                ]);
        }
        return redirect()->route('lead-task-index')->with('success', 'Task has been Approved');
    }
}

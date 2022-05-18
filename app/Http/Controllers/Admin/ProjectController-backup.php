<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Company;
use App\Models\Division;
use App\Models\Note;
use App\Models\Pic;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        $clients = Client::all();
        $users = User::all();
        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            ->whereIn('type', ['Single', 'Group'])
            // ->where("tgl_input", "<=", $dateNowTo)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc');
        $projects = $projects->paginate(10);
        $pics = Pic::with('projects')->get();
        $currentUrl = "index";
        $title = 'Task';
        $tableTitle = "All Task";
        $divisions = Division::all();
        $name = "";
        $val = "";

        return view('admin.task.tasktable', compact('name', 'val', 'divisions', 'tableTitle', 'currentUrl', 'projects', 'users', 'pics', 'clients', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::where('status', 1)->get();
        $divisions = Division::where('status', 1)->get();
        $title = 'Add Task';
        return view('admin.task.tambahtask', compact('clients', 'divisions', 'title'));
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
            'client_id' => $request->client,
            'divisi_id' => $request->division,
            'user_id' => Auth::id(),
            'perusahaan_id' => $request->company,
            'judul_project' => ucwords($request->judul_project),
            'detail_project' => ucwords($request->detail_project),
            'tgl_input' => Carbon::now(),
            'estimasi' => $request->estimasi,
            'status' => 1,
            'prioritas' => $request->prioritas,
            'total_revisi' => 0,
            'laporan_project' => ucwords($request->laporan_project),
            'foto_hasil' => $request->foto_hasil,
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

        return redirect()->route('admin-task-index')->with('success', 'New task has been created');
    }

    public function changeStatus(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->save();
        return redirect()->route('admin-task-index')->with('success', 'Status has been changed');
        // return response()->json(['message' => 'Status has been changed', 'status' => $request->status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();

        // $taskslug = Project::all()->pluck('judul_project');
        // return $taskslug;
        // $slug = str_replace(' ', '-', $project->judul_project);
        return view('admin.task.showtask', compact('project', 'slug'));
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
        $title = 'Edit Task';
        return view('admin.task.edittask', compact('project', 'clients', 'divisions', 'users', 'companies', 'title'));
    }

    public function detailTask($id)
    {
        $project = Project::with('companies', 'clients', 'divisions', 'users', 'pics')->where('id', $id)->first();
        $pics = Pic::with('projects')->get();
        $getpics = Pic::with('projects')->whereRelation('projects', 'id', $id)->exists();
        $note = Note::all()->where('project_id', $id)->first();
        $title = 'Detail Task';
        $subprojects = Project::with('companies', 'clients', 'divisions', 'users')->where('project_id', $id)->get();
        $countsubprojects = Project::where('project_id', $id)->count();
        $notes = Note::with('projects', 'users')->whereRelation('projects', 'id', $id)->get();
        return view('admin.task.detailtask', compact('notes', 'subprojects', 'countsubprojects', 'getpics', 'project', 'title', 'note', 'pics'));
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
            'tgl_selesai' => $request->tanggal_selesai,
            'status' => $request->status,
            'prioritas' => $request->prioritas,
            'total_revisi' => $request->revisi,
            'laporan_project' => ucwords($request->laporan_project),
            'foto_hasil' => $request->foto_hasil,
            'type' => $request->type,
            'is_parent' => 0,
            // 'project_id' => $request->project_id,
            // 'project_id_2' => $request->project_id_2,
            'kredit' => $request->kredit,
            'debet' => $request->debet,
        );

        if ($request->type == "Single" || $request->type == "Sub1" || $request->type == "Sub2") {
            $data['is_parent'] = 0;
        } elseif ($request->type == "Group") {
            $data['is_parent'] = 1;
        }

        $projects = Project::find($request->id)->update($data);
        if ($request->type == "Group" || $request->type == "Single") {
            return redirect()->route('admin-task-single', $request->id)->with('success', 'Task has been updated');
        } elseif ($request->type == "Sub1") {
            $parentid = Project::select('project_id')->where('id', $request->id)->first();
            return redirect()->route('admin-task-single', $parentid->project_id)->with('success', 'Task has been updated');
        } elseif ($request->type == "Sub2")
            $parentid = Project::select('project_id_2')->where('id', $request->id)->first();
        return redirect()->route('admin-task-single', $parentid->project_id_2)->with('success', 'Task has been updated');
    }

    public function verifikasiTask($id)
    {
        $project = Project::find($id);
        $project->status = 5;
        $project->save();
        return redirect()->back()->with('success', 'Task has been verified');
    }

    public function revisiTask(Request $request)
    {
        $project = Project::find($request->id);
        $project->total_revisi = $request->total_revisi + 1;
        $project->laporan_project = $request->laporan;
        $project->status = 1;
        $project->tgl_selesai = null;
        $project->save();
        return redirect()->route('task-status-search', ['status' => 1])->with('success', 'Revision successfully added');
    }

    public function gagalTask(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->save();
        return redirect()->route('task-status-search', ['status' => 5])->with('success', 'Status has been changed');
    }

    public function batalkanTask(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->save();
        return redirect()->route('task-status-search', ['status' => 5])->with('success', 'Status has been changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function search(Request $request)
    {
        // return $request->input('division');

        $fromDate = $request->from_date;
        $toDate = $request->to_date;


        if ($request->input('status') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("status", $request->status)
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status,
            ]);
        } elseif ($request->input('from_date') != null && $request->input('to_date') == null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'from_date' => $fromDate,
            ]);
        } elseif ($request->input('to_date') != null && $request->input('from_date') == null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'to_date' => $toDate,
            ]);
        } elseif ($request->input('client') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("client_id", $request->client)
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'client' => $request->client,
            ]);
        } elseif ($request->input('division') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'division' => $request->division,
            ]);
        } elseif ($request->input('from_date') && $request->input('to_date') != null) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->orderBy('client_id', 'asc');
            $projects = $projects->paginate(10)->appends([
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ]);
        } else {
            return redirect()->back()->with('errors', 'Please fill out the form!');
        }

        $clients = Client::all();
        $divisions = Division::all();
        $pics = Pic::with('projects', 'users')->get();
        $title = 'Task';
        $users = User::all();
        $currentUrl = "search";
        $tableTitle = "Filter Task";
        $name = "";
        $val = "";

        return view('admin.task.tasktable', compact('name', 'val', 'divisions', 'currentUrl', 'tableTitle', 'projects', 'users', 'clients', 'pics', 'title'));
    }

    public function singleTask($id)
    {
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $pics = Pic::with('projects', 'users')->get();
        $divisions = Division::where('status', 1)->get();
        $title = $project->judul_project;
        $title2 = 'Primary Task';
        $title3 = 'Sub 1 Task';
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
        return view('admin.task.singletask', compact('title3', 'project', 'countsubprojects', 'subprojects', 'divisions', 'pics', 'title', 'title2'));
    }

    public function addpic(Request $request)
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

    public function destroy($id)
    {
        $project = Project::find($id);
        // $idparent = $project->project_id;
        $is_group = $project->type;
        if ($is_group == "Group") {
            $subprojects = Project::where('project_id', $id)->pluck('id');
            $subpics = Pic::whereIn('project_id', $subprojects)->pluck('id');
            $subnotes = Note::whereIn('project_id', $subprojects)->pluck('id');
            Project::whereIn('id', $subprojects)->delete();
            Pic::whereIn('project_id', $subpics)->delete();
            Note::whereIn('id', $subnotes)->delete();
        } elseif ($is_group == "Sub1") {
            $subprojects = Project::where('project_id_2', $id)->pluck('id');
            $subpics = Pic::whereIn('project_id', $subprojects)->pluck('id');
            $subnotes = Note::whereIn('project_id', $subprojects)->pluck('id');
            Project::whereIn('id', $subprojects)->delete();
            Pic::whereIn('project_id', $subpics)->delete();
            Note::whereIn('id', $subnotes)->delete();
        }
        $notes_id = Note::where('project_id', $id)->pluck('id');
        Note::whereIn('id', $notes_id)->delete();
        Project::find($id)->delete();
        Pic::where('project_id', $id)->pluck('id');

        return redirect()->route('admin-task-index')->with('success', 'Task has been deleted');
    }

    public function adddestroypic($id)
    {
        $pic = Pic::find($id);
        $pic->delete();
        return redirect()->back()->with('success', 'Pic has been removed');
    }

    public function showpic($id)
    {
        $projectDivisi = Project::select('divisi_id')->where('id', $id)->first();
        $users = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', $projectDivisi->divisi_id)->get();
        $pics = Pic::all();
        $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        return view('admin.task.taskpic', compact('project', 'pics', 'users'));
    }

    // public function addestimasi(Request $request)
    // {
    //     $estimasi = Project::find($request->project_id);

    //     $estimasi->update([
    //         'estimasi' => $request->estimasi,
    //     ]);
    //     return redirect()->route('admin-task-index')->with('success', 'Estimasi successfully added');
    // }


    public function addstartDate(Request $request)
    {
        $startdate = Project::find($request->project_id);

        $startdate->update([
            'tgl_mulai' => $request->tgl_mulai,
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Task started');
    }

    public function maneSubmit(Request $request)
    {

        if ($request->foto_hasil != NULL) {
            $namaasli = $request->file('foto_hasil')->getClientOriginalName();
            $image = ImgBB::image($request->file('foto_hasil'), $namaasli);

            Project::find($request->id)
                ->update([
                    'laporan_project' => $request->keterangan,
                    'tgl_selesai' => date('Y-m-d'),
                    'status' => 5,
                    'foto_hasil' => $image["data"]["url"],
                ]);
        } else {
            Project::find($request->id)
                ->update([
                    'laporan_project' => $request->keterangan,
                    'tgl_selesai' => date('Y-m-d'),
                    'status' => 5,
                ]);
        }
        return redirect()->route('admin-task-index')->with('success', 'Task has been verified');
    }

    public function selectSearch($name, $val)
    {
        $clients = Client::all();
        $users = User::all();
        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            ->where($name, $val)
            ->whereIn('type', ['Single', 'Group'])
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc');
        $projects = $projects->paginate(10);
        $pics = Pic::with('projects')->get();
        $currentUrl = "search";
        $title = 'Task';
        $tableTitle = "All Task";
        $divisions = Division::all();
        return view('admin.task.tasktable', compact('name', 'val', 'divisions', 'tableTitle', 'currentUrl', 'projects', 'users', 'pics', 'clients', 'title'));
    }
}

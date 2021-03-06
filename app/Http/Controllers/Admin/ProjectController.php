<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Company;
use App\Models\Division;
use App\Models\LoginLogs;
use App\Models\Note;
use App\Models\Pic;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
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
            ->orderBy('id', 'desc')->get();
        $pics = Pic::with('projects')->get();
        $currentUrl = "index";
        $title = 'Task';
        $tableTitle = "All Task";
        $divisions = Division::all();
        $name = "";
        $val = "";
        $countMonth = 1;
        $month = "";

        return view('admin.task.tasktable', compact('month', 'countMonth', 'name', 'val', 'divisions', 'tableTitle', 'currentUrl', 'projects', 'users', 'pics', 'clients', 'title'));
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
        $project->tgl_selesai = NULL;
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

        $countMonth = 1;
        $month = "";

        //from
        if ($request->input('from_date') != NULL && $request->input('to_date') == NULL && $request->input('client') == NULL && $request->input('division') == NULL) {
            // return 'from';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", $fromDate)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", $fromDate)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // to
        } elseif ($request->input('to_date') != NULL && $request->input('from_date') == NULL && $request->input('client') == NULL && $request->input('division') == NULL) {
            // return 'to';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'to_date' => $toDate,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", $toDate)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", $toDate)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            //client
        } elseif ($request->input('client') != NULL && $request->input('to_date') == NULL && $request->input('from_date') == NULL && $request->input('division') == NULL) {
            // return 'client';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("client_id", $request->client)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'client' => $request->client,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("client_id", $request->client)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //Wide Modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // divisi
        } elseif ($request->input('division') != NULL && $request->input('to_date') == NULL && $request->input('from_date') == NULL && $request->input('client') == NULL) {
            // return 'division';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'division' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("divisi_id", $request->division)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //Wide Modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // form, client
        } elseif ($request->input('from_date') != NULL && $request->input('client') != NULL && $request->input('to_date') == NULL && $request->input('division') == NULL) {
            // return 'from, client';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->where("client_id", $request->client)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'client' => $request->client,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->where("client_id", $request->client)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", $fromDate)
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", $fromDate)
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // form, divisi
        } elseif ($request->input('from_date') != NULL && $request->input('division') != NULL && $request->input('to_date') == NULL && $request->input('client') == NULL) {
            // return 'from, divisi';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'division' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $fromDate)
                ->where("divisi_id", $request->division)
                ->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", $fromDate)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", $fromDate)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }

            // to, client
        } elseif ($request->input('to_date') != NULL && $request->input('client') != NULL && $request->input('from_date') == NULL && $request->input('division') == NULL) {
            // return 'to, client';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->where("client_id", $request->client)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'to_date' => $toDate,
            //     'client' => $request->client,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->where("client_id", $request->client)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", $toDate)
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", $toDate)
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // to, divisi
        } elseif ($request->input('to_date') != NULL && $request->input('division') != NULL && $request->input('from_date') == NULL && $request->input('client') == NULL) {
            // return 'to, divisi';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'to_date' => $toDate,
            //     'division' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", $toDate)
                ->where("divisi_id", $request->division)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", $toDate)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", $toDate)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // form, to
        } elseif ($request->input('from_date') != NULL && $request->input('to_date') != NULL && $request->input('client') == NULL && $request->input('division') == NULL) {
            // return 'from, to';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'to_date' => $toDate,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // divisi, form, to
        } elseif ($request->input('from_date') != NULL && $request->input('to_date') != NULL && $request->input('division') != NULL && $request->input('client') == NULL) {
            // return 'divisi, from, to';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'to_date' => $toDate,
            //     'divisi' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where("divisi_id", $request->division)
                ->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
        } elseif ($request->input('from_date') != NULL && $request->input('to_date') != NULL && $request->input('client') != NULL && $request->input('division') == NULL) {
            // return 'client, from, to';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where("client_id", $request->client)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'to_date' => $toDate,
            //     'client' => $request->client,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where("client_id", $request->client)
                ->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->where("client_id", $request->client)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // from, client, divisi
        } elseif ($request->input('from_date') != NULL && $request->input('client') != NULL && $request->input('division') != NULL && $request->input('to_date') == NULL) {
            // return 'from, client, divisi';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("client_id", $request->client)
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'client' => $request->client,
            //     'division' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("client_id", $request->client)
                ->where("divisi_id", $request->division)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("client_id", $request->client)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("client_id", $request->client)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
            // to, client, divisi
        } elseif ($request->input('to_date') != NULL && $request->input('client') != NULL && $request->input('division') != NULL && $request->input('from_date') == NULL) {
            // return 'to, client, divisi';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $toDate)
                ->where("client_id", $request->client)
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'to_date' => $toDate,
            //     'client' => $request->client,
            //     'division' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $toDate)
                ->where("client_id", $request->client)
                ->where("divisi_id", $request->division)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", ">=", $toDate)
                    ->where("client_id", $request->client)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", ">=", $toDate)
                    ->where("client_id", $request->client)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
        } elseif ($request->input('from_date') != NULL && $request->input('to_date') != NULL && $request->input('client') != NULL && $request->input('division') != NULL) {
            // return 'client, divisi, from, to';
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where("client_id", $request->client)
                ->where("divisi_id", $request->division)
                ->orderBy('status', 'asc')->get();
            // $projects = $projects->paginate(10)->appends([
            //     'from_date' => $fromDate,
            //     'to_date' => $toDate,
            //     'client' => $request->client,
            //     'division' => $request->division,
            // ]);

            $count_projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->where("client_id", $request->client)
                ->where("divisi_id", $request->division)->get();
            $count_projects = count($count_projects);

            if ($count_projects > 0) {
                //wide modal
                $pluck_mulai = Project::select('tgl_mulai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->where("client_id", $request->client)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
                $pluck_selesai = Project::select('tgl_selesai')
                    ->where("tgl_input", ">=", $fromDate)
                    ->where("tgl_input", "<=", $toDate)
                    ->where("client_id", $request->client)
                    ->where("divisi_id", $request->division)
                    ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();
            } else {
                return redirect()->back()->with('errors', 'No data found!');
            }
        } else {
            return redirect()->back()->with('errors', 'Please fill out the form!');
        }

        if ($pluck_mulai == NULL || $pluck_selesai == NULL)
            return redirect()->back()->with('errors', 'Start date and End date cannot be empty');

        $count_mulai = count($pluck_mulai);
        $count_selesai = count($pluck_selesai);

        for ($i = 0; $i < $count_mulai; $i++) {
            $dateFormat_mulai[] = date("d/m/Y", strtotime($pluck_mulai[$i]));
            $merge[] = [
                'month' => Carbon::createFromFormat('d/m/Y', $dateFormat_mulai[$i])->format('m'),
                'year' => Carbon::createFromFormat('d/m/Y', $dateFormat_mulai[$i])->format('Y')
            ];
        }
        // $unique_merge[] = array_uni;
        for ($i = 0; $i < $count_selesai; $i++) {
            $dateFormat_selesai[] = date("d/m/Y", strtotime($pluck_selesai[$i]));
            $merge[] = [
                'month' => Carbon::createFromFormat('d/m/Y', $dateFormat_selesai[$i])->format('m'),
                'year' => Carbon::createFromFormat('d/m/Y', $dateFormat_selesai[$i])->format('Y'),
            ];
        }


        $uniqueMonth = array_unique($merge, SORT_REGULAR);
        $month = array_merge($uniqueMonth);

        $firstMonth = reset($month)['month'];
        $firstYear = reset($month)['year'];
        $endMonth = end($month)['month'];
        $endYear = end($month)['year'];

        $period = CarbonPeriod::create($firstYear . '-' . $firstMonth . '-1', $endYear . '-' . $endMonth . '-1');

        foreach ($period as $date) {
            $dates[] =
                [
                    'month' => $date->format('m'),
                    'year' => $date->format('y'),
                ];
        }
        // remove duplicate array multi dimensional
        $dates = array_map("unserialize", array_unique(array_map("serialize", $dates)));
        $dates = array_merge($dates);
        $countMonth = count($dates);
        $month = getMonthName($dates);

        $columns = array_column($month, 'year');
        array_multisort($columns, SORT_ASC, $month);
        $month = $month;

        $clients = Client::all();
        $divisions = Division::all();
        $pics = Pic::with('projects', 'users')->get();
        $title = 'Task';
        $users = User::all();
        $currentUrl = "search";
        $tableTitle = "Filter Task";
        $name = "";
        $val = "";

        return view('admin.task.tasktable', compact('countMonth', 'month', 'name', 'val', 'divisions', 'currentUrl', 'tableTitle', 'projects', 'users', 'clients', 'pics', 'title'));
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
        if ($projectid == NULL) {
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
            ->orderBy('id', 'desc')->get();
        // $projects = $projects->paginate(10);

        //wide modal
        $pluck_mulai = Project::select('tgl_mulai')
            ->where($name, $val)
            ->whereNotNULL("tgl_mulai")->pluck('tgl_mulai')->toArray();
        $pluck_selesai = Project::select('tgl_selesai')
            ->where($name, $val)
            ->whereNotNULL("tgl_selesai")->pluck('tgl_selesai')->toArray();

        $count_mulai = count($pluck_mulai);
        $count_selesai = count($pluck_selesai);

        for ($i = 0; $i < $count_mulai; $i++) {
            $dateFormat_mulai[] = date("d/m/Y", strtotime($pluck_mulai[$i]));
            $merge[] = [
                'month' => Carbon::createFromFormat('d/m/Y', $dateFormat_mulai[$i])->format('m'),
                'year' => Carbon::createFromFormat('d/m/Y', $dateFormat_mulai[$i])->format('Y')
            ];
        }
        // $unique_merge[] = array_uni;
        for ($i = 0; $i < $count_selesai; $i++) {
            $dateFormat_selesai[] = date("d/m/Y", strtotime($pluck_selesai[$i]));
            $merge[] = [
                'month' => Carbon::createFromFormat('d/m/Y', $dateFormat_selesai[$i])->format('m'),
                'year' => Carbon::createFromFormat('d/m/Y', $dateFormat_selesai[$i])->format('Y'),
            ];
        }

        $uniqueMonth = array_unique($merge, SORT_REGULAR);
        $month = array_merge($uniqueMonth);

        $firstMonth = reset($month)['month'];
        $firstYear = reset($month)['year'];
        $endMonth = end($month)['month'];
        $endYear = end($month)['year'];

        $period = CarbonPeriod::create($firstYear . '-' . $firstMonth . '-1', $endYear . '-' . $endMonth . '-1');

        foreach ($period as $date) {
            $dates[] =
                [
                    'month' => $date->format('m'),
                    'year' => $date->format('y'),
                ];
        }
        // remove duplicate array multi dimensional
        $dates = array_map("unserialize", array_unique(array_map("serialize", $dates)));
        $dates = array_merge($dates);
        $countMonth = count($dates);
        $month = getMonthName($dates);

        $columns = array_column($month, 'year');
        array_multisort($columns, SORT_ASC, $month);
        $month = $month;

        $pics = Pic::with('projects')->get();
        $currentUrl = "search";
        $title = 'Task';
        $tableTitle = "All Task";
        $divisions = Division::all();
        return view('admin.task.tasktable', compact('countMonth', 'month', 'name', 'val', 'divisions', 'tableTitle', 'currentUrl', 'projects', 'users', 'pics', 'clients', 'title'));
    }
    public function reporttask()
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
            ->orderBy('id', 'desc')->get();
        $pics = Pic::with('projects')->get();
        $currentUrl = "index";
        $title = 'Task';
        $tableTitle = "All Task";
        $divisions = Division::all();
        $name = "";
        $val = "";
        $countMonth = 1;
        $month = "";

        return view('admin.task.reporttask', compact('month', 'countMonth', 'name', 'val', 'divisions', 'tableTitle', 'currentUrl', 'projects', 'users', 'pics', 'clients', 'title'));
    }

    public function laporanprojects()
    {
        $clients = Client::all();
        $users = User::all();
        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            ->whereIn('type', ['Single', 'Group'])
            // ->where("tgl_input", "<=", $dateNowTo)
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')->get();
        $pics = Pic::with('projects')->get();
        $currentUrl = "index";
        $title = 'Laporan Task';
        $tableTitle = "All Task";
        $divisions = Division::all();
        $name = "";
        $val = "";
        $countMonth = 1;
        $month = "";

        return view('admin.task.cetakproject', compact('month', 'countMonth', 'name', 'val', 'divisions', 'tableTitle', 'currentUrl', 'projects', 'users', 'pics', 'clients', 'title'));
    }
    public function laporanlogin()
    {
        //
        $title = "Log Login";

        $loginlog["allData"] = LoginLogs::all();

        $x = 0;
        $collection = new Collection();
        foreach ($loginlog["allData"] as $item2) {
            $findnama = User::where('id', $item2->user_id)->first();

            if ($findnama != null) {
                $data["UserData"][$x] = $findnama;
                $data["LoginlogData"][$x] = $item2;

                $collection->push(
                    (object)[
                        'nama' => $data["UserData"][$x]->nama,
                        'email' => $data["UserData"][$x]->email,
                        'id' => $data["LoginlogData"][$x]->id,
                        'user_id' => $data["LoginlogData"][$x]->user_id,
                        'ip_address' => $data["LoginlogData"][$x]->ip_address,
                        'mac_address' => $data["LoginlogData"][$x]->mac_address,
                        'browser' => $data["LoginlogData"][$x]->browser,
                        'created_at' => $data["LoginlogData"][$x]->created_at,
                        'updated_at' => $data["LoginlogData"][$x]->updated_at
                    ]
                );

                $x++;
            }
        };

        $collection = $collection->sortByDesc('id');
        // @dd($collection);

        return view('admin.task.cetakloglogin', ['Data' => $collection, 'title' => $title]);

        // return view('admin/loglogin', ['Data' => $collection, 'title' => $title]);
    }
}

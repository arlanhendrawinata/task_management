<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Client;
use App\Models\Company;
use App\Models\Division;
use App\Models\Pic;
use App\Models\Project;
use App\Models\Userdetail;
use App\Models\User;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $title = 'Dashboard';

        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            ->whereIn('type', ['Group', 'Single'])
            ->where("status", 1)
            ->orderBy('id', 'desc')
            ->orderBy('status', 'desc');
        $projects = $projects->paginate(10);
        $pics = Pic::with('projects', 'users')->get();

        $projectName = Project::all()->pluck('judul_project')->toArray();

        $countActive = Project::whereIn('status', [1])->whereIn('type', ['Single', 'Group'])->count();
        $countProcess = Project::whereIn('status', [2])->whereIn('type', ['Single', 'Group'])->count();
        $countSubmit = Project::whereIn('status', [3])->whereIn('type', ['Single', 'Group'])->count();
        $countVerif = Project::whereIn('status', [4])->whereIn('type', ['Single', 'Group'])->count();
        $countSuccess = Project::whereIn('status', [5])->whereIn('type', ['Single', 'Group'])->count();
        $countCancle = Project::whereIn('status', [6, 7])->whereIn('type', ['Single', 'Group'])->count();

        $tableTitle = "New Task";

        $clients = Client::all();
        $users = User::all();
        $currentUrl = " ";
        $divisions = Division::all();

        $name = "";
        $val = "";


        return view('admin.dashboard', compact('name', 'val', 'divisions', 'users', 'currentUrl', 'clients', 'projects', 'pics', 'title', 'countActive', 'countProcess', 'countSubmit', 'countVerif', 'countSuccess', 'countCancle', 'tableTitle'));
    }

    public function search(Request $request)
    {
        if ($request->input('status') == 1) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [1])
                ->whereIn('type', ['Single', 'Group'])
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Active";
        }

        if ($request->input('status') == 2) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [2])
                ->whereIn('type', ['Single', 'Group'])
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Progress";
        }

        if ($request->input('status') == 3) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [3])
                ->whereIn('type', ['Single', 'Group'])
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Submited";
        }

        if ($request->input('status') == 4) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [4])
                ->whereIn('type', ['Single', 'Group'])
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Verified";
        }

        if ($request->input('status') == 5) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [5])
                ->whereIn('type', ['Single', 'Group'])
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Success";
        }

        if ($request->input('status') == 6) {
            $projects = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereIn("status", [6, 7])
                ->whereIn('type', ['Single', 'Group'])
                ->orderBy('id', 'desc');
            $projects = $projects->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "List Task Cancelled";
        }

        $pics = Pic::with('projects', 'users')->get();
        $title = 'Task';

        $countActive = Project::whereIn('status', [1])->whereIn('type', ['Single', 'Group'])->count();
        $countProcess = Project::whereIn('status', [2])->whereIn('type', ['Single', 'Group'])->count();
        $countSubmit = Project::whereIn('status', [3])->whereIn('type', ['Single', 'Group'])->count();
        $countVerif = Project::whereIn('status', [4])->whereIn('type', ['Single', 'Group'])->count();
        $countSuccess = Project::whereIn('status', [5])->whereIn('type', ['Single', 'Group'])->count();
        $countCancle = Project::whereIn('status', [6, 7])->whereIn('type', ['Single', 'Group'])->count();

        $currentUrl = "search";
        $clients = Client::all();
        $users = User::all();
        $divisions = Division::all();
        $name = "";
        $val = "";

        return view('admin.dashboard', compact('name', 'val', 'divisions', 'currentUrl', 'projects', 'clients', 'users', 'pics', 'title',  'countActive', 'countProcess', 'countSubmit', 'countVerif', 'countSuccess', 'countCancle', 'tableTitle'));
    }

    public function filter(Request $request)
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

        $countActive = Project::whereIn('status', [1])->whereIn('type', ['Single', 'Group'])->count();
        $countProcess = Project::whereIn('status', [2])->whereIn('type', ['Single', 'Group'])->count();
        $countSubmit = Project::whereIn('status', [3])->whereIn('type', ['Single', 'Group'])->count();
        $countVerif = Project::whereIn('status', [4])->whereIn('type', ['Single', 'Group'])->count();
        $countSuccess = Project::whereIn('status', [5])->whereIn('type', ['Single', 'Group'])->count();
        $countCancle = Project::whereIn('status', [6, 7])->whereIn('type', ['Single', 'Group'])->count();

        return view('admin.dashboard', compact('divisions', 'currentUrl', 'tableTitle', 'projects', 'users', 'clients', 'pics', 'title',  'countActive', 'countSubmit', 'countProcess', 'countVerif', 'countSuccess', 'countCancle'));
    }

    public function selectSearch($name, $val)
    {
        $title = 'Task';

        $projects = Project::with('companies', 'clients', 'divisions', 'users')
            ->where($name, $val)
            ->whereIn('type', ['Single', 'Group'])
            ->orderBy('id', 'desc');
        $projects = $projects->paginate(10);
        $pics = Pic::with('projects', 'users')->get();

        $projectName = Project::all()->pluck('judul_project')->toArray();

        $countActive = Project::whereIn('status', [1])->whereIn('type', ['Single', 'Group'])->count();
        $countProcess = Project::whereIn('status', [2])->whereIn('type', ['Single', 'Group'])->count();
        $countSubmit = Project::whereIn('status', [3])->whereIn('type', ['Single', 'Group'])->count();
        $countVerif = Project::whereIn('status', [4])->whereIn('type', ['Single', 'Group'])->count();
        $countSuccess = Project::whereIn('status', [5])->whereIn('type', ['Single', 'Group'])->count();
        $countCancle = Project::whereIn('status', [6, 7])->whereIn('type', ['Single', 'Group'])->count();

        $tableTitle = "Search Task";

        $clients = Client::all();
        $users = User::all();
        $currentUrl = "search";
        $divisions = Division::all();

        return view('admin.dashboard', compact('name', 'val', 'divisions', 'users', 'currentUrl', 'clients', 'projects', 'pics', 'title', 'countActive', 'countProcess', 'countSubmit', 'countVerif', 'countSuccess', 'countCancle', 'tableTitle'));
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
        //
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

    // public function dashaddpic(Request $request)
    // {
    //     Pic::create([
    //         'project_id' => $request->project_id,
    //         'user_id' => $request->user_id,
    //         'status' => 1,
    //     ]);

    //     return redirect()->back()->with('success', 'Pic successfully added');
    // }

    // public function dashdestroypic($id)
    // {
    //     $pic = Pic::find($id);
    //     $pic->delete();
    //     return redirect()->back()->with('success', 'Pic has been removed');
    // }

    // public function dashshowpic($id)
    // {
    //     $projectDivisi = Project::select('divisi_id')->where('id', $id)->first();
    //     $users = User::with('userdetail')->whereRelation('userdetail', 'divisi_id', $projectDivisi->divisi_id)->get();
    //     $pics = Pic::all();
    //     $project = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
    //     return view('admin.pic', compact('project', 'pics', 'users'));
    // }

    // public function dashaddestimasi(Request $request)
    // {
    //     $estimasi = Project::find($request->project_id);

    //     $estimasi->update([
    //         'estimasi' => $request->estimasi,
    //     ]);
    //     return redirect()->route('dashboard')->with('success', 'Estimasi successfully added');
    // }

    public function dashstartdate(Request $request)
    {
        $startdate = Project::find($request->project_id);

        $startdate->update([
            'tgl_mulai' => $request->tgl_mulai,
            'status' => 2,
        ]);
        return redirect()->back()->with('success', 'Task Started');
    }
}

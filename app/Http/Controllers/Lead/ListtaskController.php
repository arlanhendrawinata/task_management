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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Infotech\ImgBB\ImgBB;

class ListtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listtask = Project::with('companies', 'clients', 'divisions', 'users')->get();


        return view('leadtim/listtask/listtask2', compact('listtask'));
    }

    public function listtask()
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $days = Carbon::now()->daysInMonth;
        $dateNowFrom = Carbon::createFromDate($year, $month, 0);
        $dateNowTo = Carbon::createFromDate($year, $month, $days + 1);
        if (Auth::user()->userDetail->role == 3) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users', 'pics')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc');
            $listtask = $listtask->paginate(10);
        } elseif (Auth::user()->userDetail->role == 4) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users', 'pics')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->orderBy('status', 'asc')
                ->orderBy('id', 'desc');
            $listtask = $listtask->paginate(10);
        }
        $pics = Pic::with('projects', 'users')->get();
        $clients = Client::all();
        $title = "My Task";
        $linkback = '';
        $countMyActive = Project::whereIn('status', [1])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMyProses = Project::whereIn('status', [2])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMySubmit = Project::whereIn('status', [3])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMySuccess = Project::whereIn('status', [5])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();

        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        $users = User::all();

        return view('leadtim/listtask/listtask', compact('aprojects', 'users', 'listtask', 'linkback', 'countMyActive', 'countMyProses', 'countMySubmit', 'countMySuccess', 'pics', 'clients', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {

        $status = Project::find($request->id);
        // $currentime = Carbon::now();

        $status->update([
            'status' => $request->status
        ]);
        return redirect()->route('task-index');
    }
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
        // if ($request->hasFile('foto_hasil')) {
        //     $request->file(
        //         'foto_hasil'
        //     )->move('fotohasil/', $request->file('foto_hasil')->getClientOriginalName());
        //     $request->foto_hasil = $request->file('foto_hasil')->getClientOriginalName();
        //     $request->save();
        // }
        // return redirect()->route('list-index')->with('success' . 'Task berhasil diupdate');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projects = Project::with('companies', 'clients', 'divisions', 'users')->where('id', $id)->first();
        $pics = Pic::all();
        return view('leadtim/task/isifieldtask', compact('projects', 'pics'));
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
        $title = "Submit Task";
        $notes = Note::with('projects', 'users')->whereRelation('projects', 'id', $id)->get();
        return view('leadtim/listtask/kumpultask', compact('notes', 'project', 'companies', 'clients', 'divisions', 'users', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Image
    public function update(Request $request)
    {
        $project = Project::find($request->id);
        if (Auth::user()->userDetail->role == 3) {
            $kumpul = array(
                'client_id' => $request->client_id,
                'detail_project' => $request->detail,
                'laporan_project' => $request->laporan,
                'tgl_selesai' => Carbon::now()->format('Y-m-d'),
                'status' => 3,
                'foto_hasil' => '',
            );
        } elseif (Auth::user()->userDetail->role == 4) {
            $kumpul = array(
                'client_id' => $request->client_id,
                'detail_project' => $request->detail,
                'laporan_project' => $request->laporan,
                'status' => 3,
                'foto_hasil' => '',
            );
        }
        if ($request->file('foto_hasil')) {
            $namaasli = $request->file('foto_hasil')->getClientOriginalName();
            $image = ImgBB::image($request->file('foto_hasil'), $namaasli);
            $kumpul['foto_hasil'] =  $image["data"]["url"];
        }
        $project->update($kumpul);

        return redirect()->route('user-list-task')->with('success', 'Submit task successfully');
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
    public function searchDate(Request $request)
    {
        $fromDate = $request->from_date;
        $toDate = $request->to_date;

        if ($request->input('from_date') != null) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->where("tgl_input", $fromDate)
                ->orderBy('client_id', 'asc');
            $listtask = $listtask->paginate(10)->appends([
                'from_date' => $fromDate,
            ]);
        }
        if ($request->input('to_date') != null) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->where("tgl_input", $toDate)
                ->orderBy('client_id', 'asc');
            $listtask = $listtask->paginate(10)->appends([
                'to_date' => $toDate,
            ]);
        }
        if ($request->input('client') != null) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->where("client_id", $request->client)
                ->orderBy('client_id', 'asc');
            $listtask = $listtask->paginate(10)->appends([
                'client' => $request->client,
            ]);
        }
        if ($request->input('from_date') && $request->input('to_date') != null) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->where("tgl_input", ">=", $fromDate)
                ->where("tgl_input", "<=", $toDate)
                ->orderBy('client_id', 'asc');
            $listtask = $listtask->paginate(10)->appends([
                'from_date' => $fromDate,
                'to_date' => $toDate,
            ]);
        }

        $countMyActive = Project::whereIn('status', [1])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMyProses = Project::whereIn('status', [2])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMySubmit = Project::whereIn('status', [3])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMySuccess = Project::whereIn('status', [5])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();

        $clients = Client::all();
        $pics = Pic::with('projects', 'users')->get();
        $title = 'Filter My Task';
        $linkback = '/user/tasksearch';

        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        $users = User::all();

        return view('leadtim/listtask/listtask', compact('aprojects', 'users', 'listtask', 'linkback', 'countMyActive', 'countMyProses', 'countMySubmit', 'countMySuccess', 'pics', 'clients', 'title'));
    }

    public function startDate(Request $request)
    {
        $startdate = Project::find($request->project_id);

        $startdate->update([
            'tgl_mulai' => $request->tgl_mulai,
            'status' => 2,
        ]);
        return redirect()->route('user-list-task')->with('success', 'Task started');
    }

    public function dashboardlist(Request $request)
    {
        if ($request->input('status') == 1) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->whereIn("status", [1])
                ->orderBy('id', 'desc');
            $listtask = $listtask->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "My Active Task";
        }
        if ($request->input('status') == 2) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->whereIn("status", [2])
                ->orderBy('id', 'desc');
            $listtask = $listtask->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "My Process Task";
        }
        if ($request->input('status') == 3) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->whereIn("status", [3])
                ->orderBy('id', 'desc');
            $listtask = $listtask->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "My Submited Task";
        }
        if ($request->input('status') == 4) {
            $listtask = Project::with('companies', 'clients', 'divisions', 'users')
                ->whereRelation('pics', 'user_id', Auth::id())
                ->whereIn("status", [5])
                ->orderBy('id', 'desc');
            $listtask = $listtask->paginate(10)->appends([
                'status' => $request->status
            ]);

            $tableTitle = "My Sucessfully Task";
        }

        $countMyActive = Project::whereIn('status', [1])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMyProses = Project::whereIn('status', [2])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMySubmit = Project::whereIn('status', [3])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();
        $countMySuccess = Project::whereIn('status', [5])
            ->whereRelation('pics', 'user_id', Auth::id())
            ->count();

        $clients = Client::all();
        $pics = Pic::with('projects', 'users')->get();
        $title = 'Dashboard My Task';
        $users = User::all();
        $linkback = '/user/dashlistsearch';

        $aprojects = Project::with('clients')->where('divisi_id', Auth::user()->userDetail->divisi_id)->get();
        $aprojects = $aprojects->unique('client_id');
        $users = User::all();

        return view('leadtim/listtask/listtask', compact('aprojects', 'users', 'listtask', 'tableTitle', 'countMyActive', 'countMyProses', 'countMySubmit', 'countMySuccess', 'users', 'pics', 'title', 'clients', 'linkback'));
    }
}

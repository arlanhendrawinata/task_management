<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\Project;
use App\Models\User;
use App\Models\Pic;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $projects = Project::all();
        $title = 'Notes';

        if (Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2) {
            $notes = Note::with('projects', 'users')->get();
        } elseif (Auth::user()->userDetail->role == 3) {
            $pic = Pic::with('users', 'projects')->where('user_id', Auth::id())->pluck('project_id');
            $notes = Note::with('projects', 'users')->whereRelation('projects', 'divisi_id', Auth::user()->userDetail->divisi_id)->get();
            $projects = Project::with('divisions')->whereRelation('divisions', 'id', Auth::user()->userDetail->divisi_id)->get();
        } elseif (Auth::user()->userDetail->role == 4) {
            $pic = Pic::with('users', 'projects')->where('user_id', Auth::id())->pluck('project_id');
            $notes = Note::with('projects', 'users')->whereIn('project_id', $pic)->get();
            // return $notes;
            $projects = Project::with('pics')->whereRelation('pics', 'user_id', Auth::id())->get();
        }
        return view('admin.task.notes.note', compact('notes', 'projects', 'users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $projects = Project::all();
        return view('admin.task.notes.tambahnote', compact('users', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $project_getuser = Project::all()->where('id', $request->project)->first();
        Note::create([
            'project_id' => $request->project,
            'user_id' => Auth::id(),
            'keterangan' => $request->keterangan,
        ]);

        $project = Project::all()->where('id', $request->project)->first();
        return redirect()->route('notes-index')->with('success', 'New note has been added to project ' . $project->judul_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $projects = Project::with('notes')->whereRelation('notes', 'id', $id)->first();
        $note = Note::all()->where('id', $id)->first();
        return view('admin.task.notes.editnote', compact('note', 'users', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $note = Note::find($request->id)
            ->update([
                'project_id' => $request->project,
                'keterangan' => $request->keterangan,
            ]);
        $project = Project::find($request->project);
        return redirect()->route('notes-index')->with('success', 'Note project ' . $project->judul_project . ' has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Note::find($id)->delete();
        return redirect()->route('notes-index')->with('success', 'Note has been deleted');
    }
}

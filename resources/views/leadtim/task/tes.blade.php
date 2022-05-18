@extends('layouts.app')

@section('container.isi')
@section('active_leadtask', 'mm-active')


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit Task</h4>
        <div>
            <a href="{{ route('lead-task-index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left pr-2"></i> Back</a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="{{ route('lead-task-update') }}" method="post">
                @method('put')
                @csrf
                <input type="number" class="form-control" id="val-projectid" name="project_id" value="{{ $project->project_id }}" hidden>
                <input type="number" class="form-control" id="val-projectid2" name="project_id_2" value="{{ $project->project_id_2 }}" hidden>
                <input type="number" class="form-control" id="val-company" name="company" value="1" hidden>
                <input type="number" value="{{ $project->user_id }}" name="user" hidden>
                <input type="text" name="id" value="{{$project->id}}" hidden>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-client">Client
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-client" name="client" required>
                                    <option value="">Please select client</option>
                                    @forelse($clients as $client)
                                    <option value="{{ $client->id }}" {{ ($project->clients->id == $client-> id ) ? 'selected' : '' }}>{{ $client->nama_client }}</option>
                                    @empty
                                    <option value="">No Datas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="division">Divisi
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="division" name="division" required>
                                    <option value="">Please select division</option>
                                    @forelse($divisions as $division)
                                    <option value="{{ $division->id }}" {{ ($project->divisions->id == $division-> id ) ? 'selected' : '' }}>{{ $division->nama_divisi }}</option>
                                    @empty
                                    <option value="">No Datas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="judul_">Project Title
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="judul_project" class="form-control" id="val-judul_project" name="judul" placeholder="Input project title" value="{{ $project->judul_project }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="detail">Project Details <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="val-detail_project" name="detail" rows="5" placeholder="Describe your project" required>{{ $project->detail_project }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="tgl_input">Input Date
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="tgl_input" name="tgl_input" placeholder="Project input date" value="{{ $project->tgl_input }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="tgl_mulai">Start Date
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="tanggal_mulai" name="tgl_mulai" placeholder="Project start date" value="{{$project->tgl_mulai}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="tanggal_selesai">End Date
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="tanggal_selesai" name="tgl_selesai" placeholder="Project completion date" value="{{$project->tgl_selesai}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="estimasi">S1
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="estimasi" name="estimasi" placeholder="Estimated project date" value="{{$project->estimasi}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="prioritas">Prioritas
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-prioritas" name="prioritas" required>
                                    <option value="">Please select priority</option>
                                    <option value="0" {{ ($project->prioritas == 0 ) ? 'selected' : '' }}>Low</option>
                                    <option value="1" {{ ($project->prioritas == 1 ) ? 'selected' : '' }}>Medium</option>
                                    <option value="2" {{ ($project->prioritas == 2 ) ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="status">Status
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-status" name="status" required>
                                    <option value="">Select status</option>
                                    <option value="1" {{ ($project->status == 1 ) ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ ($project->status == 2 ) ? 'selected' : '' }}>Progress</option>
                                    <option value=" 3" {{ ($project->status == 3 ) ? 'selected' : '' }}>Submited</option>
                                    <option value="4" {{ ($project->status == 4 ) ? 'selected' : '' }}>Approve</option>
                                    <option value=" 5" {{ ($project->status == 5 ) ? 'selected' : '' }}>Success</option>
                                    <option value=" 6" {{ ($project->status == 6 ) ? 'selected' : '' }}>Fail</option>
                                    <option value=" 7" {{ ($project->status == 7 ) ? 'selected' : '' }}>Cancelled</option>
                                    <option value=" 0" {{ ($project->status == 0 ) ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="debet">Debet <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="debet" name="debet" value="{{$project->debet}}" required>
                            </div>
                        </div>
                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="kredit">Credit <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="kredit" name="kredit" value="{{$project->kredit}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-type">Type Task
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-type" name="type" required>
                                    <option value="Single" {{ ( $project->type == "Single" ) ? 'selected' : '' }}>Single</option>
                                    <option value="Group" {{ ( $project->type == "Group" ) ? 'selected' : '' }}>Group</option>
                                    <option value="Sub1" {{ ( $project->type == "Sub1" ) ? 'selected' : '' }}>S 1</option>
                                    <option value="Sub2" {{ ( $project->type == "Sub2" ) ? 'selected' : '' }}>S 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><a href="javascript:void()">Terms &amp; Conditions</a> <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <label class="css-control css-control-primary css-checkbox" for="val-terms">
                                    <input checked type="checkbox" class="css-control-input mr-2" id="val-terms" name="terms" value="1" required>
                                    <span class="css-control-indicator"></span> I agree to the
                                    terms</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-2 pt-4 border-top">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scriptjs')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

</script>
@endsection
@endsection

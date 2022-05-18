@extends('layouts.app')

@section('container.isi')
@section('active_task', 'mm-active')



<style>
    .select2-container--default .select2-selection--single {
        border-radius: 0.75rem;
        border: 1px solid #d7dae3;
        padding: 0.375rem 0.75rem;
        height: 56px;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 28px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }

    .select2-selection__arrow {
        top: 15px !important;
        margin-right: 10px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #7e7e7e !important;
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit Task</h4>
        <div>
            <a href="{{ route('admin-task-index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left pr-2"></i> Back</a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="{{ route('admin-task-update') }}" method="post">
                @method('put')
                @csrf
                <input type="number" class="form-control" id="val-projectid" name="project_id" value="{{ $project->project_id }}" hidden>
                <input type="number" class="form-control" id="val-projectid2" name="project_id_2" value="{{ $project->project_id_2 }}" hidden>
                <input type="number" class="form-control" id="val-company" name="company" value="1" hidden>
                <input type="number" value="{{ $project->user_id }}" name="user" hidden>
                <input type="number" value="{{ $project->id }}" name="id" hidden>
                <div class="row mb-4">
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-client">Client
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-client" name="client">
                                    <option value="">Please select client</option>
                                    @forelse($clients as $client)
                                    <option value="{{ $client->id }}" {{ ($project->clients->id == $client->id ) ? 'selected' : '' }}>{{ $client->nama_client }}</option>
                                    @empty
                                    <option value="">No Datas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-division">Team
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-division" name="division">
                                    <option value="">Please select team</option>
                                    @forelse($divisions as $division)
                                    <option value="{{ $division->id }}" {{ ($project->divisions->id == $division->id ) ? 'selected' : '' }}>{{ $division->nama_divisi }}</option>
                                    @empty
                                    <option value="">No Datas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-judul_project">Project Title
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="judul_project" class="form-control" id="val-judul_project" name="judul_project" placeholder="Input project title" value="{{ $project->judul_project }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-detail_project">Project Details <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="val-detail_project" name="detail_project" rows="5" placeholder="Describe your project" required>{{ $project->detail_project }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-laporan_project">Project Report
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="val-laporan_project" name="laporan_project" rows="5" placeholder="Isi laporan project.."></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-tanggal_input">Input Date
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="val-tanggal_input" name="tanggal_input" placeholder="Project input date" value="{{ $project->tgl_input }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-tanggal_mulai">Start Date
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="val-tanggal_mulai" name="tanggal_mulai" placeholder="Project start date" value="{{ $project->tgl_mulai }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class=" form-group row">
                            <label class="col-lg-4 col-form-label" for="val-estimasi">Estimation
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="val-estimasi" name="estimasi" placeholder="Estimated project date" value="{{ $project->estimasi }}">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label class="col-lg-4 col-form-label" for="val-tanggal_selesai">End Date
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="val-tanggal_selesai" name="tanggal_selesai" placeholder="Project completion date" value="{{ $project->tgl_selesai }}">
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label class="col-lg-4 col-form-label" for="val-prioritas">Priority
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
                            <label class="col-lg-4 col-form-label" for="val-status">Status
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-status" name="status" required>
                                    <option value="">Select status..</option>
                                    <option value="0" {{ ($project->status == 0 ) ? 'selected' : '' }}>Inactive</option>
                                    <option value="1" {{ ($project->status == 1 ) ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ ($project->status == 2 ) ? 'selected' : '' }}>Progress</option>
                                    <option value="3" {{ ($project->status == 3 ) ? 'selected' : '' }}>Submited</option>
                                    <option value="4" {{ ($project->status == 4 ) ? 'selected' : '' }}>Approved</option>
                                    <option value="5" {{ ($project->status == 5 ) ? 'selected' : '' }}>Success</option>
                                    <option value="6" {{ ($project->status == 6 ) ? 'selected' : '' }}>Fail</option>
                                    <option value="7" {{ ($project->status == 7 ) ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-foto_hasil">Photo Result
                            </label>
                            <div class="col-lg-6">
                                <input class="form-control" type="text" id="foto_hasil" name="foto_hasil" value="{{ $project->foto_hasil }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-revisi">Total Revision <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="val-revisi" name="revisi" value="{{ $project->total_revisi }}">
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
                            <label class="col-lg-4 col-form-label" for="val-debet">Debet
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="val-debet" name="debet" value="{{ $project->debet }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-kredit">Credit
                            </label>
                            <div class="col-lg-6">
                                <input type="number" class="form-control" id="val-kredit" name="kredit" value="{{ $project->kredit }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-2 pt-4 border-top">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
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

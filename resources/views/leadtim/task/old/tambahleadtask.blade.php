@extends('layouts.app')

@section('container.isi')
@section('active_addleadtask', 'mm-active')


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Add Task</h4>
        <div>
            <a href="{{ route('lead-task-index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left pr-2"></i> Back</a>
        </div>
    </div>

    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="{{ route('lead-task-store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <input type="judul" class="form-control" id="division" name="division" value="{{ Auth::user()->UserDetail->divisi_id }}" hidden>
                            <label class="col-lg-4 col-form-label" for="val-client">Client
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-client" name="client" required>
                                    <option value="">Please select client</option>
                                    @forelse($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->nama_client }}</option>
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
                                <input type="judul" class="form-control" id="judul" name="judul" placeholder="Input project title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="detail">Project Details
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="detail" name="detail" rows="5" placeholder="Describe your project"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="estimasi">Estimation
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="date" class="form-control" id="estimasi" name="estimasi" placeholder="Estimated project date" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-prioritas">Priority
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-prioritas" name="prioritas" required>
                                    <option value="">Please select prioritas</option>
                                    <option value="0">Low</option>
                                    <option value="1">Medium</option>
                                    <option value="2">High</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-type">Type Task
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="val-type" name="type" required>
                                    <option value="Single">Single</option>
                                    <option value="Group">Group</option>
                                </select>
                            </div>
                        </div>
                        <input type="number" class="form-control" id="revisi" name="total_revisi" value="0" hidden>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" id="debet" name="debet" value="0" hidden>
                        </div>
                        <div class="col-lg-6">
                            <input type="number" class="form-control" id="kredit" name="kredit" value="0" hidden>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('scriptjs')
<script>
    $('.js-example-basic-single').select2();

</script>
@endsection
@endsection

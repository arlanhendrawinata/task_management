@extends('layouts.app')
@section('container.isi')
@section('active_task', 'mm-active')

<style>
    .tasktable .th-date {
        width: 10px !important;
    }

    .tasktable th {
        font-size: 11px !important;
        width: 10px !important;
        padding: 10px 5px !important;
        text-align: center;

    }


    .tasktable td {
        padding: 10px 4px !important;
        font-size: 11px;
        text-align: center;
    }

    .tasktable .th-target,
    .tasktable .th-result {
        width: 5px !important;
        padding: 10px 6px !important;

    }

    .box {
        background-color: green;
        width: 10px;
        height: 25px;
    }

    .card-body {
        padding: 0;
    }

    .content-body .container-fluid {
        padding-left: 20px;
        padding-right: 20px;
    }

    .infostatus {
        padding: 3px 7px;
        border-radius: 4px;
        font-size: 0.613rem;
        color: white;
        width: 90px;
        margin: 0 auto;
    }

    .info-success {
        background-color: #2bc155;
    }

    .info-info {
        background-color: #2f4cdd;
    }

    .info-danger {
        background-color: #f35757;
    }

    .wide-dialog {
        max-width: 100%;
        margin: 20px 20px;
    }

    .btn-select {
        padding: 0.525rem 1.2rem;
        font-size: 0.713rem;
    }

    .dropdown-menu {
        min-width: 0;
        padding: 0;
    }

    .dropdown-menu .dropdown-item {
        font-size: 0.713rem;
    }

    .bg-grey {
        background-color: #D2D6D9;
        color: #44494B;
    }

    .bg-teal {
        background-color: #20c997;

    }

    .bg-yellow {
        background-color: #FCE83A !important;
        color: #917217;
    }

    .bg-orange {
        background-color: #ff9900 !important;
    }

    .tasktable .td-task,
    .tasktable .td-left {
        text-align: left;
        padding-left: 10px !important;
    }

    .btn-task {
        text-decoration: blue underline;
        color: rgb(66, 103, 255);
    }

    .sharp.btn-xs {
        margin-top: 4px;
    }

</style>


<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{ $title2 }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-between mx-2">
                    <div>
                        <a href="{{ route('admin-task-index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left pr-2"></i> Back</a>
                        <!-- <a href="{{ route('admin-task-detail', ['id'=>$project->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-file pr-2"></i> Task Collection Results</a> -->
                        <!-- <a href="{{ route('admin-task-edit', ['id'=>$project->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil pr-2"></i>Edit</a> -->
                        <!-- <a href="" class="btn btn-danger btn-sm btn-delete" data-id="{{ $project->id }}" data-link="{{ route('admin-task-delete', ['id'=>$project->id]) }}"><i class="fa fa-trash pr-2"></i>Delete</a> -->
                        <!-- <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#wideModal"> Fullscreen table</a> -->
                    </div>
                </div>
                <div class=" card-body">
                    <!-- task table -->
                    <div class="table-bordered table-responsive">
                        <table class="tasktable table table-striped">
                            <thead>
                                <tr class="tre">
                                    <th>No</th>
                                    <th>Company</th>
                                    <th>Client</th>
                                    <th>Publisher</th>
                                    <th>Input</th>
                                    <th>Team</th>
                                    <th>PIC</th>
                                    <th>Task</th>
                                    <th>T</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>R</th>
                                    <th>Detail</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 3%;">{{ $project->clients->id }}</td>
                                    <td class="td-left" style="width: 8%;">{{ $project->clients->companyclients->name }}
                                    <td class="td-left" style="width: 8%;">{{ $project->clients->nama_client }}</td>
                                    <td style="width: 8%;">{{ initial($project->users->nama) }}</td>
                                    <td style="width: 6%;">
                                        @php
                                        if($project->tgl_input != null){
                                        $date_input = date("d/m/y", strtotime($project->tgl_input));
                                        echo $date_input;
                                        }
                                        @endphp</td>
                                    <td style="width: 8%;">
                                        <a href="javascript:void(0)" class="btn-addpic btn-task" data-id="{{ $project->id }}" data-url="{{ route('admin-show-pic', ['id'=>$project->id]) }}">{{ $project->divisions->nama_divisi }}</a>
                                    </td>
                                    <td class="td-left" style="width: 8%;">
                                        @foreach($pics as $pic)
                                        @if($pic->project_id == $project->id)
                                        {{ initial($pic->users->nama) . ',' }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="td-task" style="width: 20%;">{{ ucwords(strtolower($project->judul_project)) }}</td>
                                    <td style="width: 3%;">
                                        <?php
                                        $dateinput = strtotime($project->tgl_input);
                                        $dateestimasi = strtotime($project->estimasi);
                                        $secs = $dateestimasi - $dateinput;
                                        $dayestimasi = $secs / 86400;
                                        echo $dayestimasi;
                                        ?>
                                    </td>
                                    <td style="width: 5%;">
                                        @php
                                        if($project->tgl_mulai != null){
                                        $date_mulai = date("d/m/y", strtotime($project->tgl_mulai));
                                        echo $date_mulai;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 5%;">
                                        @php
                                        if($project->tgl_selesai != null){
                                        $date_selesai = date("d/m/y", strtotime($project->tgl_selesai));
                                        echo $date_selesai;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 3%;"><?php
                                                            if ($project->tgl_selesai != null) {
                                                                $dateselesai = strtotime($project->tgl_selesai);
                                                                $dateestimasi2 = strtotime($project->estimasi);
                                                                $secs = $dateestimasi2 - $dateselesai;
                                                                $dayresult = $secs / 86400;
                                                                echo $dayresult;
                                                            } else {
                                                                echo "-";
                                                            }
                                                            ?></td>
                                    <td class="td-left" style="width: 20%;">
                                        {{ $project->detail_project }}
                                    </td>
                                    <td>
                                        @if($project->type == "Group")
                                        Group
                                        @elseif($project->type == "Single")
                                        Single
                                        @elseif($project->type == "Sub1")
                                        S 1
                                        @elseif($project->type == "Sub2")
                                        S 2
                                        @endif
                                    </td>
                                    <td class="td-status" style="width: 10%;">
                                        @if($project->status == 1)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambahstartParentModal">
                                            @endif
                                            <div class="infostatus bg-<?php
                                                                        if ($project->status == 1) {
                                                                            echo 'info';
                                                                        } elseif ($project->status == 2) {
                                                                            echo 'yellow';
                                                                        } elseif ($project->status == 3) {
                                                                            echo 'orange';
                                                                        } elseif ($project->status == 4) {
                                                                            echo 'teal';
                                                                        } elseif ($project->status == 5) {
                                                                            echo 'success';
                                                                        } elseif ($project->status == 6) {
                                                                            echo 'danger';
                                                                        } elseif ($project->status == 7) {
                                                                            echo 'red';
                                                                        } elseif ($project->status == 0) {
                                                                            echo 'grey';
                                                                        }
                                                                        ?>">
                                                <?php
                                                if ($project->status == 1) {
                                                    echo 'Active';
                                                } elseif ($project->status == 2) {
                                                    echo 'Progress';
                                                } elseif ($project->status == 3) {
                                                    echo 'Submited';
                                                } elseif ($project->status == 4) {
                                                    echo 'Approved';
                                                } elseif ($project->status == 5) {
                                                    echo 'Success';
                                                } elseif ($project->status == 6) {
                                                    echo 'Fail';
                                                } elseif ($project->status == 7) {
                                                    echo 'Cancelled';
                                                } elseif ($project->status == 0) {
                                                    echo 'Inactive';
                                                }
                                                ?>
                                            </div>
                                            @if($project->status == 1)
                                        </a>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="flex align-items-center">
                                            @if($project->status == 4)
                                            <a href="javascript:void(0)" class="btn btn-success btn-verif btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Verification" data-id="{{ $project->id }}" data-link="{{ route('admin-verifikasi-task', ['id'=>$project->id]) }}"><i class="fa fa-check"></i></a>
                                            @endif
                                            <a href="javascript:void(0)" class="btn-revisi btn btn-danger btn-xs sharp mr-1" data-bs-toggle="modal" data-bs-target="#revisiModal"><i class="fa fa-reply"></i>
                                                Revision ({{ $project->total_revisi }})</a>
                                            <a href="{{ route('admin-task-detail', ['id'=>$project->id]) }}" class="btn btn-primary btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Assignment"><i class="fa fa-file"></i></a>
                                            <a href="{{ route('admin-task-edit', ['id'=>$project->id]) }}" class="btn btn-warning btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-delete btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Delete" data-id="{{ $project->id }}" data-link="{{ route('admin-task-delete', ['id'=>$project->id]) }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($project->type == "Group" || $project->type == "Sub1")
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col">
            <div class="welcome-text">
                <h4>{{ $title3 }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-between mx-2">
                    <div>
                        @if($project->type == "Group")
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSubtaskModal"><i class="fa fa-plus-circle "></i> Add subtask</a>
                        @elseif($project->type == "Sub1")
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addSub2_taskModal"><i class="fa fa-plus-circle "></i> Add subtask</a>
                        @endif
                    </div>
                </div>
                <div class=" card-body">
                    <!-- task table -->
                    @if($countsubprojects > 0)
                    <div class="table-bordered table-responsive">
                        <table class="tasktable table table-striped">
                            <thead>
                                <tr class="tre">
                                    <th>No</th>
                                    <th>Company</th>
                                    <th>Client</th>
                                    <th>Publisher</th>
                                    <th>Input</th>
                                    <th>Team</th>
                                    <th>PIC</th>
                                    <th>Task</th>
                                    <th>T</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>R</th>
                                    <th>Detail</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subprojects as $subproject)
                                <tr>
                                    <td style="width: 3%;">{{ $subproject->clients->id }}</td>
                                    <td class="td-left" style="width: 8%;">{{ $subproject->clients->companyclients->name }}
                                    <td class="td-left" style="width: 8%;">{{ $subproject->clients->nama_client }}</td>
                                    <td style="width: 7%;">{{ initial($subproject->users->nama) }}</td>
                                    <td style="width: 8%;">
                                        @php
                                        if($subproject->tgl_input != null){
                                        $date_input = date("d/m/y", strtotime($subproject->tgl_input));
                                        echo $date_input;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 7%;">
                                        <a href="javascript:void(0)" class="btn-addpic btn-task" data-id="{{ $subproject->id }}" data-url="{{ route('admin-show-pic', ['id'=>$subproject->id]) }}">{{ $subproject->divisions->nama_divisi }}</a>
                                    </td>
                                    <td class="td-left" style="width: 8%;">
                                        @foreach($pics as $pic)
                                        @if($pic->project_id == $subproject->id)
                                        {{ initial($pic->users->nama) }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td class="td-task" style="width: 20%;">
                                        {{ ucwords(strtolower($subproject->judul_project)) }}
                                    </td>
                                    <td style="width: 3%;">
                                        <?php
                                        $dateinput = strtotime($subproject->tgl_input);
                                        $dateestimasi = strtotime($subproject->estimasi);
                                        $secs = $dateestimasi - $dateinput;
                                        $dayestimasi = $secs / 86400;
                                        echo $dayestimasi;
                                        ?>
                                    </td>
                                    <td style="width: 5%;">
                                        @php
                                        if($subproject->tgl_mulai != null){
                                        $date_mulai = date("d/m/y", strtotime($subproject->tgl_mulai));
                                        echo $date_mulai;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 5%;">
                                        @php
                                        if($subproject->tgl_selesai != null){
                                        $date_selesai = date("d/m/y", strtotime($subproject->tgl_selesai));
                                        echo $date_selesai;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 3%;"><?php
                                                            if ($subproject->tgl_selesai != null) {
                                                                $dateselesai = strtotime($subproject->tgl_selesai);
                                                                $dateestimasi2 = strtotime($subproject->estimasi);
                                                                $secs = $dateestimasi2 - $dateselesai;
                                                                $dayresult = $secs / 86400;
                                                                echo $dayresult;
                                                            } else {
                                                                echo "-";
                                                            }
                                                            ?></td>
                                    <td class="td-left" style="width: 20%;">
                                        {{ $subproject->detail_project }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-task-single', ['id'=>$subproject->id]) }}" class="btn-task">
                                            @if($subproject->type == "Sub1")
                                            S 1
                                            @elseif($subproject->type == "Sub2")
                                            S 2
                                            @endif
                                        </a>
                                    </td>
                                    <td class="td-status" style="width: 10%;">
                                        @if($subproject->status == 1)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambahstartSubModal{{ $subproject->id }}">
                                            @endif
                                            <div class="infostatus bg-<?php
                                                                        if ($subproject->status == 1) {
                                                                            echo 'info';
                                                                        } elseif ($subproject->status == 2) {
                                                                            echo 'yellow';
                                                                        } elseif ($subproject->status == 3) {
                                                                            echo 'orange';
                                                                        } elseif ($subproject->status == 4) {
                                                                            echo 'teal';
                                                                        } elseif ($subproject->status == 5) {
                                                                            echo 'success';
                                                                        } elseif ($subproject->status == 6) {
                                                                            echo 'danger';
                                                                        } elseif ($subproject->status == 7) {
                                                                            echo 'red';
                                                                        } elseif ($subproject->status == 0) {
                                                                            echo 'grey';
                                                                        }
                                                                        ?>">
                                                <?php
                                                if ($subproject->status == 1) {
                                                    echo 'Active';
                                                } elseif ($subproject->status == 2) {
                                                    echo 'Progress';
                                                } elseif ($subproject->status == 3) {
                                                    echo 'Submited';
                                                } elseif ($subproject->status == 4) {
                                                    echo 'Approved';
                                                } elseif ($subproject->status == 5) {
                                                    echo 'Success';
                                                } elseif ($subproject->status == 6) {
                                                    echo 'Fail';
                                                } elseif ($subproject->status == 7) {
                                                    echo 'Cancelled';
                                                } elseif ($subproject->status == 0) {
                                                    echo 'Inactive';
                                                }
                                                ?>
                                            </div>
                                            @if($subproject->status == 1)
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex align-items-center">
                                            @if($subproject->status == 4)
                                            <a href="javascript:void(0)" class="btn btn-success btn-verif btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Verification" data-id="{{ $subproject->id }}" data-link="{{ route('admin-verifikasi-task', ['id'=>$subproject->id]) }}"><i class="fa fa-check"></i></a>
                                            @endif
                                            <a href="{{ route('admin-task-detail', ['id'=>$subproject->id]) }}" class="btn btn-primary btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Assignment"><i class="fa fa-file"></i></a>
                                            <a href="{{ route('admin-task-edit', ['id'=>$subproject->id]) }}" class="btn btn-warning btn-xs sharp mr-1"><i class="fa fa-pencil" style="cursor: pointer;" data-bs-toggle="tooltip" title="Edit"></i></a>
                                            <a href="" class="btn btn-danger btn-delete btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Delete" data-id="{{ $subproject->id }}" data-link="{{ route('admin-task-delete', ['id'=>$subproject->id]) }}"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td>No Datas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if($project->type == "Group")
<!-- Add Sub 1 Task Modal -->
<div class="modal fade" id="addSubtaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Sub 1 Task</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form class="container my-4" action="{{ route('subtask-store') }}" method="post">
                @csrf
                <input type="number" class="form-control" id="val-projectid" name="project_id" value="{{ $project->id }}" hidden>
                <input type="number" class="form-control" id="val-client" name="client" value="{{ $project->client_id }}" hidden>
                <input type="number" class="form-control" id="val-userid" name="userid" value="{{ $project->user_id }}" hidden>
                <input type="number" class="form-control" id="val-userid" name="company" value="{{ $project->perusahaan_id }}" hidden>
                <div class="row mb-4">
                    <div class="col mx-4">
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-division">Team
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <select class="form-control" id="val-division" name="division" required>
                                    <option value="">Please select team</option>
                                    @forelse($divisions as $division)
                                    <option value="{{ $division->id }}" {{ ($division->id == $project->divisi_id) ? 'selected' : '' }}>{{ $division->nama_divisi }}</option>
                                    @empty
                                    <option value="">No Datas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-judul_project">Subtask Title
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <input type="text" class="form-control" id="val-judul_project" name="judul_project" placeholder="Input title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-detail_project">Subtask Detail<span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <textarea class="form-control" id="val-detail_project" name="detail_project" rows="5" placeholder="Input subtask detail" required></textarea>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label class="col-lg-4">Estimation
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <input type="date" class="form-control" id="val-estimasi" name="estimasi" placeholder="Estimated project date" value="{{ $project->estimasi }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-prioritas">Priority
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <select class="form-control" id="val-prioritas" name="prioritas" required>
                                    <option value="">Please select priority</option>
                                    <option value="0" {{ ($project->prioritas == 0 ) ? 'selected' : '' }}>Low</option>
                                    <option value="1" {{ ($project->prioritas == 1 ) ? 'selected' : '' }}>Medium</option>
                                    <option value="2" {{ ($project->prioritas == 2 ) ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-type">Task Type
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control" id="val-type" name="type" required>
                                    <option value="Sub1" selected>S 1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-2 pt-4 border-top">
                    <button type="submit" class="btn btn-primary">Add Subtask</button>
                </div>
            </form>
        </div>
    </div>
</div>
@elseif($project->type == "Sub1")

<!-- Add Sub 2 Task Modal -->
<div class="modal fade" id="addSub2_taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Sub 2 Task</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form class="container my-4" action="{{ route('subtask-store') }}" method="post">
                @csrf
                <input type="number" class="form-control" id="val-projectid" name="project_id" value="{{ $project->id }}" hidden>
                <input type="number" class="form-control" id="val-client" name="client" value="{{ $project->client_id }}" hidden>
                <input type="number" class="form-control" id="val-userid" name="userid" value="{{ $project->user_id }}" hidden>
                <input type="number" class="form-control" id="val-userid" name="company" value="{{ $project->perusahaan_id }}" hidden>
                <div class="row mb-4">
                    <div class="col mx-4">
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-division">Team
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <select class="form-control" id="val-division" name="division" required>
                                    <option value="">Please select team</option>
                                    @forelse($divisions as $division)
                                    <option value="{{ $division->id }}" {{ ($division->id == $project->divisi_id) ? 'selected' : '' }}>{{ $division->nama_divisi }}</option>
                                    @empty
                                    <option value="">No Datas</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-judul_project">Subtask Title
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <input type="text" class="form-control" id="val-judul_project" name="judul_project" placeholder="Input title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-detail_project">Subtask Detail<span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <textarea class="form-control" id="val-detail_project" name="detail_project" rows="5" placeholder="Input subtask detail" required></textarea>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label class="col-lg-4">Estimation
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <input type="date" class="form-control" id="val-estimasi" name="estimasi" placeholder="Estimated project date" value="{{ $project->estimasi }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4" for="val-prioritas">Priority
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col">
                                <select class="form-control" id="val-prioritas" name="prioritas" required>
                                    <option value="">Please select priority</option>
                                    <option value="0" {{ ($project->prioritas == 0 ) ? 'selected' : '' }}>Low</option>
                                    <option value="1" {{ ($project->prioritas == 1 ) ? 'selected' : '' }}>Medium</option>
                                    <option value="2" {{ ($project->prioritas == 2 ) ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-type">Task Type
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control" id="val-type" name="type" required>
                                    <option value="Sub2" selected>S 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-2 pt-4 border-top">
                    <button type="submit" class="btn btn-primary">Add Subtask</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif



<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this task?
            </div>
            <div class="modal-footer modal-footer-delete">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete modal -->

<!-- verifikasi modal -->
<div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Succession</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                Are you sure to succession this task?
            </div>
            <div class="modal-footer modal-footer-verif">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end verif modal -->

<!-- revisi Modal -->
<div class="modal fade" id="revisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Revision Task</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('admin-revisi-task') }}" method="post">
                @method('put')
                @csrf
                <input type="number" name="id" value="{{ $project->id }}" hidden>
                <input type="number" name="total_revisi" value="{{ $project->total_revisi }}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label class="col-form-label" for="val-laporan">Report <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="val-laporan" name="laporan" rows="5" placeholder="Laporan..">{{ $project->laporan_project }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Revisi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Parent Task Start Date -->
<div class="modal fade" id="tambahstartParentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Start Date</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('admin-startdate') }}" method="post">
                @method('put')
                @csrf
                <input type="text" name="project_id" value="{{$project->id}}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <!--<div class="form-group row">-->
                        <label class="col-lg-4 col-form-label" for="tgl_mulai">Start Date
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Project start date">
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnaddstartdate">Start</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($countsubprojects > 0)
@foreach($subprojects as $subproject)
<!-- Modal Sub Task Start Date -->
<div class="modal fade" id="tambahstartSubModal{{ $subproject->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Start Date</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('admin-startdate') }}" method="post">
                @method('put')
                @csrf
                <input type="text" name="project_id" value="{{$subproject->id}}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <!--<div class="form-group row">-->
                        <label class="col-lg-4 col-form-label" for="tgl_mulai">Start Date
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Project start date">
                        </div>
                        <!--</div>-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnaddstartdate">Start</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif

<!-- Tambah pic modal -->
<div class="modal fade" id="tambahPICModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add PIC</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="picModalForm">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptjs')
<script>
    $(document).on('click', '.btn-addpic', function(event) {
        event.preventDefault();
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        $('#detailModal').modal('hide');
        $('#tambahPICModal').modal('show');
        $.ajax({
            type: "GET"
            , url: url
            , success: function(response) {
                $('.picModalForm').html('');
                $('.picModalForm').html(response);
            }
        });
    });

</script>
@endsection

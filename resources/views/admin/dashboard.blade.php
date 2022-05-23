@extends('layouts.app')

@section('container.isi')
@section('active_dash', 'mm-active')


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

    .tasktable .th-date {
        padding: 10px 3px !important;
        width: 100px;

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

    .tasktable .td-left {
        text-align: left;
        padding-left: 10px !important;
    }

    .btn-detail2:hover {
        color: #7e7e7e;
    }

    .btn-status {
        background: transparent;
        border: none;
    }

    .btn-status i {
        color: white;
        font-size: 30px;
    }

    .btn-status:hover {
        transform: scale(1.2);
        transition: transform .2s;
    }

    .widget-stat .media>span {
        width: 60px;
        height: 60px;
        min-width: 60px;
    }

    .widget-stat .media .media-body p {
        font-size: 11px;
        font-weight: 400;
    }

    .btn-task {
        padding: 3px 3px;
        border-radius: 4px;
        font-size: 0.713rem;
        color: white;
        width: 90px;
        margin: 0 auto;
    }

    .btn-task {
        text-decoration: blue underline;
        color: rgb(66, 103, 255);
    }

    .select2-container--default .select2-selection--single {
        width: 160px;
        border: 1px solid #d7dae3;
        border-radius: 0.75rem;
    }
</style>

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, {{ Auth::user()->nama }}!</h4>
                <span>Welcome to {{ $title }}</span>
            </div>
        </div>
    </div>

    <div class="row row-cols-6">
        <div class="col">
            <div class="widget-stat card bg-info">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('task-status-search')}}" method="GET">
                                <input type="number" value="1" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-folder-6"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Active</p>
                            <h3 class="text-white">{{ $countActive }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="widget-stat card bg-warning">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('task-status-search') }}" method="GET">
                                <input type="number" value="2" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-repeat-1"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Progress</p>
                            <h3 class="text-white">{{ $countProcess }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="widget-stat card bg-orange">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('task-status-search') }}" method="GET">
                                <input type="number" value="3" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-folder-3"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Submited</p>
                            <h3 class="text-white">{{ $countSubmit }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="widget-stat card bg-teal">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('task-status-search') }}" method="GET">
                                <input type="number" value="4" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-stopwatch"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Approved</p>
                            <h3 class="text-white">{{ $countVerif }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="widget-stat card bg-success">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('task-status-search') }}" method="GET">
                                <input type="number" value="5" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-success"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Success</p>
                            <h3 class="text-white">{{ $countSuccess }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="widget-stat card bg-danger">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('task-status-search') }}" method="GET">
                                <input type="number" value="6" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-warning-1"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Cancelled</p>
                            <h3 class="text-white">{{ $countCancle }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header border-0">
                    <div>
                        <h4 class="card-title mb-2">{{ $tableTitle }}</h4>
                    </div>
                    <div class="search-dd">
                        <div class="search-type mx-2">
                            <select class="js-example-basic-single select-type" id="val-type" name="type">
                                <option value="" disabled selected>Search type..</option>
                                <option value="Group" {{ ($name=="type" && $val=="Group" ) ? 'selected' : '' }}>Group
                                </option>
                                <option value="Single" {{ ($name=="type" && $val=="Single" ) ? 'selected' : '' }}>Single
                                </option>
                            </select>
                        </div>
                        <div class="search-prioritas mx-2">
                            <select class="js-example-basic-single select-priority" id="val-prioritas" name="prioritas">
                                <option value="" disabled selected>Search priority..</option>
                                <option value="0" {{ ($name=="prioritas" && $val==0 ) ? 'selected' : '' }}>Low</option>
                                <option value="1" {{ ($name=="prioritas" && $val==1 ) ? 'selected' : '' }}>Medium
                                </option>
                                <option value="2" {{ ($name=="prioritas" && $val==2 ) ? 'selected' : '' }}>High</option>
                            </select>
                        </div>
                        <div class="search-status mx-2">
                            <select class="js-example-basic-single select-status" id="val-status" name="status">
                                <option value="" disabled selected>Search status..</option>
                                <option value="0" {{ ($name=="status" && $val==0 ) ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="1" {{ ($name=="status" && $val==1 ) ? 'selected' : '' }}>Active
                                </option>
                                <option value="2" {{ ($name=="status" && $val==2 ) ? 'selected' : '' }}>Progress
                                </option>
                                <option value="3" {{ ($name=="status" && $val==3 ) ? 'selected' : '' }}>Submited
                                </option>
                                <option value="4" {{ ($name=="status" && $val==4 ) ? 'selected' : '' }}>Approved
                                </option>
                                <option value="5" {{ ($name=="status" && $val==5 ) ? 'selected' : '' }}>Success
                                </option>
                                <option value="6" {{ ($name=="status" && $val==6 ) ? 'selected' : '' }}>Fail
                                </option>
                                <option value="7" {{ ($name=="status" && $val==7 ) ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                        <div class="search-status mx-2">
                            <select class="js-example-basic-single select-divisi" id="val-division" name="division">
                                <option value="" disabled selected>Search team</option>
                                @forelse($divisions as $divisi)
                                <option value="{{ $divisi->id }}" {{ ($name=="divisi_id" && $val==$divisi->id) ? "selected" : "" }}>{{ $divisi->nama_divisi }}</option>
                                @empty
                                <option value="">No Datas</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="d-flex">
                        @if($currentUrl == "search")
                        <div><a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-back "></i> Back</a></div>
                        @else
                        <div class="ml-2">
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fa fa-filter mr-2"></i>Filter</a>
                        </div>
                        @endif
                    </div>

                </div>
                <div class="card-body">
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
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($projects as $key=>$item)
                                <tr>
                                    <td class="td-s3 td-cstm">{{ $key + $projects->firstItem() }}</td>
                                    <td class="td-left td-s8 td-cstm">{{ $item->clients->companyclients->name }}
                                    <td class="td-left td-s8 td-cstm">{{ $item->clients->nama_client }}</td>
                                    <td class="td-s8">{{ initial($item->users->nama) }}
                                    </td>
                                    <td class="td-s8 td-cstm">
                                        @php
                                        if($item->tgl_input != null){
                                        $date_input = date("d/m/y", strtotime($item->tgl_input));
                                        echo $date_input;
                                        }
                                        @endphp
                                    </td>
                                    <td class="td-s7 td-cstm"><a href="javascript:void(0)" class="btn-addpic btn-task" data-id="{{ $item->id }}" data-url="{{ route('admin-show-pic', ['id'=>$item->id]) }}">{{ $item->divisions->nama_divisi }}</a></td>
                                    <td class="td-left td-s8 td-cstm">
                                        <!--<a href="javascript:void(0)" class="btn-addpic" data-id="{{ $item->id }}" data-url="{{ route('admin-show-pic', ['id'=>$item->id]) }}"><button class="btn-task btn-primary">PIC</button></a><br>-->
                                        @foreach($pics as $pic)
                                        @if($pic->project_id == $item->id)
                                        {{ initial($pic->users->nama) . ','}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <!-- <td class="td-task"><a class="btn-detail" data-bs-toggle="tooltip" title="Klik untuk lihat detail project" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}" data-attr="{{ route('admin-task-show', $item->id) }}">
                       $item->judul_project 
                    </a></td>
                  <td class="td-s3"> -->
                                    <td class="td-s10 td-cstm">
                                        <a href="{{ route('admin-task-single', $item->id) }}" class="btn-task">{{ ucwords(strtolower($item->judul_project)) }}</a>
                                    </td>
                                    <td class="td-s3 td-cstm">
                                        <?php
                                        $dateinput = strtotime($item->tgl_input);
                                        $dateestimasi = strtotime($item->estimasi);
                                        $secs = $dateestimasi - $dateinput;
                                        $dayestimasi = $secs / 86400;
                                        echo $dayestimasi;
                                        ?>
                                    </td>
                                    <td class="td-s5 td-cstm">
                                        @php
                                        if($item->tgl_mulai != null){
                                        $date_mulai = date("d/m/y", strtotime($item->tgl_mulai));
                                        echo $date_mulai;
                                        }
                                        @endphp
                                    </td>
                                    <td class="td-s5 td-cstm">
                                        @php
                                        if($item->tgl_selesai != null){
                                        $date_selesai = date("d/m/y", strtotime($item->tgl_selesai));
                                        echo $date_selesai;
                                        }
                                        @endphp
                                    </td>
                                    <td class="td-s3 td-cstm">
                                        <?php
                                        if ($item->tgl_selesai != null) {
                                            $dateselesai = strtotime($item->tgl_selesai);
                                            $dateestimasi2 = strtotime($item->estimasi);
                                            $secs = $dateestimasi2 - $dateselesai;
                                            $dayresult = $secs / 86400;
                                            echo $dayresult;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td class="td-left td-cstm">
                                        {{ Str::limit($item->detail_project, 50) }}
                                    </td>
                                    <td class="td-s5 td-cstm">
                                        @if($item->type == "Sub1")
                                        <a class="btn-task" href="{{ route('admin-task-single', \App\Models\Project::where('id', $item->id)->first()->project_id) }}">
                                            S 1
                                        </a>
                                        @elseif($item->type == "Sub2")
                                        <a class="btn-task" href="{{ route('admin-task-single', \App\Models\Project::where('id', $item->id)->first()->project_id_2) }}">
                                            S 2
                                        </a>
                                        @else
                                        {{ $item->type }}
                                        @endif
                                    </td>
                                    <td class="td-status td-cstm" style="width: 10%;">
                                        @if($item->status == 1)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambahstartModal{{$item->id}}">
                                            @endif
                                            <div class="infostatus bg-<?php
                                                                        if ($item->status == 1) {
                                                                            echo 'info';
                                                                        } elseif ($item->status == 2) {
                                                                            echo 'yellow';
                                                                        } elseif ($item->status == 3) {
                                                                            echo 'orange';
                                                                        } elseif ($item->status == 4) {
                                                                            echo 'teal';
                                                                        } elseif ($item->status == 5) {
                                                                            echo 'success';
                                                                        } elseif ($item->status == 6) {
                                                                            echo 'danger';
                                                                        } elseif ($item->status == 7) {
                                                                            echo 'red';
                                                                        } elseif ($item->status == 0) {
                                                                            echo 'grey';
                                                                        }
                                                                        ?>">
                                                <?php
                                                if ($item->status == 1) {
                                                    echo 'Active';
                                                } elseif ($item->status == 2) {
                                                    echo 'Progress';
                                                } elseif ($item->status == 3) {
                                                    echo 'Submited';
                                                } elseif ($item->status == 4) {
                                                    echo 'Approved';
                                                } elseif ($item->status == 5) {
                                                    echo 'Success';
                                                } elseif ($item->status == 6) {
                                                    echo 'Fail';
                                                } elseif ($item->status == 7) {
                                                    echo 'Cancelled';
                                                } elseif ($item->status == 0) {
                                                    echo 'Inactive';
                                                }
                                                ?>
                                            </div>
                                    </td>
                                    @if($item->status == 1)
                                    </a>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td>No Datas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mx-4 mt-4">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Start Date -->
@foreach($projects as $item)
<div class="modal fade" id="tambahstartModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Start Date</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('dash-start-date') }}" method="post">
                @method('put')
                @csrf
                <input type="text" name="project_id" value="{{$item -> id}}" hidden>
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

<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this data?
            </div>
            <div class="modal-footer modal-footer-delete">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete modal -->


<!-- Filter Modal -->
<form action="{{ route('admin-search') }}" method="get">
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Filter Task</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column">
                        <div class="filter-date d-flex flex-column align-items-start ">
                            <h5 class="border-bottom mb-3 pb-3 w-100">By date</h5>
                            <div class="d-flex align-items-center">
                                <label class="" for="val-from_date">From date :</label>
                                <div class="col">
                                    <input type="date" class="form-control" id="val-from_date" value="" name="from_date">
                                </div>
                                <label class="" for="val-to_date">To date :</label>
                                <div class="col">
                                    <input type="date" class="form-control" id="val-to_date" value="" name="to_date">
                                </div>
                            </div>
                        </div>
                        <div class="filter-client mt-5">
                            <h5 class="border-bottom mb-3 pb-3">By client</h5>
                            <div class="d-flex align-items-center">
                                <label class="col-form-label" for="val-client">Client :
                                </label>
                                <div class="col-lg-6">
                                    <select class="tom-select-client" id="val-clients" name="client">
                                        <option value="">Please select client</option>
                                        @forelse($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->nama_client }}</option>
                                        @empty
                                        <option value="">No Datas</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="filter-division mt-5">
                            <h5 class="border-bottom mb-3 pb-3">By team</h5>
                            <div class="d-flex align-items-center">
                                <label class="col-form-label" for="val-division">Team :
                                </label>
                                <div class="col-lg-6">
                                    <select class="tom-select-division" id="val-divisions" name="division">
                                        <option value="">Please select team</option>
                                        @forelse($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->nama_divisi }}
                                        </option>
                                        @empty
                                        <option value="">No Datas</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search mr-2"></i>Filter</button>
                </div>
            </div>
        </div>
    </div>
</form>

@section('scriptjs')
<script>
    $('.js-example-basic-single').select2();

    $(".select-type").change(function() {
        let selectVal = $(this).val();
        let url = "/dashboard/search/type/" + selectVal;
        window.location.href = url;
    });
    $(".select-priority").change(function() {
        let selectVal = $(this).val();
        let url = "/dashboard/search/prioritas/" + selectVal;
        window.location.href = url;
    });
    $(".select-status").change(function() {
        let selectVal = $(this).val();
        let url = "/dashboard/search/status/" + selectVal;
        window.location.href = url;
    });
    $(".select-divisi").change(function() {
        let selectVal = $(this).val();
        let url = "/dashboard/search/divisi_id/" + selectVal;
        window.location.href = url;
    });
</script>
<script>
    $(document).on('click', '.btn-addpic', function(event) {
        event.preventDefault();
        let id = $(this).attr('data-id');
        let url = $(this).attr('data-url');
        $('#detailModal').modal('hide');
        $('#tambahPICModal').modal('show');
        $.ajax({
            type: "GET",
            url: url,
            success: function(response) {
                $('.picModalForm').html('');
                $('.picModalForm').html(response);
            }
        });
    });
</script>
@endsection

@endsection
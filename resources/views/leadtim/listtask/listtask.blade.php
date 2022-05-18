@extends('layouts.app')
@section('container.isi')
@section('active_listtask', 'mm-active')

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

    .btn-status {
        background: transparent;
        border: none;
    }

    .btn-status i {
        color: white;
    }

    .btn-status:hover {
        transform: scale(1.2);
        transition: transform .2s;
    }

    .btn-detail-listtask:hover {
        color: #7e7e7e;
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

    .text-left {
        text-align: left;
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
        <!--<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">-->
        <!--    <ol class="breadcrumb">-->
        <!--        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>-->
        <!--        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>-->
        <!--    </ol>-->
        <!--</div>-->
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-info">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('user-dashlist-search') }}" method="GET">
                                <input type="number" value="1" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-file-1"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1"> Active Task</p>
                            <h3 class="text-white">{{ $countMyActive }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-warning">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('user-dashlist-search') }}" method="GET">
                                <input type="number" value="2" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-repeat-1"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1"> Progress Task</p>
                            <h3 class="text-white">{{ $countMyProses }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-orange">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('user-dashlist-search') }}" method="GET">
                                <input type="number" value="3" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-stopwatch"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1"> Submited Task</p>
                            <h3 class="text-white">{{ $countMySubmit }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-success">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('user-dashlist-search') }}" method="GET">
                                <input type="number" value="4" hidden name="status">
                                <button class="btn-status" type="submit">
                                    <i class="flaticon-381-success"></i>
                                </button>
                            </form>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1"> Success Task</p>
                            <h3 class="text-white">{{ $countMySuccess }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-success">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <form action="{{ route('dashlead-search') }}" method="GET">
        <input type="number" value="5" hidden name="status">
        <button class="btn-status" type="submit">
            <i class="flaticon-381-success"></i>
        </button>
        </form>
        </span>
        <div class="media-body text-white text-right">
            <p class="mb-1">Task Success</p>
            <h3 class="text-white">{{ $countSuccess}}</h3>
        </div>
    </div>
</div>
</div>
</div> --}}
</div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between mx-2">
                <div>
                    <a href="" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#wideModal"> Fullscreen table</a>
                </div>
                <!-- tempat searchdate -->
                <div class="d-flex">
                    @php
                    $url = url()->current();
                    $parse = parse_url($url);
                    @endphp

                    @if(url()->current() == 'https://'.$parse["host"].$linkback)
                    <div><a href="{{ route('user-list-task') }}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-back "></i> Back</a></div>
                    @endif

                    @if(url()->current() == 'https://'.$parse["host"].'/user/listtask')
                    <div class="ml-2">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fa fa-filter mr-2"></i>Filter</a>
                    </div>
                    @endif

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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($listtask as $key=>$item)
                            <tr>
                                <td style="width: 3%;">{{ $key + $listtask->firstItem() }}</td>
                                <td class="text-left">{{ $item->clients->companyclients->name }}</td>
                                <td class="text-left">{{ $item->clients->nama_client }}</td>
                                <td class="text-left" style="width: 7%;">{{ initial($item->users->nama) }}</td>
                                <td style="width: 5%;">
                                    @php
                                    if($item->tgl_input != null){
                                    $date_input = date("d/m/y", strtotime($item->tgl_input));
                                    echo $date_input;
                                    }
                                    @endphp
                                </td>
                                <td class="text-left" style="width: 8%;">{{ $item->divisions->nama_divisi }}</td>
                                <td class="text-left" style="width: 8%;">
                                    @foreach($pics as $pic)
                                    @if($pic->project_id == $item->id)
                                    {{ initial($pic->users->nama). ','}}
                                    @endif
                                    @endforeach
                                </td>
                                <td style="width: 10%;"><a href="" class="btn-detail btn-task" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}" data-attr="{{ route('user-task-show', $item->id) }}">
                                        {{ ucwords(strtolower($item->judul_project)) }}</a></td>

                                <td style="width: 3%;">
                                    <?php
                                    $dateinput = strtotime($item->tgl_input);
                                    $dateestimasi = strtotime($item->estimasi);
                                    $secs = $dateestimasi - $dateinput; // == return sec in difference
                                    $dayestimasi = $secs / 86400;
                                    echo $dayestimasi;
                                    ?>
                                </td>
                                <td style="width: 5%;">@php
                                    if($item->tgl_mulai != null){
                                    $date_mulai = date("d/m/y", strtotime($item->tgl_mulai));
                                    echo $date_mulai;
                                    }
                                    @endphp</td>
                                <td style="width: 5%;"> @php
                                    if($item->tgl_selesai != null){
                                    $date_selesai = date("d/m/y", strtotime($item->tgl_selesai));
                                    echo $date_selesai;
                                    }
                                    @endphp</td>
                                <td style="width: 3%;"><?php
                                                        if ($item->tgl_selesai != null) {
                                                            $dateselesai = strtotime($item->tgl_selesai);
                                                            $dateestimasi2 = strtotime($item->estimasi);
                                                            $secs = $dateestimasi2 - $dateselesai;
                                                            $dayresult = $secs / 86400;
                                                            echo $dayresult;
                                                        } else {
                                                            echo "-";
                                                        } ?>
                                </td>
                                <td class="td-left">
                                    {{ Str::limit($item->detail_project, 50) }}
                                </td>
                                <td style="width: 5%;">{{ $item->type }}</td>
                                <td class="td-status" style="width: 10%;">
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
                                        @if($item->status == 1)
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td>No Datas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mx-4 mt-4">
                        {{ $listtask->links() }}
                    </div>
                </div>


                <!-- detail Modal -->
                <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="exampleModalLabel">Task details</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body" id="detailBody">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end detail modal -->

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

                <!-- Search Modal -->
                <form action="{{ route('user-search-date') }}" method="get">
                    <!-- @csrf -->
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
                                                    <select class="form-control" id="val-client" name="client">
                                                        <option value="">Please select client</option>
                                                        @forelse($aprojects as $item)
                                                        <option value="{{ $item->client_id }}">{{ $item->clients->nama_client }}</option>
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

                <!-- Wide Modal -->
                <div class="modal fade" id="wideModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog wide-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h5 class="modal-title" id="exampleModalLabel">Task Table</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-bordered table-responsive">
                                    <table class="tasktable table table-striped">
                                        <thead>
                                            <tr class="tre">
                                                <th>No</th>
                                                <th>Client</th>
                                                <th>Company</th>
                                                <th>Publisher</th>
                                                <th>Input</th>
                                                <th>Team</th>
                                                <th>PIC</th>
                                                <th>Project</th>
                                                <th class="th-target">T</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>R</th>
                                                <th>Type</th>
                                                <th class="th-status">Status</th>
                                                @for($i = 1; $i <= 31; $i++) <th class="th-date">{{ $i }}</th> @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($listtask as $key=>$item)
                                            <tr>
                                                <td style="width: 3%;">{{ $key + $listtask->firstItem() }}</td>
                                                <td class="text-left">{{ $item->clients->nama_client }}</td>
                                                <td class="text-left">{{ $item->clients->companyclients->name }}</td>
                                                <td class="text-left" style="width: 7%;">{{ $item->users->nama }}</td>
                                                <td style="width: 5%;">
                                                    @php
                                                    if($item->tgl_input != null){
                                                    $date_input = date("d/m/y", strtotime($item->tgl_input));
                                                    echo $date_input;
                                                    }
                                                    @endphp
                                                </td>
                                                <td>{{ $item->divisions->nama_divisi }}</td>
                                                <td>@foreach($pics as $pic)
                                                    @if($pic->project_id == $item->id)
                                                    {{ $pic->users->nama}}
                                                    @endif
                                                    @endforeach
                                                </td>
                                                <td class="td-task" style="width: 15%;">{{ ucwords(strtolower($item->judul_project)) }}</td>
                                                <td>
                                                    <?php
                                        $dateinput = strtotime($item->tgl_input);
                                        $dateestimasi = strtotime($item->estimasi);
                                        $secs = $dateestimasi - $dateinput; // == return sec in difference
                                        $dayestimasi = $secs / 86400;
                                        echo $dayestimasi;
                                    ?>
                                                </td>
                                                <td style="width: 5%;">
                                                    @php
                                                    if($item->tgl_mulai != null){
                                                    $date_mulai = date("d/m/y", strtotime($item->tgl_mulai));
                                                    echo $date_mulai;
                                                    }
                                                    @endphp
                                                </td>
                                                <td style="width: 5%;">
                                                    @php
                                                    if($item->tgl_selesai != null){
                                                    $date_mulai = date("d/m/y", strtotime($item->tgl_selesai));
                                                    echo $date_mulai;
                                                    }
                                                    @endphp
                                                </td>
                                                <td style="width: 2%;"><?php
                                                        if ($item->tgl_selesai != null) {
                                                        $dateselesai = strtotime($item->tgl_selesai);
                                                        $dateestimasi2 = strtotime($item->estimasi);
                                                        $secs = $dateestimasi2 - $dateselesai; 
                                                        $dayresult = $secs / 86400;
                                                        echo $dayresult; 
                                                        }else{
                                                         echo "-";
                                                        }
                                                        ?></td>
                                                <td>{{ $item->type }}</td>
                                                <td class="td-status" style="width: 8%;">
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
                                                <?php
                                                    if ($item->tgl_selesai != null) {
                                                        $date = date("d/m/Y", strtotime($item->tgl_selesai));
                                                        $day_selesai = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('d');
                                                    } else {
                                                        $day_selesai = $item->tgl_selesai;
                                                    }
                                                    for ($i = 1; $i <= 31; $i++) {
                                                        if ($i == $day_selesai) {
                                                            if ($item->status == 5) {
                                                                echo '<td class=""><div class="box" style="background-color: blue; height: 40px;"></div></td>';
                                                            } elseif ($item->status == 2) {
                                                                echo '<td class=""><div class="box" style="background-color: #FCE83A; height: 40px;"></div></td>';
                                                            } elseif ($item->status == 6 || $item->status == 7) {
                                                                echo '<td class=""><div class="box" style="background-color: red; height: 40px;"></div></td>';
                                                            }
                                                        } else {
                                                            echo '<td></td>';
                                                        }
                                                    }
                                                    ?>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td>No Datas</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mx-5">
                                {{ $listtask->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>

@foreach($listtask as $item)
<div class="modal fade" id="tambahstartModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Start Date</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('user-start-date') }}" method="post">
                @method('put')
                @csrf
                <input type="text" name="project_id" value="{{$item -> id}}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-lg-4 col-form-label" for="tgl_mulai">Start Date
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Project start date">
                        </div>
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
@endsection

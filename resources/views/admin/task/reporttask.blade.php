@extends('layouts.app')

@section('title', '| Task Report')
@section('titleNav', 'Task Report')

@section('container.isi')
@section('active_reporttask', 'mm-active')
<style>
    .table-container {
        padding: 20px;
    }

    .divisiTable .th-date {
        width: 10px !important;
    }

    .divisiTable th {
        font-size: 11px !important;
        width: 10px !important;
        padding: 10px 5px !important;
        text-align: center;

    }

    .divisiTable .th-date {
        padding: 10px 3px !important;
        width: 100px;

    }

    .divisiTable td {
        padding: 10px 4px !important;
        font-size: 11px;
        text-align: center;
    }

    .divisiTable .th-target,
    .divisiTable .th-result {
        width: 5px !important;
        padding: 10px 6px !important;

    }

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
        font-size: 0.813rem;
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

    .btn-task {
        padding: 3px 3px;
        border-radius: 4px;
        font-size: 0.713rem;
        color: white;
        width: 90px;
        margin: 0 auto;
    }

    /* .btn-task:hover {
        color: white;
    } */

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
    <div class="row page-titles mx-0"></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-between mx-2">
                    <div>
                        <h4 class="card-title mb-2">{{ $tableTitle }}</h4>
                    </div>
                </div>
                <div class=" card-body">
                    <!-- task table -->
                    <div class="table-bordered table-responsive table-container">
                        <table id="table" class="divisiTable table table-striped">
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
                                @forelse($projects as $no=>$item)
                                <tr>
                                    <td style="width: 3%;">{{ $no + 1 }}</td>
                                    <td class="td-left" style="width: 8%;">
                                        {{ $item->clients->companyclients->name }}
                                    <td class="td-left" style="width: 8%;">
                                        {{ $item->clients->nama_client }}
                                    </td>
                                    <td style="width: 8%;">{{ initial($item->users->nama) }}
                                    </td>
                                    <td style="width: 8%;">
                                        @php
                                        if ($item->tgl_input != null) {
                                        $date_input = date('d/m/y', strtotime($item->tgl_input));
                                        echo $date_input;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 7%;"><a href="javascript:void(0)" class="btn-addpic btn-task" data-id="{{ $item->id }}" data-url="{{ route('admin-show-pic', ['id' => $item->id]) }}">{{ $item->divisions->nama_divisi }}</a>
                                    </td>
                                    <td class="td-left" style="width: 8%;">
                                        @foreach ($pics as $pic)
                                        @if ($pic->project_id == $item->id)
                                        {{ initial($pic->users->nama) . ',' }}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td style="width: 10%;">
                                        <a href="{{ route('admin-task-single', ['id' => $item->id]) }}" class="btn-task">{{ ucwords(strtolower($item->judul_project)) }}</a>
                                    </td>
                                    <td style="width: 3%;">
                                        <?php
                                        $dateinput = strtotime($item->tgl_input);
                                        $dateestimasi = strtotime($item->estimasi);
                                        $secs = $dateestimasi - $dateinput;
                                        $dayestimasi = $secs / 86400;
                                        echo $dayestimasi;
                                        ?>
                                    </td>
                                    <td style="width: 5%;">
                                        @php
                                        if ($item->tgl_mulai != null) {
                                        $date_mulai = date('d/m/y', strtotime($item->tgl_mulai));
                                        echo $date_mulai;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 5%;">
                                        @php
                                        if ($item->tgl_selesai != null) {
                                        $date_selesai = date('d/m/y', strtotime($item->tgl_selesai));
                                        echo $date_selesai;
                                        }
                                        @endphp
                                    </td>
                                    <td style="width: 3%;">
                                        <?php
                                        if ($item->tgl_selesai != null) {
                                            $dateselesai = strtotime($item->tgl_selesai);
                                            $dateestimasi2 = strtotime($item->estimasi);
                                            $secs = $dateestimasi2 - $dateselesai;
                                            $dayresult = $secs / 86400;
                                            echo $dayresult;
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td class="td-left">
                                        {{ Str::limit($item->detail_project, 50) }}
                                    </td>
                                    <td style="width: 5%;">{{ $item->type }}</td>
                                    <td class="td-status" style="width: 10%;">
                                        @if ($item->status == 1)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambahstartModal{{ $item->id }}">
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
                                    @if ($item->status == 1)
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

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scriptjs')
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ],
            "lengthChange": false,
        });
    });
    $(document).ready(function() {
        $('.sorting').css('background-image', 'none');
        $('.sorting_asc').css('background-image', 'none');
    })
</script>
@endsection

@endsection
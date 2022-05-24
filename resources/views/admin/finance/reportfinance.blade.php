@extends('layouts.app')

@section('title', '| Finance Report')
@section('titleNav', 'Finance Report')

@section('container.isi')
@section('active_reportfinance', 'mm-active')

<style>
    .clientTable {
        padding: 10px !important;
    }

    .clientTable .th-date {
        width: 10px !important;
    }

    .clientTable th {
        font-size: 11px !important;
        width: 10px !important;
        padding: 10px 5px !important;
        text-align: center;

    }

    .clientTable .th-date {
        padding: 10px 3px !important;
        width: 100px;

    }

    .clientTable td {
        padding: 10px 4px !important;
        font-size: 11px;
        text-align: center;
    }

    .clientTable .th-target,
    .clientTable .th-result {
        width: 5px !important;
        padding: 10px 6px !important;

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
        background-color: #2bc155;
        height: 20px;
        line-height: 3px;
    }

    .inactive {
        padding: 3px 7px;
        border-radius: 4px;
        font-size: 0.613rem;
        width: 90px;
        margin: 0 auto;
        background-color: #f35757;
        color: white;
        height: 20px;
        line-height: 3px;
    }

    .infostatus:hover {
        color: white;
    }

    .inactive:hover {
        color: white;
    }

    .alignLeft {
        text-align: left !important;
    }
</style>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title">{{ $tableTitle }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-bordered table-responsive" style="padding : 10px;">
                        <table id="table" class="clientTable table table-striped " style="max-width: 95%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Detail</th>
                                    <th>Value</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($finances as $number => $item )
                                <tr>
                                    <td>{{ $number+1 }}</td>
                                    <td class="alignLeft">{{ $item->name }} </td>
                                    <td class="alignLeft">{{ $item->detail }}</td>
                                    <td class="alignLeft">{{ $item->value }}</td>
                                    <td class="alignLeft">{{ ucfirst($item->type) }}</td>
                                    <td style="width: 10%;">
                                        <a><strong><span class="status">
                                                    <?php
                                                    if ($item->status == 1) {
                                                    ?>
                                                        Active
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($item->status == 0) {
                                                    ?>

                                                        In Active
                                                    <?php
                                                    }
                                                    ?>
                                                </span></strong></a>
                                    </td>
                                </tr>
                                @endforeach

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
</script>
@endsection

@endsection
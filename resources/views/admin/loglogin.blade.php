@extends('layouts.app')

@section('container.isi')
@section('active_log', 'mm-active')


<style>
    .loginLogTable .th-date {
        width: 10px !important;

    }

    .loginLogTable th {
        font-size: 11px !important;
        width: 10px !important;
        padding: 10px 5px !important;
        text-align: center;

    }

    .loginLogTable .th-date {
        padding: 10px 3px !important;
        width: 100px;

    }

    .loginLogTable td {
        /* padding: 10px 4px !important; */
        font-size: 11px;
        text-align: center;
    }

    .loginLogTable .th-target,
    .loginLogTable .th-result {
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

    .alignLeft {
        text-align: left !important;

    }

    .even {
        background-color: white !important;
    }

    .table.dataTable tr.selected {
        color: #3e4954;
    }

</style>

<div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!--<h4 class="card-title">Log Login</h4> -->
                </div>
                <div class="card-body">
                    <div class="table-bordered table-responsive" style="padding:10px;">
                        <table id="tableEx" class="loginLogTable table table-striped " style="max-width: 95%;">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Ip Address</th>
                                    <th>Browser</th>
                                    <th>Login</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    
                                    $i = 0
                                    
                                ?>
                                @foreach ($Data as $item)
                                <tr>
                                    {{-- <td>{{ $item->id }}</td> --}}
                                    <td class="alignLeft">{{ $item->nama }}</td>
                                    <td class="alignLeft">{{ $item->email }}</td>
                                    <td class="alignLeft">{{ $item->ip_address }}</td>
                                    <td class="alignLeft">{{ $item->browser }}</td>
                                    <td class="alignLeft">{{ $item->created_at }}</td>

                                </tr>
                                <?php $i++; ?>
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

@endsection
@endsection

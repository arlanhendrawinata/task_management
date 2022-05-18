@extends('layouts.app')

@section('container.isi')
@section('active_client', 'mm-active')

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
                    <div class="d-flex">
                        <div>
                            <a href="/tambahclient" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle "></i> Add Client</a>
                        </div>
                        <div class="ml-2">
                            <a href="/tambahcategory" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle "></i> Add Category</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-bordered table-responsive" style="padding : 10px;">
                        <table id="example" class="clientTable table table-striped " style="max-width: 95%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Companies</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Category Clients</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($clients as $number => $client )
                                {{-- href="javascript:void(0);" --}}
                                <tr>
                                    <td>{{ $number+1 }}</td>
                                    <td class="alignLeft" style="width: 15%;">{{ $client->companyclients->name }}</td>
                                    <td class="alignLeft" style="width: 15%;">{{ $client->nama_client }} </td>
                                    <td class="alignLeft">{{ $client->no_telp }}</td>
                                    <td class="alignLeft">{{ $client->alamat }}</td>
                                    <td class="alignLeft">{{ $client->category_clients->nama_kategori }}</td>
                                    <td style="width: 10%;">
                                        <a><strong><span class="status">
                                                    <?php
                                                if($client->status == 1){
                                            ?>
                                                    <form action="{{ route('admin-client-status', ['id'=>$client->id,'status'=>0]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" value="0" class="btn infostatus" name="active">Active</button>
                                                    </form>
                                                    <?php
                                                }
                                            ?>
                                                    <?php
                                                if($client->status == 0){
                                            ?>
                                                    <form action="{{  route('admin-client-status', ['id'=>$client->id,'status'=>1]) }}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" value="1" class="btn inactive" name="inactive">In Active</button>
                                                    </form>
                                                    <?php
                                            }
                                            ?>
                                                </span></strong></a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">


                                            <a href="" class="btn  btn-detail btn-success shadow btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Click to see client details" style="cursor: pointer;" data-bs-toggle="modal" data-attr="{{ route('client-deatilclient', $client->id) }}"><i class="fa fa-info"></i></a>

                                            <!-- detail Modal -->
                                            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex align-items-center">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Clients</h5>
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
                                            {{-- <a href="/detailclient{{ $client->id }}" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-info"></i></a> --}}
                                            <a href="/editclient{{ $client->id }}" class="btn btn-primary shadow btn-xs sharp mr-1" title="Click to edit client"><i class="fa fa-pencil"></i></a>

                                            {{-- <a href="/client{{ $client->id }}" class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Yakin Hapus Data!?')"><i class="fa fa-trash"></i></a> --}}
                                        </div>
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
@endsection

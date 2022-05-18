@extends('layouts.app')

@section('container.isi')
@section('active_divisi', 'mm-active')

<style>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title">{{ $tableTitle }}</h4>
                    </div>
                    <a href="" class="btn btn-primary btn-sm" data-bs-target="#insertModal" data-bs-toggle="modal"><i class="fa fa-plus-circle "></i> Add Team</a>
                    {{-- <h4 class="card-title">Profile Datatable</h4> --}}
                </div>
                <div class="card-body">
                    <div class="table table-bordered table-responsive" style="padding:10px;">
                        <table id="example" class="divisiTable table table-striped" style="max-width: 95%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Team Name</th>
                                    <th>Team Description</th>
                                    <th>Team Members</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($array as $no=>$data)

                                <tr>
                                    <td style="width: 3%;">{{ $no+1 }}</td>
                                    <td class="alignLeft">{{ $data->nama_divisi }}</td>
                                    <td class="alignLeft">{{ $data->keterangan }}</td>
                                    <td style="width: 10%;"><a href="" class="btn-detail btn-task" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $data->id }}" data-attr="{{ route('goto-myisiteam', $data->id) }}">
                                            {{ countMemberTeam($data->id) }}
                                        </a></td>
                                    <td><a>
                                            <?php if($data->status == 1){ ?>
                                            <form action="{{  route('goto-updatestatus-dbvisions',['id'=>$data->id,'status'=>0])}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                <button type="submit" class="btn infostatus" name="active" value="0" type="submit">Active</button>
                                            </form>
                                            <?php } if($data->status == 0){ ?>
                                            <form action="{{  route('goto-updatestatus-dbvisions',['id'=>$data->id,'status'=>1])}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                <button type="submit" class="btn inactive" name="inactive" value="1" type="submit">Inactive</button>
                                            </form>
                                            <?php } ?>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            {{-- <a href="" class="btn btn-detail btn-success shadow btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Klik untuk lihat detail project" style="cursor: pointer;" data-bs-toggle="modal" data-attr="{{ route('goto-detail-dbdivisions',   $data->id)}}"><i class="fa fa-info"></i></a> --}}
                                            <a href="" class="btn btn-detail btn-primary shadow btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Click to see team details" style="cursor: pointer;" data-bs-toggle="modal" data-attr="{{ route('goto-edit-dbdivisions',   $data->id)}}"><i class="fa fa-pencil"></i></a>
                                            {{-- <a href="{{ route('goto-delete-dbdivisions',['id'=>$data->id])}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end div row -->
    </div>
</div>

<!-- detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Detail Team Members</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body" id="detailBody">

            </div>
        </div>
    </div>
</div>
<!-- end detail modal -->

<!-- insert Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Team</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body" id="detailBody">
                <div class="text-center">
                    <div class="card-header">
                        <h4 class="card-title">Add Team</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-valide" action="{{ route('goto-insert-dbdivisions') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="nama-divisi">Nama Team <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama-divisi" name="nama_divisi" placeholder="Enter Team Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="keterangan-divisi">Description Team <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <textarea type="text" class="form-control" id="keterangan-divisi" name="keterangan" placeholder="Enter Team Description" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Insert</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- end insert modal -->

@endsection

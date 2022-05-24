@extends('layouts.app')

@section('container.isi')
@section('active_user', 'mm-active')

<style>
    .userTable .th-date {
        width: 10px !important;
    }

    .userTable th {
        font-size: 11px !important;
        width: 10px !important;
        padding: 10px 5px !important;
        text-align: center;

    }

    .userTable .th-date {
        padding: 10px 3px !important;
        width: 100px;

    }

    .userTable td {
        padding: 10px 4px !important;
        font-size: 11px;
        text-align: center;
    }

    .userTable .th-target,
    .userTable .th-result {
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
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <!--<div class="welcome-text">-->
            <!--    <h4>Hi, {{ auth()->user()->nama }}!</h4>-->
            <!--    <span>Datatable {{ $title }}</span>-->
            <!--</div>-->
        </div>
        <!--<div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">-->
        <!--    <ol class="breadcrumb">-->
        <!--        <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>-->
        <!--        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>-->
        <!--    </ol>-->
        <!--</div>-->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> {{ $tableTitle }} </h4>
                    <a href="{{ route('goto-showinsert-dbusers') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle "></i> Add User</a>
                </div>
                <div class="card-body">
                    <div class="table-bordered table-responsive" style="padding : 10px;">
                        {{-- table database --}}
                        <table id="example" class="userTable table table-striped" style="max-width: 95%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Can_add_task</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                @foreach ($array as $data)
                                <tr>
                                    <?php $no++ ?>
                                    <td>{{ $no }}</td>
                                    <td class="alignLeft">{{ $data->nama }}</td>
                                    <td class="alignLeft">{{ $data->email }}</td>
                                    <td>
                                        @if($data->userDetail->role == 1)
                                        Admin
                                        @elseif($data->userDetail->role == 2)
                                        Management
                                        @elseif($data->userDetail->role == 3)
                                        Tim Leader
                                        @elseif($data->userDetail->role == 4)
                                        Anggota
                                        @endif
                                    </td>
                                    <td> <?php if ($data->status == 1) { ?>
                                            <form action="{{  route('goto-updateStatus-dbusers',['id'=>$data->id,'status'=>0])}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                <button type="submit" class="btn infostatus" name="active" value="0" type="submit">Active</button>
                                            </form>
                                        <?php } else { ?>
                                            <form action="{{  route('goto-updateStatus-dbusers',['id'=>$data->id,'status'=>1])}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                <button type="submit" class="btn inactive" name="inactive" value="1" type="submit">Inactive</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td> <?php if ($data->can_add_task == 1) { ?>
                                            <form action="{{  route('can-add-task',['id'=>$data->id,'val'=>0])}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                <button type="submit" class="btn infostatus" name="can_add_task" value="0" type="submit">True</button>
                                            </form>
                                        <?php } else { ?>
                                            <form action="{{  route('can-add-task',['id'=>$data->id,'val'=>1])}}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="text" name="id" value="{{ $data->id }}" hidden>
                                                <button type="submit" class="btn inactive" name="can_add_task" value="1" type="submit">False</button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">

                                            <a href="" class="btn  btn-detail btn-success shadow btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Click to see user details" style="cursor: pointer;" data-bs-toggle="modal" data-attr="{{ route('goto-showdetail-dbusers', $data->id) }}"><i class="fa fa-info"></i></a>
                                            <a href="{{ route('goto-edit-dbusers',['id'=>$data->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1" title="Click to edit user details"><i class="fa fa-pencil"></i></a>
                                            <!--<a hidden href="" class="btn btn-danger shadow btn-xs sharp btn-delete" data-id="{{ $data->id }}" data-link="{{ route('goto-delete-dbusers',['id'=>$data->id]) }}"><i class="fa fa-trash"></i></a>-->
                                            {{--<a href="{{ route('goto-delete-dbusers',['id'=>$data->id]) }}" class="btn btn-danger shadow btn-xs sharp" onclick="return confirm('Yakin Hapus Data!?')"><i class="fa fa-trash"></i></a>--}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- end table database --}}

                    </div>
                </div>
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
                Are you sure to delete this task?
            </div>
            <div class="modal-footer modal-footer-delete">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete modal -->

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
@endsection
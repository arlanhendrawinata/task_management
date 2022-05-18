@extends('layouts.app')

@section('container.isi')
@section('active_client', 'mm-active')

<style>
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

    .alignLeft {
        text-align: left !important;
    }

</style>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Category</h4>
            </div>
            <div class="container-fluid">
                <div class="card-header">
                    <a href="" class="btn btn-primary btn-sm" data-bs-target="#addcategory" data-bs-toggle="modal"><i class="fa fa-plus-circle "></i>Add Category</a>
                    {{-- <a href="/tambahclient" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle "></i> Add Chategory</a> --}}
                    {{-- <a href="/client" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-left"></i> Kembali</a> --}}
                </div>


                <div class="card-body">
                    <div class="table-bordered table-responsive">
                        <table id="" class="clientTable table table-striped " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category_clients as $number =>$category_client )
                                <tr>
                                    <td>{{ $number+1 }}</td>
                                    <td class="alignLeft">{{ $category_client->nama_kategori }}</td>
                                    <td>
                                        <a><strong><span class="status">
                                                    <?php
                                        if($category_client->status == 1){
                                    ?>
                                                    <form action="{{ route('admin-category-status', ['id'=>$category_client->id,'status'=>0]) }}" method="POST">
                                                        @csrf
                                                        @method('put')

                                                        <button type="submit" value="0" class="btn infostatus" name="active">Active</button>
                                                    </form>
                                                    <?php
                                        }
                                    ?>
                                                    <?php
                                        if($category_client->status == 0){
                                    ?>
                                                    <form action="{{  route('admin-category-status', ['id'=>$category_client->id,'status'=>1]) }}" method="POST">
                                                        @csrf
                                                        @method('put')

                                                        <button type="submit" value="1" class="btn inactive" name="inactive">In Active</button>
                                                    </form>
                                                    <?php
                                    }
                                    ?>
                                                </span></a></strong>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="" class="btn  btn-editcategory btn-primary shadow btn-xs sharp mr-1" data-bs-toggle="tooltip" title="CLick to edit Category" style="cursor: pointer;" data-bs-toggle="modal" data-attr="{{ route('admin-category-edit', $category_client->id) }}"><i class="fa fa-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="mx-4 mt-4">
                            {{ $category_clients->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal  --}}
<!-- Add Category -->
<div class="modal fade" id="addcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Form Add Category</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body" id="detailBody">
                <div class="text-center">
                    <div class="card-header">
                        <h4 class="card-title">Add Category</h4>
                    </div>
                    <div class="card-body">
                        <form class="form-valide" action="{{ route('admin-category-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label" for="nama_kategori">Category Name </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Enter Catagory Name" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
<!-- End Add Category -->

<!-- Add Edit Category -->
<div class="modal fade" id="editcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Category</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body" id="detailBodyEditCategory">


            </div>
        </div>
    </div>
</div>
<!-- End EditCategory -->
{{-- End Modal --}}
@endsection

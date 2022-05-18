@extends('layouts.app')

@section('container.isi')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Hi, welcome back!</h4>
                <span>Datatable</span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="/tambahtask" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle "></i> Add Task</a>
                    {{-- <h4 class="card-title">Fees Collection</h4> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example4" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Roll No</th>
                                    <th>Student Name</th>
                                    <th>Invoice number</th>
                                    <th>Fees Type </th>
                                    <th>Payment Type </th>
                                    <th>Status </th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Tiger Nixon</td>
                                    <td>#54605</td>
                                    <td>Library</td>
                                    <td>Cash</td>
                                    <td><span class="badge light badge-success">Paid</span></td>
                                    <td>2011/04/25</td>
                                    <td><strong>120$</strong></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="/detailtask" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-info"></i></a>
                                            <a href="/edittask" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
@endsection

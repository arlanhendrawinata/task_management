@extends('layouts.app')

@section('container.isi')
@section('active_listdiv', 'mm-active')

<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <!--<div class="welcome-text">-->
            <!--    <h4>Hi, {{ auth()->user()->nama }}!</h4>-->
            <!--<span>Datatable {{ $title }}</span>-->
            <!--</div>-->
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
            </ol>
        </div>
    </div>
    @php
    $id = auth()->user()->id;

    @endphp
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Team : {{ $nama_divisi; }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped display" style="min-width: 445px">
                            <thead>
                                <tr>
                                    <th>Team Leader : {{ $teamLeader_name; }}</th>
                                </tr>
                            </thead>
                            <thead>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td style=" @if($item['id']==$id)
                                        {{ "color : red;" }}
                                    @endif">{{ $item['nama'] }}</td>
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

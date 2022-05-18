@extends('layouts.app')

@section('container.isi')
@section('active_listtask', 'mm-active')

{{-- <div class="content-body"> --}}
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-valide" action="{{ route('user-kumpultask') }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="text" name="id" value="{{$project->id}}" hidden>
                        <div class="email-left-box px-0 mb-3">
                        </div>
                        <div class="email-right-box ml-0 ml-sm-4 ml-sm-0">
                            <div class="toolbar mb-4" role="toolbar">
                                <!-- add note button -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4>Form {{ $title }}</h4>
                                    <a href="javascript:void(0)" class="btn btn-primary px-3 success ml-2" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                                        <i class="fa fa-comment mr-2"></i>Add note</a>
                                </div>
                            </div>
                            <div class="compose-content">
                                <form action="#">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg-transparent" id="client_id" name="client_id" value="{{$project->clients->id}}" hidden>
                                        To
                                        <input type="text" class="form-control bg-transparent" id="nama_client" name="nama_client" value="{{$project->clients->nama_client}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        Project Title
                                        <input type="text" class="form-control bg-transparent" id="judul_project" name="judul_project" value="{{ ucwords(strtolower($project->judul_project)) }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        Detail Project
                                        <textarea id="email-compose-editor" name="detail" class="textarea_editor form-control bg-transparent" rows="5">{{ $project->detail_project }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        Report Project
                                        <textarea id="email-compose-editor" name="laporan" class="textarea_editor form-control bg-transparent" rows="10">{{ $project->laporan_project }}</textarea>
                                    </div>
                                </form>
                                <h5 class="mb-4"><i class="fa fa-paperclip"></i> Attatchment</h5>
                                <div class="fallback">
                                    <input name="oldfoto" type="text" value="{{ $project->foto_hasil }}" hidden />
                                    <input name="foto_hasil" type="file" multiple />
                                </div>
                            </div>
                            <div class="text-left mt-4 mb-5">
                                <button class="btn btn-primary btn-sl-sm mr-2" type="submit"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- View Note -->
<style>
    .chatbox .contacts_body {
        height: auto;
    }

    .chatbox {
        background-color: white;
    }

    .contacts {
        background-color: #ffff;
        /* box-shadow: ; */
    }

    /* .contacts {
        background-color: white;
        border: 0px solid transparent;
        border-radius: 0.75rem;
        box-shadow: 0px 12px 33px 0px rgba(62, 73, 84, 0.08);
    } */
    .msg {
        color: black;
        font-size: 1rem;
    }

    .msg_time_send {
        font-size: 0.85rem;
    }

    .card-head {
        margin-bottom: 0.15rem;
    }

    .card-left,
    .card-right {
        margin-bottom: 0.8rem;
    }

</style>
<div class="container-fluid">
    <div class="card p-3 card-head">
        <h4 class="text-center" style="margin: 0;">Notes</h4>
    </div>
    @forelse($notes as $item)
    @if(Auth::id() != $item->user_id)
    <div class="card card-right">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-center flex-column align-items-start">
                <span class="msg">
                    {{ $item->keterangan }}
                </span>
                @php
                $date = date('H:i:s', strtotime($item->created_at))
                @endphp
                <span class="msg_time_send">{{\Carbon\Carbon::create($item->created_at)->diffForHumans() }}</span>
                <span class="msg_time_send">{{ $item->users->nama }}</span>
            </div>
            @if(Auth::id() == $item->user_id)
            <div>
                <a href="javascript:void(0)" class="btn-edit btn btn-primary btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Edit Note" style="cursor: pointer;" data-attr="{{ route('notes-edit', $item->id) }}"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp btn-delete-note" data-bs-toggle="tooltip" title="Delete Note" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>

            </div>
            @endif
        </div>
    </div>
    @elseif(Auth::id() == $item->user_id)

    <div class="card card-left">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <a href="javascript:void(0)" class="btn-edit btn btn-primary btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Edit Note" style="cursor: pointer;" data-attr="{{ route('notes-edit', $item->id) }}"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp btn-delete-note" data-bs-toggle="tooltip" title="Delete Note" data-id="{{ $item->id }}" data-link="{{route('notes-delete', ['id'=>$item->id])}}"><i class="fa fa-trash"></i></a>

            </div>
            <div class="d-flex justify-content-center flex-column align-items-end">
                <span class="msg">
                    {{ $item->keterangan }}
                </span>
                @php
                $date = date('H:i:s', strtotime($item->created_at))
                @endphp
                <span class="msg_time_send">{{\Carbon\Carbon::create($item->created_at)->diffForHumans() }}</span>
                <span class="msg_time_send">{{ $item->users->nama }}</span>
            </div>
        </div>
    </div>
    @endif
    @empty
    @endforelse
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Note</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('notes-store') }}" method="post">
                @csrf
                <!-- <input type="number" name="project" value="{{ $project->id }}" hidden> -->
                <!-- <input type="number" name="total_revisi" value="{{ $project->total_revisi }}" hidden> -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="project" value="{{ $project->id }}" hidden>
                            <!-- <input type="text" name="user" value="{{ $project->user_id }}" hidden> -->
                            <label class="col-form-label text-danger" for="val-laporan">Write Note On This Section !!!</label>
                            <textarea id="notes" cols="30" rows="5" class="form-control" name="keterangan" placeholder="Insert Note.."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="edit-form"></div>
        </div>
    </div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Delete Note</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this note?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete modal -->
@endsection

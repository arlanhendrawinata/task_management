@extends('layouts.app')
@section('active_leadtask', 'mm-active')


@section('container.isi')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0 d-flex align-items-center">
            <div class=" d-flex">
                <!--<ol class="breadcrumb">-->
                <!--    <li class="breadcrumb-item"><a href="javascript:void(0)">Task</a></li>-->
                <!--    <li class="breadcrumb-item active"><a href="javascript:void(0)">Detail</a></li>-->
                <!--</ol>-->
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <!-- add note button -->
            <a href="javascript:void(0)" class="btn btn-primary px-3 success ml-2" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <i class="fa fa-comment mr-2"></i>Add note</a>
            <!-- btn verifikasi -->
            @if($project->status == 4)
            <button class="btn btn-success px-3 success ml-2" style=" color: white;" disabled><i class="fa fa-check-square-o mr-2" style="color: white;"></i>Has been Approved</button>
            @else
            <?php
            if ($getpics == 1) {

            ?>
            <form action="{{ route('lead-approve-task') }}" method="POST">
                @method('put')
                @csrf
                <input type="number" name="id" value="{{ $project->id }}" hidden>
                <input type="number" name="status" value="4" hidden>
                <button type="submit" class="btn btn-success px-3 success ml-2" style="color: white;"><i class="fa fa-check-square-o" style="color: white;"></i> Approve</button>
            </form>
            <a href="javascript:void(0)" class="btn-revisi btn btn-danger px-3 success ml-2" data-bs-toggle="modal" data-bs-target="#revisiModal"><i class="fa fa-reply"></i> Revision ({{ $project->total_revisi }})</a>
            <?php
            } ?>
            @endif
            <!-- btn revisi -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="email-left-box generic-width px-0 mb-5">
                    </div>
                    <div class="row">
                        {{-- <div class="col-12">
                        </div> --}}
                    </div>
                    <div class="read-content">
                        <div class="d-flex flex-column align-items-start justify-content-start pt-3W">
                            <h4>{{ ucwords(strtolower($project->judul_project)) }}</h4>
                            <span> @foreach($pics as $pic)
                                @if($pic->project_id == $project->id)
                                {{ $pic->users->nama}}
                                @endif
                                @endforeach</span>
                        </div>
                        <hr>
                        <div class="media mb-2 mt-3">
                            <div class="media-body"><span class="pull-right">{{ $project->created_at->translatedFormat('l, d F Y (H:m:s)') }}</span>
                                <h5 class="my-1 text-primary">{{ $project->clients->nama_company }}</h5>
                                <p class="read-content-email">
                                    {{ $project->clients->nama_client }}
                                </p>
                            </div>
                        </div>
                        <div class="read-content-body">
                            <p class="mb-2">{{ $project->detail_project }}</p>
                            <p class="mb-2">{{ $project->laporan_project }}</p>
                            <hr>
                        </div>
                        <div class="read-content-attachment">
                            <h6><i class="fa fa-download mb-2"></i> Attachments
                            </h6>
                            <div class="row attachment">
                                <div class="col-auto">
                                    <a class="text-muted" href="{{ asset('fotohasil/' . $project->foto_hasil) }}" data-lightbox="{{ $project->foto_hasil }}" data-title="{{ $project->foto_hasil }}">{{ $project->foto_hasil }}</a>
                                </div>
                            </div>
                            <hr>
                            <div class="date-content-body d-flex">
                                <div class="mr-4"><span>Start Date :</span> <span>{{ ($project->tgl_mulai != null) ? $project->tgl_mulai : '-' }}</span></div>
                                <div class="mr-4"><span>Estimation :</span> <span>{{ ($project->estimasi != null) ? $project->estimasi : '-' }}</span></div>
                                <div class="mr-4"><span>End Date :</span> <span>{{ ($project->tgl_selesai != null) ? $project->tgl_selesai : '-' }}</span></div>
                            </div>
                            <hr>
                        </div>
                        <hr>
                    </div>
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
                <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp btn-delete-note" data-bs-toggle="tooltip" title="Delete Note" data-id="{{ $item->id }}" data-link="{{route('notes-delete', ['id'=>$item->id])}}"><i class="fa fa-trash"></i></a>
                data-link="{{route('notes-delete', ['id'=>$item->id])}}"
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="text" name="project" value="{{ $project->id }}" hidden>
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

<!-- revisi Modal -->
<div class="modal fade" id="revisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Task Revision</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('lead-revisi-task') }}" method="post">
                @method('put')
                @csrf
                <input type="number" name="id" value="{{ $project->id }}" hidden>
                <input type="number" name="total_revisi" value="{{ $project->total_revisi }}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label class="col-form-label" for="val-laporan">Laporan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="val-laporan" name="laporan" rows="5" placeholder="Laporan..">{{ $project->laporan_project }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Revisi</button>
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

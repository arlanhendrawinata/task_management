@extends('layouts.app')

@section('container.isi')
<div class="chatbox active">
    <!-- <div class="chatbox-close"></div> -->
    <div class="custom-tab-1">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#notes">Notes</a>
            </li>
        </ul>
        <div class="tab-content">
            <div div class="tab-pane fade active show" id="notes" role="tabpanel">
                <div class="card mb-sm-3 mb-md-0 note_card">
                    <div class="card-header chat-list-header text-center">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#tambahNoteModal"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
                                </g>
                            </svg></a>
                        <div>
                            <h6 class="mb-1">Notes</h6>
                            <p class="mb-0">Add New Notes</p>
                        </div>
                        <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg></a>
                    </div>
                    <div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body2">
                        <ul class="contacts">
                            @forelse($notes as $item)
                            <li class="active">
                                <div class="d-flex bd-highlight">
                                    <div class="user_info">
                                        <div class="notes-info">
                                            <div class="d-flex">
                                                @if(Auth::user()->userDetail->role == 1 || Auth::user()->userDetail->role == 2)
                                                <a href="{{ route('admin-task-detail', $item->projects->id) }}">
                                                    <span>{{ $item->projects->judul_project }}</span>
                                                </a>
                                                @elseif(Auth::user()->userDetail->role == 3)
                                                <a href="{{ route('lead-task-detail', $item->projects->id) }}">
                                                    <span>{{ $item->projects->judul_project }}</span>
                                                </a>
                                                @else
                                                <a href="{{ route('user-task-kumpul', $item->projects->id) }}">
                                                    <span>{{ $item->projects->judul_project }}</span>
                                                </a>
                                                @endif
                                                @php
                                                $date = date('H:i:s', strtotime($item->created_at))
                                                @endphp
                                                <p class="px-2 time">{{
                                                    \Carbon\Carbon::create($item->created_at)->diffForHumans() }}</p>
                                            </div>
                                            <p class="py-2 keterangan">{{ $item->keterangan }}</p>
                                        </div>
                                        <div class="user-info">
                                            <p class="py-2 usr_nama">{{ $item->users->nama }}</p>
                                        </div>
                                    </div>
                                    @if(Auth::id() == $item->user_id)
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" class="btn-edit btn btn-primary btn-xs sharp mr-1" data-bs-toggle="tooltip" title="Edit Note" style="cursor: pointer;" data-attr="{{ route('notes-edit', $item->id) }}"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp btn-delete-note" data-bs-toggle="tooltip" title="Delete Note" data-id="{{ $item->id }}"><i class="fa fa-trash"></i></a>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @empty
                            <li class="active">
                                <div class="d-flex bd-highlight">
                                    <div class="user_info">
                                        <span>No datas...</span>
                                    </div>
                                </div>
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="tambahNoteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Note</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('notes-store') }}" method="post" id="add_note_form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label class="col-form-label" for="val-project">Projects
                                <span class="text-danger">*</span>
                            </label>
                            <select class="tom-select-project" id="val-project" name="project">
                                <option value="">Please select projects</option>
                                @forelse($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->judul_project }}</option>
                                @empty
                                <option value="">No Datas</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <label class="col-form-label" for="val-keterangan">Note detail <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="val-keterangan" name="keterangan" rows="5" placeholder="Describe your project"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnaddnote">Tambah Note</button>
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

@section('scriptjs')
<script>
    new TomSelect('.tom-select-project', {
        plugins: {
            remove_button: {
                title: 'Remove this item'
            , }
        }
        , sortField: {
            field: "text"
            , direction: "asc"
        }
    });

</script>
@endsection

@endsection

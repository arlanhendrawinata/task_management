{{-- @extends('layouts.app') --}}

{{-- @section('container.isi')  --}}


<div class="text-center">
    <div class="card-header">
        <h4 class="card-title">Form Edit Team</h4>
    </div>
    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="{{ route('goto-update-dbdivisions') }}" method="POST">
                @csrf
                @method("put")
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="id-divisi">ID <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="id-divisi" readonly name="id" placeholder="Enter Team ID" value="{{ $data->id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nama-divisi">Team Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nama-divisi" name="nama_divisi" placeholder="Enter Team Name" value="{{ $data->nama_divisi }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="keterangan-divisi">Description Team <span class="text-danger"></span>
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control" id="keterangan-divisi" name="keterangan" placeholder="Enter Team Description">{{ $data->keterangan }}
                                </textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

{{-- @endsection --}}

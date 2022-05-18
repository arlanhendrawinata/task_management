<form action="{{ route('notes-update') }}" method="post">
    @method('put')
    @csrf
    <input type="number" name="id" value="{{ $note->id }}" hidden>
    <div class="modal-body">
        <div class="row">
            <div class="col">
                <label class="col-form-label" for="val-project">Project <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="project" value="{{ $projects->id }}" hidden>
                <input type="text" class="form-control" value="{{ $projects->judul_project }}" readonly>
            </div>
        </div>
        <div class="row my-3">
            <div class="col">
                <label class="col-form-label" for="val-keterangan">Keterangan <span class="text-danger">*</span></label>
                <textarea class="form-control" id="val-keterangan" name="keterangan" rows="5" placeholder="Describe your project">{{ $note->keterangan }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit Note</button>
    </div>
</form>
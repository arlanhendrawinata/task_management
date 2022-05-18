<form action="{{ route('admin-add-pic') }}" method="post" id="picform">
  @csrf
  <input type="text" name="project_id" value="{{$project->id}}" hidden>
  <div class="modal-body">
    <div class="row">
      <div class="col">
        <label class="col-form-label" for="val-project">User ID
          <span class="text-danger">*</span>
        </label>
        <select class="form-control" id="val-project" name="user_id">
          <option value="">Please select PIC</option>
          @forelse($users as $user)
          <option value="{{ $user->id }}">{{ $user->nama }}</option>
          @empty
          <option value="">No Datas</option>
          @endforelse
        </select>
      </div>
    </div>
    <div class="row my-3">
      <table class="table table-striped">
        <tbody>
          @forelse($pics as $pic)
          @if($pic->project_id == $project->id)
          <tr>
            <td>User : {{ $pic->users->nama}}</td>
            <td><a class="btn btn-danger btn-delete shadow btn-xs sharp px-2" data-bs-toggle="tooltip" title="Remove PIC" data-id="{{$project->id}}" data-link=" {{ route('admin-deletepic', ['id'=>$pic->id]) }}" style="cursor: pointer;"><i class="fa fa-trash" style="color:white"></i></a></td>
          </tr>
          @endif
          @empty
          <tr>
            <td>User : No Datas</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="btnaddnote">Tambah PIC</button>
  </div>
</form>
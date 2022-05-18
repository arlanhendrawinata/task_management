@extends('layouts.app')

@section('container.isi')

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Form Edit Finance</h4>
    <div>
      <a href="{{ route('admin-finance-index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left pr-2"></i>
        Back</a>
    </div>
  </div>
  <div class="card-body">
    <div class="form-validation">
      <form class="form-valide" action="{{ route('admin-finance-update') }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method("put")
        <div class="row mb-4">
          <div class="col-xl-6">
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="id-divisi">ID <span class="text-danger">*</span>
              </label>
              <div class="col-lg-6">
                <input type="text" class="form-control" id="id-divisi" readonly name="id" placeholder="Enter Team ID" value="{{ $finance->id }}" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="val-name">Name
                <span class="text-danger">*</span>
              </label>
              <div class="col-lg-6">
                <input type="text" class="form-control" id="val-name" name="name" placeholder="Input name" value="{{ $finance->name }}" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="val-detail_finance">Detail
                <span class="text-danger">*</span>
              </label>
              <div class="col-lg-6">
                <textarea class="form-control" id="val-detail" name="detail" rows="5" placeholder="Describe your finance" required>{{ $finance->detail }}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="foto">Image
                <!--<span class="text-danger">*</span>-->
              </label>
              <div class="col-lg-6">
                <img class="img-preview">
                <input type="file" class="form-control" id="foto" name="foto" placeholder="Insert Foto" onchange="previewImageUsersCRUD()">
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="val-value">Value
                <!--<span class="text-danger">*</span>-->
              </label>
              <div class="col-lg-6">
                <input type="number" class="form-control" id="val-value" name="value" value="{{$finance->value}}">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="val-type">Type
                <span class="text-danger">*</span>
              </label>
              <div class="col-lg-6">
                <select class="js-example-basic-single" id="val-type" name="type" required>
                  <option value="">Please select type</option>
                  <option value="in">In</option>
                  <option value="out">Out</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label" for="val-companys">Company
                <span class="text-danger">*</span>
              </label>
              <div class="col-lg-6">
                <select class="js-example-basic-single" id="val-companys" name="offices_id" required>
                  <option value="0">Please select Company</option>
                  <option value="1">Test</option>
                  {{-- @forelse($clients as $client)
                  <option value="{{ $client->id }}">{{ $client->nama_client }}</option>
                  @empty
                  <option value="">No Datas</option>
                  @endforelse --}}
                </select>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="ml-2 pt-4 border-top">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
  </div>
</div>
</div>
</div>
@section('scriptjs')
<script>
  $('.js-example-basic-single').select2();
</script>
@endsection
@endsection
@extends('layouts.app')

@section('container.isi')
@section('active_companyclient', 'mm-active')


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Add Company Client</h4>
    </div>
    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="{{ route('tambah-cc-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-6">

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="name">Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="description">Description
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="alamat">Address <span class="text-danger"></span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@extends('layouts.app')

@section('container.isi')
@section('active_client', 'mm-active')


<style>
    .select2-container--default .select2-selection--single {
        border-radius: 0.75rem;
        border: 1px solid #d7dae3;
        padding: 0.375rem 0.75rem;
        height: 56px;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 28px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding: 0;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
    }

    .select2-selection__arrow {
        top: 15px !important;
        margin-right: 10px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #7e7e7e !important;
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit Client</h4>
    </div>
    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="/editclient{{ $clients->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="nama_client">User ID
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nama_client" name="id" placeholder="Name" value="{{ $clients->user_id }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="perusahaan_id">Companies
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                {{-- <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="companie Name" required> --}}
                                <select class="js-example-basic-single" id="companyclient_id" name="companyclient_id">
                                    <option value="{{ $cclient_id->id }}">{{ $cclient_id->name }}</option>
                                    @foreach($cclient as $cclients )
                                    <option value="{{ $cclients->id }}">{{ $cclients->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nama_client">Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nama_client" name="nama_client" placeholder="Name" value="{{ $clients->nama_client }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $users->email }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="kategori_client_id">Client Category
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">

                                <select class="js-example-basic-single" id="kategori_client_id" name="kategori_client_id" required>
                                    <option value="{{ $clients->kategori_client_id }}">{{ $category_clients_id->nama_kategori }}</option>
                                    <option value=""></option>
                                    @foreach($category_clients as $category_client )
                                    <option value="{{ $category_client->id }}">{{ $category_client->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="no_telp">Phone
                                <span class="text-danger"></span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Phone" value="{{ $clients->no_telp }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="alamat">Address <span class="text-danger"></span>
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Address">{{ $clients->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="logo">Image<span class="text-danger"></span>
                            </label>

                            <div class="col-lg-6">
                                <input type="hidden" name="oldlogo" value="{{ $clients->logo }}">
                                @if ($clients->logo)
                                <img src="{{ asset($clients->logo) }}" class="img-preview img-fluid mb-3 col-sm-5">

                                @else
                                <img class="img-preview img-fluid mb-3 col-sm-5">

                                @endif

                                <input type="file" class="form-control" id="logo" name="logo" onchange="previewImage()">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="/client" class="btn btn-danger">Back</a>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('scriptjs')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

</script>
@endsection
@endsection

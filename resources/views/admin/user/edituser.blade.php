@extends('layouts.app')

@section('container.isi')
@section('active_user', 'mm-active')


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form {{ $title }}</h4>
    </div>
    <div class="card-body">
        <div class="form-validation">

            <form class="form-valide" action="{{ route('goto-update-dbusers') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-xl-6">

                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="nama">ID
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="id" name="id" readonly required value="{{ $data['user_details']->id }}">
                            </div>
                        </div>

                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="nama">User ID
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="user_id" readonly name="user_id" required value="{{ $data['user_details']->user_id }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nama">Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Insert Nama" required value="{{ $data['users']->nama }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Insert Email" required value="{{ $data['users']->email }}">
                            </div>
                        </div>


                        {{-- <p id="message" style="background-color: red">zzz</p> --}}
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="id_perusahaan">Company
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="id_perusahaan" name="id_perusahaan">
                                    <option value="1" selected>1</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="id_divisi">Team
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">

                                <select class="js-example-basic-single" id="rol" name="id_divisi">


                                    @foreach ($dataDivisions as $data1)


                                    <option value="{{ $data1->id }}" <?php if($data1->id == $datarowDivisions->id) echo"selected"; ?>>{{ $data1->nama_divisi }} </option>


                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="Role">Role
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="role" name="role">

                                    <option value="1" @php if ($data['user_details']->role=="1") { echo"selected"; } @endphp >Admin</option>
                                    <option value="2" @php if ($data['user_details']->role=="2") { echo"selected"; } @endphp >Management</option>
                                    <option value="3" @php if ($data['user_details']->role=="3") { echo"selected"; } @endphp >Team Leader</option>
                                    <option value="4" @php if ($data['user_details']->role=="4") { echo"selected"; } @endphp >Anggota</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Phone
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="notelp" name="notelp" placeholder="Insert No Telp" value="{{ $data['user_details']->no_telp }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="alamat">Address
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="InsertAddress">{{ $data['user_details']->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nip">NIP
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nip" name="nip" placeholder="Insert NIP" value="{{ $data['user_details']->nip }}">
                            </div>
                        </div>

                        <div class="form-group row" hidden>
                            <label class="col-lg-4 col-form-label" for="fotolama">fotolama
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="fotolama" name="fotolama" placeholder="Insert fotolama" value="{{ $data['user_details']->foto }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="foto">Image
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                @if ($data['user_details']->foto)
                                <img src="{{asset($data['user_details']->foto) }}" class="img-preview " width="200px" height="200px">
                                @else
                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif
                                <input type="file" class="form-control" id="foto" name="foto" placeholder="Insert Foto" onchange="previewImageUsersCRUD()">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary" name="submit" id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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

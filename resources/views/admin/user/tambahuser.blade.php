@extends('layouts.app')


@section('container.isi')
@section('active_adduser', 'mm-active')


<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form {{ $title }}</h4>
    </div>
    <div class="card-body">
        <div class="form-validation">
            <form class="form-valide" action="{{ route('goto-insert-dbusers') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nama">Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Insert Nama" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Insert Email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="password">Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 d-flex flex-row-revers">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Insert Password" required>
                                <i class="bi bi-eye-slash p-2" id="togglePassword" style="cursor:pointer; position: relative; margin-right: -40px; top:0"> </i>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="confirmpassword">Confirm Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6 d-flex flex-row-revers">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmpassword" placeholder="Confirm Password" onkeyup="checkPassword()" required>
                                <i class="bi bi-eye-slash p-2" id="toggleConfirmPassword" style="cursor:pointer; position: relative; margin-right: -40px; top:0"> </i>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4"></div>
                            <div class="alert alert-danger col-lg-6" role="alert" id="alertConfirmPassword-false" style="display: none;">
                                Password doesn't match !
                            </div>
                            <div class="alert alert-success col-lg-6" role="alert" id="alertConfirmPassword-true" style="display: none;">
                                Password match !
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
                                    <option value="1">Please select</option>

                                    @foreach ($dataDivisions as $item)
                                    @if ($item->id != 1)
                                    <option value="{{ $item->id }}"> {{ $item->nama_divisi }} </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="id_Role">Role
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select class="js-example-basic-single" id="role" name="role">
                                    <option value="">Please select</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Management</option>
                                    <option value="3">Team Leader</option>
                                    <option value="4">Anggota</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="Role">Role
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="Role" name="role" placeholder="Insert Role" required>
                        </div>
                    </div> --}}

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="email">Phone
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="notelp" name="notelp" placeholder="Insert No Phone">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="alamat">Address
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                <textarea class="form-control" id="alamat" name="alamat" rows="5" placeholder="Insert Address"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="nip">NIP
                                <!--<span class="text-danger">*</span>-->
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" id="nip" name="nip" placeholder="Insert NIP">
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

                        {{-- <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="status">Status
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="status" name="status" placeholder="Insert Status" required>
                        </div>
                    </div> --}}
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary" name="submit" id="submit" disabled="false">Submit</button>
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
    $('.js-example-basic-single').select2();

</script>
@endsection

@endsection

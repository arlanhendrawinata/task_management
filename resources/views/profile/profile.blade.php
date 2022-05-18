@extends('layouts.app')

@section('container.isi')
{{-- {{ auth()->user()->userDetail->no_telp }} --}}
<div class="card">
    <div class="card-body">
        <div class="profile-tab">
            <div class="custom-tab-1">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a href="#about-me" data-toggle="tab" class="nav-link active show">About Me</a>
                    </li>
                    <li class="nav-item"><a href="#profile-settings" data-toggle="tab" class="nav-link">Setting</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="about-me" class="tab-pane fade active show">
                        <div class="profile-personal-info">
                            <h4 class="text-primary mb-4 mt-4">Personal Information</h4>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                    </h5>
                                </div>
                                <div class="col-9"><span>{{ auth()->user()->nama }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                    </h5>
                                </div>
                                <div class="col-9"><span><a href="" class="__cf_email__" data-cfemail="791c01181409151c391c01181409151c15571a1614">{{
                                            auth()->user()->email }}</a></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Company <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ $userDetail->companies->nama_perusahaan }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Team <span class="pull-right">:</span>
                                    </h5>
                                </div>
                                <div class="col-9"><span>{{ $userDetail->divisions->nama_divisi }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Role <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9">
                                    <span>
                                        {{-- {{ $user_details->role }} --}}
                                        @if ( auth()->user()->userDetail->role == 1)
                                        Admin
                                        @elseif (auth()->user()->userDetail->role == 2)
                                        Management
                                        @elseif (auth()->user()->userDetail->role == 3)
                                        Tim Leader
                                        @elseif (auth()->user()->userDetail->role == 4)
                                        Anggota
                                        @endif

                                    </span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Phone <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ auth()->user()->userDetail->no_telp }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">Address <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ auth()->user()->userDetail->alamat }}</span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3">
                                    <h5 class="f-w-500">NIP <span class="pull-right">:</span></h5>
                                </div>
                                <div class="col-9"><span>{{ auth()->user()->userDetail->nip }}</span>
                                </div>
                            </div>
                            <img src="" alt="">
                        </div>
                    </div>
                    <div id="profile-settings" class="tab-pane fade">
                        <div class="pt-3">
                            <div class="settings-form">
                                <h4 class="text-primary">Account Setting</h4>
                                <form action="{{ route('profile-update') }}" method="POST" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" placeholder="Email" class="form-control" value="{{  auth()->user()->email }}" name="email" required>
                                    </div>
                                    <div class="form-row d-flex flex-row-revers">
                                        <div class="form-group col-md-4">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password" onkeyup="checkOldPassword()" value="">
                                            <i class="bi bi-eye-slash p-2" id="toggleOldPassword" style="cursor:pointer; position: relative;
                                            left: 94%; bottom:80%"></i>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>New Password</label>
                                            <input type="password" placeholder="Masukkan Password Baru" class="form-control " name="password" id="password" />
                                            <i class="bi bi-eye-slash p-2" id="togglePassword" style="cursor:pointer; position: relative;
                                            left: 94%; bottom:80%"></i>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onkeyup="checkPassword()">
                                            <i class="bi bi-eye-slash p-2" id="toggleConfirmPassword" style="cursor:pointer; position: relative;
                                            left: 94%; bottom:80%"></i>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12"></div>

                                        <div class="alert alert-danger col-md-12" role="alert" id="alertConfirmPassword-false" style="display: none;">
                                            Password doesn't match !
                                        </div>
                                        <div class="alert alert-success col-md-12" role="alert" id="alertConfirmPassword-true" style="display: none;">
                                            Password match !
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Name" class="form-control" value="{{ auth()->user()->nama }}" name="nama" required>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Perusahaan</label>
                                        <input type="text" placeholder="Perusahaan" class="form-control"
                                            value="{{ $user_details->companies->nama_perusahaan }}"
                                    name="nama_perusahaan">
                            </div> --}}
                            {{-- <div class="form-group">
                                        <label>Divisi</label>
                                        <input type="text" placeholder="Divisi" class="form-control"
                                            value="{{ $user_details->divisions->nama_divisi }}" name="nama_divisi">
                        </div> --}}
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" placeholder="no_telp" class="form-control" value="{{    auth()->user()->userDetail->no_telp }}" name="no_telp" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" placeholder="Alamat" class="form-control" value="{{  $userDetail->alamat}}" name="alamat" required>
                        </div>
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" placeholder="NIP" class="form-control" value="{{  $userDetail->nip }}" name="nip" required>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-form-label" for="logo">Image<span class="text-danger">*</span>
                            </label>

                            <div class="col-lg-6">
                                <input type="hidden" name="oldfoto" value="{{ $userDetail->foto }}">
                                @if ($userDetail->foto)
                                <img src="{{asset(auth()->user()->userDetail->foto)}}" class="img-preview img-fluid mb-3 col-sm-5">

                                @else
                                <img class="img-preview img-fluid mb-3 col-sm-5">

                                @endif

                                <input type="file" class="form-control" id="foto" name="foto" onchange="previewImageUsers()">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" id="submit" name="submit">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection

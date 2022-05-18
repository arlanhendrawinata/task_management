{{-- @extends('layouts.app') --}}

{{-- @section('container.isi') --}}

<div class="text-center">

    @if($array->foto)
    <img class="rounded-circle" width="200" height="200" class="rounded mx-auto d-block" src="{{asset($array->foto)}}" alt="" style="align-content: center;">
    @else
    <img class="rounded-circle" width="200" height="200" src="{{asset('public/images/profile/small/pic7.jpg')}}" alt="" style="align-content: center;">
    @endif
    {{-- @if($array->foto)
        <img class="rounded-circle"  width="200" height="200"  class="rounded mx-auto d-block"  src="{{asset('users/'.$array->foto)}}" alt="" style="align-content: center;" >
    @else
    <img class="rounded-circle" width="200" height="200" src="images/profile/profile.png" alt="" style="align-content: center;">
    @endif --}}
</div>
<br>
<table class="table table-striped">

    <tbody>
        <tr>
            <td>Name</td>
            <td>:</td>
            <td>{{$array->users->nama}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{$array->users->email}}</td>
        </tr>
        {{-- <tr>
            <td>Password </td>
            <td>:</td>
            <td style="max-width: 50px; padding: 5px;width: 100%; overflow-x: auto;white-space: nowrap;">{{$arrayUsers->password}}</td>
        </tr> --}}
        <tr>
            <td>Company</td>
            <td>:</td>
            <td>{{$array->companies->nama_perusahaan}}</td>
        </tr>

        <tr>
            <td>Team</td>
            <td>:</td>
            @if ($array->divisi_id == 1)
            <td>Management</td>
            @else
            <td>{{$array->divisions->nama_divisi}}</td>
            @endif
        </tr>
        <tr>
            <td>Role</td>
            <td>:</td>
            <td>
                @php
                if ($array->role==1) {
                echo"Admin";
                }
                else if($array->role==2){
                echo"Management";
                }
                else if($array->role==3){
                echo"Team Leader";
                }
                else if($array->role==4){
                echo"Anggota";
                }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>:</td>
            <td>{{$array->no_telp}}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>:</td>
            <td>{{$array->alamat}}</td>
        </tr>
        <tr>
            <td>Nip</td>
            <td>:</td>
            <td>{{$array->nip}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <?php if($array->users->status==1){ ?>
            <td>Active</td>
            <?php } else {?>
            <td>Inactive</td>
            <?php }?>


        </tr>
    </tbody>
</table>

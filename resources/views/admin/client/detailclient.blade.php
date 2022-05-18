<div class="text-center">

    @if($clients->logo)
    <img class="rounded-circle" width="200" height="200" class="rounded mx-auto d-block" src="{{asset($clients->logo)}}" alt="" style="align-content: center;">
    @else
    <img class="rounded-circle" width="200" height="200" src="{{asset('public/images/profile/small/pic7.jpg')}}" alt="" style="align-content: center;">
    @endif
    {{-- @if($array->foto)
        <img class="rounded-circle"  width="200" height="200"  class="rounded mx-auto d-block"  src="{{asset('users/'.$array->foto)}}" alt="" style="align-content: center;" >
    @else
    <img class="rounded-circle" width="200" height="200" src="images/profile/profile.png" alt="" style="align-content: center;">
    @endif --}}
</div>

<table class="table table-striped">

    <tbody>
        <tr>
            <td>Company : {{$cclient->name}}</td>
        </tr>
        <tr>
            <td>Name : {{$clients->nama_client}}</td>
        </tr>
        <tr>
            <td>Email : {{$users->email}}</td>
        </tr>
        <tr>
            <td>Phone : {{$clients->no_telp}}</td>
        </tr>
        <tr>
            <td>Address : {{$clients->alamat}}</td>
        </tr>
        <tr>
            <td>Category Client: {{$category_clients->nama_kategori}}</td>
        </tr>
    </tbody>
</table>

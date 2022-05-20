<table class="table table-striped">
    <tbody>
        <tr>
            <td>Name : {{$finance->name}}</td>
        </tr>
        <tr>
            <td>Detail : {{$finance->detail}}</td>
        </tr>
        <tr>
            <td>Value : {{$finance->value}}</td>
        </tr>
        <tr>
            <td>Type : {{$finance->type}}</td>
        </tr>
        <tr>
            <td>Status : {{$finance->status}}</td>
        </tr>
        <tr>
            <td>
                @if($finance->img)
                <img src="{{asset($finance->img)}}" alt="" style="align-content: center;">
                @else
                <img src="{{asset('public/images/profile/small/pic7.jpg')}}" alt="" style="align-content: center;">
                @endif
            </td>
        </tr>
    </tbody>
</table>
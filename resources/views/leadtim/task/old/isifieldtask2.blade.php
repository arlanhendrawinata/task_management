<table class="table table-striped">
    <tbody>
        <tr>
            <td>User : @foreach($pics as $pic)
                @if($pic->project_id == $projects->id)
                {{ $pic->users->nama}}
                @endif
                @endforeach</td>
        </tr>
        <tr>
            <td>Project Title : {{$projects->judul_project}}</td>
        </tr>
        <tr>
            <td>Client Name : {{$projects->clients -> nama_client}}</td>
        </tr>
        <tr>
            <td>Company Name : {{$projects->clients -> nama_company}}</td>
        </tr>
        <tr>
            <td>Project Detail : {{$projects->detail_project}}</td>
        </tr>
        <tr>
            <td>Input Date : {{$projects->tgl_input}}</td>
        </tr>
        <tr>
            <td>Estimation : {{ $projects -> estimasi }}</td>
        </tr>
        <tr>
            <td>Priority : <?php
                            if ($projects->prioritas == 0) {
                                echo 'Low';
                            } elseif ($projects->prioritas == 1) {
                                echo 'Medium';
                            } elseif ($projects->prioritas == 2) {
                                echo 'High';
                            }
                            ?> </td>
        </tr>
        <tr>
            <td class="d-flex justify-content-between align-items-center">
                <div class="d-flex w-25 justify-content-between">
                    <a href="{{ route('lead-task-detail', ['id'=>$projects->id]) }}" class="btn btn-success shadow btn-xs sharp mr-1" style="cursor: pointer;" data-bs-toggle="tooltip" title="Assignment" <?php if ($getpics != 1) echo "hidden"; ?>><i class="fa fa-file" style="color:white"></i></a>
                </div>
            </td>
        </tr>
    </tbody>
</table>

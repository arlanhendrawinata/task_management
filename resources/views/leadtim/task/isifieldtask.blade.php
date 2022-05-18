<table class="table table-striped">
    <tbody>
        <tr>
            <td>PIC :
                @foreach($pics as $pic)
                @if($pic->project_id == $projects->id)
                {{ $pic->users->nama}}
                @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <td>Project Title : {{ucwords(strtolower($projects->judul_project))}}</td>
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
            <td>Input Date : @php
                if($projects->tgl_input != null){
                $date_input = date("d/m/y", strtotime($projects->tgl_input));
                echo $date_input;
                }
                @endphp
            </td>
        </tr>
        <tr>
            <td>Estimation : @php
                if($projects->estimasi != null){
                $date_estimasi = date("d/m/y", strtotime($projects->estimasi));
                echo $date_estimasi;
                }
                @endphp</td>
        </tr>
        <tr>
            <td>Start Date : @php
                if($projects->tgl_mulai != null){
                $date_mulai = date("d/m/y", strtotime($projects->tgl_mulai));
                echo $date_mulai;
                }
                @endphp</td>
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
            <td>
                <?php
                if ($projects->tgl_mulai != null) {
                    if ($projects->status == 1 || $projects->status == 2) {
                ?>
                <a href="{{ route('user-task-kumpul', ['id'=>$projects->id]) }}" class="btn btn-primary">Submit Task</a>
                <?php }
                    if ($projects->status > 2) {
                    ?>

                <?php
                    }
                }
                ?>
            </td>
        </tr>
    </tbody>
</table>

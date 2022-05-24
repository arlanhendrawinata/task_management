<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }

        .td-left {
            text-align: left;
            padding-left: 10px !important;
        }
    </style>

    <title>Cetak Project</title>
</head>

<body>
    <div class="form-group">
        <p align="center"><b>{{ $title }}</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width:95%;">
            <tr>
                <th>No.</th>
                <th>Company</th>
                <th>Client</th>
                <th>Publisher</th>
                <th>Input</th>
                <th>Team</th>
                <th>PIC</th>
                <th>Task</th>
                <th>Target</th>
                <th>Start</th>
                <th>End</th>
                <th>Result</th>
                <th>Detail</th>
                <th>Type</th>
            </tr>
            @forelse($projects as $no=>$item)
            <tr>
                <td class="td-left" style="width: 3%;">{{ $no + 1 }}</td>
                <td class="td-left" style="width: 8%;">
                    {{ $item->clients->companyclients->name }}
                <td class="td-left" style="width: 8%;">
                    {{ $item->clients->nama_client }}
                </td>
                <td class="td-left" style="width: 8%;">{{ $item->users->nama }}
                </td>
                <td class="td-left" style="width: 8%;">
                    @php
                    if ($item->tgl_input != null) {
                    $date_input = date('d/m/y', strtotime($item->tgl_input));
                    echo $date_input;
                    }
                    @endphp
                </td>
                <td class="td-left" style="width: 7%;">
                    {{ $item->divisions->nama_divisi }}
                </td>
                <td class="td-left" style="width: 8%;">
                    @foreach ($pics as $pic)
                    @if ($pic->project_id == $item->id)
                    {{($pic->users->nama) . ',' }}
                    @endif
                    @endforeach
                </td>
                <td class="td-left" style="width: 10%;">
                    {{ ucwords(strtolower($item->judul_project)) }}
                </td>
                <td class="td-left" style="width: 3%;">
                    <?php
                    $dateinput = strtotime($item->tgl_input);
                    $dateestimasi = strtotime($item->estimasi);
                    $secs = $dateestimasi - $dateinput;
                    $dayestimasi = $secs / 86400;
                    echo $dayestimasi;
                    ?>
                </td>
                <td class="td-left" style="width: 5%;">
                    @php
                    if ($item->tgl_mulai != null) {
                    $date_mulai = date('d/m/y', strtotime($item->tgl_mulai));
                    echo $date_mulai;
                    }
                    @endphp
                </td>
                <td class="td-left" style="width: 5%;">
                    @php
                    if ($item->tgl_selesai != null) {
                    $date_selesai = date('d/m/y', strtotime($item->tgl_selesai));
                    echo $date_selesai;
                    }
                    @endphp
                </td>
                <td class="td-left" style="width: 3%;">
                    <?php
                    if ($item->tgl_selesai != null) {
                        $dateselesai = strtotime($item->tgl_selesai);
                        $dateestimasi2 = strtotime($item->estimasi);
                        $secs = $dateestimasi2 - $dateselesai;
                        $dayresult = $secs / 86400;
                        echo $dayresult;
                    } else {
                        echo '-';
                    }
                    ?>
                </td>
                <td class="td-left">
                    {{ Str::limit($item->detail_project, 50) }}
                </td>
                <td style="width: 5%;">{{ $item->type }}</td>
            </tr>
            @empty
            <tr>
                <td>No Datas</td>
            </tr>
            @endforelse
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
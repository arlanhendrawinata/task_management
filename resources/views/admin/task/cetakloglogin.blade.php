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
                <th>Nama</th>
                <th>Email</th>
                <th>IP Address</th>
                <th>Browser</th>
                <th>Login</th>
            </tr>
            @foreach ($Data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->ip_address }}</td>
                <td>{{ $item->browser }}</td>
                <td>{{ $item->created_at }}</td>

            </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
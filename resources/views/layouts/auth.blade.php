<!DOCTYPE html>
<html lang="en" class="h-100">

<!-- Mirrored from koki.dexignzone.com/laravel/demo/page-login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Mar 2022 08:23:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Task Management | {{ $title }} </title>
    <meta name="description" content="Some description for the page" />
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon.png">
    <link href="{{('public/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="h-100">
    @yield('container.auth')
    <script src="{{('public/vendor/global/global.min.js')}}" type="text/javascript"></script>
    <script src="{{('public/vendor/bootstrap-select/dist/js/bootstrap-select.min.')}}" type="text/javascript"></script>
    <script src="{{('public/vendor/chart.js/Chart.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{('public/vendor/apexchart/apexchart.js')}}" type="text/javascript"></script>
    <script src="{{('public/js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{('public/js/deznav-init.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if(session()->has('errors'))
    <script>
        toastr.error('{{ session("errors") }}')

    </script>
    @endif
</body>

<!-- Mirrored from koki.dexignzone.com/laravel/demo/page-login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Mar 2022 08:23:02 GMT -->
</html>

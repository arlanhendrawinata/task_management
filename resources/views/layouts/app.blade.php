<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Task Management | {{ ucwords(strtolower($title)) }} </title>
    <meta name="description" content="Some description for the page" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/images/favicon.png')}}">
    {{--
    <link href="{{ asset('public/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet"
    type="text/css" /> --}}
    <link href="{{ asset('../../../cdn.lineicons.com/2.0/LineIcons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/style(2).css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/css/custom.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
</head>

<style>
    .item {
        background-color: #f5fafd;
        padding: 4px 10px;
    }

    .ts-control input {
        font-size: 0.875rem;
    }

    .ts-control {
        height: 58px;
        border: 1px solid #d7dae3;
        border-radius: 0.75rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 16px;
        font-size: 14px;
    }

    #example_previous,
    #example_next,
    #tableEx_previous,
    #tableEx_next {
        background-color: #0e185f;
    }

    .search-dd {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .td-s3 {
        width: 3% !important;
    }

    .td-s5 {
        width: 5% !important;
    }

    .td-s7 {
        width: 7% !important;
    }

    .td-s8 {
        width: 8% !important;
    }

    .td-s10 {
        width: 10% !important;
    }

    .select2-selection {
        height: 41px !important;
        border: 1px solid #d7dae3 !important;
        border-radius: 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 41px !important;
    }

    .select2-selection__arrow {
        top: 7px !important;
        right: 11px !important;
    }

    @media (max-width: 575px) {
        .search-dd {
            flex-direction: column;
        }

        .search-dd div {
            padding: 10px 0;
        }

        .card-header {
            flex-direction: column;
            justify-content: space-around;
        }

        .td-cstm {
            width: 10px !important;
            padding: 0 !important;
        }
    }

    .search-container {
        width: 100%;
        margin: 0 100px;
    }

    .select2-container--default .select2-selection--single {
        width: 100% !important;
    }

    .search-type,
    .search-prioritas,
    .search-status {
        width: 200px;
    }

    @media (max-width: 576px) {
        .search-container {
            width: 130px;
            margin: 0 10px;
        }

        .navbar-collapse {
            justify-content: none !important;
        }

        .search-type,
        .search-prioritas,
        .search-status {
            width: 200px;
        }
    }

    select option {
        background-color: #ffff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        color: white !important;
        background-color: #0e185f !important;
    }
</style>

<body>
    <div id="main-wrapper">
        @include('layouts.includes.__header')
        @include('layouts.includes.__sidebar')
    </div>

    @if(session()->has('success'))
    <div class=" navbar-expand-lg navbar-dark" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <div class="content-body">
        @yield('container.isi')
    </div>

    <div class="footer">
        <div class="copyright">
            {{-- <p>Copyright © Designed &amp; Developed by GDV</p> --}}
        </div>
    </div>
    <script src="{{ asset('public/vendor/global/global.min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{ asset('public/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"
    type="text/javascript"></script> --}}
    <script src="{{ asset('public/vendor/chart.js/Chart.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/vendor/apexchart/apexchart.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/js/dashboard/dashboard-1.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/js/custom.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/js/deznav-init.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/js/plugins-init/datatables.init.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/js/tn.js')}}"></script>
    <script src="{{ asset('public/js/leadtask.js')}}"></script>
    <script src="{{ asset('public/js/lightbox.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    @yield('scriptjs')

    <!-- <script>
        $(document).ready(function() {
            $("select.select2").select2({
                ajax: {
                    url: "https://api.github.com/search/repositories",
                    dataType: 'json',
                    data: (params) => {
                        return {
                            q: params.term,
                        }
                    },
                    processResults: (data, params) => {
                        console.log(data);
                        const results = data.items.map(item => {
                            return {
                                id: item.id,
                                text: item.full_name || item.name,
                            };
                        });
                        console.log(results);
                        return {
                            results: results,
                        }
                    },
                },
            });

            $(".js-search").select2({
                // templateResult: formatProduct,
                placeholder: "Search anything",
                minimumInputLength: 3,
                delay: 500,
                ajax: {
                    url: "{{ route('global-search') }}",
                    dataType: 'json',
                    data: (params) => {
                        return {
                            q: params.term,
                        }
                    },
                    processResults: function(data, key) {
                        return {
                            results: data
                        };
                    },
                },
            });
            $('.js-search').change(function() {
                var selectedData = $('.js-search').select2('data')[0];
                var selectedDataId = selectedData.id;
                // console.log(selectedData);
                // if (selectedData.type == "Projects") {
                //     window.location.href = "http://127.0.0.1:8000/task/single/" + selectedDataId
                // }
                // if (selectedData.type == "Users") {
                //     window.location.href = "http://127.0.0.1:8000/admin/detailuser" + selectedDataId
                // }

                // console.log(selectedData);
                // console.log($(this).find(':selected').parent());
            })
        });
    </script> -->

    <script>
        new TomSelect('.tom-select-client', {
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        new TomSelect('.tom-select-division', {
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        new TomSelect('.tom-select-status', {
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        $(document).ready(function() {

            $('.js-example-basic-single').select2();

            //auto refresh
            setInterval(function() {
                window.location.reload();
            }, 600000);
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    {{-- Session ALL --}}
    @if(session()->has('success'))
    <script>
        toastr.success('{{ session("success") }}')
    </script>
    @endif

    @if(session()->has('errors'))
    <script>
        toastr.error('{{ session("errors") }}')
    </script>
    @endif

    {{-- lightbox View --}}
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>

    {{-- Profile --}}
    <script>
        function previewImage() {
            const image = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageUsers() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).on('click', '.btn-detail', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                success: function(response) {
                    console.log();
                    $('#detailModal').modal("show");
                    $('#detailBody').html('');
                    $('#detailBody').append(response);
                }
            })
        });

        function checkOldPassword() {

            let oldPassword = document.getElementById("oldPassword").value;

            if (oldPassword != "") {
                document.getElementById('submit').disabled = true;
                checkPassword();

            } else {
                document.getElementById('submit').disabled = false;
                document.getElementById('alertConfirmPassword-false').style.display = 'none';
            }

        }

        function checkPassword() {


            let passwordCP = document.getElementById("password").value;
            let confirmpasswordCP = document.getElementById("confirmPassword").value;



            if (passwordCP == "") {
                document.getElementById('submit').disabled = true;

            } else {
                if (passwordCP != confirmpasswordCP) {
                    document.getElementById('alertConfirmPassword-false').style.display = 'block';
                    document.getElementById('alertConfirmPassword-true').style.display = 'none';
                    document.getElementById('submit').disabled = true;
                    console.log('tidak sama');

                } else if (passwordCP == confirmpasswordCP) {
                    document.getElementById('alertConfirmPassword-false').style.display = 'none';
                    document.getElementById('alertConfirmPassword-true').style.display = 'block';

                    document.getElementById('submit').disabled = false;

                    console.log('true');
                    return true;
                } else if (confirmpasswordCP == "") {
                    document.getElementById('alertConfirmPassword-false').style.display = 'none';
                    document.getElementById('submit').disabled = true;
                }
            }



            if (confirmpasswordCP == "" || passwordCP == "") {
                document.getElementById('alertConfirmPassword-false').style.display = 'none';
                document.getElementById('submit').disabled = true;
            }

            if (confirmpasswordCP == "" && passwordCP == "" && oldPassword == "") {
                document.getElementById('alertConfirmPassword-false').style.display = 'none';
                document.getElementById('submit').disabled = false;
            }
            if (confirmpasswordCP == "" && passwordCP != "") {
                document.getElementById('alertConfirmPassword-false').style.display = 'none';
                document.getElementById('submit').disabled = true;
            }
        }

        const toggleOldPassword = document.querySelector("#toggleOldPassword");
        const oldPassword = document.querySelector("#oldPassword");

        toggleOldPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = oldPassword.getAttribute("type") === "password" ? "text" : "password";
            oldPassword.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const confirmPassword = document.querySelector("#confirmPassword");

        toggleConfirmPassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
            confirmPassword.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });
    </script>

    {{-- Manajemen User --}}
    <script>
        function previewImageUsersCRUD() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';
            imgPreview.style.width = '200px';
            imgPreview.style.height = '200px';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }


        $(document).on('click', '.btn-detail', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                success: function(response) {
                    console.log();
                    $('#detailModal').modal("show");
                    $('#detailBody').html('');
                    $('#detailBody').append(response);
                }
            })
        });

        $(document).on('click', '.btn-editcategory', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                success: function(response) {
                    console.log();
                    $('#editcategory').modal("show");
                    $('#detailBodyEditCategory').html('');
                    $('#detailBodyEditCategory').append(response);
                }
            })
        });

        //toggle password
    </script>

</body>

</html>
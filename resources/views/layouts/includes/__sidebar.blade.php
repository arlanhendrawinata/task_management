<style>
    .nama-menu span {
        color: #ffffff;
        font-size: 12px;
        text-align: center;
        word-wrap: anywhere;
        display: flex;
        justify-content: center;
        margin: 5px 15px;
    }


    /* @media (min-width: 768px) {
        .nama-menu span {
            color: #ffffff;
            font-size: 12px;
            justify-content: center;
            display: flex;
            padding: 0.6rem;
        }
    }

    @media (min-width: 992px) {
        .nama-menu span {
            color: #ffffff;
            font-size: 12px;
            justify-content: center;
            display: flex;
            padding: 0.6rem;
        }
    }

    @media (min-width: 1200px) {
        .nama-menu span {
            color: #ffffff;
            font-size: 12px;
            justify-content: center;
            display: flex;
            padding: 0.6rem;
        }
    }

    @media (min-width: 1200px) {
        .nama-menu span {
            color: #ffffff;
            font-size: 12px;
            padding: 0.6rem 0 0.6rem 1.5rem;
        }
    } */

    .deznav .metismenu {
        padding-bottom: 15px;
    }

    .sidemenu-left-text {
        text-align: left !important;
        justify-content: start !important;
        padding-left: 1rem !important;
        padding-top: 0.5rem !important;
        font-size: 12px !important;
    }



    @media (max-width: 576px) {
        .nama-menu span {
            /* text-align: left !important; */
            justify-content: start !important;
            margin-left: 1.7rem !important;
            padding-top: 0.8rem !important;
            font-size: 12px !important;
            /* border-bottom: 2px solid #08104a; */
            padding-bottom: 5px;
        }

        .sidemenu-left-text {
            padding-left: 2.7rem !important;
        }
    }
</style>


<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <!-- Dashboard -->
            @if(auth()->user()->userDetail->role == 1 || auth()->user()->userDetail->role == 2)
            <li class="@yield('active_dash')">
                <a class="" href="{{route('dashboard')}}" aria-expanded="false" data-bs-toggle="tooltip" data-placement="right" title="Dashboard">
                    <i class="flaticon-381-home-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            @endif

            <!-- Master Data (User, Team, Client) -->
            @if(auth()->user()->userDetail->role == 1)
            <div class="nama-menu">
                <span class="sidemenu-left-text"> Data </span>
            </div>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-id-card-5"></i>
                    <span class="nav-text">User</span>
                </a>
                <ul aria-expanded="false">
                    <li class="@yield('active_user')">
                        <a class="@yield('active_user')" href="{{route('goto-show-dbusers')}}">
                            User
                        </a>
                    </li>
                    <li class="@yield('active_user')">
                        <a class="@yield('active_adduser')" href="{{route('goto-showinsert-dbusers')}}">
                            Add User
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->userDetail->role == 1 || auth()->user()->userDetail->role == 2)
            <!-- Client-->
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-controls-3"></i>
                    <span class="nav-text">Client</span>
                </a>
                <ul aria-expanded="false">
                    <li class="@yield('active_companyclient')">
                        <a class="@yield('active_companyclient')" href="{{route('index-cc')}}">
                            Company
                        </a>
                    </li>
                    <li class="@yield('active_client')">
                        <a class="@yield('active_addclient')" href="{{route('admin-client-tambahclient')}}">
                            Add Client
                        </a>
                    </li>
                    <li class="@yield('active_client')">
                        <a class="@yield('active_client')" href="{{route('admin-client-client')}}">
                            List Client
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Team -->
            <li class="@yield('active_divisi')">
                <a class="" href="{{route('goto-show-dbdivisions')}}" aria-expanded="false" data-bs-toggle="tooltip" data-placement="right" title="Team">
                    <i class="flaticon-381-id-card-2"></i>
                    <span class="nav-text">Team</span>
                </a>
            </li>

            <!-- Task-->
            <div class="nama-menu">
                <span class="sidemenu-left-text"> Task </span>
            </div>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-folder-5"></i>
                    <span class="nav-text">Task</span>
                </a>
                <ul aria-expanded="false">
                    <li class="@yield('active_task')">
                        <a class="@yield('active_addtask')" href="{{route('admin-task-tambah')}}">
                            Add Task
                        </a>
                    </li>
                    <li class="@yield('active_task')">
                        <a class="@yield('active_task')" href="{{route('admin-task-index')}}">
                            Task
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Transaction-->
            <div class="nama-menu">
                <span class="sidemenu-left-text"> Trx </span>
            </div>
            <li class="@yield('active_finance')">
                <a class="@yield('active_finance')" href="{{route('admin-finance-index')}}" aria-expanded="false" data-bs-toggle="tooltip" data-placement="right" title="Transaction">
                    <i class="flaticon-381-id-card"></i>
                    <span class="nav-text">Transaction</span>
                </a>
            </li>

            <!-- Report -->
            <div class="nama-menu">
                <span class="sidemenu-left-text"> Rpt </span>
            </div>
            <li>
                <a class="has-arrow ai-icon" href="#2" aria-expanded="false">
                    <i class="flaticon-381-folder-4"></i>
                    <span class="nav-text">Report</span>
                </a>
                <ul aria-expanded="false">
                    <li class="@yield('#')">
                        <a class="" href="#@3">
                            Report Task
                        </a>
                    </li>
                    <li class="@yield('#')">
                        <a class="" href="#@2">
                            Report Transaction
                        </a>
                    </li>
                    <!-- Login Log-->
                    <li class="@yield('#')">
                        <a class="" href="{{route('goto-show-loglogin')}}">
                            Report Log Login
                        </a>
                    </li>
                </ul>
            </li>
            @endif


            {{-- KETUA DAN ANGGOTA TIM --}}
            @if(auth()->user()->userDetail->role == 3 || auth()->user()->userDetail->role == 4)
            <li class="@yield('active_listtask')">
                <a class="" href="{{route('user-list-task')}}" aria-expanded="false" data-bs-toggle="tooltip" data-placement="right" title="My Task">
                    <i class="flaticon-381-notebook-2"></i>
                    <span class="nav-text">My Task</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->userDetail->role == 3)
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-folder-5"></i>
                    <span class="nav-text">Team Task</span>
                </a>
                <ul aria-expanded="false">
                    <li class="@yield('active_leadtask')">
                        <a class="@yield('active_addleadtask')" href="{{route('lead-task-create')}}">
                            Add Team Task
                        </a>
                    </li>
                    <li class="@yield('active_leadtask')">
                        <a class="@yield('active_leadtask')" href="{{route('lead-task-index')}}">
                            Team Task
                        </a>
                    </li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->userDetail->role == 3 || auth()->user()->userDetail->role == 4)
            <li class="@yield('active_listdiv')">
                <a class="" href="{{ route('goto-myListTeam',['id'=>auth()->user()->id])}}" aria-expanded="false" data-bs-toggle="tooltip" data-placement="right" title="My Team">
                    <i class="flaticon-381-news"></i>
                    <span class="nav-text">My Team</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
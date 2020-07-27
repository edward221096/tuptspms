<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
    <title>TUP-Taguig SPMS</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/fontawesome.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <!-- jQuery -->
    <script src=" {{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <!-- CHART JS -->
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/sidebar/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .main-sidebar{
            width: 270px;
        }

        body, html {
            height: 100%;
            background: white;
        }
    </style>

</head>
<body class="hold-transition sidebar-dark-red sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <!-- For the Logout and Name -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-5">
        <!-- Brand Logo -->
        <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
        <a href="home" class="brand-link">
            <img type="image/png" src="{!! asset('images/tuptlogo.png') !!} " alt="TUP-T Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">TUP-TAGUIG SPMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="width: 270px; !important;">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="mydashboard" class="nav-link">
                                        <i class="fa fa-chart-line nav-icon"></i>
                                        <p>My Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                            @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Division Head' || Auth::User()->role == 'Campus Director')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="ipcrdashboard" class="nav-link">
                                        <i class="fa fa-chart-bar nav-icon"></i>
                                        <p>IPCR Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-chart-area nav-icon"></i>
                                        <p>OPCR Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                                @endif
                        </li>


                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-clone"></i>
                            <p>
                                Evaluation Forms
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="myevaluationforms" class="nav-link">
                                    <i class="fa fa-sticky-note nav-icon"></i>
                                    <p>My Evaluation Forms</p>
                                </a>
                            </li>
                        </ul>
                        @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Section Head'
                        || Auth::User()->role == 'Department Head' || Auth::User()->role == 'Division Head' || Auth::User()->role == 'Campus Director')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="myteamevaluationforms" class="nav-link">
                                        <i class="fa fa-list-ul nav-icon"></i>
                                        <p>My Team Evaluation Forms</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                    @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director' || Auth::User()->role == 'Division Head' ||
                        Auth::User()->role == 'Department Head')
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa fa-user-secret"></i>
                            <p>
                                Admin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @endif
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director')
                                <a href="manageevaluationperiod" class="nav-link">
                                    <i class="fa fa-calendar-alt nav-icon"></i>
                                    <p>Manage Evaluation Period</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manageorganization" class="nav-link">
                                    <i class="fa fa-sitemap nav-icon"></i>
                                    <p>Manage Organization</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="manageevaluationforms" class="nav-link">
                                    <i class="fas fa-edit nav-icon"></i>
                                    <p>Manage Evaluation Forms</p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                    || Auth::User()->role == 'Division Head' || Auth::User()->role == 'Department Head')
                                <a href="employee" class="nav-link">
                                    <i class="fa fa-user-circle nav-icon"></i>
                                    <p>Manage Employee</p>
                                </a>
                                    @endif
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item has-treeview menu-close">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon"></i>
                            <p>
                                IPCR
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                    @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                        @if(Auth::User()->role == 'College Sec - Associate Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrcsassocp" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>College Secretary</p>
                                            <br>
                                            <p>Associate Professor</p>
                                        </a>
                                        @endif
                                    @endforeach
                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'College Sec - Assistant Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrcsassisp" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>College Secretary</p>
                                            <br>
                                            <p>Assistant Professor</p>
                                        </a>
                                                @endif
                                        @endforeach
                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'College Sec - Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrcsprofessor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>College Secretary</p>
                                            <br>
                                            <p>Professor</p>
                                        </a>
                                                @endif
                                        @endforeach
                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'College Sec - Instructor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrcsinstructor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>College Secretary</p>
                                            <br>
                                            <p>Instructor</p>
                                        </a>
                                                @endif
                                        @endforeach
                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Admin Function - Associate Professor'
                                        OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                        Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                        OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfafassocp" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Admin Function</p>
                                            <br>
                                            <p>Associate Professor</p>
                                        </a>
                                                @endif
                                        @endforeach
                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Admin Function - Assistant Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfafassisp" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Admin Function</p>
                                            <br>
                                            <p>Assistant Professor</p>
                                        </a>
                                                @endif
                                        @endforeach

                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Admin Function - Professor'
                                       OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                       Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                       OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfafprofessor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Admin Function</p>
                                            <br>
                                            <p>Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Admin Function - Instructor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfafinstructor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Admin Function</p>
                                            <br>
                                            <p>Instructor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Quasi Function - Associate Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfqfassocp" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Quasi Function</p>
                                            <br>
                                            <p>Associate Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Quasi Function - Assistant Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfqfassisp" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Quasi Function</p>
                                            <br>
                                            <p>Assistant Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Quasi Function - Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfqfprofessor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Quasi Function</p>
                                            <br>
                                            <p>Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Faculty with Quasi Function - Instructor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfqfinstructor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Faculty with Quasi Function</p>
                                            <br>
                                            <p>Instructor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Fulltime - Associate Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfassprofessor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Fulltime Associate Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Fulltime - Assistant Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfastprofessor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Fulltime Assistant Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Fulltime - Professor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfprofessor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Fulltime Professor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Fulltime - Instructor'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Teaching'
                                    OR Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director')
                                        <a href="ipcrfinstructor" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Fulltime Instructor</p>
                                        </a>
                                                @endif
                                        @endforeach


                                        @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                            @if(Auth::User()->role == 'Fulltime - Admin'
                                    OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Section Head' OR
                                    Auth::User()->role == 'Division Head' OR Auth::User()->role == 'Campus Director' OR
                                    Auth::User()->role == 'Department Head' AND $row->type === 'Non-Teaching')
                                        <a href="ipcrfulladmin" class="nav-link">
                                            <i class="far fa-circle navbar-icon"></i>
                                            <p>Fulltime Admin</p>
                                        </a>
                                                @endif
                                        @endforeach
                            </li>
                        </ul>
                    </li>
                    @if(Auth::User()->role == 'Campus Director' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Department Head'
                       || Auth::User()->role == 'Division Head')
                    <li class="nav-item has-treeview menu-close">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon"></i>
                            <p>
                                OPCR
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                @if($row->dept_name == 'Campus Director' || Auth::User()->role == 'Super Admin'
                                        || Auth::User()->role == 'Division Head')
                                    <a href="opcrcampusdirector" class="nav-link">
                                        <i class="far fa-circle navbar-icon"></i>
                                        <p>Campus Director</p>
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'ADAA' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                     || Auth::User()->role == 'Division Head')
                                    <a href="opcradaa" class="nav-link">
                                        <i class="far fa-circle navbar-icon"></i>
                                        <p>ADAA</p>
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'ADAF' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                        || Auth::User()->role == 'Division Head')
                                    <a href="opcradaf" class="nav-link">
                                        <i class="far fa-circle navbar-icon"></i>
                                        <p>ADAF</p>
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'ADRE' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                   || Auth::User()->role == 'Division Head')
                                    <a href="opcradre" class="nav-link">
                                        <i class="far fa-circle navbar-icon"></i>
                                        <p>ADRE</p>
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if($row->type != 'Non-Teaching' ||  Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                    || Auth::User()->role == 'Division Head')
                                    <a href="opcracademics" class="nav-link">
                                        <i class="far fa-circle navbar-icon"></i>
                                        <p>Academics Department</p>
                                    </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                    @if($row->dept_name === 'Accounting' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                    || Auth::User()->role == 'Division Head')
                                <a href="opcraccounting" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Accounting</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'Budget' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrbudget" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Budget</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'Cashier' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                  OR Auth::User()->role == 'Division Head')
                                <a href="opcrcashier" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Cashier</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'IDO' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrido" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>IDO</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'Industry Based' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrindustrybased" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Industry Based</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'Medical Services' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrmedicalserv" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Medical Services</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'PDO' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrpdo" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>PDO</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'Procurement' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrprocurement" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Procurement</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'QAA' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrqaa" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>QAA</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'Records' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                 OR Auth::User()->role == 'Division Head')
                                <a href="opcrrecords" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Records</p>
                                </a>
                                    @endif
                            </li>
                            <li class="nav-item">
                                @if($row->dept_name === 'UITC' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                OR Auth::User()->role == 'Division Head')
                                <a href="opcruitc" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>UITC</p>
                                </a>
                                    @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                        @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                    <div class="col-sm-12">
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}"></a></li>
                        </ol>
                    </div><!-- /.col -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    <!-- /.content-wrapper -->
        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @yield('employee')
                            @yield('manageevaluationforms')
                            @yield('manageorganization')
                            @yield('manageevaluationperiod')
                            @yield('myevaluationforms')
                            @yield('myteamevaluationforms')
                            @yield('ipcrcsassocp')
                            @yield('editipcrcsassocp')
                            @yield('ipcrcsassisp')
                            @yield('ipcrcsinstructor')
                            @yield('ipcrcsprofessor')
                            @yield('ipcrfafassocp')
                            @yield('ipcrfafassisp')
                            @yield('ipcrfafinstructor')
                            @yield('ipcrfafprofessor')
                            @yield('ipcrfqfassocp')
                            @yield('ipcrfqfassisp')
                            @yield('ipcrfqfprofessor')
                            @yield('ipcrfqfinstructor')
                            @yield('ipcrfassprofessor')
                            @yield('ipcrfastprofessor')
                            @yield('ipcrfprofessor')
                            @yield('ipcrfinstructor')
                            @yield('ipcrfulladmin')
                            @yield('opcracademics')
                            @yield('opcraccounting')
                            @yield('opcradaa')
                            @yield('opcradaf')
                            @yield('opcradre')
                            @yield('opcrbudget')
                            @yield('opcrcashier')
                            @yield('opcrido')
                            @yield('opcrindustrybased')
                            @yield('opcrmedicalserv')
                            @yield('opcrpdo')
                            @yield('opcrprocurement')
                            @yield('opcrqaa')
                            @yield('opcrrecords')
                            @yield('opcruitc')
                            @yield('ipcrdashboard')
                            @yield('mydashboard')
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        </div>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
</div>
</div>
</body>

<!-- Menu Toggle Script -->
<script type="text/javascript">
    $(document).ready(function() {
        /** add active class and stay opened when selected */
        var url = window.location;

        // for sidebar menu entirely but not cover treeview
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
    });

    //EDIT MODAL IN MANAGEFUNCTIONSTYPE VIEW
    $('#editfunction').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var func_name = button.data('myfunctionname')
        var func_id = button.data('myfunctionid')
        var modal = $(this)

        modal.find('.modal-body #function_name').val(func_name);
        modal.find('.modal-body #function_id').val(func_id);
    })

    //DELETE MODAL IN MANAGEFUNCTIONSTYPE VIEW
    $('#deletefunction').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var funcid = button.data('myfunctionid')
        var modal = $(this)

        modal.find('.modal-body #funcid').val(funcid);
    })

    //EDIT MODAL IN MANAGE DEPARTMENTS
    $('#editorganization').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var division_id = button.data('mydivisionid')
        var dept_id = button.data('mydeptid')
        var section_id = button.data('mysectionid')
        var division_name = button.data('mydivisionname')
        var dept_name = button.data('mydeptname')
        var section_name = button.data('mysectionname')
        var type = button.data('mytype')
        var modal = $(this)

        modal.find('.modal-body #division_id').val(division_id);
        modal.find('.modal-body #dept_id').val(dept_id);
        modal.find('.modal-body #section_id').val(section_id);
        modal.find('.modal-body #division_name').val(division_name);
        modal.find('.modal-body #dept_name').val(dept_name);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #type').val(type);
    })

    //DELETE MODAL IN MANAGE DEPARTMENTS
    $('#deleteorganization').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var section_id = button.data('mysectionid')
        var modal = $(this)

        modal.find('.modal-body #section_id').val(section_id);
    })

    //EDIT MODAL IN MANAGE FORM TYPE
    $('#editformtype').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var formtype_id = button.data('myformtypeid')
        var form_type = button.data('myformtype')
        var modal = $(this)

        modal.find('.modal-body #formtype_id').val(formtype_id);
        modal.find('.modal-body #form_type').val(form_type);
    })

    //DELETE MODAL IN MANAGE FORM TYPE
    $('#deleteformtype').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)
        var formtype_id = button.data('myformtypeid')
        var modal = $(this)

        modal.find('.modal-body #formtype_id').val(formtype_id);
    })

    //EDIT MODAL IN MANAGE MFO CONTENT
    $('#deletemfo').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var mfoid = button.data('mymfoid');
        var modal = $(this);

        modal.find('.modal-body #mfoid').val(mfoid);
    })

    //EDIT MODAL IN MANAGE EMPLOYEE
    $('#editemployee').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var empid = button.data('myempid');
        var name = button.data('myname');
        var username = button.data('myusername');
        var password = button.data('mypassword')
        var email = button.data('myemail');
        var status = button.data('mystatus')
        var role = button.data('myrole');
        var divisionid = button.data('mydivisionid');
        var deptid = button.data('mydeptid');
        var sectionid = button.data('mysectionid');
        var modal = $(this);

        modal.find('.modal-body #empid').val(empid);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #username').val(username);
        modal.find('.modal-body #password').val(password);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #role').val(role);
        modal.find('.modal-body #divisionid').val(divisionid);
        modal.find('.modal-body #deptid').val(deptid);
        modal.find('.modal-body #sectionid').val(sectionid);
    })

    //DELETE MODAL IN MANAGE EMPLOYEE
    $('#deleteemployee').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var empid = button.data('myempid');
        var modal = $(this);

        modal.find('.modal-body #empid').val(empid);
    })

    //EDIT MY EVALUATION PERIOD
    $('#editevaluationperiod').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var evalperiodid = button.data('myevalperiodid');
        var evalstartdate = button.data('myevalstartdate');
        var evalenddate = button.data('myevalenddate');
        var status = button.data('myevalstatus')
        var modal = $(this);

        modal.find('.modal-body #evalperiodid').val(evalperiodid);
        modal.find('.modal-body #evaluation_startdate').val(evalstartdate);
        modal.find('.modal-body #evaluation_enddate').val(evalenddate);
        modal.find('.modal-body #evaluation_period_status').val(status);
    })

    //DELETE MY EVALUATION PERIOD
    $('#deleteevalperiod').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var evalperiodid = button.data('myevalperiodid');
        var modal = $(this);

        modal.find('.modal-body #evalperiodid').val(evalperiodid);
    })

    //DELETE MY EVALUATION FORM RECORD
    $('#deletemyvaluationform').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var formseqid = button.data('myformseqid');
        var modal = $(this);

        modal.find('.modal-body #form_sequence_id').val(formseqid);
    })
</script>
</html>

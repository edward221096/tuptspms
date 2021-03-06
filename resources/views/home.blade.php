<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
    <title>TUP TAGUIG - SPMS</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/fontawesome.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Signature Pad -->
    <script type="text/javascript" src="{{ asset('/js/signaturepadjquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/signaturepadjquery-ui.min.js') }}"></script>

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
            background-color: #808080; !important
        }

        body, html {
            height: 100%;
            background: white;
        }

    </style>

</head>
<body class="hold-transition sidebar-dark-red sidebar-mini-md">
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
    <aside class="main-sidebar elevation-5">
        <!-- Brand Logo -->
        <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
        <a href="home" class="brand-link">
            <img type="image/png" src="{!! asset('images/tuptlogo.png') !!} " alt="TUP-T Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">TUP TAGUIG - SPMS</span>
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
                                    <p style="color: black;">My Dashboard</p>
                                </a>
                            </li>
                        </ul>
                        @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Division Head' || Auth::User()->role == 'Campus Director')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="ipcrdashboard" class="nav-link">
                                        <i class="fa fa-chart-bar nav-icon"></i>
                                        <p style="color: black;">IPCR Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="opcrdashboard" class="nav-link">
                                        <i class="fa fa-chart-area nav-icon"></i>
                                        <p style="color: black;">OPCR Dashboard</p>
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
                                    <p style="color: black;">My Evaluation Forms</p>
                                </a>
                            </li>
                        </ul>
                        @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Section Head'
                        || Auth::User()->role == 'Department Head' || Auth::User()->role == 'Division Head' || Auth::User()->role == 'Campus Director')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="myteamevaluationforms" class="nav-link">
                                        <i class="fa fa-list-ul nav-icon"></i>
                                        <p style="color: black;">My Team Evaluation Forms</p>
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
                                            <p style="color: black;">Manage Evaluation Period</p>
                                        </a>
                                </li>
                                <li class="nav-item">
                                        <a href="managemultiplier" class="nav-link">
                                            <i class="fa fa-superscript nav-icon"></i>
                                            <p style="color: black;">Manage Form Multiplier</p>
                                        </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manageorganization" class="nav-link">
                                        <i class="fa fa-sitemap nav-icon"></i>
                                        <p style="color: black;">Manage Organization</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="manageevaluationforms" class="nav-link">
                                        <i class="fas fa-edit nav-icon"></i>
                                        <p style="color: black;">Manage Evaluation Forms</p>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    @if(Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                        || Auth::User()->role == 'Division Head' || Auth::User()->role == 'Department Head')
                                        <a href="employee" class="nav-link">
                                            <i class="fa fa-user-circle nav-icon"></i>
                                            <p style="color: black;">Manage Employee</p>
                                        </a>
                                    @endif
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview menu-close">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-newspaper"></i>
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
                                                <p style="color: black;">College Secretary</p>
                                                <br>
                                                <p style="color: black;">Associate Professor</p>
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
                                                <p style="color: black;">College Secretary</p>
                                                <br>
                                                <p style="color: black;">Assistant Professor</p>
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
                                                <p style="color: black;">College Secretary</p>
                                                <br>
                                                <p style="color: black;">Professor</p>
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
                                                <p style="color: black;">College Secretary</p>
                                                <br>
                                                <p style="color: black;">Instructor</p>
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
                                                <p style="color: black;">Faculty with Admin Function</p>
                                                <br>
                                                <p style="color: black;">Associate Professor</p>
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
                                                <p style="color: black;">Faculty with Admin Function</p>
                                                <br>
                                                <p style="color: black;">Assistant Professor</p>
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
                                                <p style="color: black;">Faculty with Admin Function</p>
                                                <br>
                                                <p style="color: black;">Professor</p>
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
                                                <p style="color: black;">Faculty with Admin Function</p>
                                                <br>
                                                <p style="color: black;">Instructor</p>
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
                                                <p style="color: black;">Faculty with Quasi Function</p>
                                                <br>
                                                <p style="color: black;">Associate Professor</p>
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
                                                <p style="color: black;">Faculty with Quasi Function</p>
                                                <br>
                                                <p style="color: black;">Assistant Professor</p>
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
                                                <p style="color: black;">Faculty with Quasi Function</p>
                                                <br>
                                                <p style="color: black;">Professor</p>
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
                                                <p style="color: black;">Faculty with Quasi Function</p>
                                                <br>
                                                <p style="color: black;">Instructor</p>
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
                                                <p style="color: black;">Fulltime Associate Professor</p>
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
                                                <p style="color: black;">Fulltime Assistant Professor</p>
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
                                                <p style="color: black;">Fulltime Professor</p>
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
                                                <p style="color: black;">Fulltime Instructor</p>
                                            </a>
                                        @endif
                                    @endforeach


                                    @foreach(\App\Http\Controllers\IpcrController::getUserDepartmentName() as $row)
                                        @if($row->type == 'Non-Teaching' OR $row->type == 'Admin' OR Auth::User()->role == 'Fulltime - Admin'
                                AND Auth::User()->role == 'Super Admin' AND Auth::User()->role == 'Section Head' OR
                                Auth::User()->role == 'Division Head' AND Auth::User()->role == 'Campus Director' AND
                                Auth::User()->role == 'Department Head')
                                            <a href="ipcrfulladmin" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Fulltime Admin</p>
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
                                    <i class="nav-icon fab fa-wpforms"></i>
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
                                                    <p style="color: black;">Campus Director</p>
                                                </a>
                                            @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'ADAA' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                             || Auth::User()->role == 'Division Head')
                                            <a href="opcradaa" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">ADAA</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'ADAF' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                                || Auth::User()->role == 'Division Head')
                                            <a href="opcradaf" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">ADAF</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'ADRE' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                           || Auth::User()->role == 'Division Head')
                                            <a href="opcradre" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">ADRE</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->type != 'Non-Teaching' ||  Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                            || Auth::User()->role == 'Division Head')
                                            <a href="opcracademics" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Academics Department</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Accounting' || Auth::User()->role == 'Super Admin' || Auth::User()->role == 'Campus Director'
                                        || Auth::User()->role == 'Division Head')
                                            <a href="opcraccounting" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Accounting</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Budget' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrbudget" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Budget</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Cashier' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                          OR Auth::User()->role == 'Division Head')
                                            <a href="opcrcashier" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Cashier</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'IDO' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrido" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">IDO</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Industry Based' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrindustrybased" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Industry Based</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Medical Service' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrmedicalserv" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Medical Services</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'PDO' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrpdo" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">PDO</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Procurement' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrprocurement" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Procurement</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'QAA' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrqaa" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">QAA</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'Records' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                         OR Auth::User()->role == 'Division Head')
                                            <a href="opcrrecords" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">Records</p>
                                            </a>
                                        @endif
                                    </li>
                                    <li class="nav-item">
                                        @if($row->dept_name === 'UITC' OR Auth::User()->role == 'Super Admin' OR Auth::User()->role == 'Campus Director'
                                        OR Auth::User()->role == 'Division Head')
                                            <a href="opcruitc" class="nav-link">
                                                <i class="far fa-circle navbar-icon"></i>
                                                <p style="color: black;">UITC</p>
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
                                <p style="font-weight: bold"> Welcome to Technological University of the Philippines - Taguig Strategic Performance Management System (SPMS)</p>
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
                                @yield('opcrcampusdirector')
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
                                @yield('opcrdashboard')
                                @yield('mydashboard')
                                @yield('managemultiplier')
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <p style="font-weight: bold">Done using the system?</p>
                            <div>
                                Help us by answering the Post Survey form. By clicking this <a href="https://docs.google.com/forms/d/e/1FAIpQLSdlaG6t1LwNIegypZlSjWpst-___ui4Zp-bQoQPbThTHtrFTA/viewform"><u style="font-size: 12pt; font-weight: bolder">Link</u></a>
                                <br>
                            </div>
                        </div>

                        <div class="card">
                            <p style="font-weight: bold">AS A NORMAL USER (FACULTY OR STAFF)</p>
                            1. Please wait for the evaluation period to OPEN by Planning Officer before answering the IPCR form based on your role
                            <br>
                            2. If the evaluation period is OPEN. You can navigate to: <u style="font-style: italic;">IPCR > IPCR Form based on Role</u>
                            3. If you are done with the evaluation. You can check the previous, recent and status of your evaluation forms. Navigate to:
                            <u style="font-style: italic;">Evaluation Forms > My Evaluation Forms</u>
                            4. If you want to check the graph of your previous and recent IPCR and OPCR Ratings (If any). You can navigate to:
                            <u style="font-style: italic;">Dashboard > My Dashboard</u>
                            <br>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <p style="font-weight: bold;">AS A SECTION HEAD</p>
                            1. Please wait for the evaluation period to OPEN by Planning Officer before answering the IPCR form based on your role
                            <br>
                            2. If the evaluation period is OPEN. You can navigate to: <u style="font-style: italic;">IPCR > IPCR Form based on Role</u>
                            3. If you want to see the previous and recent evaluation forms and its status then navigate to: <u style="font-style: italic;">Evaluation Forms > My Evaluation Forms</u>
                            4. If you want to see the evaluation forms of faculty/staff under you then navigate to:  <u style="font-style: italic;">Evaluation Forms > My Team Evaluation Forms</u>
                            5. If you want to check the graph of your previous and recent IPCR and OPCR Ratings (If any). You can navigate to:
                            <u style="font-style: italic;">Dashboard > My Dashboard</u>
                            <br>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <p style="font-weight: bold;">AS A DEPARTMENT HEAD</p>
                            1. If the evaluation period is OPEN. You can navigate to: <u style="font-style: italic;">IPCR > IPCR Form based on Role</u> or <u style="font-style: italic;">OPCR > OPCR Form based on your Department</u>
                            2. If you want to see the previous and recent evaluation forms and its status then navigate to: <u style="font-style: italic;">Evaluation Forms > My Evaluation Forms</u>
                            3. If you want to see the evaluation forms of faculty/staff under you then navigate to:  <u style="font-style: italic;">Evaluation Forms > My Team Evaluation Forms</u>
                            4. If you want to manage employee user accounts as well as account approval then navigate to: <u style="font-style: italic;">Admin > Manage Employee</u>
                            5. If you want to check the graph of your previous and recent IPCR and OPCR Ratings (If any). You can navigate to:
                            <u style="font-style: italic;">Dashboard > My Dashboard</u>
                            <br>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <p style="font-weight: bold;">AS A DIVISION HEAD</p>
                            1. If the evaluation period is OPEN. You can navigate to: <u style="font-style: italic;">IPCR > IPCR Form based on Role</u> or <u style="font-style: italic;">OPCR > OPCR Form based on your Department</u>
                            2. If you want to see the previous and recent evaluation forms and its status then navigate to: <u style="font-style: italic;">Evaluation Forms > My Evaluation Forms</u>
                            3. If you want to see the evaluation forms of faculty/staff under you then navigate to:  <u style="font-style: italic;">Evaluation Forms > My Team Evaluation Forms</u>
                            4. If you want to manage employee user accounts as well as account approval then navigate to: <u style="font-style: italic;">Admin > Manage Employee</u>
                            5. If you want to check the graph of your previous and recent IPCR and OPCR Ratings (If any). You can navigate to:
                            <u style="font-style: italic;">Dashboard > My Dashboard</u>
                            6. If you want to check the simple Analytics related with the IPCR Forms then navigate to <u style="font-style: italic;">Dashboard > IPCR Dashboard</u>
                            7. If you want to check the simple Analytics related with the OPCR Forms then navigate to <u style="font-style: italic;">Dashboard > OPCR Dashboard</u>
                            <br>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <p style="font-weight: bold">AS A CAMPUS DIRECTOR OR PLANNING OFFICER</p>
                            1. If the evaluation period is OPEN. You can navigate to: <u style="font-style: italic;">IPCR > IPCR Form based on Role</u> or <u style="font-style: italic;">OPCR > OPCR Form based on your Role</u>
                            2. If you want to see the previous and recent evaluation forms and its status then navigate to: <u style="font-style: italic;">Evaluation Forms > My Evaluation Forms</u>
                            3. If you want to see the evaluation forms of faculty/staff under you then navigate to:  <u style="font-style: italic;">Evaluation Forms > My Team Evaluation Forms</u>
                            4. If you want to manage evaluation period uthen navigate to: <u style="font-style: italic;">Admin > Manage Evaluation Period</u>
                            4. If you want to manage organization (Divisions, Departments and Sections) then navigate to: <u style="font-style: italic;">Admin > Manage Organization</u>
                            4. If you want to manage evaluation form questions and content then navigate to: <u style="font-style: italic;">Admin > Manage Evaluation Forms</u>
                            4. If you want to manage employee user accounts as well as account approval then navigate to: <u style="font-style: italic;">Admin > Manage Employee</u>
                            5. If you want to check the graph of your previous and recent IPCR and OPCR Ratings (If any). You can navigate to:
                            <u style="font-style: italic;">Dashboard > My Dashboard</u>
                            6. If you want to check the simple Analytics related with the IPCR Forms then navigate to <u style="font-style: italic;">Dashboard > IPCR Dashboard</u>
                            7. If you want to check the simple Analytics related with the OPCR Forms then navigate to <u style="font-style: italic;">Dashboard > OPCR Dashboard</u>
                            <br>
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
<<<<<<< HEAD
<<<<<<< HEAD
<!-- POST SURVEY MODAL CONFIRMATION -->
<div class="modal fade" id="postsurveymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Survey Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Did you already answer our Post Survey questions?</h6>
            </div>
            <div class="modal-footer">
                <a href="https://docs.google.com/forms/d/e/1FAIpQLSdlaG6t1LwNIegypZlSjWpst-___ui4Zp-bQoQPbThTHtrFTA/viewform"
                   class="btn btn-sm btn-outline-secondary">Not yet</a>
                <a class="btn btn-sm btn-outline-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        </div>
    </div>
</div>

=======
>>>>>>> 9b1f7ef... After logout redirect to post survey form
=======
>>>>>>> master
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

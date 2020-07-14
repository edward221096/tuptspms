<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
    <title>TUP-Taguig SPMS</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }} ">
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

{{--    <script src="{{asset('jquery/jquery.min.js')}}"></script>--}}
{{--    <script src="{{asset('js/app.js')}}"></script>--}}

<!-- Bootstrap core CSS -->
    <link href="{{ asset('css/sidebar/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .main-sidebar{
            width: 265px;
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
        <div class="sidebar" style="width: 265px; !important;">

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
                    </li>

                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
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
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-list-ul nav-icon"></i>
                                    <p>My Team Evaluation Forms</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fa fa-user-secret"></i>
                            <p>
                                Admin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
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
                            <li class="nav-item">
                                <a href="employee" class="nav-link">
                                    <i class="fa fa-user-circle nav-icon"></i>
                                    <p>Manage Employee</p>
                                </a>
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
                                <a href="ipcrcsassocp" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>College Secretary</p>
                                    <br>
                                    <p>Associate Professor</p>
                                </a>
                                <a href="ipcrcsassisp" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>College Secretary</p>
                                    <br>
                                    <p>Assistant Professor</p>
                                </a>
                                <a href="ipcrcsprofessor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>College Secretary</p>
                                    <br>
                                    <p>Professor</p>
                                </a>
                                <a href="ipcrcsinstructor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>College Secretary</p>
                                    <br>
                                    <p>Instructor</p>
                                </a>
                                <a href="ipcrfafassocp" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Admin Function</p>
                                    <br>
                                    <p>Associate Professor</p>
                                </a>
                                <a href="ipcrfafassisp" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Admin Function</p>
                                    <br>
                                    <p>Assistant Professor</p>
                                </a>
                                <a href="ipcrfafprofessor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Admin Function</p>
                                    <br>
                                    <p>Professor</p>
                                </a>
                                <a href="ipcrfafinstructor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Admin Function</p>
                                    <br>
                                    <p>Instructor</p>
                                </a>
                                <a href="ipcrfqfassocp" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Quasi Function</p>
                                    <br>
                                    <p>Associate Professor</p>
                                </a>
                                <a href="ipcrfqfassisp" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Quasi Function</p>
                                    <br>
                                    <p>Assistant Professor</p>
                                </a>
                                <a href="ipcrfqfprofessor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Quasi Function</p>
                                    <br>
                                    <p>Professor</p>
                                </a>
                                <a href="ipcrfqfinstructor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Faculty with Quasi Function</p>
                                    <br>
                                    <p>Instructor</p>
                                </a>
                                <a href="ipcrfassprofessor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Fulltime Associate Professor</p>
                                </a>
                                <a href="ipcrfastprofessor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Fulltime Assistant Professor</p>
                                </a>
                                <a href="ipcrfprofessor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Fulltime Professor</p>
                                </a>
                                <a href="ipcrfinstructor" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Fulltime Instructor</p>
                                </a>
                                <a href="ipcrfulladmin" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Fulltime Admin</p>
                                </a>
                            </li>
                        </ul>
                    </li>
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
                                <a href="opcraccounting" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Accounting</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcradre" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>ADRE</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrbudget" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Budget</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrcashier" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Cashier</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrido" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>IDO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrindustrybased" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Industry Based</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrmedicalserv" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Medical Services</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrpdo" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>PDO</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrprocurement" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Procurement</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrqaa" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>QAA</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcrrecords" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>Records</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="opcruitc" class="nav-link">
                                    <i class="far fa-circle navbar-icon"></i>
                                    <p>UITC</p>
                                </a>
                            </li>
                        </ul>
                    </li>
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
                                <br>
                                <p style="font-weight: bold">As a normal user (Faculty or Staff):</p>
                                1. Please wait for the evaluation period to be OPEN by Planning Department before answering the IPCR forms based on your role
                                <br>
                                2. If the evaluation period is OPEN. You can navigate to IPCR then click the form based on your role to start the evaluation
                                <br>
                                3. If you are done with the evaluation. You can navigate to Evaluation Forms > My Evaluation Forms to see the previous and recent evaluation forms and its status
                                <br>
                                <br>
                                <p style="font-weight: bold">As a Section Head and Above</p>
                                1. You can go to My Team Evaluation Forms to check your OPCR and IPCR forms as well as the IPCR form of your team
                                <br>
                                2. You can manage employee to change the basic information of each users and their respective division, department, section and account status
                                <br>
                                <br>
                                <p style="font-weight: bold">As a Planning Officer</p>
                                1. You can navigate to Admin > Manage Evaluation Period to set evaluation period start and end date and status
                                <br>
                                2. You can navigate to Manage > Organization > to view, add, edit and delete organization (Division, Department, Section)
                                <br>
                                3. You can navigate to Manage Evaluation Forms to view, add, edit and delete content or questions for each evaluation forms
                                <br>
                                4. You can manage employee to change the basic information of each users and their respective division, department, section and account status

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
                                @yield('opcraccounting')
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->
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
        var modal = $(this)

        modal.find('.modal-body #division_id').val(division_id);
        modal.find('.modal-body #dept_id').val(dept_id);
        modal.find('.modal-body #section_id').val(section_id);
        modal.find('.modal-body #division_name').val(division_name);
        modal.find('.modal-body #dept_name').val(dept_name);
        modal.find('.modal-body #section_name').val(section_name);
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
</script>
</html>

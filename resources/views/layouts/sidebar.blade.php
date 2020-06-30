<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
    <title>TUP-Taguig SPMS</title>

    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/sidebar/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->


    <style>
        body {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            -webkit-transition: margin .25s ease-out;
            -moz-transition: margin .25s ease-out;
            -o-transition: margin .25s ease-out;
            transition: margin .25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
    </style>

</head>
<body>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Navigation </div>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action bg-light">User Profile</a>
            <a href="manageorganization" class="list-group-item list-group-item-action bg-light">Manage Organization</a>
            <a href="manageformtype" class="list-group-item list-group-item-action bg-light">Manage Form Type</a>
            <a href="managefunctionstype" class="list-group-item list-group-item-action bg-light">Manage Functions</a>
            <a href="manageevaluationforms" class="list-group-item list-group-item-action bg-light">Manage Evaluation Forms</a>
            <a href="employee" class="list-group-item list-group-item-action bg-light">Manage Employee</a>
            <a href="#evaluationforms" data-toggle="collapse" aria-expanded="false" class="bg-light list-group-item list-group-item-action flex-column align-items-start">
                <span class="menu-collapsed">Evaluation Forms</span>
            </a>
            <!-- Submenu content -->
            <div id='evaluationforms' class="collapse sidebar-submenu">
                <!-- ADD THE IPCR FORM SIDEBAR HERE -->
                <a href="ipcrcsassocp" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (College Sec - Associate Professor)</span>
                </a>
                <a href="ipcrcsassisp" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (College Sec - Assistant Professor)</span>
                </a>
                <a href="ipcrcsprofessor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (College Sec - Professor)</span>
                </a>
                <a href="ipcrcsinstructor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (College Sec - Instructor)</span>
                </a>
                <a href="ipcrfafassocp" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Admin Function - Associate Professor)</span>
                </a>
                <a href="ipcrfafassisp" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Admin Function - Assistant Professor)</span>
                </a>
                <a href="ipcrfafinstructor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Admin Function - Instructor)</span>
                </a>
                <a href="ipcrfafprofessor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Admin Function - Professor)</span>
                </a>
                <a href="ipcrfqfassocp" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Quasi Function - Associate Professor)</span>
                </a>
                <a href="ipcrfqfassisp" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Quasi Function - Assistant Professor)</span>
                </a>

                <a href="ipcrfqfprofessor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Quasi Function - Professor)</span>
                </a>

                <a href="ipcrfqfinstructor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Faculty with Quasi Function - Instructor)</span>
                </a>

                <a href="ipcrfassprofessor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Fulltime - Associate Professor)</span>
                </a>

                <a href="ipcrfastprofessor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Fulltime - Assistant Professor)</span>
                </a>

                <a href="ipcrfprofessor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Fulltime - Professor)</span>
                </a>

                <a href="ipcrfinstructor" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Fulltime - Instructor)</span>
                </a>

                <a href="ipcrfulladmin" class="list-group-item list-group-item-action bg-light">
                    <span class="menu-collapsed">IPCR (Fulltime - Admin)</span>
                </a>
            </div>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Navigation</button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
            </div>
        </nav>

    @yield('employee')
    @yield('manageevaluationforms')
    @yield('manageformtype')
    @yield('managefunctionstype')
    @yield('manageorganization')
    @yield('ipcrcsassocp')
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

    <!-- /#page-content-wrapper -->

    </div>
</div>
</body>

<!-- Menu Toggle Script -->
<script type="text/javascript">



    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    // Hide submenus
    $('#body-row .collapse').collapse('hide');

    // Collapse/Expand icon
    $('#collapse-icon').addClass('fa-angle-double-left');

    // Collapse click
    $('[data-toggle=sidebar-colapse]').click(function() {
        SidebarCollapse();
    });

    <!-- FOR MODAL JQUERY -->
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


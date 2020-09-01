@extends('layouts.sidebar')
@section('employee')
    <style>
        .alert{
            width: 100%;
        }
    </style>
    <div class="container-fluid">
        @if(session()->has('postmessage'))
            <div class="row">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <strong>Information: </strong> {{ session()->get('postmessage') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="row">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    @foreach ($errors->all() as $error)
                        <li>
                            <strong>Error: </strong> {{ $error }}
                        </li>
                    @endforeach
                </div>
            </div>
        @endif
        @if(session()->has('updatemessage'))
            <div class="row">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <strong>Information: </strong> {{ session()->get('updatemessage') }}
                </div>
            </div>
        @endif
        @if(session()->has('deletemessage'))
            <div class="row">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <strong>Information: </strong> {{ session()->get('deletemessage') }}
                </div>
            </div>
        @endif
    </div>
    <div class="container-fluid">
        <h3 class="mt-4">TUP-Taguig Employees</h3>
        <p>Manage Employee Information</p>

        <!-- SEARCH EMPLOYEE -->
        <label>Search for Employee</label>
        <form action="/searchemployee" method="GET">
            <div class="input-group">
                <input type="search" class="form-control form-control-sm" name="search"
                       placeholder="Search">
                <span class="input-group-prepend">
                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                            Search
                        </button>
                    <a href="{{route('employee.index')}}" class="btn btn-sm btn-outline-info">Clear Search</a>
                    </span>
            </div>
        </form>
        <!-- SHOW DATA IN A TABLE-->
        <table class="table table-striped" style="font-size: 11pt;">
            <thead>
            <tr>
                <th>NAME</th>
                <th>USERNAME</th>
                <th>ROLE</th>
                <th>SECTOR/DIVISION</th>
                <th>COLLEGE /DEPARTMENT /OFFICE</th>
                <th>AREA/SECTION</th>
                <th>ACCOUNT STATUS</th>
                <th>ACTIONS</th>
            </tr>
            </thead>

            <tbody>
            @foreach($employee as $row)
                <tr>
                    <td style ="word-wrap: break-word;">{{$row->name}}</td>
                    <td style ="word-wrap: break-word;">{{$row->username}}</td>
                    <td style ="word-wrap: break-word;">{{$row->role}}</td>
                    <td style ="word-wrap: break-word;">{{$row->division_name}}</td>
                    <td style ="word-wrap: break-word;">{{$row->dept_name}}</td>
                    <td style ="word-wrap: break-word;">{{$row->section_name}}</td>
                    @if($row->status == 'Account Approved')
                        <td style ="word-wrap: break-word; color: green;">{{$row->status}}</td>
                        @else
                        <td style ="word-wrap: break-word; color: red;">{{$row->status}}</td>
                    @endif
                    <td>
                        <form action="employee/{{$row->id}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <a href="#" class="btn btn-secondary btn-sm"
                               data-myempid="{{$row->id}}"
                               data-myname="{{$row->name}}"
                               data-myusername="{{$row->username}}"
                               data-myemail="{{$row->email}}"
                               data-myrole="{{$row->role}}"
                               data-mystatus="{{$row->status}}"
                               data-mydivisionid="{{$row->division_id}}"
                               data-mysectionid="{{$row->section_id}}"
                               data-mydeptid="{{$row->dept_id}}"
                               data-toggle="modal" data-target="#editemployee">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm"
                           data-myempid="{{$row->id}}"
                           data-toggle="modal" data-target="#deleteemployee">Delete</a>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$employee->links()}}
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editemployee" tabindex="-1" role="dialog" aria-labelledby="editemployeelabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editemployeelabel">Edit Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('employee.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="empid" id="empid">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control form-control-sm" name="name"
                                       placeholder="Full Name" required autocomplete="name" id="name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="Username">Username</label>
                                <input type="text" class="form-control form-control-sm" name="username"
                                       placeholder="Username" required autocomplete="Username" id="username">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="email">E-mail Address</label>
                                <input type="text" class="form-control form-control-sm" name="email"
                                       placeholder="E-mail Address" required autocomplete="email" id="email">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="status">Account Status</label>
                                <select name="status" class="form-control form-control-sm" id="status">
                                    <option>Account Pending</option>
                                    <option>Account Approved</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm" id="role">
                                    <option readonly>Select a Role</option>
                                    <option disabled style="font-weight: bolder;">ADMIN ROLE</option>
                                    <option>Super Admin</option>
                                    <option disabled style="font-weight: bolder;">HEAD ROLES</option>
                                    <option>Campus Director</option>
                                    <option>Division Head</option>
                                    <option>Department Head</option>
                                    <option>Section Head</option>
                                    <option disabled style="font-weight: bolder;">FACULTY ROLES</option>
                                    <option>College Sec - Associate Professor</option>
                                    <option>College Sec - Assistant Professor</option>
                                    <option>College Sec - Professor</option>
                                    <option>College Sec - Instructor</option>
                                    <option>Faculty with Admin Function - Associate Professor</option>
                                    <option>Faculty with Admin Function - Assistant Professor</option>
                                    <option>Faculty with Admin Function - Professor</option>
                                    <option>Faculty with Admin Function - Instructor</option>
                                    <option>Faculty with Quasi Function - Associate Professor</option>
                                    <option>Faculty with Quasi Function - Assistant Professor </option>
                                    <option>Faculty with Quasi Function - Professor</option>
                                    <option>Faculty with Quasi Function - Instructor</option>
                                    <option>Fulltime - Associate Professor</option>
                                    <option>Fulltime - Assistant Professor</option>
                                    <option>Fulltime - Professor</option>
                                    <option>Fulltime - Instructor</option>
                                    <option disabled style="font-weight: bolder;">STAFF ROLE</option>
                                    <option>Fulltime - Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="division">Division</label>
                                <select name="division_id" class="form-control form-control-sm" id="divisionid">
                                    @foreach(App\Division::orderBy('id')->distinct()->get() as $divisions)
                                        <option value="{{$divisions->id}}">{{$divisions->division_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="department">Department</label>
                                <select name="dept_id" class="form-control form-control-sm" id="deptid">
                                        <option disabled style="font-weight: bolder;">ADAA RELATED DEPARTMENTS</option>
                                    @foreach(App\Department::orderBy('dept_name')
                                          ->whereIn('dept_name', ['Electrical and Allied Department',
                                          'Civil and Allied Department', 'Mechanical and Allied Department',
                                          'Bachelors of Engineering Department', 'Basic Arts and Sciences Department (BASD)', 'ADAA', 'Office of Student Affairs'])->get() as $department)
                                        <option value="{{$department->id}}">{{$department->dept_name}}</option>
                                    @endforeach
                                        <option disabled style="font-weight: bolder;">ADAF RELATED DEPARTMENTS</option>
                                    @foreach(App\Department::orderBy('dept_name')
                                          ->whereIn('type', ['Non-Teaching'])->where('dept_name', '!=', 'ADRE')->get() as $department)
                                        <option value="{{$department->id}}">{{$department->dept_name}}</option>
                                    @endforeach
                                        <option disabled style="font-weight: bolder;">ADRE RELATED DEPARTMENTS</option>
                                    @foreach(App\Department::orderBy('dept_name')->where('dept_name', '=', 'ADRE')->get() as $department)
                                        <option value="{{$department->id}}">{{$department->dept_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="section">Area/Section</label>
                                <select name="section_id" class="form-control form-control-sm" id="sectionid">
                                        <option disabled style="font-weight: bolder;">TEACHING AREA/SECTIONS</option>
                                    @foreach(App\Section::orderBy('section_name')->whereIn('dept_id', ['2', '3', '4', '5'])->get() as $section)
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    @endforeach
                                        <option disabled style="font-weight: bolder;">NON-TEACHING AREA/SECTIONS</option>
                                    @foreach(App\Section::orderBy('section_name')->wherenotIn('dept_id', ['1','2','3','4','5'])->wherenotIn('section_name', ['Academics', 'Academics Section'])->get() as $section)
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteemployee" tabindex="-1" role="dialog" aria-labelledby="deleteemployeelabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteemployeelabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('employee.destroy', 'test')}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="modal-body">
                        <label style="font-weight: normal;">Please confirm if you want to delete this Employee information</label>
                        <input type="hidden" name="empid" id="empid">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<style>


</style>
@extends('layouts.sidebar')
@section('employee')

    <div class="container-fluid">
        <h3 class="mt-4">Manage Employees</h3>
        <p>Employee Table</p>
        <!-- SHOW DATA IN A TABLE-->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>E-Mail Address</th>
                <th>Role</th>
                <th>Division Name</th>
                <th>Department Name</th>
                <th>Area/Section Name</th>
                <th>Account Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($employee as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->username}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->role}}</td>
                    <td>{{$row->division_name}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->section_name}}</td>
                    <td>{{$row->status}}</td>
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
                <form action="{{route('employee.update', [$row->id])}}" method="POST">
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
                                    <option>Super Admin</option>
                                    <option>Division Head</option>
                                    <option>Department Head</option>
                                    <option>Division Head</option>
                                    <option selected>Staff</option>
                                    <option disabled style="font-weight: bold">FACULTY WITH FUNCTION</option>
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
                                    @foreach(App\Department::orderBy('dept_name')->get() as $department)
                                        <option value="{{$department->id}}">{{$department->dept_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="section">Area/Section</label>
                                <select name="section_id" class="form-control form-control-sm" id="sectionid">
                                    @foreach(App\Section::orderBy('section_name')->get() as $section)
                                        <option value="{{$section->id}}">{{$section->section_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Close</button>
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
                <form action="employee/{{$row->id}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="modal-body">
                        <label>Please confirm if you want to delete this Employee information</label>
                        <input type="hidden" name="empid" id="empid">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Employee Information</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/sidebar/bootstrap.min.css') }}" rel="styl esheet">

    <style>
        body {
            overflow-x: hidden;
        }
    </style>

    <div class="main_content">
    <div class="info">
        <div class="container-fluid">
            <h1 class="mt-4">Edit Employees</h1>
            <form action="{{route('employee.update', [$employee->id])}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Full Name" required autocomplete="name"
                           value="{{$employee->name}}">
                </div>

                    <div class="form-group col-md-12">
                        <label for="name">Username</label>
                        <input type="text" class="form-control form-control-sm" name="username" placeholder="Full Name" required autocomplete="username"
                               value="{{$employee->username}}">

                    </div>
                    <div class="form-group col-md-12">
                            <label for="name">E-mail Address</label>
                            <input type="text" class="form-control form-control-sm" name="email" placeholder="Full Name" required autocomplete="email"
                                   value="{{$employee->email}}">
                    </div>

                <div class="form-group col-md-12">
                    <label for="role">Role</label>
                    <select name="role" class="form-control form-control-sm">
                        <option value="{{$employee->role}}">{{$employee->role}}</option>
                        <option>Division Head</option>
                        <option>Department Head</option>
                        <option>Division Head</option>
                        <option>Staff</option>
                        <option disabled style="font-weight: bold">FACULTY</option>
                        <option>Instructor I</option>
                        <option>Instructor II</option>
                        <option>Instructor III</option>
                        <option>Asst. Professor I</option>
                        <option>Asst. Professor II</option>
                        <option>Asst. Professor III</option>
                        <option>Asst. Professor IV</option>
                        <option>Associate Professor I</option>
                        <option>Associate Professor II</option>
                        <option>Associate Professor III</option>
                        <option>Associate Professor IV</option>
                        <option>Associate Professor V</option>
                        <option>Professor I</option>
                        <option>Professor II</option>
                        <option>Professor III</option>
                        <option>Professor IV</option>
                        <option>Professor V</option>
                        <option>Professor VI</option>
                    </select>
                </div>

                <div class="form-label-group col-md-12">
                    <label for="department">Department</label>
                    <select name="dept_id" class="form-control form-control-sm" value="text">
                        @foreach(App\Organization::orderBy('dept_name')->get() as $department)
                            <option value="{{$department->id}}">{{$department->dept_name}}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <br>
                <div class="form-group pull-right">
                    <a class="btn btn-default btn-close" href="{{ __('/employee') }}">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</head>
</html>


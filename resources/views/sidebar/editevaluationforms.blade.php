<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TUP-Taguig SPMS</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/sidebar/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
        }
    </style>



    <div class="main_content">
        <div class="info">
            <div class="container-fluid">
                <h3 class="mt-4">Edit Evaluation Form Data</h3>
                <form method="POST" action="{{action('MfoController@update', $id)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PATCH"/>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="form" style="font-weight: bold">Form</label>
                            <select name="form_type" class="form-control form-control-sm">
                                <!-- GET THE CURRENT DATA IN DROP DOWN -->
                                @foreach(App\Form::orderBy('id')->where('id', '=', $mfo->form_id)->get() as $selectedformtype)
                                    <option selected>{{$selectedformtype->form_type}}</option>
                                    @endforeach

                                @foreach(App\Form::orderBy('id')->get() as $form)
                                    <option>{{$form->form_type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="function" style="font-weight: bold">Function</label>
                            <select name="function_name" id="function_name" class="form-control form-control-sm">
                                <!-- GET THE CURRENT DATA IN DROP DOWN -->
                                @foreach(App\FunctionType::orderBy('id')->where('id', '=', $mfo->function_id)->get() as $selectedfunctiontype)
                                    <option selected>{{$selectedfunctiontype->function_name}}</option>
                                @endforeach
                                @foreach(App\FunctionType::orderBy('id')->get() as $functiontype)
                                    <option>{{$functiontype->function_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="department" style="font-weight: bold">Department</label>
                            <select name="dept_name" id="dept_name" class="form-control form-control-sm">
                                <!-- GET THE CURRENT DATA IN DROP DOWN -->
                                @foreach(App\Department::orderBy('id')->where('id', '=', $mfo->dept_id)->get() as $selecteddeptname)
                                    <option selected>{{$selecteddeptname->dept_name}}</option>
                                @endforeach
                                @foreach(App\Department::orderBy('id')->get() as $department)
                                    <option>{{$department->dept_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="role" style="font-weight: bold">Role</label>
                            <select name="role" class="form-control form-control-sm" value="text">
                                @foreach(\Illuminate\Support\Facades\DB::table('mfos')->where('id', '=', $id)->get() as $selectedrole)
                                    <option selected value="{{$selectedrole->role}}">{{$selectedrole->role}}</option>
                                @endforeach
                                <option>Division Head</option>
                                <option>Department Head</option>
                                <option>Division Head</option>
                                <option>Staff</option>
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

                    <!-- MFO TEXTBOX -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mfo_desc" style="font-weight: bold">Organizational Outcomes/Key Results Area</label>
                            <textarea class="mfo_desc" name="mfo_desc" rows="5">{{$mfo->mfo_desc}}</textarea>
                        </div>
                    </div>

                    <!-- SUCCESS_INDICATOR TEXTBOX -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="success_indicator_desc" style="font-weight: bold">Quality Objectives (Targets + Measures)</label>
                            <textarea class="form-control" rows="5" name="success_indicator_desc">{{$mfo->success_indicator_desc}}</textarea>
                        </div>
                    </div>

                    <!-- ACTUAL ACCOMPLISHMENT TEXTBOX -->
{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-md-12">--}}
{{--                            <label for="actual_accomplishment_desc" style="font-weight: bold">Actual Accomplishments</label>--}}
{{--                            <textarea class="form-control" rows="5" name="actual_accomplishment_desc">{{$mfo->actual_accomplishment_desc}}</textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <!-- REMARKS TEXT AREA -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="remarks" style="font-weight: bold;">Remarks</label>
                            <textarea class="form-control" rows="5" name="remarks">{{$mfo->remarks}}</textarea>
                        </div>
                    </div>

                    <a href="{{ __('/manageevaluationforms') }}" class="btn btn-secondary btn-sm mr-1" style="float: left;" type="submit">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
            </div>
        </div>

        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'lists',
                toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
            });


        </script>


        {{--                <form method="POST" action="{{action('JoinUserDeptController@update', $id)}}">--}}
        {{--                    <!-- FULL NAME TEXTBOX -->--}}
        {{--                    {{ csrf_field() }}--}}
        {{--                    <input type="hidden" name="_method" value="PATCH"/>--}}
        {{--                    <div class="form-row">--}}
        {{--                        <div class="form-group col-md-12">--}}
        {{--                            <label for="name">Full Name</label>--}}
        {{--                            <input type="text" class="form-control form-control-sm" name="name" placeholder="Full Name"  required autocomplete="name"--}}
        {{--                                   value="{{$employee->name}}">--}}
        {{--                        </div>--}}

        {{--                        <div class="form-group col-md-12">--}}
        {{--                            <label for="name">Username</label>--}}
        {{--                            <input type="text" class="form-control form-control-sm" name="username" placeholder="Full Name"  required autocomplete="username"--}}
        {{--                                   value="{{$employee->username}}">--}}

        {{--                        </div>--}}
        {{--                        <div class="form-group col-md-12">--}}
        {{--                            <label for="name">E-mail Address</label>--}}
        {{--                            <input type="text" class="form-control form-control-sm" name="email" placeholder="Full Name"  required autocomplete="email"--}}
        {{--                                   value="{{$employee->email}}">--}}
        {{--                        </div>--}}

        {{--                        <div class="form-group col-md-12">--}}
        {{--                            <label for="role">Role</label>--}}
        {{--                            <select name="role" class="form-control form-control-sm" value="{{$employee->role}}">--}}
        {{--                                <option>Staff</option>--}}
        {{--                                <option>Faculty</option>--}}
        {{--                                <option>Organization Head</option>--}}
        {{--                                <option>Section Head</option>--}}
        {{--                            </select>--}}
        {{--                        </div>--}}

        {{--                        <div class="form-label-group col-md-12">--}}
        {{--                            <label for="department">Organization</label>--}}
        {{--                            <select name="dept_id" class="form-control form-control-sm" value="text">--}}
        {{--                                <option selected value="1">Library</option>--}}
        {{--                                <option value="2">Supply</option>--}}
        {{--                                <option value="3">Basic Arts and Sciences Organization</option>--}}
        {{--                                <option value="4">Computer Engineering Technology</option>--}}
        {{--                                <option value="5">Mechanical Engineering Technology</option>--}}
        {{--                            </select>--}}
        {{--                        </div>--}}

        {{--                        <input class="btn btn-primary btn-sm" type="submit" value="Submit">--}}
        {{--                        <a href="{{ __('/employee') }}" class="btn btn-secondary btn-sm" style="float: right;" type="submit">Cancel</a>--}}
        {{--                    </div>--}}
        {{--                </form>--}}

    </div>

</head>
</html>

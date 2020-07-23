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
    <!-- Bootstrap core JavaScript -->
    <!-- jQuery -->
    <script src=" {{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <style>
        .note-group{
            color: red;
            font-weight: lighter;
            font-size: 10pt;
            font-style: italic;
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
                            <div class="note-group">
                                Choose where to apply the Form question
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="role" style="font-weight: bold">Role</label>
                            <select name="role" class="form-control form-control-sm" id="role">
                                @foreach(\Illuminate\Support\Facades\DB::table('mfos')->where('id', '=', $id)->get() as $selectedrole)
                                    <option selected value="{{$selectedrole->role}}">{{$selectedrole->role}}</option>
                                @endforeach
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
                            <div class="note-group">
                                IPCR form questions depends on the selected role
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="department" style="font-weight: bold">Department</label>
                                <select name="dept_name" id="dept_name" class="form-control form-control-sm">
                                    @foreach(App\Department::orderBy('id')->where('id', '=', $mfo->dept_id)->get() as $selecteddeptname)
                                        <option selected>{{$selecteddeptname->dept_name}}</option>
                                    @endforeach
                                    <option disabled style="font-weight: bold;">TEACHING DEPARTMENT</option>
                                    @foreach(App\Department::orderBy('id')->whereIn('type', ['Teaching'])->get() as $department)
                                        <option value="{{$department->dept_name}}">{{ $department->dept_name }}</option>
                                    @endforeach
                                    <option disabled style="font-weight: bold;">NON-TEACHING DEPARTMENT</option>
                                    @foreach(App\Department::orderBy('id')->whereIn('type', ['Non-Teaching'])->whereNotIn('dept_name', ['System Admin'])->get() as $department)
                                        <option value="{{$department->dept_name}}">{{ $department->dept_name }}</option>
                                    @endforeach
                                </select>
                            <div class="note-group">
                                OPCR form questions depends on the selected department
                            </div>
                            <div class="note-group">
                                Select a Department so the Function will be filtered out
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="function" style="font-weight: bold">Function</label>
                            <select name="function_name" id="function_name" class="form-control form-control-sm">
                                <!-- GET THE CURRENT DATA IN DROP DOWN -->
                                @foreach(App\FunctionType::orderBy('id')->where('id', '=', $mfo->function_id)->get() as $selectedfunctiontype)
                                    <option selected>Current Value: {{$selectedfunctiontype->function_name}}</option>
                                @endforeach
                            </select>
                            <div class="note-group">
                                Please re-select a role to update the function type
                            </div>
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
    </div>
    <script>
        $("#role").change(function(){
            $('#function_name').html('')

            let selectedrole = $(this).children("option:selected").val();
            let ipcrFunctionValues =
                {"Core Administrative Functions": "Core Administrative Functions",
                    "Support Functions": "Support Functions",
                    "Higher and Advanced Education Program": "Higher and Advanced Education Program",
                    "Research Program": "Research Program",
                    "Technical Advisory Extension Program": "Technical Advisory Extension Program"
                }
            let ipcrFullAdminValues =
                {"Core Administrative Functions - Clerical/Routine": "Core Administrative Functions - Clerical/Routine",
                    "Core Administrative Functions - Technical": "Core Administrative Functions - Technical",
                    "Support Functions": "Support Functions",
                }

            let ipcrFulltimeValues = {
                "Higher and Advanced Education Program": "Higher and Advanced Education Program",
                "Support Functions": "Support Functions",
                "Research Program": "Research Program",
                "Technical Advisory Extension Program": "Technical Advisory Extension Program"
            }

            if (selectedrole === 'College Sec - Associate Professor' || selectedrole === 'College Sec - Assistant Professor' ||
                selectedrole === 'College Sec - Professor' || selectedrole === 'College Sec - Instructor' ||
                selectedrole === 'Faculty with Admin Function - Associate Professor' || selectedrole === 'Faculty with Admin Function - Assistant Professor' ||
                selectedrole === 'Faculty with Admin Function - Professor' || selectedrole === 'Faculty with Admin Function - Instructor' ||
                selectedrole === 'Faculty with Quasi Function - Associate Professor' || selectedrole === 'Faculty with Quasi Function - Assistant Professor' ||
                selectedrole === 'Faculty with Quasi Function - Professor' || selectedrole === 'Faculty with Quasi Function - Instructor') {
                $.each(ipcrFunctionValues, function(key, value) {
                    $('#function_name')
                        .append($('<option>', { value : key })
                            .text(value))
                });
            }

            if (selectedrole === 'Fulltime - Admin') {
                $.each(ipcrFullAdminValues, function(key, value) {
                    $('#function_name')
                        .append($('<option>', { value : key })
                            .text(value))
                });
            }

            if (selectedrole === 'Fulltime - Associate Professor' || selectedrole === 'Fulltime - Assistant Professor'
                || selectedrole === 'Fulltime - Professor' || selectedrole === 'Fulltime - Instructor') {
                $.each(ipcrFulltimeValues, function(key, value) {
                    $('#function_name')
                        .append($('<option>', { value : key })
                            .text(value))
                });
            }
        })
    </script>
        <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'lists',
                toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
            })
            </script>
</head>
</html>

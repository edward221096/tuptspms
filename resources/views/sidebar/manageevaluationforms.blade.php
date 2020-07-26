<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<style>
    .form-control{
        resize: none;
        width: 100%;
    }

    .th{
        font-size: 10pt;
    }

    .note-group{
        color: red;
        font-weight: lighter;
        font-size: 10pt;
        font-style: italic;
    }

    .alert{
        width: 100%;
    }

</style>

<script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}"></script>

@extends('layouts.sidebar')
@section('manageevaluationforms')
        <div class="container-fluid">
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
        <h3 class="mt-4">Evaluation Forms</h3>
        <p>Manage the Content of Evaluation Forms for IPCR and OPCR Forms</p>

                <!-- Add IPCR and OPCR Forms Modal -->

        <label>Search Questions per IPCR Role or per Department</label>
        <form action="/search" method="GET">
            <div class="input-group">
                <input type="search" class="form-control form-control-sm" name="search"
                       placeholder="Search">
                <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Search
                        </button>
                    <a href="{{route('manageevaluationforms.index')}}" class="btn btn-sm btn-outline-info">Clear Search</a>
                    </span>
            </div>
        </form>
        <br>
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addmfo">
            Add
        </button>
        <div>
            <br>
        </div>

        <form method="GET" action="/manageevaluationforms">
            <table class="table table-striped">
                <thead>
                <tr style="font-size: 11pt;">
                    <th>FORM TYPE</th>
                    <th>DEPARTMENT NAME</th>
                    <th>FUNCTION NAME</th>
                    <th>ROLE NAME</th>
                    <th>ORGANIZATIONAL OUTCOMES/KEY RESULTS AREA</th>
                    <th>QUALITY + OBJECTIVES
                        (TARGETS + MEASURES)</th>
{{--                    <th>ACTUAL ACCOMPLISHMENTS</th>--}}
                    <th>REMARKS</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach($mfo as $row)
                    <tr>
                        <td>{{$row->form_type}}</td>
                        <td>{{$row->dept_name}}</td>
                        <td>{{$row->function_name}}</td>
                        <td>{{$row->role}}</td>
                        <td>{!! $row->mfo_desc !!}</td>
                        <td>{!! $row->success_indicator_desc !!}</td>
{{--                        <td>{!! $row->actual_accomplishment_desc !!}</td>--}}
                        <td>{!! $row->remarks !!}
                        <td>
{{--                                <a href="#" class="btn btn-secondary btn-sm"--}}
{{--                                   data-mymfoid="{{$row->id}}"--}}
{{--                                   data-myformtype="{{$row->form_type}}"--}}
{{--                                   data-mydeptname="{{$row->dept_name}}"--}}
{{--                                   data-myfunctionname="{{$row->function_name}}"--}}
{{--                                   data-mymfodesc="{{ $row->mfo_desc }}"--}}
{{--                                   data-mysuccessindicatordesc="{{ $row->success_indicator_desc }}"--}}
{{--                                   data-actualaccomplishmentdesc="{{ $row->actual_accomplishment_desc }}"--}}
{{--                                   data-myremarks="{{ $row->remarks }}"--}}
{{--                                   data-toggle="modal" data-target="#editmfo">Edit</a>--}}
                                <a href="{{action('MfoController@edit', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm"
                                   data-mymfoid="{{$row->id}}" data-toggle="modal" data-target="#deletemfo">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
        {{$mfo->links()}}

    <!-- START OF DELETE MODAL -->
        <div class="modal fade" id="deletemfo" tabindex="-1" role="dialog" aria-labelledby="deletemfolabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletemfolabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('manageevaluationforms.destroy', 'test')}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <div class="modal-body">
                            <label style="font-weight: normal;">Please confirm if you want to delete this information</label>
                            <input type="hidden" name="mfoid" id="mfoid">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- START OF ADD MODAL -->
        <div class="modal fade" id="addmfo" tabindex="-1" role="dialog" aria-labelledby="addmfo">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addmfo">Add Evaluation Form Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="/storemfo">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-row">
                                <label for="Notes">Note: *All fields are required</label>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="form">Form</label>
                                    <select name="form_type" id="form_type" class="form-control form-control-sm">
                                        <option selected disabled>Select a Form</option>
                                        @foreach(App\Form::orderBy('id')->get() as $form)
                                            <option>{{$form->form_type}}</option>
                                        @endforeach
                                    </select>
                                    <div class="note-group">
                                        Choose where to apply the Form question
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        <option selected disabled>Select a Role</option>
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
                                        Select a role so function will be filtered out
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="department">Department</label>
                                    <select name="dept_name" id="dept_name" class="form-control form-control-sm">
                                        <option selected disabled>Select a Department</option>
                                        <option disabled style="font-weight: bold;">TEACHING DEPARTMENT</option>
                                        @foreach(App\Department::orderBy('id')->whereIn('dept_name', ['Faculty'])->get() as $department)
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
                                        Select a Department so Function will be filtered out
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="function">Function</label>
                                    <select name="function_name" id="function_name" class="form-control form-control-sm">
{{--                                        <option selected disabled>Select a Function</option>--}}
{{--                                        <option disabled style="font-weight: bold;">IPCR RELATED FUNCTION</option>--}}
{{--                                        @foreach(App\FunctionType::orderBy('id')->whereNotIn('function_name', ['Core Administrative Functions - Clerical/Routine', 'Core Administrative Functions - Technical'])->get() as $functiontype)--}}
{{--                                            <option>{{$functiontype->function_name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                        <option disabled style="font-weight: bold;">IPCR FULLTIME ROLE RELATED FUNCTION</option>--}}
{{--                                        @foreach(App\FunctionType::orderBy('id')->whereNotIn('function_name', ['Core Administrative Functions', 'Core Administrative Functions - Clerical/Routine', 'Core Administrative Functions - Technical'])->get() as $functiontype)--}}
{{--                                            <option>{{$functiontype->function_name}}</option>--}}
{{--                                        @endforeach--}}

{{--                                        <option disabled style="font-weight: bold;">IPCR FULLTIME - ADMIN RELATED FUNCTION</option>--}}
{{--                                        @foreach(App\FunctionType::orderBy('id')->whereIn('function_name', ['Core Administrative Functions - Clerical/Routine', 'Core Administrative Functions - Technical', 'Support Functions'])->get() as $functiontype)--}}
{{--                                            <option>{{$functiontype->function_name}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                    <div class="note-group">
                                        *Choose what type of function for the question
                                    </div>
                                </div>
                                </div>
                            <!-- MFO TEXTAREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="mfo_desc">Organizational Outcomes/Key Result Area</label>
                                    <textarea class="form-control" rows="5" name="mfo_desc"></textarea>
                                </div>
                            </div>

                            <!-- SUCCESS_INDICATOR TEXT AREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="success_indicator_desc">Quality + Objectives (Targets + Measures)</label>
                                    <textarea class="form-control" rows="5" name="success_indicator_desc"></textarea>
                                </div>
                            </div>

                            <!-- REMARKS TEXT AREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="Remarks">Remarks</label>
                                    <textarea class="form-control" rows="5" name="remarks"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <!-- Add Information Button-->
                            <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <br>
    </div>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'lists',
        toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code',
    });
</script>
    <script type="text/javascript">
        $("#role").change(function(){
            $('#function_name').html('')

            //IPCR RELATED DYNAMICALLY CHANGE THE FUNCTION NAME BASED ON SELECTED FUNCTION (FUNCTION VALUES)
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

        //OPCR RELATED DYNAMICALLY CHANGE THE FUNCTION NAME BASED ON SELECTED DEPARTMENT (VALUES)
        $("#dept_name").change(function() {
            $('#function_name').html('')

            let selecteddept = $(this).children("option:selected").val();
            let opcrFunctionValues = {
                "Core Administrative Functions": "Core Administrative Functions",
                "General Administration and Support": "General Administration and Support",
                "Support to Operations": "Support to Operations",
                "Higher and Advanced Education Program": "Higher and Advanced Education Program",
                "Research Program": "Research Program",
                "Technical Advisory Extension Program": "Technical Advisory Extension Program"
            }

            let opcrFunctionValues2 = {
                "Core Administrative Functions": "Core Administrative Functions",
                "General Administration and Support": "General Administration and Support",
                "Support to Operations": "Support to Operations",
                "Higher and Advanced Education Program": "Higher and Advanced Education Program"
            }

            if (selecteddept === 'Accounting' || selecteddept === 'Budget' || selecteddept === 'Cashier'
                || selecteddept === 'Industry Based' || selecteddept === 'Medical Service') {
                $.each(opcrFunctionValues, function (key, value) {
                    $('#function_name')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selecteddept === 'ADRE' || selecteddept === 'IDO' || selecteddept === 'PDO' || selecteddept === 'Procurement' || selecteddept === 'QAA'
                || selecteddept === 'Records' || selecteddept === 'UITC') {
                $.each(opcrFunctionValues2, function (key, value) {
                    $('#function_name')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }
        });


    </script>
</head>
</html>
@endsection

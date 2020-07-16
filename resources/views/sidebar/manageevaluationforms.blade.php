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

</style>

<script src="{{ asset('node_modules/tinymce/tinymce.min.js') }}"></script>

@extends('layouts.sidebar')
@section('manageevaluationforms')
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
                    <th>ACTUAL ACCOMPLISHMENTS</th>
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
                        <td>{!! $row->actual_accomplishment_desc !!}</td>
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
                        <h5 class="modal-title" id="addmfo">Add Evaluation Form Content</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="/storemfo">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <!-- FUNCTION COMBOBOX-->
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="form">Form</label>
                                    <select name="form_type" id="form_type" class="form-control form-control-sm">
                                        <option selected disabled>Select a Form</option>
                                        @foreach(App\Form::orderBy('id')->get() as $form)
                                            <option>{{$form->form_type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="function">Function</label>
                                    <select name="function_name" id="function_name" class="form-control form-control-sm">
                                        <option selected disabled>Select a Function</option>
                                        @foreach(App\FunctionType::orderBy('id')->get() as $functiontype)
                                            <option>{{$functiontype->function_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="department">Department</label>
                                    <select name="dept_name" id="dept_name" class="form-control form-control-sm">
                                        <option selected disabled>Select a Department</option>
                                        @foreach(App\Department::orderBy('id')->get() as $department)
                                            <option>{{$department->dept_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="role">Role</label>
                                        <select name="role" class="form-control form-control-sm" value="text">
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
                            <!-- MFO TEXTAREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="mfo_desc">Major Final Output/Programs/Projects/Activities (PAP)</label>
                                    <textarea class="form-control" rows="5" name="mfo_desc"></textarea>
                                </div>
                            </div>

                            <!-- SUCCESS_INDICATOR TEXT AREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="success_indicator_desc">Success Indicators (Targets + Measures)</label>
                                    <textarea class="form-control" rows="5" name="success_indicator_desc"></textarea>
                                </div>
                            </div>

                            <!-- ACTUAL ACCOMPLISHMENT TEXT AREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="actual_accomplishment_desc">Actual Accomplishment</label>
                                    <textarea class="form-control" rows="5" name="actual_accomplishment_desc"></textarea>
                                </div>
                            </div>

                            <!-- REMARKS TEXT AREA -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="Remarks">Remarks</label>
                                    <textarea class="form-control" rows="5" name="Remarks"></textarea>
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
</head>
</html>
@endsection

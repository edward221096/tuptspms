@extends('layouts.sidebar')
@section('myteamevaluationforms')
    <div class="container-fluid">
        <h3 class="mt-4">My Team Evaluation Forms</h3>
        <p>Manage my Team Evaluation Forms</p>

        <div>
            <br>
        </div>

        <table class="table table-striped">
            <thead>
            <tr style="font-size: 11pt;">
                <th>FORM TYPE</th>
                <th>NAME</th>
                <th>ROLE</th>
                <th>DIVISION NAME</th>
                <th>DEPARTMENT NAME</th>
                <th>SECTION NAME</th>
                <th>EVALUATION PERIOD</th>
                <th>EVALUATION STATUS</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            @foreach($myteamevaluationform as $row)
                <tr>
                    <td>{{$row->form_type}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->ratee_role}}</td>
                    <td>{{$row->division_name}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->section_name}}</td>
                    <td>{{$row->evaluation_startdate}} to {{$row->evaluation_enddate}}</td>
                    <td>{{$row->evaluationform_status}}</td>
                    <td>
                            <!-- EDIT FORM TYPE BUTTON -->
                        @if($row->evaluationform_name == 'ipcrcsassocp')
                            <a href="{{action('MyTeamEvaluationFormController@editipcrcsassocp', $row->id)}}" class="btn btn-primary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrcsassisp')
                            <a href="{{action('MyTeamEvaluationFormController@editipcrcsassisp', $row->id)}}" class="btn btn-primary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrcsprofessor')
                            <a href="{{action('MyTeamEvaluationFormController@editipcrcsprofessor', $row->id)}}" class="btn btn-primary btn-sm" type="submit">View</a>
                        @endif
                            <a href="#" class="btn btn-danger btn-sm"
                           data-myformseqid="{{$row->id}}"
                           data-toggle="modal" data-target="#deletemyvaluationform">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- START OF DELETE MODAL -->
    <div class="modal fade" id="deletemyvaluationform" tabindex="-1" role="dialog" aria-labelledby="deletemyvaluationformlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletemyvaluationformlabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('myteamevaluationforms.destroy', 'test')}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <div class="modal-body">
                        <label style="font-weight: normal;">Please confirm if you want to delete this evaluation form</label>
                        <input type="hidden" name="form_sequence_id" id="form_sequence_id">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

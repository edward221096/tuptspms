@extends('layouts.sidebar')
@section('myevaluationforms')
    <div class="container-fluid">
        <h3 class="mt-4">My Evaluation Forms</h3>
        <p>Manage my Evaluation Forms</p>

        <div>
            <br>
        </div>

        <table class="table table-striped">
            <thead>
            <tr style="font-size: 11pt;">
{{--                <th>FORM NO.</th>--}}
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
            @foreach($myevaluationform as $row)
                <tr>
{{--                    <td>{{$row->form_sequence_id}}</td>--}}
                    <td>{{$row->form_type}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->ratee_role}}</td>
                    <td>{{$row->division_name}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->section_name}}</td>
                    <td>{{$row->evaluation_startdate}} to {{$row->evaluation_enddate}}</td>
                    <td>{{$row->evaluationform_status}}</td>
                    <td>
                            <!-- DELETE FORM TYPE BUTTON -->
                                <a href="#" class="btn btn-primary btn-sm"
                                   data-toggle="modal" data-target="#">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

{{--    <!-- START OF EDIT Modal -->--}}
{{--    <div class="modal fade" id="editformtype" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
{{--        <div class="modal-dialog modal-sm" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="myModalLabel">Edit Form Type</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form action="{{route('manageformtype.update', [$row->id])}}" method="post">--}}
{{--                    {{method_field('PATCH')}}--}}
{{--                    {{csrf_field()}}--}}
{{--                    <div class="modal-body">--}}
{{--                        <input type="hidden" name="formtype_id" id="formtype_id">--}}
{{--                        <div class="form-group col-md-12">--}}
{{--                            <label for="form_type">Form Type</label>--}}
{{--                            <input type="text" class="form-control" name="form_type" id="form_type">--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- START OF DELETE MODAL -->--}}
{{--    <div class="modal fade" id="deleteformtype" tabindex="-1" role="dialog" aria-labelledby="deleteformtypelabel">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="deleteformtypelabel">Confirmation</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <form method="POST" action="{{route('manageformtype.destroy', [$row->id])}}">--}}
{{--                    {{csrf_field()}}--}}
{{--                    {{method_field('DELETE')}}--}}
{{--                    <div class="modal-body">--}}
{{--                        <label>Please confirm if you want to delete this form type</label>--}}
{{--                        <input type="hidden" name="formtype_id" id="formtype_id">--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection

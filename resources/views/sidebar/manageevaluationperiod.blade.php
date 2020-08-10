@extends('layouts.sidebar')
@section('manageevaluationperiod')
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
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
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
        <h3 class="mt-4">Evaluation Period</h3>
        <p>Manage Evaluation Period</p>

        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addevaluationperiod">
            Add
        </button>

        <div>
            <br>
        </div>

        <!-- SHOW DATA IN A TABLE-->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Evaluation Period Start Date</th>
                <th>Evaluation Period End Date</th>
                <th>Evaluation Period Status</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($evaluationperiod as $row)
                <tr>
                    <td>{{$row->evaluation_startdate}}</td>
                    <td>{{$row->evaluation_enddate}}</td>
                    <td>{{$row->evaluation_period_status}}</td>
                    <td>
                            <a href="#" class="btn btn-secondary btn-sm"
                               data-myevalperiodid="{{$row->id}}"
                               data-myevalstartdate="{{$row->evaluation_startdate}}"
                               data-myevalenddate="{{$row->evaluation_enddate}}"
                               data-myevalstatus="{{$row->evaluation_period_status}}"
                               data-toggle="modal" data-target="#editevaluationperiod">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm"
                           data-myevalperiodid="{{$row->id}}"
                           data-toggle="modal" data-target="#deleteevalperiod">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- START OF ADD MODAL -->
    <div class="modal fade" id="addevaluationperiod" tabindex="-1" role="dialog" aria-labelledby="addevaluationperiod" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addevaluationperiod">Add Evaluation Period</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storeevaluationperiod">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <!-- Start Evaluation Date -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="evaluation_startdate">Evaluation Start Date</label>
                                <input type="date" class="form-control form-control-sm" name="evaluation_startdate"
                                       required autocomplete="evaluation_startdate">
                            </div>
                        </div>
                        <!-- End Evaluation Date -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="evaluation_end_date">Evaluation end Date</label>
                                <input type="date" class="form-control form-control-sm" name="evaluation_enddate"
                                       required autocomplete="evaluation_enddate">
                            </div>
                        </div>

                        <!-- Evaluation Status -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="evaluation_period_status">Evaluation Status</label>
                                <select name="evaluation_period_status" class="form-control form-control-sm" id="evaluation_period_status">
                                    <option>Open</option>
                                    <option>Closed</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Add Information Button-->
                            <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- END OF ADD MODAL -->

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editevaluationperiod" tabindex="-1" role="dialog" aria-labelledby="editevaluationperiod" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editevaluationperiod">Edit Evaluation Period Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('evaluationperiod.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="evalperiodid" id="evalperiodid">
                            <!-- Start Evaluation Date -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="evaluation_startdate">Evaluation Start Date</label>
                                    <input type="date" class="form-control form-control-sm" name="evaluation_startdate"
                                         id="evaluation_startdate" required autocomplete="evaluation_startdate">
                                </div>
                            </div>

                            <!-- End Evaluation Date -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="evaluation_end_date">Evaluation end Date</label>
                                    <input type="date" class="form-control form-control-sm" name="evaluation_enddate"
                                          id="evaluation_enddate" required autocomplete="evaluation_enddate">
                                </div>
                            </div>

                            <!-- Evaluation Status -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="evaluation_period_status">Evaluation Status</label>
                                    <select name="evaluation_period_status" class="form-control form-control-sm"
                                            id="evaluation_period_status" required autocomplete="evaluation_period_status">
                                        <option>Open</option>
                                        <option>Closed</option>
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
    <div class="modal fade" id="deleteevalperiod" tabindex="-1" role="dialog" aria-labelledby="deleteemployeelabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteevalperiodlabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('evaluationperiod.destroy', 'test')}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="modal-body">
                        <label style="font-weight: normal;">Are yofu sure do you want to delete this Evaluation Period?</label>
                        <input type="hidden" name="evalperiodid" id="evalperiodid">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

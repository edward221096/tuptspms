<style>
    .form-control{
        resize: none;
        width: 100%;
    }

</style>

@extends('layouts.sidebar')
@section('managefunctionstype')
    <div class="container-fluid">
        <h3 class="mt-4">Functions</h3>
        <p>Manage Function Types</p>
        <!-- Add Button -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addfunction">
            Add
        </button>

        <div>
            <br>
        </div>

        <table class="table table-striped">
            <thead>
            <tr style="font-size: 11pt;">
                <th>FUNCTION ID</th>
                <th>FUNCTION NAME</th>
                <th>ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($functiontype as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->function_name}}</td>
                    <td>
                            <!-- EDIT FUNCTIONS TYPE BUTTON -->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-myfunctionid="{{$row->id}}"
                                   data-myfunctionname="{{$row->function_name}}"
                                   data-toggle="modal" data-target="#editfunction">Edit</a>
                            <!-- DELETE FUNCTIONS TYPE BUTTON -->
                                <a href="#" class="btn btn-danger btn-sm"
                                   data-myfunctionid="{{$row->id}}"
                                   data-toggle="modal" data-target="#deletefunction">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$functiontype->links()}}
    </div>

    <!-- START OF ADD MODAL -->
    <div class="modal fade" id="addfunction" tabindex="-1" role="dialog" aria-labelledby="addfunction" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addfunction">Add Function</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storefunctionstype">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <!-- Function Name-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="function">Function Name</label>
                                <input type="text" class="form-control form-control-sm" name="function_name"
                                       placeholder="Function Name"  required autocomplete="function_name">
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
        <!-- END OF ADD MODAL -->
    </div>

    <!-- START OF EDIT MODAL -->
    <div class="modal fade" id="editfunction" tabindex="-1" role="dialog" aria-labelledby="editfunctionlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editfunctionlabel">Edit Function Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('managefunctionstype.update', [$row->id])}}" method="post">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="function_id" id="function_id">
                        <div class="form-group col-md-12">
                            <label for="function_name">Function Name</label>
                            <input type="text" class="form-control" name="function_name" id="function_name">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- START OF DELETE MODAL -->
    <div class="modal fade" id="deletefunction" tabindex="-1" role="dialog" aria-labelledby="deletefunctionlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletefunctionlabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('managefunctionstype.destroy', [$row->id])}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <div class="modal-body">
                        <label>Please confirm if you want to delete this function type</label>
                        <input type="hidden" name="funcid" id="funcid">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    .form-control{
        resize: none;
        width: 100%;
    }

</style>

@extends('layouts.sidebar')
@section('manageformtype')
    <div class="container-fluid">
        <h3 class="mt-4">Form</h3>
        <p>Manage Form Types</p>
        <!-- Add Button -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addformtype">
            Add
        </button>

        <div>
            <br>
        </div>

        <table class="table table-striped">
            <thead>
            <tr style="font-size: 11pt;">
                <th>FORM ID</th>
                <th>FORM TYPE</th>
                <th>ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($formtype as $row)
                <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->form_type}}</td>
                    <td>
                            <!-- EDIT FORM TYPE BUTTON -->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-myformtypeid="{{$row->id}}"
                                   data-myformtype="{{$row->form_type}}"
                                   data-toggle="modal" data-target="#editformtype">Edit</a>
                            <!-- DELETE FORM TYPE BUTTON -->
                                <a href="#" class="btn btn-danger btn-sm"
                                   data-myformtypeid="{{$row->id}}"
                                   data-toggle="modal" data-target="#deleteformtype">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$formtype->links()}}
    </div>

    <!-- START OF ADD MODAL -->
    <div class="modal fade" id="addformtype" tabindex="-1" role="dialog" aria-labelledby="addformtype" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addformtype">Add Form Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storeformtype">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <!-- Form Type-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="form_type">Form Type</label>
                                <input type="text" class="form-control form-control-sm" name="form_type"
                                       placeholder="Form Type"  required autocomplete="form_type">
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

    <!-- START OF EDIT Modal -->
    <div class="modal fade" id="editformtype" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Form Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('manageformtype.update', [$row->id])}}" method="post">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="formtype_id" id="formtype_id">
                        <div class="form-group col-md-12">
                            <label for="form_type">Form Type</label>
                            <input type="text" class="form-control" name="form_type" id="form_type">
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
    <div class="modal fade" id="deleteformtype" tabindex="-1" role="dialog" aria-labelledby="deleteformtypelabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteformtypelabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('manageformtype.destroy', [$row->id])}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <div class="modal-body">
                        <label>Please confirm if you want to delete this form type</label>
                        <input type="hidden" name="formtype_id" id="formtype_id">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

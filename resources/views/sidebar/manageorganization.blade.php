<style>
    .form-control{
        resize: none;
        width: 100%;
    }

</style>

@extends('layouts.sidebar')
@section('manageorganization')
    <div class="container-fluid">
        <h3 class="mt-4">Organization</h3>
        <p>Manage TUP-Taguig Organization</p>
        <!--ADD DEPARTMENT BUTTON -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addorganization">
            Add
        </button>

        <div>
            <br>
        </div>

        <!-- SEARCH ORGANIZATION -->
        <form action="/searchorganization" method="GET">
            <div class="input-group">
                <input type="search" class="form-control form-control-sm" name="search"
                       placeholder="Search for Division, Department or Area/Section Name">
                <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Search
                        </button>
                    </span>
            </div>
        </form>


        <table class="table table-striped">
            <thead>
            <tr style="font-size: 11pt;">
                <th>ID</th>
                <th>DIVISION NAME</th>
                <th>DEPARTMENT NAME</th>
                <th>AREA/SECTION NAME</th>
                <th>ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizations as $row)
                <tr>
                    <td>{{$row->section_id}}</td>
                    <td>{{$row->division_name}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->section_name}}</td>
                    <td>
                            <!-- EDIT DEPARTMENT TYPE BUTTON -->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-mydivisionid="{{$row->division_id}}"
                                   data-mydeptid="{{$row->dept_id}}"
                                   data-mysectionid="{{$row->section_id}}"
                                   data-mydivisionname="{{$row->division_name}}"
                                   data-mydeptname="{{$row->dept_name}}"
                                   data-mysectionname="{{$row->section_name}}"
                                   data-toggle="modal" data-target="#editorganization">Edit</a>
                            <!-- DELETE DEPARTMENT TYPE BUTTON -->
                                <a href="#" class="btn btn-danger btn-sm"
                                   data-mysectionid="{{$row->section_id}}"
                                   data-toggle="modal" data-target="#deleteorganization">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$organizations->links()}}
    </div>

    <!-- START OF ADD MODAL -->
    <div class="modal fade" id="addorganization" tabindex="-1" role="dialog" aria-labelledby="addorganizationlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addorganization">Add Organization Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storeorganization">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <!-- Division Name-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="division">Division Name</label>
                                <input type="text" class="form-control form-control-sm" name="division_name"
                                       placeholder="Division Name"  required autocomplete="division_name">
                            </div>
                        </div>
                        <!-- Department Name-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="department">Department Name</label>
                                <input type="text" class="form-control form-control-sm" name="dept_name"
                                       placeholder="Department Name"  required autocomplete="dept_name">
                            </div>
                        </div>
                        <!-- Area/Section Name-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="section">Area/Section Name</label>
                                <input type="text" class="form-control form-control-sm" name="section_name"
                                       placeholder="Section Name"  required autocomplete="section_name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
    <div class="modal fade" id="editorganization" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Department Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('manageorganization.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="division_id" id="division_id">
                        <input type="hidden" name="dept_id" id="dept_id">
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="division">Division Name</label>
                                <input type="text" class="form-control form-control-sm" name="division_name"
                                      id="division_name" placeholder="Division Name" required autocomplete="division_name">
                            </div>
                        </div>
                        <!-- Department Name-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="department">Department Name</label>
                                <input type="text" class="form-control form-control-sm" name="dept_name"
                                      id="dept_name" placeholder="Department Name"  required autocomplete="dept_name">
                            </div>
                        </div>
                        <!-- Area/Section Name-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="section">Area/Section Name</label>
                                <input type="text" class="form-control form-control-sm" name="section_name"
                                      id="section_name" placeholder="Section Name"  required autocomplete="section_name">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- START OF DELETE MODAL -->
    <div class="modal fade" id="deleteorganization" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteorganization">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('manageorganization.destroy', 'test')}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <div class="modal-body">
                        <label>Are you sure do you want to delete this Organization Group?</label>
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

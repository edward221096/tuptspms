<style>
    .form-control{
        resize: none;
        width: 100%;
    }

    .alert{
        width: 100%;
    }

</style>

@extends('layouts.sidebar')
@section('manageorganization')
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
        <h3 class="mt-4">Organization</h3>
        <p>Manage TUP-Taguig Organization Hierarchically</p>

        <!-- SEARCH ORGANIZATION -->
        <label>Search for Division/Department or Area/Section</label>
        <form action="/searchorganization" method="GET">
            <div class="input-group">
                <input type="search" class="form-control form-control-sm" name="search"
                       placeholder="Search">
                <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Search
                        </button>
                    <a href="{{route('manageorganization.index')}}" class="btn btn-sm btn-outline-info">Clear Search</a>
                    </span>
            </div>
        </form>

        <!--ADD DEPARTMENT BUTTON -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addorganization">
            Add
        </button>
        <div>
            <br>
        </div>
        <table class="table table-striped">
            <thead>
            <tr style="font-size: 11pt;">
                <th>DIVISION NAME</th>
                <th>DEPARTMENT NAME</th>
                <th>AREA/SECTION NAME</th>
                <th>TYPE</th>
                <th>ACTIONS</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizations as $row)
                <tr>
                    <td>{{$row->division_name}}</td>
                    <td>{{$row->dept_name}}</td>
                    <td>{{$row->section_name}}</td>
                    <td>{{$row->type}}</td>
                    <td>
                            <!-- EDIT DEPARTMENT TYPE BUTTON -->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-mydivisionid="{{$row->division_id}}"
                                   data-mydeptid="{{$row->dept_id}}"
                                   data-mysectionid="{{$row->section_id}}"
                                   data-mydivisionname="{{$row->division_name}}"
                                   data-mydeptname="{{$row->dept_name}}"
                                   data-mysectionname="{{$row->section_name}}"
                                   data-mytype="{{$row->type}}"
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

                        <!-- Type -->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="type">Type</label>
                                <select name="type" class="form-control form-control-sm" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Teaching">Teaching</option>
                                    <option value="Non-Teaching">Non-Teaching</option>
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

                        <!-- Type-->
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="section">Type</label>
                                <select name="type" id="type" class="form-control form-control-sm" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Teaching">Teaching</option>
                                    <option value="Non-Teaching">Non-Teaching</option>
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
                        <label style="font-weight: normal;">Please confirm if you want to delete this organization group</label>
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

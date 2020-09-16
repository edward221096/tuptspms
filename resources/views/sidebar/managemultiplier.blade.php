@extends('layouts.sidebar')
@section('managemultiplier')
<style>
    .alert{
        width: 100%;
    }
    .note-group{
        color: red;
        font-weight: lighter;
        font-size: 10pt;
        font-style: italic;
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
        <h3 class="mt-4">Evaluation Form Multiplier</h3>
        <p>Manage Evaluation Form Multiplier</p>

        <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#addformmultiplier">
            Add
        </button>

        <div>
            <br>
        </div>

        <!-- SHOW DATA IN A TABLE-->
        <table class="table table-striped">
            <thead>
            <tr>
                <th>FORM NAME</th>
                <th>FUNCTION NAME</th>
                <th>MULTIPLIER</th>
                <th>ACTIONS</th>
            </tr>
            </thead>

            <tbody>
            @foreach($multiplier as $row)
                <tr style="font-size: 11pt;">
                    <td>{{$row->form_name}}</td>
                    <td>{{$row->function_name}}</td>
                    <td>{{$row->multiplier}}</td>
                    <td>
                            <a href="#" class="btn btn-secondary btn-sm"
                               data-myformmultiplierid="{{$row->id}}"
                               data-myformname="{{$row->form_name}}"
                               data-myfunctionname="{{$row->function_name}}"
                               data-mymultiplier="{{$row->multiplier}}"
                               data-toggle="modal" data-target="#editformmultiplier">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm"
                           data-myformmultiplierid="{{$row->id}}"
                           data-toggle="modal" data-target="#deleteformmultiplier">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- START OF ADD MODAL -->
    <div class="modal fade" id="addformmultiplier" tabindex="-1" role="dialog" aria-labelledby="addformmultiplier" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addformmultiplier">Add Evaluation Form Multiplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/storemultiplier">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="form_name">Form Name</label>
                                <select name="form_name" class="form-control form-control-sm" id="formname">
                                    <option selected style="font-weight: bold; font-size: 12pt;">Select Form</option>
                                    <option disabled style="font-weight: bold; font-size: 12pt;">IPCR</option>
                                    <option value="IPCR - College Sec Associate Professor">IPCR - College Sec Associate Professor</option>
                                    <option value="IPCR - College Sec Assistant Professor">IPCR - College Sec Assistant Professor</option>
                                    <option value="IPCR - College Sec Professor">IPCR - College Sec Professor</option>
                                    <option value="IPCR - College Sec Instructor">IPCR - College Sec Instructor</option>
                                    <option value="IPCR - Faculty with Admin Function Associate Professor">IPCR - Faculty with Admin Function Associate Professor</option>
                                    <option value="IPCR - Faculty with Admin Function Assistant Professor">IPCR - Faculty with Admin Function Assistant Professor</option>
                                    <option value="IPCR - Faculty with Admin Function Professor">IPCR - Faculty with Admin Function Professor</option>
                                    <option value="IPCR - Faculty with Admin Function Instructor">IPCR - Faculty with Admin Function Instructor</option>
                                    <option value="IPCR - Faculty with Quasi Function Associate Professor">IPCR - Faculty with Quasi Function Associate Professor</option>
                                    <option value="IPCR - Faculty with Quasi Function Assistant Professor">IPCR - Faculty with Quasi Function Assistant Professor</option>
                                    <option value="IPCR - Faculty with Quasi Function Professor">IPCR - Faculty with Quasi Function Professor</option>
                                    <option value="IPCR - Faculty with Quasi Function Instructor">IPCR - Faculty with Quasi Function Instructor</option>
                                    <option value="IPCR - Fulltime Associate Professor">IPCR - Fulltime Associate Professor</option>
                                    <option value="IPCR - Fulltime Assistant Professor">IPCR - Fulltime Assistant Professor</option>
                                    <option value="IPCR - Fulltime Professor">IPCR - Fulltime Professor</option>
                                    <option value="IPCR - Fulltime Instructor">IPCR - Fulltime Instructor</option>
                                    <option value="IPCR - Fulltime Admin">IPCR - Fulltime Admin</option>
                                    <option disabled style="font-weight: bold; font-size: 12pt;">OPCR</option>
                                    <option value="OPCR - Campus Director">OPCR - Campus Director</option>
                                    <option value="OPCR - ADAF">OPCR - ADAF</option>
                                    <option value="OPCR - ADAA">OPCR - ADAA</option>
                                    <option value="OPCR - ADRE">OPCR - ADRE</option>
                                    <option value="OPCR - Academics Department">OPCR - Academics Department</option>
                                    <option value="OPCR - Accounting">OPCR - Accounting</option>
                                    <option value="OPCR - Budget">OPCR - Budget</option>
                                    <option value="OPCR - Cashier">OPCR - Cashier</option>
                                    <option value="OPCR - Medical Serv">OPCR - Medical Serv</option>
                                    <option value="OPCR - IDO">OPCR - IDO</option>
                                    <option value="OPCR - Industry Based">OPCR - Industry Based</option>
                                    <option value="OPCR - PDO">OPCR - PDO</option>
                                    <option value="OPCR - Procurement">OPCR - Procurement</option>
                                    <option value="OPCR - QAA">OPCR - QAA</option>
                                    <option value="OPCR - Records">OPCR - Records</option>
                                    <option value="OPCR - UITC">OPCR - UITC</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="function_name">Function Name</label>
                                <select name="function_name" class="form-control form-control-sm" id="functionname">
                                 </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="multiplier">Multiplier</label>
                                <input type="number" class="form-control form-control-sm" min="0.0000" max="1.0000" step="0.0001" name="multiplier">
                                <div class="note-group">
                                    Value ranging 0.0 to 1.0 (Ex. 0.65 = 65%)
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <!-- Add Information Button-->
                            <input class="btn btn-secondary btn-sm" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- END OF ADD MODAL -->

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editformmultiplier" tabindex="-1" role="dialog" aria-labelledby="editformmultiplier" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editformmultiplier">Edit Evaluation Form Multiplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('formmultiplier.update', 'test')}}" method="POST">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="formmultiplierid" id="formmultiplierid">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="form_name">Form Name</label>
                                <select name="form_name" class="form-control form-control-sm" id="formname">
                                    <option disabled style="font-weight: bold; font-size: 12pt;">IPCR</option>
                                    <option value="IPCR - College Sec Associate Professor">IPCR - College Sec Associate Professor</option>
                                    <option value="IPCR - College Sec Assistant Professor">IPCR - College Sec Assistant Professor</option>
                                    <option value="IPCR - College Sec Professor">IPCR - College Sec Professor</option>
                                    <option value="IPCR - College Sec Instructor">IPCR - College Sec Instructor</option>
                                    <option value="IPCR - Faculty with Admin Function Associate Professor">IPCR - Faculty with Admin Function Associate Professor</option>
                                    <option value="IPCR - Faculty with Admin Function Assistant Professor">IPCR - Faculty with Admin Function Assistant Professor</option>
                                    <option value="IPCR - Faculty with Admin Function Professor">IPCR - Faculty with Admin Function Professor</option>
                                    <option value="IPCR - Faculty with Admin Function Instructor">IPCR - Faculty with Admin Function Instructor</option>
                                    <option value="IPCR - Faculty with Quasi Function Associate Professor">IPCR - Faculty with Quasi Function Associate Professor</option>
                                    <option value="IPCR - Faculty with Quasi Function Assistant Professor">IPCR - Faculty with Quasi Function Assistant Professor</option>
                                    <option value="IPCR - Faculty with Quasi Function Professor">IPCR - Faculty with Quasi Function Professor</option>
                                    <option value="IPCR - Faculty with Quasi Function Instructor">IPCR - Faculty with Quasi Function Instructor</option>
                                    <option value="IPCR - Fulltime Associate Professor">IPCR - Fulltime Associate Professor</option>
                                    <option value="IPCR - Fulltime Assistant Professor">IPCR - Fulltime Assistant Professor</option>
                                    <option value="IPCR - Fulltime Professor">IPCR - Fulltime Professor</option>
                                    <option value="IPCR - Fulltime Instructor">IPCR - Fulltime Instructor</option>
                                    <option value="IPCR - Fulltime Admin">IPCR - Fulltime Admin</option>
                                    <option disabled style="font-weight: bold; font-size: 12pt;">OPCR</option>
                                    <option value="OPCR - Campus Director">OPCR - Campus Director</option>
                                    <option value="OPCR - ADAF">OPCR - ADAF</option>
                                    <option value="OPCR - ADAA">OPCR - ADAA</option>
                                    <option value="OPCR - ADRE">OPCR - ADRE</option>
                                    <option value="OPCR - Academics Department">OPCR - Academics Department</option>
                                    <option value="OPCR - Accounting">OPCR - Accounting</option>
                                    <option value="OPCR - Budget">OPCR - Budget</option>
                                    <option value="OPCR - Cashier">OPCR - Cashier</option>
                                    <option value="OPCR - Medical Serv">OPCR - Medical Serv</option>
                                    <option value="OPCR - IDO">OPCR - IDO</option>
                                    <option value="OPCR - Industry Based">OPCR - Industry Based</option>
                                    <option value="OPCR - PDO">OPCR - PDO</option>
                                    <option value="OPCR - Procurement">OPCR - Procurement</option>
                                    <option value="OPCR - QAA">OPCR - QAA</option>
                                    <option value="OPCR - Records">OPCR - Records</option>
                                    <option value="OPCR - UITC">OPCR - UITC</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="function_name">Function Name</label>
                                <select name="function_name" class="form-control form-control-sm" id="functionname">
                                    <option disabled style="font-weight: bold; font-size: 12pt;">IPCR RELATED FUNCTION</option>
                                    <option value="Higher and Advanced Education Programs and Support Functions">Higher and Advanced Education Programs and Support Functions</option>
                                    <option value="Core Administrative Functions">Core Administrative Functions</option>
                                    <option value="Research/Technical Advisory and Extension Programs">Research/Technical Advisory and Extension Programs</option>
                                    <option disabled style="font-weight: bold; font-size: 12pt;">OPCR RELATED FUNCTION</option>
                                    <option value="Core Administrative Functions, General Administration and Support to Operations, Higher and Advanced Education Programs, Research and Technical Advisory Extension Program">Core Administrative Functions, General Administration and Support to Operations, Higher and Advanced Education Programs, Research and Technical Advisory Extension Program</option>
                                    <option value="Higher and Advanced Education Programs, Core Administrative Functions, General Administration and Support to Operations">Higher and Advanced Education Programs, Core Administrative Functions, General Administration and Support to Operations</option>
                                    <option value="Research Program, Core Administrative Functions, General Administration and Support Functions">Research Program, Core Administrative Functions, General Administration and Support Functions</option>
                                    <option value="Higher and Advanced Education Programs, Research and Technical Advisory Extension Programs, Core Administrative Functions, Support to Operations and General Administration Support">Higher and Advanced Education Programs, Research and Technical Advisory Extension Programs, Core Administrative Functions, Support to Operations and General Administration Support</option>
                                    <option value="Core Administrative Functions, General Administration and Support to Operations">Core Administrative Functions, General Administration and Support to Operations</option>
                                    <option value="Support Functions for Higher and Advanced Education Programs, Research Programs, Technical Advisory Extension Programs">Support Functions for Higher and Advanced Education Programs, Research Programs, Technical Advisory Extension Programs</option>
                                    <option value="Core Administrative Functions, General Administration and Support Functions">Core Administrative Functions, General Administration and Support Functions</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="multiplier">Multiplier</label>
                                <input type="number" class="form-control form-control-sm" min="0.0000" max="1.0000" step="0.0001" name="multiplier" id="multiplier">
                                <div class="note-group">
                                    Value ranging 0.0 to 1.0 (Ex. 0.65 = 65%)
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <!-- Add Information Button-->
                            <input class="btn btn-secondary btn-sm" type="submit" value="Submit">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteformmultiplier" tabindex="-1" role="dialog" aria-labelledby="deleteformmultiplierlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteformmultiplier">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('formmultiplier.destroy', 'test')}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="modal-body">
                        <label style="font-weight: normal;">Are you sure do you want to delete this Evaluation Form Multiplier?</label>
                        <input type="hidden" name="formmultiplierid" id="formmultiplierid">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#formname").change(function() {
            $('#functionname').html('')

            //IPCR RELATED DYNAMICALLY CHANGE THE FUNCTION NAME BASED ON SELECTED FORM (FUNCTION VALUES)
            let selectedform = $(this).children("option:selected").val();
            let ipcrFunctionValues1 =
                {
                    "Core Administrative Functions": "Core Administrative Functions",
                    "Higher and Advanced Education Programs and Support Functions": "Higher and Advanced Education Programs and Support Functions",
                    "Research/Technical Advisory and Extension Programs": "Research/Technical Advisory and Extension Programs"
                }
            let ipcrFunctionValues2 =
                {
                    "Higher and Advanced Education Programs and Support Functions": "Higher and Advanced Education Programs and Support Functions",
                    "Research/Technical Advisory and Extension Programs": "Research/Technical Advisory and Extension Programs"
                }

            let ipcrFunctionValues3 = {
                "Support Functions": "Support Functions",
            }

            if (selectedform === 'IPCR - College Sec Associate Professor' || selectedform === 'IPCR - College Sec Assistant Professor' ||
                selectedform === 'IPCR - College Sec Professor' || selectedform === 'IPCR - College Sec Instructor' ||
                selectedform === 'IPCR - Faculty with Admin Function Associate Professor' || selectedform === 'IPCR - Faculty with Admin Function Assistant Professor' ||
                selectedform === 'IPCR - Faculty with Admin Function Professor' || selectedform === 'IPCR - Faculty with Admin Function Instructor' ||
                selectedform === 'IPCR - Faculty with Quasi Function Associate Professor' || selectedform === 'IPCR - Faculty with Quasi Function Assistant Professor' ||
                selectedform === 'IPCR - Faculty with Quasi Function Professor' || selectedform === 'IPCR - Faculty with Quasi Function Instructor') {
                $.each(ipcrFunctionValues1, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'IPCR - Fulltime Associate Professor' || selectedform === 'IPCR - Fulltime Assistant Professor' ||
                selectedform === 'IPCR - Fulltime Professor' || selectedform === 'IPCR - Fulltime Instructor') {
                $.each(ipcrFunctionValues2, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'IPCR - Fulltime Admin') {
                $.each(ipcrFunctionValues3, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            //OPCR RELATED DYNAMICALLY CHANGE THE FUNCTION NAME BASED ON SELECTED FORM (FUNCTION VALUES)
            let opcrFunctionValues1 =
                {
                    "Core Administrative Functions, General Administration and Support to Operations, Higher and Advanced Education Programs, Research and Technical Advisory Extension Program": "Core Administrative Functions, General Administration and Support to Operations, Higher and Advanced Education Programs, Research and Technical Advisory Extension Program",
                }
            let opcrFunctionValues2 =
                {
                    "Higher and Advanced Education Programs, Core Administrative Functions, General Administration and Support to Operations": "Higher and Advanced Education Programs, Core Administrative Functions, General Administration and Support to Operations"
                }
            let opcrFunctionValues3 =
                {
                    "Research Program, Core Administrative Functions, General Administration and Support Functions": "Research Program, Core Administrative Functions, General Administration and Support Functions"
                }
            let opcrFunctionValues4 =
                {
                    "Higher and Advanced Education Programs, Research and Technical Advisory Extension Programs, Core Administrative Functions, Support to Operations and General Administration Support": "Higher and Advanced Education Programs, Research and Technical Advisory Extension Programs, Core Administrative Functions, Support to Operations and General Administration Support"
                }
            let opcrFunctionValues5 =
                {
                    "Core Administrative Functions, General Administration and Support to Operations": "Core Administrative Functions, General Administration and Support to Operations",
                    "Support Functions for Higher and Advanced Education Programs, Research Programs, Technical Advisory Extension Programs": "Support Functions for Higher and Advanced Education Programs, Research Programs, Technical Advisory Extension Programs"
                }
            let opcrFunctionValues6 =
                {
                    "Core Administrative Functions, General Administration and Support Functions": "Core Administrative Functions, General Administration and Support Functions"
                }
            let opcrFunctionValues7 =
                {
                    "Research Program, Core Administrative Functions, General Administration and Support Functions": "Research Program, Core Administrative Functions, General Administration and Support Functions"
                }

            if (selectedform === 'OPCR - Campus Director' || selectedform === 'OPCR - ADAF') {
                $.each(opcrFunctionValues1, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'OPCR - ADAA') {
                $.each(opcrFunctionValues2, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'OPCR - ADRE') {
                $.each(opcrFunctionValues3, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'OPCR - Academics Department') {
                $.each(opcrFunctionValues4, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'OPCR - Accounting' || selectedform === 'OPCR - Budget' ||
                selectedform === 'OPCR - Cashier' || selectedform === 'OPCR - Medical Serv') {
                $.each(opcrFunctionValues5, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'OPCR - IDO') {
                $.each(opcrFunctionValues6, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

            if (selectedform === 'OPCR - Industry Based' || selectedform === 'OPCR - PDO' ||
                selectedform === 'OPCR - Procurement' || selectedform === 'OPCR - QAA' ||
                selectedform === 'OPCR - Records' || selectedform === 'OPCR - UITC') {
                $.each(opcrFunctionValues7, function (key, value) {
                    $('#functionname')
                        .append($('<option>', {value: key})
                            .text(value))
                });
            }

        });
    </script>

@endsection

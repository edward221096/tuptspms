@extends('layouts.sidebar')
@section('myevaluationforms')
    <style>
        .alert{
            width: 100%;
        }

        .table-sortable th {
            cursor: pointer;
        }

        .table-sortable .th-sort-asc::after {
            content: "\25b4";
        }

        .table-sortable .th-sort-desc::after {
            content: "\25be";
        }

        .table-sortable .th-sort-asc::after,
        .table-sortable .th-sort-desc::after {
            margin-left: 5px;
        }

        .table-sortable .th-sort-asc,
        .table-sortable .th-sort-desc {
            background: rgba(0, 0, 0, 0.1);
        }

    </style>
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
        @if(session()->has('denied'))
            <div class="row">
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            &times;
                    </button>
                    <strong>Information: </strong> {{ session()->get('denied') }}
                </div>
            </div>
        @endif
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
        <h3 class="mt-4">My Evaluation Forms</h3>
        <p>Manage my Evaluation Forms</p>

        <div>
            <label for="select_status">Filter by Status:</label>
            <select class="form-control form-control-sm">
                <option selected value="ALL">ALL</option>
                <option value="For Evaluation (Immediate/Commitee)">For Evaluation (Immediate/Commitee)</option>
                <option value="For Verification">For Verification</option>
                <option value="For Validation/Audit">For Validation/Audit</option>
                <option value="Approved (Cannot be edited)">Approved (Cannot be edited)</option>
            </select>
        </div>

        <table class="table table-striped table-sortable">
            <thead>
            <tr style="font-size: 11pt; text-align: center;">
                <th>FORM TYPE</th>
                <th>NAME</th>
                <th>ROLE</th>
                <th>SECTOR/DIVISION</th>
                <th>COLLEGE/DEPARTMENT/OFFICE</th>
                <th>PERIOD</th>
                <th>STATUS</th>
                <th>RATING</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            @foreach($myevaluationform as $row)
                <tr style="font-size: 11pt;">
                    <td style ="word-wrap: break-word;">{{$row->evaluationform_name}}</td>
{{--                    <td style ="word-wrap: break-word;">{{$row->form_type}}</td>--}}
                    <td style ="word-wrap: break-word;">{{$row->name}}</td>
                    <td style ="word-wrap: break-word;">{{$row->ratee_role}}</td>
                    <td style ="word-wrap: break-word;">{{$row->division_name}}</td>
                    <td style ="word-wrap: break-word;">{{$row->dept_name}}</td>
                    <td style ="word-wrap: break-word;">{{$row->evaluation_startdate}} to {{$row->evaluation_enddate}}</td>

                    @if($row->evaluationform_status == 'Approved (Cannot be edited)')
                        <td style="color: green;">{{$row->evaluationform_status}}</td>
                    @else
                        <td style="color: red;">{{$row->evaluationform_status}}</td>
                    @endif
                    @if($row->total_weighted_score < '3.0')
                        <td style="color: red; word-wrap: break-word;">{{$row->total_weighted_score}}</td>
                    @else
                        <td style="color: green; word-wrap: break-word;">{{$row->total_weighted_score}}</td>
                    @endif
                    <td>
                            <!-- EDIT FORM TYPE BUTTON -->
                        @if($row->evaluationform_name == 'ipcrcsassocp')
                            <a href="{{action('MyEvaluationFormController@editmyipcrcsassocp', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrcsassisp')
                            <a href="{{action('MyEvaluationFormController@editmyipcrcsassisp', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrcsprofessor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrcsprofessor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrcsinstructor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrcsinstructor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfafassocp')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfafassocp', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfafassisp')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfafassisp', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfafprofessor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfafprofessor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfafinstructor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfafinstructor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfqfassocp')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfqfassocp', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfqfassisp')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfqfassisp', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfqfprofessor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfqfprofessor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfqfinstructor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfqfinstructor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfassprofessor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfassprofessor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfastprofessor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfastprofessor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfprofessor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfprofessor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfinstructor')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfinstructor', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'ipcrfulladmin')
                            <a href="{{action('MyEvaluationFormController@editmyipcrfulladmin', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrcampusdirector')
                            <a href="{{action('MyEvaluationFormController@editmyopcrcampusdirector', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcradaf')
                            <a href="{{action('MyEvaluationFormController@editmyopcradaf', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcradaa')
                            <a href="{{action('MyEvaluationFormController@editmyopcradaa', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcracademics')
                            <a href="{{action('MyEvaluationFormController@editmyopcracademics', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcraccounting')
                            <a href="{{action('MyEvaluationFormController@editmyopcraccounting', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcradre')
                            <a href="{{action('MyEvaluationFormController@editmyopcradre', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrbudget')
                            <a href="{{action('MyEvaluationFormController@editmyopcrbudget', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrcashier')
                            <a href="{{action('MyEvaluationFormController@editmyopcrcashier', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrido')
                            <a href="{{action('MyEvaluationFormController@editmyopcrido', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrindustrybased')
                            <a href="{{action('MyEvaluationFormController@editmyopcrindustrybased', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrmedicalserv')
                            <a href="{{action('MyEvaluationFormController@editmyopcrmedicalserv', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrpdo')
                            <a href="{{action('MyEvaluationFormController@editmyopcrpdo', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrprocurement')
                            <a href="{{action('MyEvaluationFormController@editmyopcrprocurement', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrqaa')
                            <a href="{{action('MyEvaluationFormController@editmyopcrqaa', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcrrecords')
                            <a href="{{action('MyEvaluationFormController@editmyopcrrecords', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
                        @elseif($row->evaluationform_name == 'opcruitc')
                            <a href="{{action('MyEvaluationFormController@editmyopcruitc', $row->id)}}" class="btn btn-secondary btn-sm" type="submit">View</a>
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
                <form method="POST" action="{{ route('myevaluationform.destroy', 'test')}}">
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

    <script type="text/javascript">
        /**
         * Sorts a HTML table.
         *
         * @param {HTMLTableElement} table The table to sort
         * @param {number} column The index of the column to sort
         * @param {boolean} asc Determines if the sorting will be in ascending
         */
        function sortTableByColumn(table, column, asc = true) {
            const dirModifier = asc ? 1 : -1;
            const tBody = table.tBodies[0];
            const rows = Array.from(tBody.querySelectorAll("tr"));

            // Sort each row
            const sortedRows = rows.sort((a, b) => {
                const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
                const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

                return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
            });

            // Remove all existing TRs from the table
            while (tBody.firstChild) {
                tBody.removeChild(tBody.firstChild);
            }

            // Re-add the newly sorted rows
            tBody.append(...sortedRows);

            // Remember how the column is currently sorted
            table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
            table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
        }

        document.querySelectorAll(".table-sortable th").forEach(headerCell => {
            headerCell.addEventListener("click", () => {
                const tableElement = headerCell.parentElement.parentElement.parentElement;
                const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
                const currentIsAscending = headerCell.classList.contains("th-sort-asc");

                sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
            });
        });

        $('select').change( function(e) {
            var letter = $(this).val();
            if (letter === 'ALL') {
                $ ('tr').show ();
            }
            else {
                $('tr').each( function(rowIdx,tr) {
                    $(this).hide().find('td').each( function(idx, td) {
                        if( idx === 6) {
                            var check = $(this).text();
                            if (check && check.indexOf(letter) === 0) {
                                $(tr).show();
                            }
                        }
                    });

                });
            }
        });
    </script>
@endsection

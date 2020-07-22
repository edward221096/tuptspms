<!doctype html>

<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<link rel="icon" type="image/png" href="{!! asset('images/tuptlogo.png') !!}"/>
<title>TUP-Taguig SPMS</title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href=" {{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }} ">
<!-- Theme style -->
<link rel="stylesheet" href=" {{ asset('adminlte/dist/css/adminlte.min.css') }}">
<!-- Google Font: Source Sans Pro -->

<!-- Bootstrap core JavaScript -->
<!-- jQuery -->
<script src=" {{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src=" {{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src=" {{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <style>
        input[type="number"]{
            width:73px
        }

        .alert{
            width: 100%;
        }
    </style>
</head>
<body>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
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
                        @foreach($ratingsinglevalue as $row)
                        <!-- UPDATE ALL THE USER DATA TO RATING TABLE -->
                        <form action="{{route('updatemyipcr.update', [$row->form_sequence_id])}}" method="post">
                            {{method_field('PATCH')}}
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $row->user_id }}" name="user_id[]">
                            <input type="hidden" value="{{ $row->division_id}}" name="division_id[]">
                            <input type="hidden" value="{{ $row->dept_id }}" name="dept_id[]">
                            <input type="hidden" value="{{ $row->section_id }}" name="section_id[]">
                            <input type="hidden" value="{{ $row->ratee_role }}" name="ratee_role[]">
                            <input type="hidden" value="{{ $row->evaluation_startdate }}" name="evaluation_startdate[]">
                            <input type="hidden" value="{{ $row->evaluation_enddate }}" name="evaluation_enddate[]">
                            <input type="hidden" value="{{ $row->form_id}}" name="form_id[]">
                            <input type="hidden" value="{{ $row->form_sequence_id }}" name="form_sequence_id[]">
                            <input type="hidden" value="{{ $row->evaluationform_name }}" name="evaluationform_name[]">

                            <label>
                                Evaluation Form Status:
                                <select name="evaluationform_status[]" class="form-control form-control-sm">
                                    @if(Auth::User()->role == 'Fulltime - Assistant Professor')
                                        <option readonly="{{$row->evaluationform_status}}" selected value="{{$row->evaluationform_status}}">Current Form Status: {{$row->evaluationform_status}}</option>
                                    @else
                                        <option readonly="{{$row->evaluationform_status}}" selected value="{{$row->evaluationform_status}}">Current Form Status: {{$row->evaluationform_status}}</option>
                                        <option value="For Review and Approval">For Review and Approval</option>
                                        <option value="For Re-evaluation">For Re-evaluation</option>
                                        <option value="Approved by Head">Approved by Head</option>
                                        <option value="Approved (Cannot be edited)">Approved (Cannot be edited)</option>
                                    @endif
                                </select>

                            </label>

                        @endforeach
                        <div>
                            <table width="" style="font-family: 'Times New Roman';; font-size: medium; border-collapse: collapse">
                                <tbody>
                                <tr style="background-color: rgb(255, 255, 255)">
                                    <td rowspan="4" style="width: 101px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><img style="width: 100px; height: 100px;" type="image/png" src="{!! asset('images/tuptlogo.png') !!} " alt="TUP-T Logo"></td>
                                    <td rowspan="4" style="text-align: center; width: 983px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES - TAGUIG CAMPUS</b></span>
                                        <br><span style="color: rgb(34, 34, 34); font-family: Arial; font-size: 10pt; text-align: left; background-color: rgb(255, 255, 255); display: inline !important">14 East Service Road Western Bicutan Taguig, 1630 Metro Manila</span><span style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 14px; text-align: left; background-color: rgb(255, 255, 255); display: inline !important"><br></span><span style="font-size: 10pt; font-family: Arial">(02) 8823 2457</span>
                                        <br><span style="font-size: 10pt; font-family: Arial">Email: planning@tup.edu.ph | Website: www.tup.edu.ph</span></td>
                                    <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-family: Arial">​</span><span style="font-family: Arial; font-size: 10pt">Index No.</span>
                                        <br>
                                    </td>
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial">F-PDO-9.1-IPC</span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255)">
                                    <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial">Issue No.</span></td>
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial">01</span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255)">
                                    <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial">Revision No.</span></td>
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171); width: 343px"><span style="font-size: 10pt; font-family: Arial">02</span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255)">
                                    <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial">Date</span></td>
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 10pt; font-family: Arial">09242019</span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255)">
                                    <td rowspan="2" style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-family: Arial; font-size: 10pt">VPD-PDO</span></td>
                                    <td rowspan="2" style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 12pt; font-family: Arial"><b>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR)</b></span></td>
                                    <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-family: Arial; font-size: 10pt">Page</span></td>
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-family: Arial; font-size: 10pt">1/23</span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255)">
                                    <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-family: Arial; font-size: 10pt">QAC No.</span></td>
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-family: Arial; font-size: 10pt">CC-10182019</span><span style="font-family: Arial; font-size: 10pt"><br></span></td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>
                        <div>
                            <!-- Getting the currently logged user -->
                            <p style="margin: 0cm 0cm 10pt; line-height: 115%; font-size: 11pt; font-family: Calibri, sans-serif;margin-bottom:0cm;margin-bottom:.0001pt;text-align:
                    justify;line-height:normal"><span style="font-family: Arial; font-size: 10pt;">I, </span><span style="font-family: Arial; font-size: 10pt;"><b><u>
                                            @foreach($userdata as $row)
                                            {{$row->name}},
                                            </u></b></span><span style="font-family: Arial; font-size: 10pt;"> </span><span style="font-family: Arial; font-size: 10pt;"><b><u>{{$row->ratee_role}},</u></b></span><span style="font-family: Arial; font-size: 10pt;"></span><span style="font-family: Arial; font-size: 10pt;"><b><u>
                                            {{$row->division_name}} / {{$row->dept_name}} / {{$row->section_name}}
                                        </u></b></span><span style="font-family: Arial; font-size: 10pt;">,
                    Technological University of the Philippines - Taguig, commits to deliver and
                    agree to be rated on the attainment of the following targets in accordance with
                    the indicated measures for the period </span><span style="font-family: Arial; font-size: 10pt;">
                                    @endforeach
                                    <b>
                                        <u>
                    <!-- TO DISPLAY THE EVALUATION PERIOD START AND END DATE -->
                                            @foreach($ratingsinglevalue as $row)
                                                {{ $row->evaluation_startmonth }} {{ $row->evaluation_startyear }}
                                                TO
                                                {{ $row->evaluation_endmonth }} {{ $row->evaluation_endyear }}
                                            @endforeach

                                        </u>
                                    </b>
                                </span>
                            </p>
                            <br>
                        </div>
                        <div><span style="font-family: Arial;">____________________</span></div>
                        <div><span style="font-size: 10pt; font-family: Arial;">&nbsp; &nbsp;Signature of Employee</span></div>
                        <div>
                            <br>
                        </div>
                        <div><span style="font-size: 10pt; font-family: Arial;">Date: <input name="date" value="<?= date('Y-m-d',time()) ;?>" readonly></span></div>
                        <div>
                            <br>
                        </div>
                        <div>
                            <table cellspacing="0" cellpadding="1" style="border-collapse: collapse;" width="">
                                <tbody>
                                <tr style="background-color: rgb(255, 255, 255);">
                                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"><span style="font-size: 10pt; font-family: Arial;">Approved by:</span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255);">
                                    <td style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171); width: 373px;">
                                        @foreach($ratingsinglevalue as $row)
                                            @if(Auth::User()->role !== 'Super Admin' AND Auth::User()->role !== 'Section Head' AND Auth::User()->role !== 'Department Head' AND Auth::User()->role !== 'Division Head')
                                                <br><span style="font-family: Arial; font-size: 12pt; text-decoration: underline;"><b><input type="text" class="form-control form-control-sm" readonly style="color: black; text-align: center; font-family: Arial; font-size: 12pt; text-decoration: underline; !important" value="{{$row->rater_esignature}}"></b></span>
                                            @else
                                                <br><span style="font-family: Arial; font-size: 12pt; text-decoration: underline;"><b><input type="text" class="form-control form-control-sm" style="color: black; text-align: center; font-family: Arial; font-size: 12pt; text-decoration: underline; !important" value="{{$row->rater_esignature}}"></b></span>
                                            @endif
                                        @endforeach
                                        <span style="font-family: Arial; font-size: 12pt;"><b>Name of Evaluator</b></span>
                                        <br><span style="font-size: 10pt; font-family: Arial;">Position/Designation</span></td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                        </div>
                        <div>

                            <table cellspacing="0" cellpadding="1" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                <tr style="background-color: rgb(255, 255, 255);">
                    {{--                <td style="text-align: center; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;">​</span><span style="font-family: Arial; font-size: 10pt;"><b>FUNCTION NAME</b></span><b><br></b></td>--}}
                                    <td style="text-align: center; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;">​</span><span style="font-family: Arial; font-size: 10pt;"><b>ORGANIZATIONAL OUTCOMES/KEY RESULTS AREA</b></span><b><br></b></td>
                                    <td style="text-align: center; width: 341px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;"><b>QUALITY + OBJECTIVES</b></span><b><br></b><span style="font-family: Arial; font-size: 10pt;"><b>&nbsp;(TARGETS + MEASURES)</b></span></td>
                                    <td style="text-align: center; width: 437px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;"><b>ACTUAL ACCOMPLISHMENTS</b></span></td>
                                    <td style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" colspan="4"><span style="font-family: Arial; font-size: 10pt;"><b>RATING</b></span></td>
                                    <td style="text-align: center; width: 366px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;"><b>REMARKS</b></span></td>
                                </tr>
                                <tr style="background-color: rgb(255, 255, 255);">
                                    <td style="text-align: center; width: 44px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"><span style="font-family: Arial; font-size: 10pt;"><b>Q</b></span></td>
                                    <td style="text-align: center; width: 49px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"><span style="font-family: Arial; font-size: 10pt;"><b>E</b></span></td>
                                    <td style="text-align: center; width: 44px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"><span style="font-family: Arial; font-size: 10pt;"><b>T</b></span></td>
                                    <td style="text-align: center; width: 73px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"><span style="font-family: Arial; font-size: 10pt;"><b>A</b></span></td>
                                </tr>
                                </thead>

                                @foreach($ratingsmultiplevalue as $row)
                                    <input type="hidden" value="{{ $row->id }}" name="rating_id[]">
                                    <input type="hidden" value="{{ $row->mfo_id}}" name="mfo_id[]">
                                    <input type="hidden" value="{{ $row->function_name}}" name="function_name[]">
                                    <input type="hidden" value="{{ $row->mfo_desc }}" name="mfo_desc[]">
                                    <input type="hidden" value="{{ $row->success_indicator_desc }}" name="success_indicator_desc[]">
                                    <input type="hidden" value="{{ $row->remarks }}" name="remarks[]">
                                    <tbody>
                                        <tr style="vertical-align: top;">
                    {{--                    <td style="text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->function_name !!} </td>--}}
                                        <td style="text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->mfo_desc !!}</td>
                                        <td style="text-align: left; width: 341px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->success_indicator_desc !!}</td>
                                            <td style="position: relative; text-align: center; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0"><textarea style="position: absolute; height: 100%; width: 100%;" class="form-control form-control-sm" name="actual_accomplishment_desc[]">{{$row->actual_accomplishment_desc}}</textarea></td>
                                        </tr>
                                        <tr style="background-color: rgb(255, 255, 255); vertical-align: top">
                                            <td rowspan="0" style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
                                                <div class="form-label-group">
                                                    <select name="Q[]" class="form-control form-control-sm q-value" style="width: 50px">
                                                        <option selected value="{{ $row->Q1 }}">{{ $row->Q1 }}</option>
                                                        <option value=""></option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td rowspan="0" style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
                                                <div class="form-label-group">
                                                    <select name="E[]" class="form-control form-control-sm e-value" style="width: 50px">
                                                        <option selected value="{{ $row->E2 }}">{{ $row->E2 }}</option>
                                                        <option value=""></option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td rowspan="0" style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
                                                <div class="form-label-group">
                                                    <select name="T[]" class="form-control form-control-sm t-value" style="width: 50px">
                                                        <option selected value="{{ $row->T3 }}">{{ $row->T3 }}</option>
                                                        <option value=""></option>
                                                        <option value="5">5</option>
                                                        <option value="4">4</option>
                                                        <option value="3">3</option>
                                                        <option value="2">2</option>
                                                        <option value="1">1</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td rowspan="0" style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
                                                <div class="form-label-group">
                                                    @if($row->function_name == 'Higher and Advanced Education Program' || $row->function_name == 'Support Functions')
                                                        <input type="number" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm a-value-support"
                                                               name="A[]" value="{{ $row->A4 }}" style="width: 73px" readonly>
                                                    @endif
                                                    @if($row->function_name == 'Research Program' || $row->function_name == 'Technical Advisory Extension Program')
                                                        <input type="number" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm a-value-research"
                                                               name="A[]" value="{{ $row->A4}}" style="width: 73px" readonly>
                                                    @endif

                                                </div>
                                            </td>

                                            <td style="text-align: center; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->remarks !!}</td>
                                        </tr>
                                    </tbody>
                            @endforeach
                            </table>
                            <div>
                                <br>
                                <input type="button" class="btn btn-secondary btn-sm btn-reset" value="Reset All Values">
                                <br>
                                <br>
                            </div>
                            @foreach($ratingsinglevalue as $row)

                            <div style="box-sizing: border-box; color: rgb(33, 37, 41); text-align: left; background-color: rgb(255, 255, 255);">
                                <font face="Arial">
                                    <span style="font-size: 13.3333px;"><b>RATINGS</b></span>
                                </font>
                            </div>
                            <table
                                width=""
                                style="
                            box-sizing: border-box;
                            border-collapse: collapse;
                            color: rgb(33, 37, 41);
                            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
                            text-align: left;
                            background-color: rgb(255, 255, 255);
                            border: none;
                        "
                            >
                                <tbody>
                                <tr style="box-sizing: border-box;">
                                    <td width="514" style="box-sizing: border-box; border: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;"></td>
                                    <td
                                        width="25"
                                        style="box-sizing: border-box; border-top: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: none; padding: 0cm 5.4pt;"
                                        colspan="4"
                                    >
                                        <div align="center" style="box-sizing: border-box; margin: 0px 0cm 0.000133333px; text-align: center;">
                                            <b style="font-family: Calibri, sans-serif; font-size: 14.6667px; background-color: rgb(255, 255, 255); box-sizing: border-box; font-weight: bolder;">
                                                <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;">FINAL RATINGS</span>
                                            </b>
                                            <br />
                                        </div>
                                    </td>
                                    <td width="254" style="box-sizing: border-box; border-top: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: none; padding: 0cm 5.4pt;">
                                        <p align="center" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                                            <b style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;">REMARKS</span></b>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="box-sizing: border-box; height: 2.9pt;">
                                    <td
                                        width="514"
                                        style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt; width: 892px;"
                                    >
                                        <div align="right" style="box-sizing: border-box; margin: 0px 0cm 0.000133333px; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right;">
                                            <b style="color: rgb(0, 0, 0); font-family: Arial, sans-serif; font-size: 13.3333px; box-sizing: border-box; font-weight: bolder;">
                                                Higher and Advanced Education Programs and Support Functions&nbsp;<br style="box-sizing: border-box;" />
                                                Weighted Average (70%)
                                            </b>
                                            <br />
                                        </div>
                                    </td>
                                    <td width="25" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; width: 309px;" colspan="4">
                                        <!-- Total Rating for Function -->
                                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm" id="support-total-average" name="support_total_average[]" value="{{$row->support_total_average}}" readonly>
                                    </td>
                                    <td width="254" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;">
                                        <p align="center" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;"><br />Supports functions includes involvement on various programs, activities and projects related to faculty/staff development and institutional awards, etc. </p>
                                    </td>
                                </tr>
                                <tr style="box-sizing: border-box;">
                                    <td width="514" style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt;">
                                        <div align="right" style="box-sizing: border-box; margin: 8px 0cm; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right; line-height: 12.65pt;">
                                            <p align="right" style="background-color: rgb(255, 255, 255); box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                                                <b style="box-sizing: border-box; font-weight: bolder;">
                                                    <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Research/ Technical Advisory and Extension Programs</span>
                                                </b>
                                                <span style="box-sizing: border-box; color: black;"></span>
                                            </p>
                                            <p align="right" style="background-color: rgb(255, 255, 255); box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif;">
                                                <b style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Weighted Average (30%)</span></b>
                                            </p>
                                        </div>
                                    </td>
                                    <td width="25" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;" colspan="4">
                                        <!-- Total Rating for Function -->
                                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm" id="research-total-average" name="research_total_average[]" value="{{$row->research_total_average}}" readonly>
                                    </td>
                                    <td width="254" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; width: 524px;">
                                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                                            <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;"></span>
                                        </p>
                                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                                            <span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;"></span>
                                            <span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;">&nbsp;</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr style="box-sizing: border-box;">
                                    <td
                                        width="514"
                                        style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt; height: 2.9pt;"
                                    >
                                        <p align="right" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right;">
                                            <b style="box-sizing: border-box;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;">Total Weighted Score</span></b>
                                        </p>
                                    </td>
                                    <td width="25" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; height: 2.9pt;" colspan="4">
                                        <p align="center" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                                                <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm total-weighted-score-color" id="total-weighted-score" name="total_weighted_score[]" value="{{$row->total_weighted_score}}" readonly>
                                        </p>
                                    </td>
                                    <td width="254" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; height: 2.9pt;">
                                        <p align="center" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                                            <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;"><o:p style="box-sizing: border-box;">&nbsp;</o:p></span>
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <div>
                                <table style="width: 100%; border-collapse: collapse; mso-yfti-tbllook: 1184; mso-padding-alt: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                    <tbody>
                                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes; mso-yfti-lastrow: yes;">
                                        <td width="1440" style="width: 1080pt; border: solid #ababab 1pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                                <b><span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">&nbsp;RATING SCALE:</span></b>
                                                <span style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: justify; line-height: normal;">
                                                <b><span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">&nbsp;</span></b>
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">
                                                5 - Outstanding&nbsp; &nbsp; &nbsp;4 - Very Satisfactory&nbsp; &nbsp; &nbsp;3 - Satisfactory&nbsp; &nbsp; &nbsp;2 - Unsatisfactory&nbsp; &nbsp; &nbsp;1 - Poor
                                            </span>
                                                <span style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                                <span style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;"><br /> </span>
                                                <b>
                                                    <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">&nbsp;LEGEND:<br /> </span>
                                                </b>
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                                                &nbsp;Q - Quantity/Efficiency&nbsp; &nbsp; &nbsp;E - Effectiveness/Quality&nbsp; &nbsp; &nbsp;T - Timelines&nbsp; &nbsp; &nbsp;A - Average
                                            </span>
                                                <span style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                    <b>
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">
                                    <br />
                                    The above rating has been discussed with me by my immediate supervisor:
                                </span>
                                    </b>
                                </p>
                                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                    <b>
                                        <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;"><br /></span>
                                    </b>
                                </p>
                                <table style="width: 100%; border-collapse: collapse; mso-yfti-tbllook: 1184; mso-padding-alt: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                    <tbody>
                                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                                        <td width="837" style="width: 627.75pt; border: solid #ababab 1pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                        <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;">
                            &nbsp;<span style="color: black; mso-color-alt: windowtext; background: white;">Name and Signature of Ratee:&nbsp;
                                <input type="text" class="form-control form-control-sm" name="ratee_esignature[]" value="{{$row->ratee_esignature}}" readonly>
                            </span>
                        </span>
                                            </p>
                                        </td>
                                        <td width="800" style="width: 600pt; border: solid #ababab 1pt; border-left: none; mso-border-left-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                        <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                            @if(Auth::User()->role !== 'Super Admin' AND Auth::User()->role !== 'Section Head' AND Auth::User()->role !== 'Department Head' AND Auth::User()->role !== 'Division Head')
                                &nbsp;Name and Signature of Rater: <input type="text" class="form-control form-control-sm" readonly name="rater_esignature[]" value="{{$row->rater_esignature}}">
                            @else
                                Name and Signature of Rater: <input type="text" class="form-control form-control-sm" name="rater_esignature[]" value="{{$row->rater_esignature}}">
                            @endif
                        </span>
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="mso-yfti-irow: 1;">
                                        <td style="border: solid #ababab 1pt; border-top: none; mso-border-top-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                            <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                                    Position: <input type="text" class="form-control form-control-sm" name="ratee_role[]" disabled value="{{$row->ratee_role}}" readonly></span>
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                        </td>
                                        <td
                                            style="
                        border-top: none;
                        border-left: none;
                        border-bottom: solid #ababab 1pt;
                        border-right: solid #ababab 1pt;
                        mso-border-top-alt: solid #ababab 0.75pt;
                        mso-border-left-alt: solid #ababab 0.75pt;
                        mso-border-alt: solid #ababab 0.75pt;
                        background: white;
                        padding: 0.6pt 0.6pt 0.6pt 0.6pt;
                    "
                                        >
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                            <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                                @if(Auth::User()->role !== 'Super Admin' AND Auth::User()->role !== 'Section Head' AND Auth::User()->role !== 'Department Head' AND Auth::User()->role !== 'Division Head')
                                    &nbsp;Position: <input type="text" class="form-control form-control-sm" name="rater_role[]" readonly value="{{$row->rater_role}}"></span>
                                                @else
                                                    Position: <input type="text" class="form-control form-control-sm" name="rater_role[]" value="{{$row->rater_role}}">
                                                @endif
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="mso-yfti-irow: 2; mso-yfti-lastrow: yes;">
                                        <td style="border: solid #ababab 1pt; border-top: none; mso-border-top-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Date: <input type="date" class="form-control form-control-sm" name="ratee_date[]" value="{{$row->ratee_date}}" readonly></span>
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                        </td>
                                        <td
                                            style="
                        border-top: none;
                        border-left: none;
                        border-bottom: solid #ababab 1pt;
                        border-right: solid #ababab 1pt;
                        mso-border-top-alt: solid #ababab 0.75pt;
                        mso-border-left-alt: solid #ababab 0.75pt;
                        mso-border-alt: solid #ababab 0.75pt;
                        background: white;
                        padding: 0.6pt 0.6pt 0.6pt 0.6pt;
                    "
                                        >
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                            <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                                @if(Auth::User()->role !== 'Super Admin' AND Auth::User()->role !== 'Section Head' AND Auth::User()->role !== 'Department Head' AND Auth::User()->role !== 'Division Head')
                                    &nbsp;Date:&nbsp;<input type="date" class="form-control form-control-sm" readonly name="rater_date[]" value="{{$row->rater_date}}"></span>
                                                @else
                                                    &nbsp;Date:&nbsp;<input type="date" class="form-control form-control-sm" name="rater_date[]" value="{{$row->rater_date}}">
                                                @endif
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                    <span style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;"><o:p>&nbsp;</o:p></span>
                                </p>
                                <table style="width: 100%; border-collapse: collapse; mso-yfti-tbllook: 1184;">
                                    <tbody>
                                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes; mso-yfti-lastrow: yes;">
                                        <td width="1440" style="width: 1080pt; border: solid #ababab 1pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.75pt 0.75pt 0.75pt 0.75pt;">
                                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                                <span style="font-size: 12pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;">&nbsp;</span>
                                                <b>
                                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                                                    COMMENTS / FEEDBACKS / RECOMMENDATIONS:&nbsp; <textarea class="form-control" rows="5" name="rater_comments[]">{{$row->rater_comments}}</textarea>
                                                </span>
                                                </b>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br />
                                <div>
                                    @if(Auth::User()->role !== 'Super Admin' AND Auth::User()->role !== 'Section Head' AND Auth::User()->role !== 'Department Head' AND Auth::User()->role !== 'Division Head')
                                    <a href="{{ __('/myevaluationforms') }}" class="btn btn-secondary btn-sm" type="submit">Back</a>
                                    @else
                                        <a href="{{ __('/myteamevaluationforms') }}" class="btn btn-secondary btn-sm" type="submit">Back</a>
                                    @endif
                                    <input class="btn btn-primary btn-sm btn-submit" type="submit" value="Update">
                                </div>

                            </div>
                        </div>
                        @endforeach
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    //CLEAR AVERAGE FIELDS AND RESET
    $(document).ready(function(){
        $(".btn-reset").click(function(){
            $('.a-value-core, .a-value-support, .a-value-research, #core-total-average, #support-total-average, #research-total-average, #total-weighted-score').val('');
        });
    });

    //COMPUTE THE AVERAGE PER ROW
    $(".q-value, .e-value, .t-value").change(function(){
        let currentRow = $(this).closest('tr');
        let EValue = Number(currentRow.find('.e-value').val());
        let QValue = Number(currentRow.find('.q-value').val());
        let TValue = Number(currentRow.find('.t-value').val());
        let counter = 0

        if (QValue !== 0){
            counter = counter + 1
        }
        if (EValue !== 0){
            counter = counter + 1
        }
        if (TValue !== 0){
            counter = counter + 1
        }

        currentRow.find('.a-value-support').val((EValue  + QValue + TValue ) / Number(counter));
        currentRow.find('.a-value-research').val((EValue  + QValue + TValue ) / Number(counter));

        computeAvg();
        computeWeightedScore();
        $(".a-value-core, .a-value-support, .a-value-research, #core-total-average, #support-total-average, #research-total-average, #total-weighted-score").trigger("change")
        setFourNumberDecimal();
    });

    //CONDITIONAL FORMATTING COLORS
    $('.total-weighted-score-color').change(function(){
        let totalweightedscore = document.getElementById('total-weighted-score')

        if(totalweightedscore.value < 3.0000){
            totalweightedscore.style.color = "red";
        }
        else {
            totalweightedscore.style.color = "green";
        }
    })

    //COMPUTE AVERAGE FOR EACH FUNCTION
    function computeAvg() {
        // For Support Functons
        avg = 0
        total = 0
        count = 0
        const supvalues = document.getElementsByClassName("a-value-support")
        for (let x = 0; x < supvalues.length; x++) {
            if (supvalues[x].value !== "") {
                count++
                total = total + parseFloat(supvalues[x].value)
            }
        }
        avg = total / count * 0.70
        $('#support-total-average').val(isNaN(avg) ? "" : avg)

        // For Research Services
        avg = 0
        total = 0
        count = 0
        const resvalues = document.getElementsByClassName("a-value-research")
        for (let x = 0; x < resvalues.length; x++) {
            if (resvalues[x].value !== "") {
                count++
                total = total + parseFloat(resvalues[x].value)
            }
        }
        avg = total / count * 0.30
        $('#research-total-average').val(isNaN(avg) ? "" : avg)
    }

    //COMPUTE FOR TOTAL WEIGHTED AVERAGE. If there is incomplete value for function.
    // The weighted score will not do the computation
    function computeWeightedScore(){
        let weightedscore = 0
        let ASuppValue = $("#support-total-average").val()
        let AResValue = $("#research-total-average").val()

        weightedscore = parseFloat(ASuppValue) + parseFloat(AResValue)

        $('#total-weighted-score').val(weightedscore)
    }

    //ROUND OFF TO 4 PLACES INPUT TYPE NUMBER ON CHANGE
    function setFourNumberDecimal(el) {
        el.value = parseFloat(el.value).toFixed(4);
    }
</script>


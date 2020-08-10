@extends('layouts.sidebar')
@section('opcruitc')
    <style>
        input[type="number"]{
            width:73px
        }
        .kbw-signature {
            width: 20%;
            height: auto;
            border-style: solid;
            border-width: thin;
        }
    </style>
    <body>
    <!-- STORE ALL THE USER DATA TO RATING TABLE -->
    <form method="POST" action="/storedataopcruitc">
        {{ csrf_field() }}
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->id}}" name="user_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->division_id}}" name="division_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->dept_id}}" name="dept_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->section_id}}" name="section_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->role}}" name="ratee_role[]">
        <input type="hidden" value="opcruitc" name="evaluationform_name[]">
        @foreach(\App\Http\Controllers\OpcrController::getEvaluationStartDate() as $getstartdate)
            <input type="hidden" value="{{ $getstartdate ->evaluation_startdate }}" name="evaluation_startdate[]">
        @endforeach

        @foreach(\App\Http\Controllers\OpcrController::getEvaluationEndDate() as $getenddate)
            <input type="hidden" value="{{ $getenddate ->evaluation_enddate }}" name="evaluation_enddate[]">
        @endforeach
        <label>
            Evaluation Form Status:
            <select name="evaluationform_status[]" class="form-control form-control-sm">
                <option selected value="For Review and Approval">For Review and Approval</option>
            </select>
        </label>
        <div>
        </div>
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
                <td rowspan="2" style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span style="font-size: 12pt; font-family: Arial"><b>OFFICE PERFORMANCE COMMITMENT AND REVIEW (OPCR)</b></span></td>
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
        <div>
            <!-- Getting the currently logged user -->
            <p style="margin: 0cm 0cm 10pt; line-height: 115%; font-size: 11pt; font-family: Calibri, sans-serif;margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;line-height:normal"><span style="font-family: Arial; font-size: 10pt;">I, </span><span style="font-family: Arial; font-size: 10pt;"><b><u>{{Str::Upper(Auth::User()->name)}},</u></b></span><span style="font-family: Arial; font-size: 10pt;"> </span><span style="font-family: Arial; font-size: 10pt;"><b><u>{{Str::Upper(Auth::User()->role)}}</u></b></span><span style="font-family: Arial; font-size: 10pt;"> </span><span style="font-family: Arial; font-size: 10pt;"><b><u>
                        UNIVERSITY INFORMATION TECHNOLOGY CENTER </u></b></span><span style="font-family: Arial; font-size: 10pt;">,
Technological University of the Philippines - Taguig, commits to deliver and
agree to be rated on the attainment of the following targets in accordance with
the indicated measures for the period </span><span style="font-family: Arial; font-size: 10pt;">
                <b>
                    <u>
<!-- TO DISPLAY THE EVALUATION PERIOD START AND END DATE -->
                        @foreach(\App\Http\Controllers\EvaluationPeriodController::getEvaluationPeriod() as $getStartMonth)
                            {{ $getStartMonth->evaluation_startdate }} {{ $getStartMonth->start_year}}
                        @endforeach
                            TO

                        @foreach(\App\Http\Controllers\EvaluationPeriodController::getEvaluationPeriod() as $getEndMonth)
                            {{ $getEndMonth->evaluation_enddate }} {{ $getStartMonth->end_year }}
                        @endforeach
                    </u>
                </b>
            </span>
            </p>
            <br>
        </div>
        <div class="row">
            <div class="kbw-signature">
                <div id="signature"></div>
            </div>
            <p>&nbsp; &nbsp; </p>
            <div>
                <input type="button" class="btn btn-secondary btn-sm btn-reset" id="clearsignature" value="Clear">
            </div>

            <input type="hidden" id="ratee_signature" name="ratee_esignature_file" value="">
        </div>
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
                        <br><span style="font-family: Arial; font-size: 12pt; text-decoration: underline;"><b></b></span>
                        <br><span style="font-family: Arial; font-size: 12pt;"><b>Name of Evaluator</b></span>
                        <br><span style="font-size: 10pt; font-family: Arial;">Position/Designation</span></td>
                </tr>
                </tbody>
            </table>
            <br>
        </div>
        <div>

            <table cellspacing="0" cellpadding="1" style="border-collapse: collapse;" width="">
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

                @foreach($opcruitc as $row)
                    <input type="hidden" value="{{ $row->form_id }}" name="form_id[]">
                    <input type="hidden" value="{{ $row->function_name }}" name="function_name[]">
                    <input type="hidden" value="{{ $row->id }}" name="mfo_id[]">
                    <input type="hidden" value="{{ $row->mfo_desc }}" name="mfo_desc[]">
                    <input type="hidden" value="{{ $row->success_indicator_desc }}" name="success_indicator_desc[]">
                    {{--                <input type="hidden" value="{{ $row->actual_accomplishment_desc }}" name="actual_accomplishment_desc[]">--}}
                    <input type="hidden" value="{{ $row->remarks }}" name="remarks[]">
                    <tbody>
                    <tr>
                        {{--                    <td style="vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->function_name !!}</td>--}}
                        <td style=" vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->mfo_desc !!}</td>
                        <td style=" vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->success_indicator_desc !!}</td>
                        <td style="position: relative; vertical-align: top; text-align: center; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0"><textarea style="position: absolute; height: 100%; width: 100%;" class="form-control form-control-sm" name="actual_accomplishment_desc[]" rows="15"></textarea></td>
                    </tr>
                    <tr style="background-color: rgb(255, 255, 255); vertical-align: top;">
                        <td rowspan="0" style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
                            <div class="form-label-group">
                                <select name="Q[]" class="form-control form-control-sm q-value" style="width: 50px">
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
                                @if($row->function_name == 'Higher and Advanced Education Program' || $row->function_name == 'Core Administrative Functions' || $row->function_name == 'General Administration and Support'
                                    || $row->function_name == 'Support to Operations' || $row->function_name == 'Technical Advisory Extension Program' || $row->function_name == 'Research Program')
                                    <input type="number" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm a-value-core" name="A[]" style="width: 73px" readonly>
                                @endif

                            </div>
                        </td>

                        <td style="vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">{!! $row->remarks !!}</td>
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

            <div style="box-sizing: border-box; color: rgb(33, 37, 41); text-align: left; background-color: rgb(255, 255, 255);">
                <font face="Arial">
                    <span style="font-size: 13.3333px;"><b>RATINGS</b></span>
                </font>
            </div>
            <ul id="avgdisplay"></ul>
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
                            Research Program, Core Administrative Functions, General Administration and Support Functions  (80%)
                            </b>
                        </div>
                    </td>
                    <td width="25" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; width: 309px;" colspan="4">
                        <!-- Total Rating for Function -->
                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm" id="core-total-average" name="core_total_average[]" readonly>
                    </td>
                    <td width="254" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;">
                        <p align="center" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;"><br /></p>
                    </td>
                </tr>
                <tr style="box-sizing: border-box;">
                    <td width="514" style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt;">
                        <div align="right" style="box-sizing: border-box; margin: 8px 0cm; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right; line-height: 12.65pt;">
                            <p align="right" style="background-color: rgb(255, 255, 255); box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                                <b style="box-sizing: border-box; font-weight: bolder;">
                                    <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">  </span>
                                </b>
                                <span style="box-sizing: border-box; color: black;"></span>
                            </p>
                            <p align="right" style="background-color: rgb(255, 255, 255); box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif;">
                                <b style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;"> IPCR Rating  (20%)</span></b>
                            </p>
                        </div>
                    </td>
                    <td width="25" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;" colspan="4">
                        @foreach(\App\Http\Controllers\OpcrController::getLatestIpcrRatings() as $row)
                            <input type="hidden" value="{{$row->total_weighted_score}}" id="get-ipcr-rating-average">
                        @endforeach
                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm" id="ipcr-rating-average" name="ipcr_rating_average[]" readonly>
                    </td>
                    <td width="254" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; width: 524px;">
                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                            <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Choose 1 QO in instruction; 1 QO in research/ extension; choose all for admin; with Graduate </span>
                        </p>
                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                            <span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;">Program QO if applicable</span>
                            <span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;">&nbsp;</span>
                        </p>
                    </td>
                </tr>
                <tr style="box-sizing: border-box; height: 2.9pt;">
                    <td width="514" style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt;">
                        <p align="right" style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right; line-height: 12.65pt;">
                            <b style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;"></span></b>
                            <span style="box-sizing: border-box; color: black;"></span>
                        </p>
                        <p align="right" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right;">
                            <b style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Total Weighted Score</span></b>
                            <b style="box-sizing: border-box; font-weight: bolder;"><span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;"></span></b>
                        </p>
                    </td>
                    <td width="25" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;" colspan="4">
                        <!-- Total Rating for Function -->
                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)" class="form-control form-control-sm total-weighted-score-color" id="total-weighted-score" name="total_weighted_score[]" readonly>
                    </td>
                    <td width="254" style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;">
                        <div style="box-sizing: border-box; font-size: 11pt; font-family: Calibri, sans-serif; margin: 8px 0cm; line-height: 12.65pt;">
                            <p style="box-sizing: border-box; margin: 6pt 0cm;">
                                <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;"></span>
                            </p>
                            <p style="box-sizing: border-box; margin: 6pt 0cm;"><span style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;"></span></p>
                        </div>
                        <p align="center" style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                            <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;"></span>
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
                            &nbsp;<span style="color: black; mso-color-alt: windowtext; background: white;">Name and Signature of Ratee:&nbsp;<input type="text" class="form-control form-control-sm" name="ratee_esignature[]" value="{{ Auth::User()->name }}" readonly></span>
                        </span>
                            </p>
                        </td>
                        <td width="800" style="width: 600pt; border: solid #ababab 1pt; border-left: none; mso-border-left-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                        <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                            &nbsp;Name and Signature of Rater: <input type="text" class="form-control form-control-sm" name="rater_esignature[]" readonly>
                        </span>
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                            </p>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 1;">
                        <td style="border: solid #ababab 1pt; border-top: none; mso-border-top-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Position: <input type="text" class="form-control form-control-sm" value="{{Auth::User()->role}}" readonly></span>
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
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Position: <input type="text" class="form-control form-control-sm" name="rater_role[]" value="" readonly></span>
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                            </p>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 2; mso-yfti-lastrow: yes;">
                        <td style="border: solid #ababab 1pt; border-top: none; mso-border-top-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Date: <input type="date" class="form-control form-control-sm" name="ratee_date[]" value="<?= date('Y-m-d',time()) ;?>" readonly></span>
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
                                <span style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Date:&nbsp;<input type="date" class="form-control form-control-sm" name="rater_date[]" value="" readonly></span>
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
                                COMMENTS / FEEDBACKS / RECOMMENDATIONS:&nbsp; <textarea class="form-control" rows="5" name="rater_comments[]"></textarea>
                            </span>
                                </b>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br />

                @foreach(\App\Http\Controllers\OpcrController::isEvaluationOpen() as $isevaluationopen)
                    @if($isevaluationopen->evaluation_period_status == 'Open')
                        <div>
                            <input class="btn btn-primary btn-sm btn-submit" type="submit" value="Submit">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </form>
    <script src="{{ asset('js/jSignature.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#signature").jSignature()
        });

        $("#signature").bind('change', function(e){
            var dataToBeSaved = $("#signature").jSignature("getData", "svgbase64");
            $("#ratee_signature").val(dataToBeSaved)
        });

        $("#clearsignature").click(function () {
            var $sigdiv = $("#signature")
            $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
        });
    </script>
    </body>
    <script type="text/javascript">
        $(document).ready(function(){
            let ipcrcomputed = $("#get-ipcr-rating-average").val()
            let computed = 0

            computed = ipcrcomputed * 0.20

            $('#ipcr-rating-average').val(isNaN(computed) ? "" : computed)
            computeWeightedScore();
            $(".a-value-core, #core-total-average, #total-weighted-score, #ipcr-rating-average").trigger("change")
            setFourNumberDecimal();
        });

        //CLEAR AVERAGE FIELDS AND RESET
        $(document).ready(function(){
            $(".btn-reset").click(function(){
                $('.a-value-core, .a-value-support, .a-value-research, #core-total-average, #support-total-average, #total-weighted-score').val('');
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

            currentRow.find('.a-value-core').val((EValue  + QValue + TValue ) / Number(counter));
            // currentRow.find('.a-value-support').val((EValue  + QValue + TValue ) / Number(counter));

            computeAvg();
            computeWeightedScore();
            $(".a-value-core, #core-total-average, #total-weighted-score, #ipcr-rating-average").trigger("change")
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
            // For Core Functions
            const corevalues = document.getElementsByClassName("a-value-core")
            let avg = 0
            let total = 0
            let count = 0
            for (let x = 0; x < corevalues.length; x++) {
                if (corevalues[x].value !== "") {
                    count++
                    total = total + parseFloat(corevalues[x].value)
                }
            }
            avg = (total / count) * 0.80
            $('#core-total-average').val(isNaN(avg) ? "" : avg)
        }

        //COMPUTE FOR TOTAL WEIGHTED AVERAGE. If there is incomplete value for function.
        // The weighted score will not do the computation
        function computeWeightedScore(){
            let weightedscore = 0
            let ACoreValue = $("#core-total-average").val()
            let IpcrRating = $("#ipcr-rating-average").val()

            weightedscore = parseFloat(ACoreValue) + parseFloat(IpcrRating)

            $('#total-weighted-score').val(weightedscore)
        }

        //ROUND OFF TO 4 PLACES INPUT TYPE NUMBER ON CHANGE
        function setFourNumberDecimal(el) {
            el.value = parseFloat(el.value).toFixed(4);
        }
    </script>
@endsection


@extends('layouts.sidebar')
@section('ipcrfulladmin')
    <style>
        input[type="number"] {
            width: 73px
        }
        .kbw-signature {
            width: 20%;
            height: auto;
            border-style: solid;
            border-width: thin;
        }
        .hidden {
            display: none;
        }
    </style>
    <body>
    <!-- STORE ALL THE USER DATA TO RATING TABLE -->
    <form method="POST" action="/storedataipcrfulladmin">
        {{ csrf_field() }}
        @foreach($getmultiplier as $row)
            @if($row->function_name == 'Core Administrative Functions')
                <input type="hidden" value="{{$row->multiplier}}" id="coreadminfunctionmultiplier" name="core_multiplier[]">
            @elseif($row->function_name == 'Higher and Advanced Education Programs and Support Functions')
                <input type="hidden" value="{{$row->multiplier}}" id="higherfunctionmultiplier" name="support_multiplier[]">
            @elseif($row->function_name == 'Research/Technical Advisory and Extension Programs')
                <input type="hidden" value="{{$row->multiplier}}" id="researchfunctionmultiplier" name="research_multiplier[]">
            @endif
        @endforeach
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->id}}" name="user_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->division_id}}" name="division_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->dept_id}}" name="dept_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->section_id}}" name="section_id[]">
        <input type="hidden" value="{{\Illuminate\Support\Facades\Auth::User()->role}}" name="ratee_role[]">
        <input type="hidden" value="ipcrfulladmin" name="evaluationform_name[]">
        @foreach(\App\Http\Controllers\IpcrController::getEvaluationStartDate() as $getstartdate)
            <input type="hidden" value="{{ $getstartdate ->evaluation_startdate }}" name="evaluation_startdate[]">
        @endforeach

        @foreach(\App\Http\Controllers\IpcrController::getEvaluationEndDate() as $getenddate)
            <input type="hidden" value="{{ $getenddate ->evaluation_enddate }}" name="evaluation_enddate[]">
        @endforeach
        <div class="hidden" id="reviewformmessage">
            <label style="font-size: 15pt; font-style: italic; font-family: Arial; color: indianred">Review the form again. Answered questions have asterisk (*) in the leftmost side.</label>
        </div>
        <label>
            Evaluation Form Status:
            <select name="evaluationform_status[]" class="form-control form-control-sm">
                <option selected value="For Evaluation (Immediate/Commitee)">For Evaluation (Immediate/Commitee)</option>
            </select>
        </label>
        <div>
        </div>
        <table width="" style="font-family: 'Times New Roman';; font-size: medium; border-collapse: collapse">
            <tbody>
            <tr style="background-color: rgb(255, 255, 255)">
                <td rowspan="4"
                    style="width: 101px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><img
                        style="width: 100px; height: 100px;" type="image/png"
                        src="{!! asset('images/tuptlogo.png') !!} " alt="TUP-T Logo"></td>
                <td rowspan="4"
                    style="text-align: center; width: 983px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)">
                    <span style="font-size: 10pt; font-family: Arial"><b>TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES - TAGUIG CAMPUS</b></span>
                    <br><span
                        style="color: rgb(34, 34, 34); font-family: Arial; font-size: 10pt; text-align: left; background-color: rgb(255, 255, 255); display: inline !important">14 East Service Road Western Bicutan Taguig, 1630 Metro Manila</span><span
                        style="color: rgb(34, 34, 34); font-family: arial, sans-serif; font-size: 14px; text-align: left; background-color: rgb(255, 255, 255); display: inline !important"><br></span><span
                        style="font-size: 10pt; font-family: Arial">(02) 8823 2457</span>
                    <br><span style="font-size: 10pt; font-family: Arial">Email: planning@tup.edu.ph | Website: www.tup.edu.ph</span>
                </td>
                <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-family: Arial">​</span><span
                        style="font-family: Arial; font-size: 10pt">Index No.</span>
                    <br>
                </td>
                <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-size: 10pt; font-family: Arial">F-PDO-9.1-IPC</span></td>
            </tr>
            <tr style="background-color: rgb(255, 255, 255)">
                <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-size: 10pt; font-family: Arial">Issue No.</span></td>
                <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-size: 10pt; font-family: Arial">01</span></td>
            </tr>
            <tr style="background-color: rgb(255, 255, 255)">
                <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-size: 10pt; font-family: Arial">Revision No.</span></td>
                <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171); width: 343px"><span
                        style="font-size: 10pt; font-family: Arial">02</span></td>
            </tr>
            <tr style="background-color: rgb(255, 255, 255)">
                <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-size: 10pt; font-family: Arial">Date</span></td>
                <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-size: 10pt; font-family: Arial">09242019</span></td>
            </tr>
            <tr style="background-color: rgb(255, 255, 255)">
                <td rowspan="2"
                    style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)">
                    <span style="font-family: Arial; font-size: 10pt">VPD-PDO</span></td>
                <td rowspan="2"
                    style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)">
                    <span style="font-size: 12pt; font-family: Arial"><b>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR)</b></span>
                </td>
                <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-family: Arial; font-size: 10pt">Page</span></td>
                <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-family: Arial; font-size: 10pt">1/23</span></td>
            </tr>
            <tr style="background-color: rgb(255, 255, 255)">
                <td style="width: 120px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-family: Arial; font-size: 10pt">QAC No.</span></td>
                <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171)"><span
                        style="font-family: Arial; font-size: 10pt">CC-<?= date('mdY',time()) ;?></span><span
                        style="font-family: Arial; font-size: 10pt"><br></span></td>
            </tr>
            </tbody>
        </table>
        <br>
        <div>
            <!-- Getting the currently logged user -->
            <p style="margin: 0cm 0cm 10pt; line-height: 115%; font-size: 11pt; font-family: Calibri, sans-serif;margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;line-height:normal"><span style="font-family: Arial; font-size: 10pt;">I, </span><span style="font-family: Arial; font-size: 10pt;"><b><u>{{ Str::Upper(Auth::User()->name)}},</u></b></span><span style="font-family: Arial; font-size: 10pt;"> </span><span style="font-family: Arial; font-size: 10pt;"><b><u>{{ Str::Upper(Auth::User()->role)}}</u></b></span><span style="font-family: Arial; font-size: 10pt;"> </span><span style="font-family: Arial; font-size: 10pt;"><b><u>
                        @foreach(\App\Http\Controllers\IpcrController::getUserdata() as $getdata) {{ Str::Upper($getdata->division_name) }} / {{ Str::Upper($getdata->dept_name)}} / {{Str::Upper($getdata->section_name)}} @endforeach</u></b></span><span style="font-family: Arial; font-size: 10pt;">,
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
        <div><span style="font-size: 10pt; font-family: Arial;">Date: <input name="date"
                                                                             value="<?= date('Y-m-d', time());?>"
                                                                             readonly></span></div>
        <div>
            <br>
        </div>
        <div>
            <table cellspacing="0" cellpadding="1" style="border-collapse: collapse;" width="">
                <tbody>
                <tr style="background-color: rgb(255, 255, 255);">
                    <td style="border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"><span
                            style="font-size: 10pt; font-family: Arial;">Approved by:</span></td>
                </tr>
                <tr style="background-color: rgb(255, 255, 255);">
                    <td style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171); width: 373px;">
                        <br><span
                            style="font-family: Arial; font-size: 12pt; text-decoration: underline;"><b></b></span>
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
                    <td style="text-align: center; width: 10%; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;">​</span><span style="font-family: Arial; font-size: 10pt;"><b>ORGANIZATIONAL OUTCOMES/KEY RESULTS AREA</b></span><b><br></b></td>
                    <td style="text-align: center; width: 40%; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;"><b>QUALITY + OBJECTIVES</b></span><b><br></b><span style="font-family: Arial; font-size: 10pt;"><b>&nbsp;(TARGETS + MEASURES)</b></span></td>
                    <td style="text-align: center; width: 30%; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;"><b>ACTUAL ACCOMPLISHMENTS</b></span></td>
                    <td style="text-align: center; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" colspan="4"><span style="font-family: Arial; font-size: 10pt;"><b>RATING</b></span></td>
                    <td style="text-align: center; width: 20%; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="2"><span style="font-family: Arial; font-size: 10pt;"><b>REMARKS</b></span></td>
                </tr>
                <tr style="background-color: rgb(255, 255, 255);">
                    <td style="text-align: center; width: 44px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);">
                        <span style="font-family: Arial; font-size: 10pt;"><b>Q</b></span></td>
                    <td style="text-align: center; width: 49px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);">
                        <span style="font-family: Arial; font-size: 10pt;"><b>E</b></span></td>
                    <td style="text-align: center; width: 44px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);">
                        <span style="font-family: Arial; font-size: 10pt;"><b>T</b></span></td>
                    <td style="text-align: center; width: 73px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);">
                        <span style="font-family: Arial; font-size: 10pt;"><b>A</b></span></td>
                </tr>
                </thead>

                @foreach($ipcrfulladmin as $row)
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
                        <td style=" vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"
                            rowspan="0">{!! $row->mfo_desc !!}</td>
                        <td style=" vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"
                            rowspan="0">{!! $row->success_indicator_desc !!}</td>

                    </tr>
                    <tr style="background-color: rgb(255, 255, 255); vertical-align: top;">
                        <td style="position: relative; vertical-align: top; text-align: center; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0"><textarea style="position: absolute; height: 100%; width: 100%;"class="form-control form-control-sm actualaccomplishmentdesc" name="actual_accomplishment_desc[]" rows="15"></textarea></td>
                        <td rowspan="0"
                            style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
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
                        <td rowspan="0"
                            style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
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
                        <td rowspan="0"
                            style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
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
                        <td rowspan="0"
                            style="text-align: center; border-top: 1pt solid rgb(171, 171, 171); border-right: 1pt solid rgb(171, 171, 171); border-bottom: 1pt solid rgb(171, 171, 171); border-image: initial; border-left: none; background: white; padding: 0.6pt;">
                            <div class="form-label-group">
                                @if($row->function_name == 'Core Administrative Functions - Clerical/Routine')
                                    <input type="number" onchange="setFourNumberDecimal(this)"
                                           class="form-control form-control-sm clerical-value-core" name="A[]"
                                           style="width: 73px" readonly>
                                @endif
                                @if($row->function_name == 'Core Administrative Functions - Technical')
                                        <input type="number" onchange="setFourNumberDecimal(this)"
                                               class="form-control form-control-sm technical-value-core" name="A[]"
                                               style="width: 73px" readonly>
                                    @endif
                                @if($row->function_name == 'Support Functions')
                                    <input type="number" onchange="setFourNumberDecimal(this)"
                                           class="form-control form-control-sm a-value-support" name="A[]"
                                           style="width: 73px" readonly>
                                @endif

                            </div>
                        </td>

                        <td style="vertical-align: top; text-align: left; width: 316px; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);"
                            rowspan="0">{!! $row->remarks !!}</td>
                        <td style="vertical-align: top; text-align: left; width: 5%; border-width: 1px; border-style: solid; border-color: rgb(171, 171, 171);" rowspan="0">
                            <div class="divhasvalue">
                                <label style="font-size: 20pt; color: red; font-weight: bold">*</label>
                            </div>
                        </td>
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

            <div
                style="box-sizing: border-box; color: rgb(33, 37, 41); text-align: left; background-color: rgb(255, 255, 255);">
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
                    <td width="514"
                        style="box-sizing: border-box; border: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;"></td>
                    <td
                        width="25"
                        style="box-sizing: border-box; border-top: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: none; padding: 0cm 5.4pt;"
                        colspan="4"
                    >
                        <div align="center"
                             style="box-sizing: border-box; margin: 0px 0cm 0.000133333px; text-align: center;">
                            <b style="font-family: Calibri, sans-serif; font-size: 14.6667px; background-color: rgb(255, 255, 255); box-sizing: border-box; font-weight: bolder;">
                                <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;">FINAL RATINGS</span>
                            </b>
                            <br/>
                        </div>
                    </td>
                    <td width="254"
                        style="box-sizing: border-box; border-top: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: none; padding: 0cm 5.4pt;">
                        <p align="center"
                           style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                            <b style="box-sizing: border-box; font-weight: bolder;"><span
                                    style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;">REMARKS</span></b>
                        </p>
                    </td>
                </tr>
                <tr style="box-sizing: border-box; height: 2.9pt;">
                    <td
                        width="514"
                        style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt; width: 892px;">
                        <div align="right"
                             style="box-sizing: border-box; margin: 0px 0cm 0.000133333px; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right;">
                            <b style="color: rgb(0, 0, 0); font-family: Arial, sans-serif; font-size: 13.3333px; box-sizing: border-box; font-weight: bolder;">
                                Core Administrative Functions&nbsp;<br style="box-sizing: border-box;"/>
                                Weighted Average (80%)
                            </b>
                            <br/>
                        </div>
                    </td>
                    <td width="25"
                        style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; width: 309px;"
                        colspan="4">
                        <!-- Total Rating for Function -->
                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)"
                               class="form-control form-control-sm" id="core-total-average" name="core_total_average[]"
                               readonly>
                    </td>
                    <td width="254"
                        style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;">
                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                            <span
                                style="font-style: italic; box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Refer to the notes below on the specific percentage of clerical and technical admin functions based on the salary grade (SG)</span>
                        </p>
                    </td>
                </tr>
                <tr style="box-sizing: border-box;">
                    <td width="514"
                        style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt;">
                        <div align="right"
                             style="box-sizing: border-box; margin: 8px 0cm; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right; line-height: 12.65pt;">
                            <p align="right"
                               style="background-color: rgb(255, 255, 255); box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                                <b style="box-sizing: border-box; font-weight: bolder;">
                                    <span
                                        style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Support Functions</span>
                                </b>
                                <span style="box-sizing: border-box; color: black;"></span>
                            </p>
                            <p align="right"
                               style="background-color: rgb(255, 255, 255); box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif;">
                                <b style="box-sizing: border-box; font-weight: bolder;"><span
                                        style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;">Weighted Average @foreach($getmultiplier as $row)
                                            @if($row->function_name == 'Higher and Advanced Education Programs and Support Functions')
                                                <input type="text" class="form-control-sm" disabled style="font-weight: bold; font-size: 10pt; width: 65px;" readonly value="{{$row->multiplier * 100}}%">
                                            @endif
                                        @endforeach</span></b>
                            </p>
                        </div>
                    </td>
                    <td width="25"
                        style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt;"
                        colspan="4">
                        <!-- Total Rating for Function -->
                        <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)"
                               class="form-control form-control-sm" id="support-total-average"
                               name="support_total_average[]" readonly>
                    </td>
                    <td width="254"
                        style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; width: 524px;">
                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                            <span
                                style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif; color: black;"></span>
                        </p>
                        <p style="box-sizing: border-box; margin: 6pt 0cm; font-size: 11pt; font-family: Calibri, sans-serif; line-height: 12.65pt;">
                            <span
                                style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;"></span>
                            <span
                                style="box-sizing: border-box; font-family: Arial, sans-serif; font-size: 10pt; text-align: center;">&nbsp;</span>
                        </p>
                    </td>
                </tr>
                <tr style="box-sizing: border-box;">
                    <td
                        width="514"
                        style="box-sizing: border-box; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; padding: 0cm 5.4pt; height: 2.9pt;"
                    >
                        <p align="right"
                           style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: right;">
                            <b style="box-sizing: border-box;"><span
                                    style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;">Total Weighted Score</span></b>
                        </p>
                    </td>
                    <td width="25"
                        style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; height: 2.9pt;"
                        colspan="4">
                        <p align="center"
                           style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                            <input type="number" style="width: 73px" onchange="setFourNumberDecimal(this)"
                                   class="form-control form-control-sm total-weighted-score-color"
                                   id="total-weighted-score" name="total_weighted_score[]" readonly>
                        </p>
                    </td>
                    <td width="254"
                        style="box-sizing: border-box; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); padding: 0cm 5.4pt; height: 2.9pt;">
                        <p align="center"
                           style="box-sizing: border-box; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri, sans-serif; text-align: center;">
                            <span style="box-sizing: border-box; font-size: 10pt; font-family: Arial, sans-serif;"><o:p
                                    style="box-sizing: border-box;">&nbsp;</o:p></span>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
            <br>
            <div>
                <table
                    style="width: 100%; border-collapse: collapse; mso-yfti-tbllook: 1184; mso-padding-alt: 0.6pt 0.6pt 0.6pt 0.6pt;">
                    <tbody>
                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes; mso-yfti-lastrow: yes;">
                        <td width="1440"
                            style="width: 1080pt; border: solid #ababab 1pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <b><span
                                        style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">&nbsp;RATING SCALE:</span></b>
                                <span
                                    style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;"></span>
                            </p>
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: justify; line-height: normal;">
                                <b><span
                                        style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">&nbsp;</span></b>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">
                            5 - Outstanding&nbsp; &nbsp; &nbsp;4 - Very Satisfactory&nbsp; &nbsp; &nbsp;3 - Satisfactory&nbsp; &nbsp; &nbsp;2 - Unsatisfactory&nbsp; &nbsp; &nbsp;1 - Poor
                        </span>
                                <span
                                    style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;"></span>
                            </p>
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <span
                                    style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;"><br/> </span>
                                <b>
                                    <span
                                        style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">&nbsp;LEGEND:<br/> </span>
                                </b>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                            &nbsp;Q - Quantity/Efficiency&nbsp; &nbsp; &nbsp;E - Effectiveness/Quality&nbsp; &nbsp; &nbsp;T - Timelines&nbsp; &nbsp; &nbsp;A - Average
                        </span>
                                <span
                                    style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;"></span>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                    <b>
            <span
                style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">
                <br/>
                Notes:
            </span>
                    </b>
                </p>
                <div class="form-row">
                    <div class="form-group col-2">
                        <label for="salarygrade" style="font-size: 10pt; font-family: Arial; font-weight: bold; color: black;">Salary Grade</label>
                        <select style="font-size: 10pt; font-family: Arial; font-weight: bold; color: black;" class="form-control form-control-sm" id="salarygrade" name="salary_grade[]">
                            <option value="">Select a Salary Grade</option>
                            <option value=">20">>20</option>
                            <option value="16-19">16-19</option>
                            <option value="11-15">11-15</option>
                            <option value="6-10">6-10</option>
                        </select>
                    </div>
                    <div class="form-group col-3">
                        <label for="clericalroutine" style="font-size: 10pt; font-family: Arial; font-weight: bold; color: black;">Clerical/Routine Computed Value</label>
                        <input type="text" class="form-control form-control-sm col-12" id="clericalroutine" onchange="setFourNumberDecimal(this)" name="clericalroutine[]" readonly>
                    </div>

                    <div class="form-group col-3">
                        <label for="technical" style="font-size: 10pt; font-family: Arial; font-weight: bold; color: black;">Technical Computed Value</label>
                        <input type="text" class="form-control form-control-sm col-12" id="technical" onchange="setFourNumberDecimal(this)" name="technical[]" readonly>
                    </div>
                </div>

                <table style="width: 100%; margin-left: -1.7pt; border-collapse: collapse;">
                    <tbody>
                    <tr style="mso-yfti-irow: 4; height: 3.5pt;">
                        <td width="204" rowspan="2"
                            style="width: 122.35pt; border: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i style=""><span style="font-size: 10pt; font-family: Arial; color: black;">Salary Grade</span></i>
                                    <span style="color: black;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="333" colspan="2"
                            style="width: 199.55pt; border: solid windowtext 1pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i><span
                                            style="font-size: 10pt; font-family: Arial; color: black;">Core Admin</span></i>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="310"
                            style="border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i><span style="font-size: 10pt; font-family: Arial; color: black;">Support Functions*</span></i>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="254"
                            style="border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i><span style="font-size: 10pt; font-family: Arial; color: black;">Total</span></i>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="353"
                            style="width: 211.5pt; border: solid windowtext 1pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i><span
                                            style="font-size: 10pt; font-family: Arial; color: black;">Remarks</span></i>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 5; mso-yfti-lastrow: yes; height: 11.75pt;">
                        <td width="186"
                            style="width: 111.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i><span style="font-size: 10pt; font-family: Arial; color: black;">Clerical/</span></i>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                    <i><span style="font-size: 10pt; font-family: Arial;">Routine</span></i>
                                    <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="146"
                            style="width: 87.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <i><span style="font-size: 10pt; font-family: Arial; color: black;">Technical</span></i>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="309"
                            style="text-align: center; width: 642px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><input
                                    class="form-control form-control-sm" style="width: 100%;" id="sgsupportfunction" onchange="setFourNumberDecimal(this)" type="number"
                                    readonly></span>
                        </td>
                        <td width="339"
                            style="text-align: center; width: 689px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><input
                                    class="form-control form-control-sm" style="width: 100%;" id="sgtotal" onchange="setFourNumberDecimal(this)" type="number"
                                    readonly></span>
                        </td>
                        <td width="791" rowspan="5"
                            style="width: 474.75pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"> </span>
                            <p style="margin-bottom: 0cm; margin-bottom: 0.0001pt;">
                                <span style="font-size: 10pt; font-family: Arial; color: black;">Choose all for core admin;</span>
                                <span style="color: black;">
                          <o:p><span style="font-family: Arial; font-size: 10pt;">&nbsp;</span></o:p>
                      </span>
                            </p>
                            <p style="margin-bottom: 0cm; margin-bottom: 0.0001pt;">
                                <span style="font-size: 10pt; font-family: Arial;">choose at least 2 QO for support functions</span>
                                <o:p style=""><span style="font-family: Arial; font-size: 10pt;">&nbsp;</span></o:p>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 4; height: 3.5pt;">
                        <td width="204"
                            style="width: 122.35pt; border: solid windowtext 1pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">>20</span>
                                    <span style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="186"
                            style="width: 111.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">N/A</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="146"
                            style="width: 87.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">80%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="310"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">20%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="254"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">100%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 5; mso-yfti-lastrow: yes; height: 11.75pt;">
                        <td width="204"
                            style="width: 122.35pt; border: solid windowtext 1pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">16-19</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="186"
                            style="width: 111.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">10%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="146"
                            style="width: 87.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">70%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="310"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">20%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="254"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.2pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">100%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 4; height: 3.5pt;">
                        <td width="204"
                            style="width: 122.35pt; border: solid windowtext 1pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt; height: 3.5pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">11-15</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="186"
                            style="width: 111.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 3.5pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">20%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="146"
                            style="width: 87.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 3.5pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">60%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="310"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">20%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="254"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">100%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 5; mso-yfti-lastrow: yes; height: 11.75pt;">
                        <td width="204"
                            style="width: 122.35pt; border: solid windowtext 1pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.75pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">6-10</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="186"
                            style="width: 111.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.75pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">30%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="146"
                            style="width: 87.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1pt; border-right: solid windowtext 1pt; padding: 0cm 5.4pt 0cm 5.4pt; height: 11.75pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">50%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="310"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.75pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">20%</span>
                                    <span
                                        style="mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;">
                              <o:p><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                        </td>
                        <td width="254"
                            style="border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 11.75pt;">
                            <span style="font-size: 10pt; font-family: Arial;"><b> </b></span>
                            <p align="center" style="margin-bottom: 0cm; margin-bottom: 0.0001pt; text-align: center;">
                                <b>
                                    <span style="font-size: 10pt; font-family: Arial; color: black;">100%</span>
                                    <span style="color: black;">
                              <o:p style=""><span style="font-size: 10pt; font-family: Arial;">&nbsp;</span></o:p>
                          </span>
                                </b>
                            </p>
                            <span style="font-size: 10pt; font-family: Arial;"> </span>
                        </td>
                    </tr>
                    </tbody>
                </table>


                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                    <b>
            <span
                style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;">
                <br/>
                The above rating has been discussed with me by my immediate supervisor/evaluator/verifier/auditor:
            </span>
                    </b>
                </p>
                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                    <b>
                        <span
                            style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; background: white; mso-fareast-language: EN-PH;"><br/></span>
                    </b>
                </p>
                <table
                    style="width: 100%; border-collapse: collapse; mso-yfti-tbllook: 1184; mso-padding-alt: 0.6pt 0.6pt 0.6pt 0.6pt;">
                    <tbody>
                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
                        <td width="837"
                            style="width: 627.75pt; border: solid #ababab 1pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                        <span
                            style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;">
                            &nbsp;<span style="color: black; mso-color-alt: windowtext; background: white;">Name and Signature of Ratee:&nbsp;<input
                                    type="text" class="form-control form-control-sm" name="ratee_esignature[]"
                                    value="{{ Auth::User()->name }}" readonly></span>
                        </span>
                            </p>
                        </td>
                        <td width="800"
                            style="width: 600pt; border: solid #ababab 1pt; border-left: none; mso-border-left-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                        <span
                            style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                            &nbsp;Name and Signature of Rater: <input type="text" class="form-control form-control-sm"
                                                                      name="rater_esignature[]" readonly>
                        </span>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                            </p>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 1;">
                        <td style="border: solid #ababab 1pt; border-top: none; mso-border-top-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Position: <input
                                        type="text" class="form-control form-control-sm" value="{{Auth::User()->role}}"
                                        readonly></span>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
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
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Position: <input
                                        type="text" class="form-control form-control-sm" name="rater_role[]" value=""
                                        readonly></span>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                            </p>
                        </td>
                    </tr>
                    <tr style="mso-yfti-irow: 2; mso-yfti-lastrow: yes;">
                        <td style="border: solid #ababab 1pt; border-top: none; mso-border-top-alt: solid #ababab 0.75pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.6pt 0.6pt 0.6pt 0.6pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Date: <input
                                        type="date" class="form-control form-control-sm" name="ratee_date[]"
                                        value="<?= date('Y-m-d', time());?>" readonly></span>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
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
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">&nbsp;Date:&nbsp;<input
                                        type="date" class="form-control form-control-sm" name="rater_date[]" value=""
                                        readonly></span>
                                <span
                                    style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;"></span>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                    <span
                        style="font-size: 13.5pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-fareast-language: EN-PH;"><o:p>&nbsp;</o:p></span>
                </p>
                <table style="width: 100%; border-collapse: collapse; mso-yfti-tbllook: 1184;">
                    <tbody>
                    <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes; mso-yfti-lastrow: yes;">
                        <td width="1440"
                            style="width: 1080pt; border: solid #ababab 1pt; mso-border-alt: solid #ababab 0.75pt; background: white; padding: 0.75pt 0.75pt 0.75pt 0.75pt;">
                            <p style="margin: 0cm 0cm 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif; margin-bottom: 0cm; margin-bottom: 0.0001pt; line-height: normal;">
                                <span
                                    style="font-size: 12pt; font-family: 'Times New Roman', serif; mso-fareast-font-family: 'Times New Roman'; mso-fareast-language: EN-PH;">&nbsp;</span>
                                <b>
                            <span
                                style="font-size: 10pt; font-family: 'Arial', sans-serif; mso-fareast-font-family: 'Times New Roman'; color: black; mso-color-alt: windowtext; mso-fareast-language: EN-PH;">
                                COMMENTS / FEEDBACKS / RECOMMENDATIONS:&nbsp; <textarea class="form-control" rows="5"
                                                                                        name="rater_comments[]"></textarea>
                            </span>
                                </b>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br/>

                @foreach(\App\Http\Controllers\IpcrController::isEvaluationOpen() as $isevaluationopen)
                    @if($isevaluationopen->evaluation_period_status == 'Open')
                        <div>
                            <input class="btn btn-primary btn-sm" id="btnreviewform" type="button" value="Review Form">
                            <input class="btn btn-primary btn-sm hidden" id="btnsubmitform" type="submit" value="Submit Form">
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
        //HIDE THE SUBMIT BUTTON FIRST
        $(document).ready(function(){
            $("#btnsubmitform").hide();
            $(".divhasvalue").hide();
            $("#reviewformmessage").hide();
        });

        //SHOW THE SUBMIT BUTTON CLICKING THE BUTTON REVIEW FORM
        $("#btnreviewform").click(function(){
            $('#btnreviewform').hide();
            $("#reviewformmessage").show();
            window.scrollTo({top: 0, behavior: 'smooth'});
            $('#btnsubmitform').show();
        })

        //CLEAR AVERAGE FIELDS AND RESET
        $(document).ready(function () {
            $(".btn-reset").click(function () {
                $("#core-total-average, #sgsupportfunction, #sgtotal, .clerical-value-core, .technical-value-core, .a-value-support, #technical, #clericalroutine, #support-total-average, #total-weighted-score").val('');
            });
        });

        //COMPUTE THE AVERAGE PER ROW
        $(".q-value, .e-value, .t-value, .actualaccomplishmentdesc").change(function(){
            let currentRow = $(this).closest('tr');
            let EValue = Number(currentRow.find('.e-value').val());
            let QValue = Number(currentRow.find('.q-value').val());
            let TValue = Number(currentRow.find('.t-value').val());
            let actualaccomplishmentdesc = currentRow.find('.actualaccomplishmentdesc').val();
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
            currentRow.find('.a-value-support').val((EValue  + QValue + TValue ) / Number(counter));
            currentRow.find('.a-value-research').val((EValue  + QValue + TValue ) / Number(counter));

            //ADDING AN ASTERISK IF THE VALUE CHANGED
            if(QValue){
                currentRow.find('.divhasvalue').show();
            } else if(EValue) {
                currentRow.find('.divhasvalue').show();
            } else if(TValue) {
                currentRow.find('.divhasvalue').show();
            } else if(actualaccomplishmentdesc) {
                currentRow.find('.divhasvalue').show();
            } else {
                currentRow.find('.divhasvalue').hide();
            }

            //AVERAGE COMPUTATIONS, ADDING AVERAGES, CHANGE DECIMAL VALUE
            computeAvg();
            computeWeightedScore();
            $(".a-value-core, .a-value-support, .a-value-research, #core-total-average, #support-total-average, #research-total-average, #total-weighted-score").trigger("change")
            setFourNumberDecimal();
        });


        //CONDITIONAL FORMATTING COLORS
        $('.total-weighted-score-color').change(function () {
            let totalweightedscore = document.getElementById('total-weighted-score')

            if (totalweightedscore.value < 3.0000) {
                totalweightedscore.style.color = "red";
            } else {
                totalweightedscore.style.color = "green";
            }
        })

        //COMPUTE AVERAGE FOR EACH FUNCTION
        function computeAvg() {
            // For Core Functions - Clerical/Routine
            const clericalvalues = document.getElementsByClassName("clerical-value-core")
            let avg = 0
            let total = 0
            let count = 0
            for (let x = 0; x < clericalvalues.length; x++) {
                if (clericalvalues[x].value !== "") {
                    count++
                    total = total + Number(clericalvalues[x].value)
                }
            }
            avg = (total / count)
            $('#clericalroutine').val(isNaN(avg) ? "" : avg)

            // For Core Functions - Technical
            avg = 0
            total = 0
            count = 0
            const technicalvalues = document.getElementsByClassName("technical-value-core")
            for (let x = 0; x < technicalvalues.length; x++) {
                if (technicalvalues[x].value !== "") {
                    count++
                    total = total + Number(technicalvalues[x].value)
                }
            }
            avg = total / count
            $('#technical').val(isNaN(avg) ? "" : avg)

            // For Support Functions
            let higherfunctionmultiplier = $("#higherfunctionmultiplier").val()
            avg = 0
            total = 0
            count = 0
            const supvalues = document.getElementsByClassName("a-value-support")
            for (let x = 0; x < supvalues.length; x++) {
                if (supvalues[x].value !== "") {
                    count++
                    total = total + Number(supvalues[x].value)
                }
            }
            avg = total / count * higherfunctionmultiplier
            $('#support-total-average').val(isNaN(avg) ? "" : avg)
            $('#sgsupportfunction').val(isNaN(avg) ? "" : avg)
        }

        //COMPUTE THE SALARY GRADE BASED ON SELECTED VALUE
        $("#salarygrade").change(function(){
                let AClericalvalue = $("#clericalroutine").val()
                let ATechnicalvalue = $("#technical").val()
                let selectedsalarygrade = $(this).children("option:selected").val();
                let totalAclerical = 0
                let totalAtechnical = 0
                let totalclericaltechnical = 0

                if (selectedsalarygrade === '>20'){
                    totalAclerical = 0;
                    totalAtechnical = Number(ATechnicalvalue * 0.80)
                    totalclericaltechnical = totalAclerical + totalAtechnical
                }

                if(selectedsalarygrade === '16-19'){
                    totalAclerical = Number(AClericalvalue * 0.10)
                    totalAtechnical = Number(ATechnicalvalue * 0.70)
                    totalclericaltechnical = totalAclerical + totalAtechnical
                }

                if(selectedsalarygrade === '11-15'){
                    totalAclerical = Number(AClericalvalue * 0.20)
                    totalAtechnical = Number(ATechnicalvalue * 0.60)
                    totalclericaltechnical = totalAclerical + totalAtechnical
                }

                if(selectedsalarygrade === '6-10'){
                    totalAclerical = Number(AClericalvalue * 0.30)
                    totalAtechnical = Number(ATechnicalvalue * 0.50)
                    totalclericaltechnical = totalAclerical + totalAtechnical
                }
                $('#core-total-average').val(totalclericaltechnical)


                computeAvg()
                computeWeightedScore()
                $("#sgsupportfunction, #sgtotal, .clerical-value-core, .technical-value-core, .a-value-support, #technical, #clericalroutine, #support-total-average, #total-weighted-score").trigger("change")
                setFourNumberDecimal();
            })

        //COMPUTE FOR TOTAL WEIGHTED AVERAGE. If there is incomplete value for function.
        // The weighted score will not do the computation
        function computeWeightedScore() {
            let weightedscore = 0
            let ACoreValue = $("#core-total-average").val()
            let ASuppValue = $("#support-total-average").val()

            weightedscore = Number(ACoreValue) + Number(ASuppValue)

            $('#total-weighted-score, #sgtotal').val(weightedscore)
        }

        //ROUND OFF TO 4 PLACES INPUT TYPE NUMBER ON CHANGE
        function setFourNumberDecimal(el) {
            el.value = Number(el.value).toFixed(4);
        }
    </script>
@endsection


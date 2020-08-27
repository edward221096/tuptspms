@extends('layouts.sidebar')
@section('ipcrdashboard')

    <div class="container-fluid">
                <h4 class="mt-4">Individual Performance Commitment Review (IPCR) Dashboard ('OPEN' Evaluation Period Status Only)</h4>
        <div>
            <br>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header" style="text-align: center;">IPCR based on Evaluation Status
                        @foreach($getEvalPeriod as $row)
                            <div style="font-size: 11.5pt;">
                                Evaluation Period: <u> {{$row->evaluation_period}}</u>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <canvas id="countipcrevalstatus"></canvas>
                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">
                            <div>Shows the total count of IPCR based on Evaluation Status</div>
                            <div>(All Evaluation Form Status)</div>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header" style="text-align: center;">IPCR having Total Weighted Score below 3
                        @foreach($getEvalPeriod as $row)
                            <div style="font-size: 11.5pt;">
                                Evaluation Period: <u> {{$row->evaluation_period}}</u>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <canvas id="countipcrweightedscore"></canvas>
                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">
                            <div>Shows the total count of IPCR having a Total Weighted Score Below 3.</div>
                            <div>(Unapproved Evaluation Form Status only)<div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="text-align: center;">IPCR based on Deparment
                        @foreach($getEvalPeriod as $row)
                            <div style="font-size: 11.5pt;">
                                Evaluation Period: <u> {{$row->evaluation_period}}</u>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <canvas id="countipcrdepartment"></canvas>
                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">
                            <div>Shows the total count of IPCR per Department</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="text-align: center;">Faculty/Staff who are done (Approved IPCR)
                        @foreach($getEvalPeriod as $row)
                            <div style="font-size: 11.5pt;">
                                Evaluation Period: <u> {{$row->evaluation_period}}</u>
                            </div>
                        @endforeach
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th style="vertical-align: center; text-align: center; width: 40%;">Name</th>
                                <th style="vertical-align: center; text-align: center; width: 40%;">Department</th>
                                <th style="vertical-align: center; text-align: center; width: 20%;">Rating</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($getevaluated as $row)
                                <tr>
                                    <td style="vertical-align: center; text-align: center; width: 40%;">{{$row->name}}</td>
                                    <td style="vertical-align: center; text-align: center; width: 40%;">{{$row->dept_name}}</td>
                                    <td style="vertical-align: center; text-align: center; width: 20%;">{{$row->total_weighted_score}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        //COUNT TOTAL IPCR BASED ON EVALUATION STATUS
        var countipcrevalstatus = $('#countipcrevalstatus');

        var url1 = "{{url('/countipcrevalstatus')}}";
        var count = [];
        var evalstatus = [];

        $(document).ready(function(){
            $.get(url1, function(response){
                response.forEach(function(data){
                    count.push(data.count);
                    evalstatus.push(data.evaluationform_status);
                });
                var ctx = document.getElementById("countipcrevalstatus").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: evalstatus,
                        datasets: [{
                            label: "Total",
                            data: count,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(0, 192, 0, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(0, 192, 0, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            // barThickness: 100,
                            borderWidth: 2

                        }]
                    },
                    options: {
                        legend: {
                            display: true,
                            position: 'left',
                            labels: {
                                fontColor: 'rgb(0, 0, 0)',
                        scales: {
                            xAxes: [{scaleLabel:{display: true, labelString: "COUNT", fontStyle: 'Bold'}}]
                        }
                                }
                        }
                    }
                });
            });
        });

        //TOTAL IPCR COUNT PER EVALUATION STATUS BELOW 3 TOTAL WEIGHTED SCORE
        var countipcrweightedscore = $('#countipcrweightedscore');

        var url2 = "{{url('/countipcrweightedscore')}}";
        var count2 = [];
        var evalstatus2 = [];

        $(document).ready(function(){
            $.get(url2, function(response){
                response.forEach(function(data){
                    count2.push(data.count);
                    evalstatus2.push(data.evaluationform_status);
                });
                var ctx2 = document.getElementById("countipcrweightedscore").getContext('2d');
                var myChart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: evalstatus2,
                        datasets: [{
                            label: 'Total Count',
                            data: count2,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            barThickness: 100,
                            borderWidth: 2

                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{scaleLabel:{display: true, labelString: "COUNT", fontStyle: 'Bold'}, ticks: {beginAtZero:true}}]
                        }
                    }
                });
            });
        });

        //TOTAL COUNT OF IPCR PER DEPARTMENT
        var countipcrdepartment = $('#countipcrdepartment');

        var url3 = "{{url('/countipcrdepartment')}}";
        var count3 = [];
        var deptname = [];

        $(document).ready(function(){
            $.get(url3, function(response){
                response.forEach(function(data){
                    count3.push(data.count);
                    deptname.push(data.dept_name);
                });
                var ctx3 = document.getElementById("countipcrdepartment").getContext('2d');
                var myChart = new Chart(ctx3, {
                    type: 'horizontalBar',
                    data: {
                        labels: deptname,
                        datasets: [{
                            label: 'Total Count',
                            data: count3,
                            backgroundColor: [
                                'rgba(255, 128, 128, 0.5)',
                                'rgba(255, 128, 166, 0.5)',
                                'rgba(255, 166, 128, 0.5)',
                                'rgba(255, 204, 128, 0.5)',
                                'rgba(255, 242, 128, 0.5)',
                                'rgba(229, 255, 128, 0.5)',
                                'rgba(191, 255, 128, 0.5)',
                                'rgba(153, 255, 128, 0.5)',
                                'rgba(128, 255, 140, 0.5)',
                                'rgba(128, 255, 179, 0.5)',
                                'rgba(128, 255, 217, 0.5)',
                                'rgba(128, 217, 255, 0.5)',
                                'rgba(128, 179, 255, 0.5)',
                                'rgba(128, 140, 255, 0.5)',
                                'rgba(153, 128, 255, 0.5)',
                                'rgba(191, 128, 255, 0.5)',
                                'rgba(230, 128, 255, 0.5)',
                                'rgba(255, 128, 242, 0.5)',
                                'rgba(255, 128, 204, 0.5)',
                                'rgba(255, 128, 166, 0.5)',
                            ],
                            borderColor: [
                                'rgba(255, 128, 128, 1)',
                                'rgba(255, 128, 166, 1)',
                                'rgba(255, 166, 128, 1)',
                                'rgba(255, 204, 128, 1)',
                                'rgba(255, 242, 128, 1)',
                                'rgba(229, 255, 128, 1)',
                                'rgba(191, 255, 128, 1)',
                                'rgba(153, 255, 128, 1)',
                                'rgba(128, 255, 140, 1)',
                                'rgba(128, 255, 179, 1)',
                                'rgba(128, 255, 217, 1)',
                                'rgba(128, 217, 255, 1)',
                                'rgba(128, 179, 255, 1)',
                                'rgba(128, 140, 255, 1)',
                                'rgba(153, 128, 255, 1)',
                                'rgba(191, 128, 255, 1)',
                                'rgba(230, 128, 255, 1)',
                                'rgba(255, 128, 242, 1)',
                                'rgba(255, 128, 204, 1)',
                                'rgba(255, 128, 166, 1)',
                            ],
                            barThickness: 30,
                            borderWidth: 2

                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{scaleLabel:{display: true, labelString: "DEPARTMENTS", fontStyle: 'Bold'}}],
                            xAxes: [{ticks: {beginAtZero:true, labelString: "COUNT", fontStyle: 'Bold'}}]
                        }
                        }

                });
            });
        });
    </script>
@endsection

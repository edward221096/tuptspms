@extends('layouts.sidebar')
@section('mydashboard')
    <div class="container-fluid">
        <h4 class="mt-4">My Dashboard</h4>
        <div>
            <br>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="text-align: center;">My IPCR Ratings</div>
                    <div class="card-body">
                        <div style="height: 250px">
                        <canvas id="mytotalipcrratings"></canvas>
                        </div>
                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">
                            <div>Shows the IPCR Ratings per Evaluation Period</div>
                            <div>(Final and Approved IPCR only)</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="text-align: center;">My OPCR Ratings</div>
                    <div class="card-body">
                        <div style="height: 250px">
                            <canvas id="mytotalopcrratings"></canvas>
                        </div>
                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">
                            <div>Shows the OPCR Ratings per Evaluation Period</div>
                            <div>(Final and Approved OPCR only)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //COUNT TOTAL IPCR BASED ON EVALUATION STATUS
        var mytotalipcrratings = $('#mytotalipcrratings');

        // ctx.height(500);
        var url1 = "{{url('/totalipcrweightedscore')}}";
        var ratings = [];
        var evalperiod = [];

        $(document).ready(function(){
            $.get(url1, function(response){
                response.forEach(function(data){
                    ratings.push(data.total_weighted_score);
                    evalperiod.push(data.evaluation_period);
                });
                var ctx = document.getElementById("mytotalipcrratings").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: evalperiod,
                        datasets: [{
                            label: 'Total Weighted Score',
                            data: ratings,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.2)',

                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        title: {
                            display: true,
                            text: 'IPCR Ratings'
                        }
                        }

                });
            });
        });

        //COUNT TOTAL OPCR BASED ON EVALUATION STATUS
        var mytotalopcrratings = $('#mytotalopcrratings');

            // ctx.height(500);
            var url2 = "{{url('/totalopcrweightedscore')}}";
            var ratings2 = [];
            var evalperiod2 = [];

            $(document).ready(function(){
            $.get(url2, function(response){
                response.forEach(function(data){
                    ratings2.push(data.total_weighted_score);
                    evalperiod2.push(data.evaluation_period);
                });
                var ctx = document.getElementById("mytotalopcrratings").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: evalperiod2,
                        datasets: [{
                            label: 'Total Weighted Score',
                            data: ratings2,
                            backgroundColor: [
                                'rgba(128, 255, 179, 0.5)',

                            ],
                            borderColor: [
                                'rgba(128, 255, 179, 0.5)',
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        title: {
                            display: true,
                            text: 'OPCR Ratings'
                        }
                    }

                });
            });
        });
    </script>
@endsection

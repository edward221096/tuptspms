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

{{--            <div class="col-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" style="text-align: center;">IPCR having Total Weighted Score below 3</div>--}}
{{--                    <div class="card-body">--}}
{{--                        <canvas id="countipcrweightedscore"></canvas>--}}
{{--                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">--}}
{{--                            <div>Shows the total count of IPCR having a Total Weighted Score Below 3.</div>--}}
{{--                            <div>(Unapproved Evaluation Form Status only)<div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header" style="text-align: center;">IPCR based on Deparment</div>--}}
{{--                    <div class="card-body">--}}
{{--                        <canvas id="countipcrdepartment"></canvas>--}}
{{--                        <div class="card-footer" style="font-weight: lighter; font-size: 11pt; text-align: center;">--}}
{{--                            <div>Shows the total count of IPCR per Department</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--    </div>--}}
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
    </script>
@endsection

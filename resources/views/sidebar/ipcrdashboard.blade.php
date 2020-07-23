@extends('layouts.sidebar')
@section('ipcrdashboard')
    <div class="container-fluid">
        <h4 class="mt-4">Individual Performance Commitment Review (IPCR) Dashboard</h4>
        <div>
            <br>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">IPCR based on Evaluation Status</div>
                    <div class="card-body">
                        <canvas id="countipcrevalstatus"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">IPCR Total Weighted Score (below 3)</div>
                    <div class="card-body">
                        Chart
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //SALES PER DAY LINE CHART
        var countipcrevalstatus = $('#countipcrevalstatus');

        var url1 = "{{url('/countipcrevalstatus')}}";
        var count = new Array();
        var evalstatus = new Array()

        $(document).ready(function(){
            $.get(url1, function(response){
                response.forEach(function(data){
                    count.push(data.count);
                    evalstatus.push(data.evaluationform_status);
                });
                var ctx = document.getElementById("countipcrevalstatus").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: evalstatus,
                        datasets: [{
                            label: 'Total Count',
                            data: count,
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
                            borderWidth: 1

                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });
        });
    </script>

@endsection

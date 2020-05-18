@extends('layouts.appAdmin')
@section('title','Dashbord')

<style>
    #clear {
        margin-top: 4px;
    }

    #filter {
        margin-left: 555px;
    }
</style>

@section('content')

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $sumtoupday }}</h2>
                                    <span>
                                        <font size="3.5">ยอดการเติมรายวัน</font>
                                    </span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $sumbuyday }}</h2>
                                    <span>ยอดการซื้อรายวัน</span>
                                </div>
                            </div>
                            <div class="overview-chart">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $sumtoupall }}</h2>
                                    <span>ยอดการเติมรวม</span>
                                </div>
                            </div>
                            <div class="overview-chart">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                                <div class="text">
                                    <h2>{{ $sumbuy  }}</h2>
                                    <span>ยอดการซื้อสะสม</span>
                                </div>
                            </div>
                            <div class="overview-chart">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    <h3 class="title-2">credit reports</h3>
                    <br>
                    <canvas id="myLineChart" width="400" height="150"></canvas>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                    <script>
                        var ctx = document.getElementById("myLineChart");
                            var myLineChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
                                    datasets: [{
                                        label: '# of Credit',
                                        data: [ {{ $sumtoupJan }} , {{ $sumtoupFeb }} , {{ $sumtoupMar }} , {{ $sumtoupApr }} , {{ $sumtoupMay }} ,
                                        {{ $sumtoupJun }} , {{ $sumtoupJul }} , {{ $sumtoupAug }} , {{ $sumtoupSept }} , {{ $sumtoupOct }} , {{ $sumtoupNov }} ,
                                        {{ $sumtoupDec }} ],
                                        backgroundColor: [
                                            'rgba(30, 139, 195, 1)',
                                            'rgba(255, 133, 133, 1)',
                                            'rgba(236, 100, 75, 1)',
                                            'rgba(4, 147, 114, 1)',
                                            'rgba(247, 202, 24, 1)',
                                            'rgba(108, 122, 137, 1)',
                                            'rgba(103, 65, 114, 1)',
                                            'rgba(51, 110, 123, 1)',
                                            'rgba(192, 57, 43, 1)',
                                            'rgb(232, 126, 4)',
                                            'rgba(103, 128, 159, 1)' ,
                                            'rgba(51, 110, 123, 1)'
                                        ],
                                        borderColor: [
                                            'rgba(30, 139, 195, 1)',
                                            'rgba(255, 133, 133, 1)',
                                            'rgba(236, 100, 75, 1)',
                                            'rgba(4, 147, 114, 1)',
                                            'rgba(247, 202, 24, 1)',
                                            'rgba(108, 122, 137, 1)',
                                            'rgba(103, 65, 114, 1)',
                                            'rgba(51, 110, 123, 1)',
                                            'rgba(192, 57, 43, 1)',
                                            'rgb(232, 126, 4)',
                                            'rgba(103, 128, 159, 1)',
                                            'rgba(51, 110, 123, 1)'
                                        ],
                                        borderWidth: 3
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
                    </script>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    <h3 class="title-2">sales reports</h3>
                    <br>
                    <canvas id="myChart" width="400" height="150"></canvas>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                    <script>
                        var ctx = document.getElementById("myChart");
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
                                    datasets: [{
                                        label: '# of Sales',
                                        data: [ {{ $sumbuyJan }} , {{ $sumbuyFeb }} , {{ $sumbuyMar }} , {{ $sumbuyApr }} , {{ $sumbuyMay }} , {{ $sumbuyJun }} ,
                                        {{ $sumbuyJul }} , {{ $sumbuyAug }} , {{ $sumbuySept }} , {{ $sumbuyOct }} , {{ $sumbuyNov }} , {{ $sumbuyDec }} ],
                                        backgroundColor: [
                                            'rgba(103, 128, 159, 1)',
                                            'rgba(30, 139, 195, 1)',
                                            'rgba(255, 133, 133, 1)',
                                            'rgba(51, 110, 123, 1)',
                                            'rgba(236, 100, 75, 1)',
                                            'rgba(4, 147, 114, 1)',
                                            'rgba(247, 202, 24, 1)',
                                            'rgba(108, 122, 137, 1)',
                                            'rgba(103, 65, 114, 1)',
                                            'rgba(51, 110, 123, 1)',
                                            'rgba(192, 57, 43, 1)',
                                            'rgb(232, 126, 4)'
                                        ],
                                        borderColor: [
                                            'rgba(103, 128, 159, 1)',
                                            'rgba(30, 139, 195, 1)',
                                            'rgba(255, 133, 133, 1)',
                                            'rgba(51, 110, 123, 1)',
                                            'rgba(236, 100, 75, 1)',
                                            'rgba(4, 147, 114, 1)',
                                            'rgba(247, 202, 24, 1)',
                                            'rgba(108, 122, 137, 1)',
                                            'rgba(103, 65, 114, 1)',
                                            'rgba(51, 110, 123, 1)',
                                            'rgba(192, 57, 43, 1)',
                                            'rgb(232, 126, 4)'
                                        ],
                                        borderWidth: 3
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
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    <h3 class="title-2">Product sales by month</h3>
                    <div class="chart-info">
                    </div>
                    <canvas id="myproductsChart" width="400" height="240"></canvas>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
                    <script>
                        var q = <?php echo $quantity; ?>;
                        var p = <?php echo $productname; ?>;
                        var ctx = document.getElementById("myproductsChart");
                        var myDoughnutChart = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                    labels: p ,
                                    datasets: [{
                                        label: '# of Products',
                                        data: q ,
                                        backgroundColor: [
                                            'rgba(30, 139, 195, 1)',
                                            'rgba(255, 148, 120, 1)',
                                            'rgba(169, 109, 173, 1)',
                                            'rgba(77, 175, 124, 1)',
                                            'rgba(247, 202, 24, 1)',
                                            'rgb(211, 84, 0)'
                                        ],
                                        borderColor: [
                                            'rgba(30, 139, 195, 1)',
                                            'rgba(255, 148, 120, 1)',
                                            'rgba(169, 109, 173, 1)',
                                            'rgba(77, 175, 124, 1)',
                                            'rgba(247, 202, 24, 1)',
                                            'rgb(211, 84, 0)'
                                        ],
                                        borderWidth: 3
                                    }]
                                },
                            });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card chart-percent-card">
                <div class="au-card-inner">
                    <h3 class="title-2 tm-b-5">Top 10 Reseller</h3>
                    <br>
                    <div class="col-lg-12">
                        <div class="au-card au-card--bg-blue au-card-top-countries m-b-30">
                            <div class="au-card-inner">
                                <div class="table-responsive">
                                    <table class="table table-top-countries">
                                        <tbody>
                                            @foreach ($topten as $ten)
                                            <tr>
                                                <td>{{ $ten->name }} {{ $ten->surname }}</td>
                                                <td class="text-right">{{ number_format($ten->total,2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Dashboard';
    $description= 'Main Dashboard';
    $breadcrumbs = ["/dashboard"=>"Home"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')
    <script src="js/vendor/moment-with-locales.min.js"></script>
    <script src="js/vendor/Chart.bundle.min.js"></script>
    <script src="js/vendor/chartjs-plugin-rounded-bar.min.js"></script>
    <script src="js/vendor/chartjs-plugin-crosshair.js"></script>

    <script src="js/vendor/chartjs-plugin-streaming.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/cs/charts.extend.js"></script>
    <script src="/js/pages/dashboard.analytic.js"></script>

    <script type="text/javascript">
        $(function() {
            "use strict";
            var ctx = document.getElementById("allTime").getContext('2d');
            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#60ea7c');
            gradientStroke1.addColorStop(1, '#3eea17');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#60e5ea');
            gradientStroke2.addColorStop(1, '#17caea');

            const d = new Date();
            let year = d.getFullYear();

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['@lang("app.month1")','@lang("app.month2")','@lang("app.month3")','@lang("app.month4")','@lang("app.month5")','@lang("app.month6")','@lang("app.month7")',
                        '@lang("app.month8")','@lang("app.month9")','@lang("app.month10")','@lang("app.month11")','@lang("app.month12")',],
                    datasets: [{
                        data: [{{$tJan}},{{$tFeb}},{{$tMar}},{{$tApr}},{{$tMay}},{{$tJun}},{{$tJul}},{{$tAug}},{{$tSep}},{{$tOct}},{{$tNov}},{{$tDec}}],
                        borderColor: gradientStroke1,
                        backgroundColor: gradientStroke1,
                        hoverBackgroundColor: gradientStroke1,
                        pointStyle: 'circle',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: false,
                        borderWidth: 0,
                        label: year,
                    },{
                        data: [{{$lJan}},{{$lFeb}},{{$lMar}},{{$lApr}},{{$lMay}},{{$lJun}},{{$lJul}},{{$lAug}},{{$lSep}},{{$lOct}},{{$lNov}},{{$lDec}}],
                        borderColor: gradientStroke2,
                        backgroundColor: gradientStroke2,
                        hoverBackgroundColor: gradientStroke2,
                        pointStyle: 'triangle',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: false,
                        borderWidth: 0,
                        label: year - 1,
                    }]
                },

                options: {
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        display: true,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    },
                    scales: {
                        xAxes: [{
                            barPercentage: 1
                        }]
                    }
                }
            });
        })
    </script>

    <!-- All Time -->
    <script type="text/javascript">
        $(function() {
            "use strict";
            var ctx = document.getElementById("chart2").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#15ca20');
            gradientStroke1.addColorStop(1, '#3cdc48');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#fd3550');
            gradientStroke2.addColorStop(1, '#fd5a35');


            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#008cff');
            gradientStroke3.addColorStop(1, '#009dff');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#ffc107');
            gradientStroke4.addColorStop(1, '#fdcd3c');

            var gradientStroke5 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke5.addColorStop(0, '#0dcaf0');
            gradientStroke5.addColorStop(1, '#82e7ff');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["{{count($pie) > 0 ? $pie[0]->name : 'N/A'}}", "{{count($pie) > 1 ? $pie[1]->name : 'N/A'}}", "{{count($pie) > 2 ? $pie[2]->name : 'N/A'}}", "{{count($pie) > 3 ? $pie[3]->name : 'N/A'}}", "{{count($pie) > 4 ? $pie[4]->name : 'N/A'}}"],
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5
                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5
                        ],
                        data: [{{count($pie) > 0 ? $pie[0]->count : 0}}, {{count($pie) > 1 ? $pie[1]->count: 0}}, {{count($pie) >2 ? $pie[2]->count : 0}}, {{count($pie) > 3 ? $pie[3]->count : 0}},{{count($pie) > 4 ?  $pie[4]->count : 0}}],
                        borderWidth: [1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    }
                }
            });
        })
    </script>
    <!-- Last Month -->
    <script type="text/javascript">
        $(function() {
            "use strict";
            var ctx = document.getElementById("chart3").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#15ca20');
            gradientStroke1.addColorStop(1, '#3cdc48');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#fd3550');
            gradientStroke2.addColorStop(1, '#fd5a35');


            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#008cff');
            gradientStroke3.addColorStop(1, '#009dff');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#ffc107');
            gradientStroke4.addColorStop(1, '#fdcd3c');

            var gradientStroke5 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke5.addColorStop(0, '#0dcaf0');
            gradientStroke5.addColorStop(1, '#82e7ff');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["{{count($pie2) > 0 ? $pie2[0]->name : 'N/A'}}", "{{count($pie2) > 1 ? $pie2[1]->name : 'N/A'}}", "{{count($pie2) > 2 ? $pie2[2]->name : 'N/A'}}", "{{count($pie2) > 3 ? $pie2[3]->name : 'N/A'}}", "{{count($pie2) > 4 ? $pie2[4]->name : 'N/A'}}"],
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5
                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5
                        ],
                        data: [{{count($pie2) > 0 ? $pie2[0]->count : 0}}, {{count($pie2) > 1 ? $pie2[1]->count: 0}}, {{count($pie2) >2 ? $pie2[2]->count : 0}}, {{count($pie2) > 3 ? $pie2[3]->count : 0}},{{count($pie2) > 4 ?  $pie2[4]->count : 0}}],
                        borderWidth: [1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    }
                }
            });
        })
    </script>
    <!-- This Month -->
    <script type="text/javascript">
        $(function() {
            "use strict";
            var ctx = document.getElementById("chart4").getContext('2d');

            var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke1.addColorStop(0, '#15ca20');
            gradientStroke1.addColorStop(1, '#3cdc48');

            var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke2.addColorStop(0, '#fd3550');
            gradientStroke2.addColorStop(1, '#fd5a35');


            var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke3.addColorStop(0, '#008cff');
            gradientStroke3.addColorStop(1, '#009dff');

            var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke4.addColorStop(0, '#ffc107');
            gradientStroke4.addColorStop(1, '#fdcd3c');

            var gradientStroke5 = ctx.createLinearGradient(0, 0, 0, 300);
            gradientStroke5.addColorStop(0, '#0dcaf0');
            gradientStroke5.addColorStop(1, '#82e7ff');

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["{{count($pie3) > 0 ? $pie3[0]->name : 'N/A'}}", "{{count($pie3) > 1 ? $pie3[1]->name : 'N/A'}}", "{{count($pie3) > 2 ? $pie3[2]->name : 'N/A'}}", "{{count($pie3) > 3 ? $pie3[3]->name : 'N/A'}}", "{{count($pie3) > 4 ? $pie3[4]->name : 'N/A'}}"],
                    datasets: [{
                        backgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5
                        ],
                        hoverBackgroundColor: [
                            gradientStroke1,
                            gradientStroke2,
                            gradientStroke3,
                            gradientStroke4,
                            gradientStroke5
                        ],
                        data: [{{count($pie3) > 0 ? $pie3[0]->count : 0}}, {{count($pie3) > 1 ? $pie3[1]->count: 0}}, {{count($pie3) >2 ? $pie3[2]->count : 0}}, {{count($pie3) > 3 ? $pie3[3]->count : 0}},{{count($pie3) > 4 ?  $pie3[4]->count : 0}}],
                        borderWidth: [1, 1, 1, 1]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutoutPercentage: 75,
                    legend: {
                        position: 'bottom',
                        display: false,
                        labels: {
                            boxWidth: 8
                        }
                    },
                    tooltips: {
                        displayColors: false,
                    }
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                lengthChange: false,
                pageLength: 100,
                searching: false,
                info: false,
            } );

            table.buttons().container()
                .appendTo( '#example2_wrapper .col-lg-12:eq(0)' );
        } );
    </script>

    <script>
        function resize() {
            if($(window).width() > 800) {
                changeClasses('#head-card1',"3")
                changeClasses('#head-card2',"3")
                changeClasses('#head-card3',"3")
                changeClasses('#head-card4',"3")
                changeClasses('#head-data1',"5")
                changeClasses('#head-data2',"3")
                changeClasses('#head-data3',"4")
            }else{
                changeClasses('#head-card1',"3",true)
                changeClasses('#head-card2',"3",true)
                changeClasses('#head-card3',"3",true)
                changeClasses('#head-card4',"3",true)
                changeClasses('#head-data1',"5",true)
                changeClasses('#head-data2',"3",true)
                changeClasses('#head-data3',"4",true)
            }
        }

        function changeClasses($object,$mainSize,$small = false)
        {
            if($small)
            {
                $($object).addClass('col-12');
                $($object).addClass('col-sm-12');
                $($object).addClass('col-lg-12');
                $($object).removeClass('col-'+$mainSize);
                $($object).removeClass('col-sm-'+$mainSize);
                $($object).removeClass('col-lg-'+$mainSize);
                return;
            }
            $($object).addClass('col-'+$mainSize);
            $($object).addClass('col-sm-'+$mainSize);
            $($object).addClass('col-lg-'+$mainSize);
            $($object).removeClass('col-12');
            $($object).removeClass('col-sm-12');
            $($object).removeClass('col-lg-12');

        }

        $(window).on('resize', function(){
            resize();
        });


        $(function() {
            resize();
        })
    </script>

@endsection

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                    @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs])
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Content Start -->
        <div class="row g-4">
            <div id="head-card1" class="col-3 col-sm-3 col-lg-3">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex text-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Sales</p>
                                <h4 class="my-1 text-info"><i class="icon material-symbols-outlined">point_of_sale</i> {{$totalCount}} </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-wrench'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="head-card2" class="col-3 col-sm-3 col-lg-3">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">@lang('app.totalRevenue')</p>
                                <h4 class="my-1 text-danger"><i class="icon material-symbols-outlined">wallet</i> ${{$totalIncome}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="head-card3" class="col-3 col-sm-3 col-lg-3">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">@lang('app.onDuty')</p>
                                <h4 class="my-1 text-success"><i class="icon material-symbols-outlined">badge</i> {{$onDuty}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-user' ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="head-card4" class="col-3 col-sm-3 col-lg-3">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">@lang('app.activeInCity')</p>
                                <h4 class="my-1 text-warning"><i class="icon material-symbols-outlined">group</i> {{$citizens}}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <hr>
        <div class="row g-4">
            <!-- Sales Start -->
            <div id="head-data1" class="col-5 col-sm-5 col-lg-5">
                <div class="card mb-5 sh-40">
                    <div class="card-header">
                        <h4>Sales</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="allTime"></canvas>
                    </div>
                </div>
            </div>
            <div id="head-data2" class="col-3 col-sm-3 col-lg-3">
                <div class="card radius-10" style="min-height: 320px !important; max-height: 320px !important; overflow: auto;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">@lang('app.onDuty')</h6>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($onDutyList as $od)
                                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$od->name}} <span class="badge bg-danger rounded-pill">{{$od->workingAs}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div id="head-data3" class="col-4 col-sm-4 col-lg-4">
                <div class="card radius-10" style="min-height: 320px !important; max-height: 320px !important; overflow: auto;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">This Month Vs Last Month</h6>
                            </div>
                            <hr>
                        </div>
                        <table class="table table-responsive-lg">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Sales</th>
                                <th>Revenue</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>This Month</th>
                                <td>{!! $thisMonthCount !!}</td>
                                <td>${!! $thisMonthIncome!!}</td>
                            </tr>
                            <tr>
                                <th>Last Month</th>
                                <td>{!! $lastMonthCount !!}</td>
                                <td>${!! $lastMonthIncome !!}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Sales End -->
        </div><!--end row-->
        <hr>
        <div class="row g-4">
            <!-- All Time -->
            <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">All Time Top 5 Staff</h6>
                            </div>

                        </div>
                        <div class="chart-container-2 mt-4">
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if (count($pie) > 0)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie[0]->name}} <span class="badge bg-success rounded-pill">{{$pie[0]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie) > 1)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie[1]->name}} <span class="badge bg-danger rounded-pill">{{$pie[1]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie) > 2)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie[2]->name}} <span class="badge bg-primary rounded-pill">{{$pie[2]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie) > 3)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie[3]->name}} <span class="badge bg-warning text-dark rounded-pill">{{$pie[3]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie) > 4)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie[4]->name}} <span class="badge bg-info text-dark rounded-pill">{{$pie[4]->count}}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- Last Month-->
            <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0"> Top 5 Staff Last Month</h6>
                            </div>

                        </div>
                        <div class="chart-container-2 mt-4">
                            <canvas id="chart3"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if (count($pie2) > 0)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie2[0]->name}} <span class="badge bg-success rounded-pill">{{$pie2[0]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie2) > 1)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie2[1]->name}} <span class="badge bg-danger rounded-pill">{{$pie2[1]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie2) > 2)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie2[2]->name}} <span class="badge bg-primary rounded-pill">{{$pie2[2]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie2) > 3)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie2[3]->name}} <span class="badge bg-warning text-dark rounded-pill">{{$pie2[3]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie2) > 4)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie2[4]->name}} <span class="badge bg-info text-dark rounded-pill">{{$pie2[4]->count}}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- This Month-->
            <div class="col-12 col-lg-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Top 5 Staff This Month</h6>
                            </div>

                        </div>
                        <div class="chart-container-2 mt-4">
                            <canvas id="chart4"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        @if (count($pie3) > 0)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie3[0]->name}} <span class="badge bg-success rounded-pill">{{$pie3[0]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie3) > 1)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie3[1]->name}} <span class="badge bg-danger rounded-pill">{{$pie3[1]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie3) > 2)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie3[2]->name}} <span class="badge bg-primary rounded-pill">{{$pie3[2]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie3) > 3)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie3[3]->name}} <span class="badge bg-warning text-dark rounded-pill">{{$pie3[3]->count}}</span>
                            </li>
                        @endif
                        @if (count($pie3) > 4)
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$pie3[4]->name}} <span class="badge bg-info text-dark rounded-pill">{{$pie3[4]->count}}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div><!--end row-->

        <!-- Content End -->
    </div>
@endsection

@extends("layouts.app")
@section("style")
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">@lang('app.totalRepairs')</p>
                                    <h4 class="my-1 text-info">{{$count}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-wrench'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">@lang('app.totalRevenue')</p>
                                    <h4 class="my-1 text-danger">${{$rev}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">@lang('app.onDuty')</p>
                                    <h4 class="my-1 text-success">{{$onDuty}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-user' ></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">@lang('app.activeInCity')</p>
                                    <h4 class="my-1 text-warning">{{$citizens}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end row-->

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">@lang('app.repairsOverview')</h6>
                                </div>

                            </div>
                            <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                            </div>
                            <div class="chart-container-1">
                                <canvas id="chart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card radius-10" style="min-height: 342px !important;">
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
                <div class="col-12 col-lg-4">
                    <div class="card radius-10" style="min-height: 342px !important;">
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
                                    <th>Repairs</th>
                                    <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>This Month</th>
                                        <td>{!! $count3 !!}</td>
                                        <td>${!! $rev3!!}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Month</th>
                                        <td>{!! $count2 !!}</td>
                                        <td>${!! $rev2 !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
            <div class="row">
                <!-- All Time -->
                <div class="col-12 col-lg-4">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">All Time @lang('app.topFiveMech')</h6>
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
                                    <h6 class="mb-0">@lang('app.topFiveMech') Last Month</h6>
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
                                    <h6 class="mb-0">@lang('app.topFiveMech') This Month</h6>
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


        </div>
        @endsection

        @section("script")
            <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
            <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
            <script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
            <script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>


            <script type="text/javascript">
                $(function() {
                    "use strict";
                    var ctx = document.getElementById("chart1").getContext('2d');
                    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
                    gradientStroke1.addColorStop(0, '#a360ea');
                    gradientStroke1.addColorStop(1, '#9617ea');

                    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
                    gradientStroke2.addColorStop(0, '#eab360');
                    gradientStroke2.addColorStop(1, '#ea8117');

                    const d = new Date();
                    let year = d.getFullYear();

                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['@lang("app.month1")','@lang("app.month2")','@lang("app.month3")','@lang("app.month4")','@lang("app.month5")','@lang("app.month6")','@lang("app.month7")',
                                '@lang("app.month8")','@lang("app.month9")','@lang("app.month10")','@lang("app.month11")','@lang("app.month12")',],
                            datasets: [{
                                data: [{{$jan[0]->count}},{{$feb[0]->count}},{{$mar[0]->count}},{{$apr[0]->count}},{{$may[0]->count}},{{$jun[0]->count}},{{$jul[0]->count}},{{$aug[0]->count}},{{$sep[0]->count}},{{$oct[0]->count}},{{$nov[0]->count}},{{$dec[0]->count}}],
                                borderColor: gradientStroke1,
                                backgroundColor: gradientStroke1,
                                hoverBackgroundColor: gradientStroke1,
                                pointRadius: 0,
                                fill: true,
                                borderWidth: 0,
                                label: year
                            },{
                                data: [{{$ljan[0]->count}},{{$lfeb[0]->count}},{{$lmar[0]->count}},{{$lapr[0]->count}},{{$lmay[0]->count}},{{$ljun[0]->count}},{{$ljul[0]->count}},{{$laug[0]->count}},{{$lsep[0]->count}},{{$loct[0]->count}},{{$lnov[0]->count}},{{$ldec[0]->count}}],
                                borderColor: gradientStroke2,
                                backgroundColor: gradientStroke2,
                                hoverBackgroundColor: gradientStroke2,
                                pointRadius: 0,
                                fill: true,
                                borderWidth: 0,
                                label: year - 1
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
                                    barPercentage: 0.7
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

            <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
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
@endsection

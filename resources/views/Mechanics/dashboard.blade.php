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
    @livewireChartsScripts
@endsection

@section('js_page')

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
            <x-dashboard-stat-panel :icon="'bx bxs-wrench'" :class="'border-info'">
                <p class="mb-0 text-secondary">@lang('app.totalRepairs')</p>
                <h4 class="my-1 text-info"><i class="icon material-symbols-outlined">home_repair_service</i> {{$totalCount}} </h4>
            </x-dashboard-stat-panel>
            <x-dashboard-stat-panel :icon="'bx bxs-wrench'" :class="'border-info'">
                <p class="mb-0 text-secondary">@lang('app.totalRevenue')</p>
                <h4 class="my-1 text-danger"><i class="icon material-symbols-outlined">wallet</i> {{$totalIncome}} </h4>
            </x-dashboard-stat-panel>
            <x-dashboard-stat-panel :icon="'bx bxs-wrench'" :class="'border-info'">
                <p class="mb-0 text-secondary">@lang('app.onDuty')</p>
                <h4 class="my-1 text-success"><i class="icon material-symbols-outlined">badge</i> {{$onDuty}} </h4>
            </x-dashboard-stat-panel>
            <x-dashboard-stat-panel>
                <p class="mb-0 text-secondary">@lang('app.activeInCity')</p>
                <livewire:dashboard.active-players lazy/>


            </x-dashboard-stat-panel>
        </div>
            <!--end row-->
        <hr>
        <div class="row g-4">
            <!-- Sales Start -->
            <div id="head-data1" class="col-5 col-sm-5 col-lg-5">
                <div class="card mb-5 sh-40">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Sales</h6>
                            </div>

                        </div>
                        <livewire:dashboard.mechanic.monthly-sales lazy/>

                        <!--<canvas id="allTime"></canvas>-->
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
                                <th>Repairs</th>
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
                                <h6 class="mb-0">All Time @lang('app.topFiveMech')</h6>
                            </div>

                        </div>
                        <div class="chart-container-2 mt-4">
                            <livewire:dashboard.mechanic.top-five-all-time />
                        </div>
                    </div>
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
                            <livewire:dashboard.mechanic.top-five-last-month />
                        </div>
                    </div>
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
                            <livewire:dashboard.mechanic.top-five-this-month />
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <!-- Content End -->
    </div>
@endsection

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
            <!-- Sales Start -->
            <div id="head-data1" class="col-5 col-sm-5 col-lg-5">
                <div class="card mb-5 sh-40">
                    <div class="card-header">
                        <h4>Active Cases</h4>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th scope="col">Case</th>
                                <th scope="col">Prosecution</th>
                                <th scope="col">Defence</th>
                                <th scope="col">State</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">12345</th>
                                <td>SASP</td>
                                <td>Jane Doe</td>
                                <td><span class="badge bg bg-outline-warning btn-sm rounded-pill">Pending</span></td>
                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div id="head-data2" class="col-3 col-sm-3 col-lg-3">
                <div class="card radius-10" style="min-height: 320px !important; max-height: 320px !important; overflow: auto;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Who is available?</h6>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($onDutyList as $od)
                                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">{{$od->name}} <span class="badge bg-danger rounded-pill">{{$od->workingAs}}</span>
                                </li>
                            @endforeach
                                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">John Doe<span class="badge bg-success rounded-pill">Lawyer</span>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sales End -->
        </div><!--end row-->
        <hr>

        <!-- Content End -->
    </div>
@endsection

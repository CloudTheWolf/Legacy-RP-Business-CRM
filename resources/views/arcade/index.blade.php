@extends("layouts.app")
@section("style")
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Sales</p>
                                    <h4 class="my-1 text-success">{{$sales}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-deepblue text-white ms-auto"><i class='bx bxs-shopping-bag'></i>
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
                                    <p class="mb-0 text-secondary">Total Revenue</p>
                                    <h4 class="my-1 text-success">${{$rev}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-ibiza text-white ms-auto"><i class='bx bxs-dollar-circle'></i>
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
            </div><!--end row-->

        </div>
        @endsection

        @section("script")
            <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
            <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
            <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
            <script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
            <script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>


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

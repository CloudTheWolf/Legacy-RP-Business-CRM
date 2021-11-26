<?php
use \App\Http\Controllers\TowController;
use Carbon\Carbon
?>
        @extends("layouts.app")

        @section("style")
            <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
            <link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
            <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
        @endsection

        @section("wrapper")
		<div class="page-wrapper">
			<div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Tow Tools</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tow Tracker</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
            </div>

            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <h6 class="mb-0 text-uppercase">Recent Impounds</h6>
                    <hr/>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                @foreach($apiTable as $users)
                                    @if(in_array((int)$users->characterId,$cidList))
                                    <h5>{{TowController::cidToName($users->characterId)}}</h5>
                                <table id="example2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle</th>
                                        <th>Plate</th>
                                        <th>Type</th>
                                        @if(Auth::user()->IsAdmin == '1')
                                        <th>Payout</th>
                                        @endif
                                        <th>Timestamp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                                @foreach($users->towImpounds as $impound)
                                                    <tr>
                                                        <td>{{$impound->timestamp}}</td>
                                                        <td>{{$impound->modelName}}</td>
                                                        <td>{{$impound->plateNumber}}</td>
                                                        <td>{{$impound->playerVehicle == 1 ? "Citizen" : "Local"}}</td>
                                                        @if(Auth::user()->IsAdmin == '1')
                                                        <td>{{$impound->reward}}</td>
                                                        @endif
                                                        <td>{{Carbon::parse($impound->timestamp)->setTimezone('PST')}}</td>
                                                    </tr>
                                                @endforeach


                                    </tbody>
                                </table>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
		@endsection



        @section("script")
            <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    var table = $('#example2').DataTable( {
                        lengthChange: false,
                        searching: false,
                        order: [[5,"desc"]]
                    } );

                    table.buttons().container()
                        .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
                } );
            </script>
            <script>
                $(document).ready(function() {
                    setInterval(function() {
                        window.location.reload();
                    }, 60000);
                })
            </script>
        @endsection

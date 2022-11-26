<?php
use \App\Http\Controllers\TeamsController;
?>
@extends("layouts.app")

@section("style")
    <link href="assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
@endsection

@section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">

            <div class="container">
                <div class="row">
                        <div class="col col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Team</h5>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <table id="team" class="table table-striped table-bordered table-info">
                                            <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Name</th>
                                                        <th>Job Title</th>
                                                        <th>CID</th>
                                                        <th>Cell</th>
                                                        <th>Tow</th>
                                                        @if(Auth::user()->IsAdmin == 1)
                                                        <th>In City</th>
                                                        @endif
                                                        <th>On Duty</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                @if($user->role == "IT Support")
                                                    @continue
                                                @endif
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->role}}</td>
                                                    <td>{{$user->cid}}</td>
                                                    <td>{{$user->cell}}</td>
                                                    <td>{{$user->towID}}</td>
                                                    @if(Auth::user()->IsAdmin == 1)
                                                    <td>
                                                            @php
                                                            if($user->cid != '')
                                                            {
                                                                $found = false;
                                                                $cid = $user->cid;
                                                                foreach($onlineUsers['data'] as $ou)
                                                                    {
                                                                        $c = $ou['character'];
                                                                        $oCid = $c["id"] ??= 0;
                                                                        $match = $cid == $oCid;
                                                                        if($match)
                                                                            {
                                                                               $found = true;
                                                                               break;
                                                                            }
                                                                    }
                                                            }
                                                            if($found) {
                                                                    echo("<span style=\"color: greenyellow\">In City <i class=\"bx bx-check\"></i></span>");
                                                                 }
                                                            else{
                                                                     echo("<span style=\"color: orangered\">Out Of City <i class=\"bx bx-x\"></i></span>");
                                                                 }
                                                            @endphp</td>
                                                    @endif
                                                    <td style="color: {{$user->onDuty == 1 ? "greenyellow" :  "orangered"}}">{{$user->onDuty == 1 ? $user->workingAs : "Off Duty"}}<i class="bx bx-{{$user->onDuty == 1 ? "check" : "x"}}"></i></td>
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
            <!--end row-->
        </div>

    </div>
@endsection

@section("script")
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#team').DataTable( {
                lengthChange: false,
                pageLength: 100,
                order: [[0,"asc"]]
            } );

            table.buttons().container()
                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
        } );
    </script>
@endsection

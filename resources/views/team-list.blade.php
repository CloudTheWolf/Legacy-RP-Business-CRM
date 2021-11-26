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
                                                        <th>In City</th>
                                                        <th>On Duty</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->role}}</td>
                                                    <td>{{$user->cid}}</td>
                                                    <td>{{$user->cell}}</td>
                                                    <td>{{$user->towID}}</td>
                                                    <td><span id="{{$user->cid}}">{{$user->cid != '' ? 'Loading...': 'CID Not Set'}}</span></td>
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
    <script type="text/javascript">

        $(document).ready(function() {
            @foreach($users as $userScript)
                checkCity('{{$userScript->cid}}');
            @endforeach
        });


        function checkCity(cid)
        {
            if(cid == '')
            {
                console.log("No CID")
                return;
            }
            console.log("Searching "+cid)
            $.ajax({
                type: 'GET',
                url: "{{env('API_BASE_URI')}}/op-framework/character.json?characterId="+cid,
                tryCount : 0,
                retryLimit : 5,
                success: function (data) {
                    if (JSON.parse(data).statusCode == "200") {
                        $("#"+cid).html("In City <i class=\"bx bx-check\">").css('color', 'greenyellow');
                    } else {
                        $("#"+cid).html("Out Of City <i class=\"bx bx-x\">").css('color', 'orangered');
                    };
                },
                error:function(xhr, textStatus, errorThrown ) {
                    if (textStatus == 'timeout') {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            setTimeout(2000);
                            $.ajax(this);
                            return;
                        }
                        return;
                    }
                    if (xhr.status == 500) {
                        $("#"+cid).html("Error").css('color', 'red');
                    } else {
                        $("#"+cid).html("Error").css('color', 'red');
                    }
                }
            });
        }

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

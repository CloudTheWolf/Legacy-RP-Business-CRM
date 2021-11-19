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
                    @foreach($users as $user)
                        <div class="col col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h5 class="card-title">{{$user->name}}</h5>
                                        <table class="table table-striped table-bordered table-info">
                                            <thead>
                                                    <tr>
                                                        <th>CID</th>
                                                        <th>Cell</th>
                                                        <th>Tow</th>
                                                        <th>In City</th>
                                                        <th>On Duty</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{$user->cid}}</td>
                                                <td>{{$user->cell}}</td>
                                                <td>{{$user->towID}}</td>
                                                <td>{{$user->cid != '' ? 'Soon™️': '?'}}</td>
                                                <td style="color: {{$user->onDuty == 1 ? "greenyellow" :  "orangered"}}">{{$user->onDuty == 1 ? "Yes" : "No"}}<i class="bx bx-{{$user->onDuty == 1 ? "check" : "x"}}"></i></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <!--end row-->
        </div>

    </div>
@endsection





@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Add User ';
    $description= 'Add User';
    $breadcrumbs = ["/"=>"Home","#"=>"Admin","admin/add-user/"=>"Add User"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')

@endsection

@section('js_page')

    <script>
        function FindByCid(){
            var settings = {
                "url": "{{url("/api/opfw/")}}/" + $("#cid").val(),
                "method": "GET",
                "timeout": 0,
                error: function(){
                    alert("Failed to find CID [" + $("#cid").val() + "]");
                }
            };

            $.ajax(settings).done(function (response) {
                console.log("Found " + response["first_name"] + " " + response["last_name"]);
                $("#name").val(response["first_name"] + " " + response["last_name"]);
                $("#username").val(response["first_name"] + "." + response["last_name"]);
                $("#cell").val(response["phone_number"]);
                $("#inputChoosePassword").val(response["phone_number"]);
            });
        }
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
            <div class="col-2 col-sm-2 col-lg-2">
            </div>
            <div class="col-8 col-sm-8 col-lg-8">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Add User</h4>
                    </div>
                    @if (\Session::has('message'))
                        <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-white">Success</h6>
                                    <div class="text-white">{!! \Session::get('message') !!}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        {{Form::open()}}
                        <hr class="form-control-separator">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Full Name</label>
                                <input id="name" name="name" class="form-control" type="text" placeholder="John Doe" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">Username</label>
                                <input id="username" name="username" class="form-control" type="text" placeholder="John.Doe" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-9">
                                <label for="app-name" class="form-label">Citizen ID</label>
                                <input type="text" class="form-control" id="cid" name="cid" placeholder="123456" pattern="[0-9]+" required>
                            </div>
                            <div class="col-md-3" style="padding-top: 3%;">
                                <button type="button" class="btn btn-gradient-primary" onclick="FindByCid();"><i class="bx bx-search"></i> Find By CID</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">SteamID <sub>REQUIRED FOR STEAM LOGIN</sub></label>
                                <input type="text" class="form-control" id="steamId" name="steamId" placeholder="steam:123456789abcdef">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">Cell Phone</label>
                                <input type="text" class="form-control" id="cell" name="cell" placeholder="123-4567" pattern="^[0-9]{3}-[0-9]{4}$" required>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputRole" class="form-label">Job Role</label>
                                        <select class="form-control" id="inputRole" name="role" required>
                                            <option selected disabled>Please Select</option>
                                            @if(config('app.siteMode') == "Mechanic")
                                                <option value="Tow Driver">Tow Driver</option>
                                                <option value="Intern Mechanic">Intern Mechanic</option>
                                                <option value="Mechanic">Mechanic</option>
                                                <option value="Lead Mechanic">Lead Mechanic</option>
                                                <option value="Expert Mechanic">Expert Mechanic</option>
                                                <option value="Veteran Mechanic">Veteran Mechanic</option>
                                                <option value="Trainer">Trainer</option>
                                            @endif
                                            @if(config('app.siteMode') == "Arcade" || config('app.siteMode') == "Bar")
                                                <option value="Bartender">Bartender</option>
                                            @endif
                                            <option value="Manager">Manager</option>
                                            @if(config('app.siteMode') == "Mechanic")
                                                <option value="Veteran Manager">Veteran Manager</option>
                                            @endif
                                            <option value="Boss">Boss</option>
                                            <option value="IT Support">IT Support</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="inputChoosePassword" placeholder="Enter Password" required>
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="isAdmin" type="checkbox" id="flexSwitchCheckChecked" value="1">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Grant Admin Functions</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-outline-success col-md-12"><span class="material-symbols-outlined">save</span>Save</button>
                            </div>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <!-- Content End -->
    </div>
@endsection

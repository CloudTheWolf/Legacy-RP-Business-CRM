@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Edit User ';
    $description= 'Edit User';
    $breadcrumbs = ["/"=>"Home","#"=>"Admin","admin/users/"=>"Manage User","admin/users/". $user->id => $user->name]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')

@endsection

@section('js_page')

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
                                <input id="name" name="name" class="form-control" type="text" placeholder="John Doe" value="{{$user->name}}" required autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">Username</label>
                                <input id="username" name="username" class="form-control" type="text" placeholder="John.Doe" value="{{$user->email}}" readonly autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">Citizen ID</label>
                                <input type="text" class="form-control" id="cid" name="cid" placeholder="123456" pattern="[0-9]+" value="{{$user->cid}}" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">SteamID <sub>REQUIRED FOR STEAM LOGIN</sub></label>
                                <input type="text" class="form-control" id="inputEmailAddress" name="steamId" placeholder="steam:123456789abcdef" value="{{$user->steamId}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="app-name" class="form-label">Cell Phone</label>
                                <input type="text" class="form-control" id="inputEmailAddress" name="cell" placeholder="123-4567" pattern="^[0-9]{3}-[0-9]{4}$" value="{{$user->cell}}" required>
                            </div>
                        </div>
                        @if(config('app.siteMode') == "Mechanic")
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="inputEmailAddress" class="form-label">Tow Plate(s)</label>
                                <input type="text" class="form-control" id="inputEmailAddress" name="towID" placeholder="AAAAAAAA" pattern="[a-zA-Z0-9;,]+" value="{{$user->towID}}">
                            </div>
                        </div>
                        @endif
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inputRole" class="form-label">Job Role</label>
                                        <select class="form-control" id="inputRole" name="role" required>
                                            <option selected disabled>Please Select</option>
                                            @if(config('app.siteMode') == "Mechanic")
                                                <option {{$user->role == "Tow Driver" ? 'selected' : ''}} value="Tow Driver">Tow Driver</option>
                                                <option {{$user->role == "Intern Mechanic" ? 'selected' : ''}} value="Intern Mechanic">Intern Mechanic</option>
                                                <option {{$user->role == "Lead Mechanic" ? 'selected' : ''}} value="Lead Mechanic">Lead Mechanic</option>
                                                <option {{$user->role == "Adept Mechanic" ? 'selected' : ''}} value="Adept Mechanic">Adept Mechanic</option>
                                                <option {{$user->role == "Expert Mechanic" ? 'selected' : ''}} value="Expert Mechanic">Expert Mechanic</option>
                                                <option {{$user->role == "Veteran Mechanic" ? 'selected' : ''}} value="Veteran Mechanic">Veteran Mechanic</option>
                                                <option {{$user->role == "Trainer" ? 'selected' : ''}} value="Trainer">Trainer</option>
                                            @endif
                                            @if(config('app.siteMode') == "Arcade" || config('app.siteMode') == "Bar")
                                                <option {{$user->role == "Bartender" ? 'selected' : ''}} value="Bartender">Bartender</option>
                                            @endif
                                            <option {{$user->role == "Manager" ? 'selected' : ''}} value="Manager">Manager</option>
                                            @if(config('app.siteMode') == "Mechanic")
                                                <option {{$user->role == "Veteran Manager" ? 'selected' : ''}} value="Veteran Manager">Veteran Manager</option>
                                            @endif
                                            @if(config('app.siteMode')!= 'Motorcycle Club')
                                                <option {{$user->role == "Boss" ? 'selected' : ''}} value="Boss">Boss</option>
                                            @endif
                                            @if(config('app.siteMode') == 'Motorcycle Club')
                                                <option {{$user->role == "Prospect" ? 'selected' : ''}} value="Prospect">Prospect</option>
                                                <option {{$user->role == "Member" ? 'selected' : ''}} value="Member">Member</option>
                                                <option {{$user->role == "Enforcer" ? 'selected' : ''}} value="Enforcer">Enforcer</option>
                                                <option {{$user->role == "Treasurer" ? 'selected' : ''}} value="Treasurer">Treasurer</option>
                                                <option {{$user->role == "Secretary" ? 'selected' : ''}} value="Secretary">Secretary</option>
                                                <option {{$user->role == "Road Captain" ? 'selected' : ''}} value="Road Captain">Road Captain</option>
                                                <option {{$user->role == "SGT at Arms" ? 'selected' : ''}} value="SGT at Arms">SGT at Arms</option>
                                                <option {{$user->role == "Vice President" ? 'selected' : ''}} value="Vice President">Vice President</option>
                                                <option {{$user->role == "President" ? 'selected' : ''}} value="President">President</option>
                                            @endif
                                                <option {{$user->role == "IT Support" ? 'selected' : ''}} value="IT Support">IT Support</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Change Password</label>
                                    <input type="password" class="form-control" name="password" id="inputChoosePassword" placeholder="Enter Password" autocomplete="off">
                                </div>
                                <hr>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        @if($user->IsAdmin == 1)
                                            <input class="form-check-input" name="isAdmin" type="checkbox" id="flexSwitchCheckChecked" value="1" checked>
                                        @else
                                            <input class="form-check-input" name="isAdmin" type="checkbox" id="flexSwitchCheckChecked" value="1" >
                                        @endif
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Grant Admin Functions</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            @if($user->disabled == 1)
                                                <input class="form-check-input" name="disabled" type="checkbox" id="flexSwitchCheckChecked" value="1" checked>
                                            @else
                                                <input class="form-check-input" name="disabled" type="checkbox" id="flexSwitchCheckChecked" value="1" >
                                            @endif
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Disable account</label>
                                        </div>
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

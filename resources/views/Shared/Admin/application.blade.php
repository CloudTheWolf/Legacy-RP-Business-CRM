@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Job Application | '. $application->name;
    $description= 'View Job Applications';
    $breadcrumbs = ["/"=>"Home","#"=>"Admin","admin/applications/"=>"Job Applications","admin/applications/".$application->id => $application->name]
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
                            <h4>Job Application | {{$application->name}}</h4>
                        </div>
                        <div class="card-body">
                            {{Form::open()}}
                            <input name="id" type="hidden" value="{!! $application->id !!}">
                            <h5 class="text-center">Details</h5>
                            <hr class="form-control-separator">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input id="name" name="name" class="form-control" type="text" value="{{$application->name}}" readonly="readonly" aria-readonly="true" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name" class="form-label">Username</label>
                                    <input id="username" name="username" class="form-control" type="text" value="{{str_replace(" ",".",$application->name)}}" placeholder="Company Name" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name" class="form-label" >Discord</label>
                                    <input type="text" name="discord" class="form-control" id="inputEmailAddress" value="{{str_replace(' ','.',$application->discord)}}" readonly="readonly" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name" class="form-label">Citizen ID</label>
                                    <input type="text" class="form-control" id="inputEmailAddress" name="cid" placeholder="123456" pattern="[0-9]+" value="{{$application->cid}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name" class="form-label">SteamID</label>
                                    <input type="text" class="form-control" id="inputEmailAddress" name="steamId" placeholder="steam:123456789abcdef" value="{{$application->steam}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name" class="form-label">Cell Phone</label>
                                    <input type="text" class="form-control" id="inputEmailAddress" name="cell" placeholder="123-4567" pattern="^[0-9]{3}-[0-9]{4}$" value="{{$application->cell}}" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="form-group col-md-12">
                                    <h6 class="form-label" style="font-weight: bold"><strong>Tell us a little about yourself</strong></h6>
                                    <p style="white-space: pre-wrap;">{!! $application->about !!}</p>
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="form-group col-md-12">
                                    <h6 class="form-label"><strong>Tell us why you want a job at
                                            {!! config('app.companyName') !!} and why we should hire you!</strong></h6>
                                    <p style="white-space: pre-wrap;">{!! $application->why !!}</p>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="form-group col-md-12">
                                    <h6 class="form-label"><strong>Tell us about your Criminal Record</strong></h6>
                                    <p style="white-space: pre-wrap;">{!! $application->record !!}</p>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="form-group col-md-12">
                                    <h6 class="form-label"><strong>Do you have any gang ties, or affiliations that may affect your employment?</strong></h6>
                                    <p style="white-space: pre-wrap;">{!! $application->gang == 1 ? 'Yes' : 'No' !!}</p>
                                </div>
                            </div>
                            <hr>
                            <h5 class="text-center">Response</h5>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="inputRole" class="form-label">Job Role</label>
                                            <select class="form-control" id="inputRole" name="role" required>
                                                <option selected value="Tow Driver">Tow Driver</option>
                                                <option value="Intern Mechanic">Intern Mechanic</option>
                                                <option value="Lead Mechanic">Lead Mechanic</option>
                                                <option value="Adept Mechanic">Adept Mechanic</option>
                                                <option value="Expert Mechanic">Expert Mechanic</option>
                                                <option value="Veteran Mechanic">Veteran Mechanic</option>
                                                <option value="Manager">Manager</option>
                                                <option value="Boss">Boss</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ack" id="accept" value="accept" required aria-required="true">
                                        <label class="form-check-label" for="accept">Accept Application</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ack" id="deny" value="deny" required aria-required="true">
                                        <label class="form-check-label" for="deny">Deny Application</label>
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

@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Site Settings';
    $description= 'Manage Settings For The Site';
    $breadcrumbs = ["/"=>"Home","/"=>"Admin","settings/"=>"Site Settings"]
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
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card radius-10">
                        <div class="card-header">
                            <h4>Application Settings</h4>
                        </div>
                        <div class="card-body">
                            @if (\Session::has('message'))
                                <div class="alert alert-success border-0 border-start border-5 border-success fade show py-2">
                                    <div class="d-flex">
                                        <div class="font-35"><i class='bx bx-success'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Success</h6>
                                            <div class="">{!! \Session::get('message') !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{Form::open()}}
                            <h5>Site Settings</h5>
                            <hr class="form-control-separator">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Application Name</label>
                                    <input id="app-name" name="app-name" class="form-control" type="text" value="{{Config('app.APP_NAME')}}" placeholder="App Name" autocomplete="off">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Company Name</label>
                                    <input id="company-name" name="company-name" class="form-control" type="text" value="{{Config('app.companyName')}}" placeholder="Company Name" autocomplete="off">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Branding Directory Name</label>
                                    <!--<input id="branding-dir" name="branding-dir" class="form-control" type="text" value="{{Config('app.brandingPath')}}" placeholder="harmony" autocomplete="off">-->
                                    <select class="form-control" id="branding-dir" name="branding-dir">
                                        <option disabled readonly selected>Please Select</option>
                                        <optgroup label="Mechanic Shop">
                                            <option @if(Config('app.brandingPath') == "harmony") selected @endif value="harmony">Harmony</option>
                                            <option @if(Config('app.brandingPath') == "hayes") selected @endif value="hayes">Hayes</option>
                                            <option @if(Config('app.brandingPath') == "lost") selected @endif value="lost">Lost</option>
                                            <option @if(Config('app.brandingPath') == "mpar") selected @endif value="mpar">Mirror Park</option>
                                            <option @if(Config('app.brandingPath') == "mosleys") selected @endif value="mosleys">Mosley's</option>
                                            <option @if(Config('app.brandingPath') == "2g") selected @endif value="2g">Second Gear</option>
                                            <option @if(Config('app.brandingPath') == "sol") selected @endif value="sol">SOL</option>
                                        </optgroup>
                                        <optgroup label="Bars/Clubs/Arcade">
                                            <option @if(Config('app.brandingPath') == "bahama") selected @endif value="bahama">Bahama Mama</option>
                                            <option @if(Config('app.brandingPath') == "steak1") selected @endif value="steak1">Madrazo's Steak House</option>
                                            <option @if(Config('app.brandingPath') == "splitsides") selected @endif value="splitsides">Split Sides</option>
                                            <option @if(Config('app.brandingPath') == "tll") selected @endif value="tll">Tequi-la-la</option>
                                            <option @if(Config('app.brandingPath') == "vg") selected @endif value="vg">Videogeddon</option>
                                            <option @if(Config('app.brandingPath') == "yellowjack") selected @endif value="yellowjack">Yellow Jack Inn</option>
                                        </optgroup>
                                        <optgroup label="Gangs">
                                            <option @if(Config('app.brandingPath') == "aod") selected @endif value="aod">Angels Of Death</option>
                                        </optgroup>
                                        <optgroup label="Law">
                                            <option @if(Config('app.brandingPath') == "doj") selected @endif value="doj">DOJ</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Site Mode</label>
                                    <select class="form-control" id="site-mode" name="site-mode">
                                        <option {{Config('app.siteMode') == "Arcade" ? "selected" : ""}} value="Arcade">Arcade</option>
                                        <option {{Config('app.siteMode') == "Bar" ? "selected" : ""}} value="Bar">Bars/Clubs</option>
                                        <option {{Config('app.siteMode') == "Mechanic" ? "selected" : ""}} value="Mechanic">Mechanic</option>
                                        <option {{Config('app.siteMode') == "Motorcycle Club" ? "selected" : ""}} value="Motorcycle Club">Motorcycle Club</option>
                                        <option {{Config('app.siteMode') == "DOJ" ? "selected" : ""}} value="DOJ">DOJ</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="form-control-separator">
                            @if(Config('app.siteMode') == "Mechanic" || Config('app.siteMode') == "Bar" || Config('app.siteMode') == "Arcade")
                            <h5>Discord Settings</h5>
                            <hr class="form-control-separator">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Post Job Applications To Discord</label>
                                    <select class="form-control" id="post-job" name="post-job">
                                        <option {{!Config('app.postJobApplications') ? "selected" : ""}} value="false">Off</option>
                                        <option {{Config('app.postJobApplications') ? "selected" : ""}} value="true">On</option>
                                    </select>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Automatically Clock Users Out When They Are Not In City</label>
                                        <select class="form-control" id="auto-clockout" name="auto-clockout">
                                            <option {{!Config('app.autoClockOut') ? "selected" : ""}} value="false">No</option>
                                            <option {{Config('app.autoClockOut') ? "selected" : ""}} value="true">Yes</option>
                                        </select>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Job Applications Webhook URL</label>
                                    <input id="job-discord" name="job-discord" class="form-control" type="text" value="{{Config('app.jobWebhook')}}" placeholder="https://discord.com/api/webhooks/..." autocomplete="off">
                                </div>
                            </div>
                            @endif
                            @if(Config('app.siteMode') == "Mechanic")
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Sale Webhook URL</label>
                                    <input id="sale-discord" name="sale-discord" class="form-control" type="text" value="{{Config('app.saleWebhook')}}" placeholder="https://discord.com/api/webhooks/..." autocomplete="off">
                                </div>
                            </div>
                            @endif
                            @if(Config('app.siteMode') == "Mechanic" || Config('app.siteMode') == "Bar" || Config('app.siteMode') == "Arcade")
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Timesheet Webhook URL</label>
                                    <input id="timesheet-discord" name="timesheet-discord" class="form-control" type="text" value="{{Config('app.timesheetWebhook')}}" placeholder="https://discord.com/api/webhooks/..." autocomplete="off">
                                </div>
                            </div>
                            @endif
                            @if(Config('app.siteMode') == "Mechanic")
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Tow Log Webhook URL</label>
                                    <input id="tow-discord" name="tow-discord" class="form-control" type="text" value="{{Config('app.towWebhook')}}" placeholder="https://discord.com/api/webhooks/..." autocomplete="off">
                                </div>
                            </div>
                            @endif
                            <hr>
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

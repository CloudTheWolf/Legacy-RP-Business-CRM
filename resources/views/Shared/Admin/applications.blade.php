@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Job Applications';
    $description= 'View Job Applications';
    $breadcrumbs = ["/"=>"Home","#"=>"Admin","admin/applications/"=>"Job Applications"]
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
        <div class="row">
            @foreach($applications as $application)
            <div class="col-md-3" style="min-height: 400px !important; max-height: 350px !important; overflow: hidden; padding-top: 5px;">
                <div class="card radius-10" style="height: 100%">
                    <div class="card-header" style="padding-bottom: 5px !important; padding-top: 15px !important;">
                        <h4 style="font-weight: bold; text-align: center">{{$application->name}} [{{$application->cid}}]</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Email (Discord): {{$application->discord}}</p>
                        <p class="card-text">Passport (Steam): {{$application->steam}}</p>
                        <p class="card-text">About {{substr($application->about,0,300)}}...</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{url('/admin/applications/'.$application->id)}}" class="btn btn-lg btn-primary" style="width: 100%">Review Application</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--end row-->
        <!-- Content End -->
    </div>
@endsection

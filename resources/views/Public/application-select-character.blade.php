@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed", "color": "dark-green"  }, "storagePrefix" : "legacy-rp", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Login Page';
    $description = 'Login Page'
@endphp
@extends('layout_full',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])
@section('css')
    <style>
        .fixed-background
        {
            background:url({{url('/assets/images/branding')}}/{{env('BRANDING_DIR')}}/bg.png) no-repeat 50% fixed !important;
            background-size:cover;
            width:100%;height:100%;
            position:fixed;
            top:0;
            right:0;
            bottom:0;
            left:0 ;
        }
        .logo-default
        {
            background-image: url({{url('/assets/images/branding')}}/{{env('BRANDING_DIR')}}/logo-img2.png) !important;
            width: 100% !important;
            height: 250px !important;


        }
    </style>
@endsection

@section('js_vendor')
    <script src="/js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="/js/vendor/jquery.validate/additional-methods.min.js"></script>
@endsection

@section('js_page')

@endsection

@section('content_left')
    <!--<div class="min-h-100 d-flex align-items-center">
        <div class="w-100 w-lg-75 w-xxl-50">
            <div style="color: #fff !important;">
                <div class="mb-5">
                    <h1 class="display-3 text-white">Welcome To</h1>
                    <h1 class="display-3 text-white">{{env('COMPANY_NAME')}}</h1>
                </div>
                <p class="h6 text-white lh-1-5 mb-5">
                    Login to the Staff Panel to begin!
                </p>
                <p class="h6 text-white lh-1-5 mb-5">
                <ol>
                    <li>IT IS AN OFFENSE TO CONTINUE WITHOUT PROPER AUTHORIZATION.</li>
                    <li>This system is restricted to authorized users. Individuals who attempt unauthorized access will be prosecuted. If you're unauthorized, terminate access now. Click "Login" to indicate your acceptance of this information.</li>
                </ol>
                </p>
            </div>
        </div>
    </div>-->
@endsection

@section('content_right')
    <div class="sw-lg-80 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div class="sw-lg-50 px-5">
            <div class="sh-11">
                <a href="/">
                    <div class="logo-default"></div>
                </a>
            </div>
            <div class="mb-5">
                <h2 class="cta-1 mb-0 text-primary">Welcome,</h2>
                <h2 class="cta-1 text-primary">let's get started!</h2>
            </div>
            <div class="mb-5">

            </div>
            <div>
                @if (\Session::has('error'))
                    <div class="alert alert-danger border-0 border-start border-5 border-danger fade show py-2">
                        <div class="d-flex">
                            <div class="font-35"><i class='bx bxs-error'></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0">Error</h6>
                                <div class="">{!! \Session::get('error') !!}</div>
                            </div>
                        </div>
                    </div>
                @endif
                    <h5 class="card-title">Apply As...</h5>
                    {{ Form::open(array('id'=>'apply', 'class' => 'row g-3')) }}
                    <label for="cid">Enter your Character ID (Use <code>/info</code> in city to get this)</label>
                    <input type="hidden" value="{{Session::get('steamID')}}" name="steamId">
                    <input type="text" placeholder="53676" name="cid">
                    <button type="submit" class="btn btn-primary">Continue...</button>
                    {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
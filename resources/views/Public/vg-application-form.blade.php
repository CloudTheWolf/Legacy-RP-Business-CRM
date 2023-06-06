@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed", "color": "dark-green"  }, "storagePrefix" : "legacy-rp", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Login Page';
    $description = 'Login Page'
@endphp
@extends('layout_full',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])
@section('css')
    <link rel="stylesheet" href="/css/vendor/select2.min.css"/>
    <link rel="stylesheet" href="/css/vendor/select2-bootstrap4.min.css"/>
    <link rel="stylesheet" href="/css/vendor/bootstrap-datepicker3.standalone.min.css"/>
    <link rel="stylesheet" href="/css/vendor/tagify.css"/>
    <style>
        .fixed-background
        {
            background:url({{url('/assets/images/branding')}}/{{config('app.brandingPath')}}/bg.png) no-repeat 50% fixed !important;
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
            background-image: url({{url('/assets/images/branding')}}/{{config('app.brandingPath')}}/logo-img2.png) !important;
            width: 100% !important;
            height: 250px !important;


        }
    </style>
@endsection

@section('js_vendor')
    <script src="/js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="/js/vendor/jquery.validate/additional-methods.min.js"></script>
    <script src="/js/cs/scrollspy.js"></script>
    <script src="/js/vendor/jquery.validate/jquery.validate.min.js"></script>
    <script src="/js/vendor/jquery.validate/additional-methods.min.js"></script>
    <script src="/js/vendor/select2.full.min.js"></script>
    <script src="/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/js/vendor/tagify.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/forms/validation.js"></script>

    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('input[name="timezone"]').val(new Date().toString().match(/\(([A-Za-z\s].*)\)/)[1]);
        });
    </script>
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
    <div style="position: absolute; right: 0px; width: 80% !important;" class="sw-lg-80 min-h-100 bg-foreground d-flex justify-content-center align-items-center shadow-deep py-5 full-page-content-right-border">
        <div style="width: 80%">
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
                    <img src="{!! url('/assets/images/branding/'.config('app.brandingPath').'/job_banner.png') !!}" width="100%">
                    <hr>
                    <p><strong>Directions</strong>:
                    <ul>
                        <li>Please fill out the application <i>In Character</i>. </li>
                        <li>Please fill out the application COMPLETELY and ANSWER ALL QUESTIONS honestly.</li>
                        <li>Please allow upto 7 Business Days for a reply to your Application.</li>
                    </ul>
                    <strong>NOTE: Receipt of this Application form does not mean employment.</strong>
                    </p>
                    <strong>PRE-REQUIREMENTS</strong>
                    <ul>
                        <li>Must be willing to undergo any criminal background check that may be required.</li>
                        <!--<li>Have the ability to work at least 4 hours per week (On-Duty)</li>-->
                        <li>Understand that, unless otherwise stated, you will start as a Tow Driver</li>
                    </ul>
                    <hr>
                    {{ Form::open(array('id'=>'apply','url' => 'apply/done', 'class' => 'row g-3 needs-validation', '')) }}
                    {{ csrf_field() }}
                    <div class="form-group col-md-3">

                        <label for="name" class="form-label">Your Timezone</label>
                        <input type="text" name="timezone" id="timezone" value="" class="form-control" required aria-required="true">
                        <div class="invalid-feedback">This is required.</div>

                    </div>
                    <hr>
                    <div class="form-group col-md-3">
                        <input type="hidden" name="timezone" id="timezone" value="">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" name="name" readonly class="form-control" placeholder="John Doe" required aria-required="true" value="{!! $name !!}">
                        <div class="invalid-feedback">This is required.</div>

                    </div>
                    <hr>
                    <div class="form-group col-md-3">
                        <label for="name" class="form-label">Your Email</label>
                        <input type="text" class="form-control" name="discord" placeholder="John#1234" required aria-required="true">
                        <div class="invalid-feedback">This is required.</div>
                    </div>
                    <hr>
                    <div class="form-group col-md-3">
                        <label for="name" class="form-label">Your Passport ID (Steam FiveM ID)</label>
                        <input type="text" readonly class="form-control" name="steam" placeholder="steam:112233445abc6de" pattern="^steam:+[a-zA-Z0-9]{13,16}" required aria-required="true" value="{!! $steamID !!}">
                        <!--sub class="form-help"><a href="https://steamdb.info/calculator/" target="_blank">Click Here</a> to find this. Enter your Steam Username and then copy the FiveM value under SteamID</sub>-->
                        <div class="invalid-feedback">
                            Invalid Steam FiveM ID
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name" class="form-label">Your Citizen ID</label>
                        <input type="text" class="form-control" readonly name="cid" placeholder="69420" pattern="[0-9]{1,6}" required aria-required="true" value="{!! $cid !!}">
                        <p class="form-help">use <code>/info</code> in city to get this</p>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="name" class="form-label">Your Cell Phone</label>
                        <input type="text" class="form-control" readonly name="cell" placeholder="123-4567" pattern="[0-9]{3}-[0-9]{4}" required aria-required="true" value="{!! $cell !!}">
                        <div class="invalid-feedback">This is required.</div>
                        <p class="form-help">Use <code>/number</code> in city to get this</p>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="name" class="form-label">How long have you been a resident of Los Santos?</label>
                        <input type="text" class="form-control" name="duration" placeholder="4 Months 3 Days 47 Minutes and 37 Seconds" required aria-required="true">
                    </div>

                    <hr>
                    <div class="form-group col-md-12">
                        <label for="name" class="form-label">Tell us a little about yourself</label>
                        <textarea class="form-control col-md-12" name="about" maxlength="190" pattern="[a-zA-Z0-9\-\_\s]{1,255}" required aria-required="true"></textarea>
                        <div class="invalid-feedback">This is required.</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name" class="form-label">What shift do you prefer? </label>
                        <select class="form-control" id="inputShift" name="shift" required>
                            <option value="early">Early (Right After Tsunami)</option>
                            <option value="midday">Midday</option>
                            <option value="night">Night</option>
                            <option value="graveyard">Graveyard (Right Before Tsunami)</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name" class="form-label">Tell us why you want a job at {!! config('app.companyName') !!} and why we should hire you?</label>
                        <textarea class="form-control col-md-12" name="why" maxlength="230" pattern="[a-zA-Z0-9\-\_\s]{1,230}" required aria-required="true"></textarea>
                        <div class="invalid-feedback">This is required.</div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="name" class="form-label">Tell us about your Criminal Record!</label>
                        <textarea class="form-control col-md-12" name="record" maxlength="200" pattern="[a-zA-Z0-9\-\_\s]{1,230}" required aria-required="true">My Last Arrest Was {{$lastArrest}}</textarea>
                        <div class="invalid-feedback">This is required.</div>
                    </div>
                    <hr>

                    <div class="form-group col-md-12">
                        <p>Do you have any gang ties, or affiliations that may affect your employment?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gang" value="1" id="flexRadioDefault2" required aria-required="true">
                            <label class="form-check-label" for="flexRadioDefault2">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gang" value="0" id="flexRadioDefault2" required aria-required="true">
                            <label class="form-check-label" for="flexRadioDefault2">No</label>
                        </div>
                        <div class="invalid-feedback">This is required.</div>
                    </div>
                    <hr>
                    <div class="form-group col-md-6">
                        <h4>𝐃𝐈𝐒𝐂𝐋𝐀𝐈𝐌𝐄𝐑</h4>
                        <p><strong>𝐍𝐎𝐓𝐄:</strong> Applicants may have to go through a CRB check. An applicant who fails to pass on any of the checks mentioned above will result in dismissal.</p>
                        <p>I confirm that my answers are accurate and complete to the best of my knowledge. If this application leads to my employment, I understand that false or dishonest information in my application or interview could lead to my dismissal. </p>
                    </div>
                    <div class="form-group col-md-12">
                        <p>I have read the disclaimer and am aware I will start as a Tow unless stated otherwise?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ack" id="flexRadioDefault2" required aria-required="true">
                            <div class="invalid-feedback">This is required.</div>
                            <label class="form-check-label" for="flexRadioDefault2">Yes</label>
                        </div>
                    </div>

                    {{Form::submit('Submit Application!',array('class'=>'btn btn-success'))}}
                    </form>

            </div>
        </div>
    </div>
@endsection

<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../../assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->

    <link href="../../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="../../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../../assets/css/app.css" rel="stylesheet">
    <link href="../../assets/css/icons.css" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../../assets/css/dark-theme.css" />
    <link rel="stylesheet" href="../../assets/css/semi-dark.css" />
    <link rel="stylesheet" href="../../assets/css/header-colors.css" />
    <title>{{config('app.name')}} - Job Application</title>
</head>

<body>


            <div class="page-wrapper">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header">
                            <h4>Job Application Form</h4>
                        </div>
                        <div class="card-body">
                            @if (\Session::has('message'))
                                <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-white">Success</h6>
                                            <div class="text-white">Application Submitted!</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            </ul>
                            <hr>
                            {{ Form::open(array('id'=>'apply','url' => 'apply/done', 'class' => 'row g-3')) }}
                                {{ csrf_field() }}
                            <div class="form-group col-md-3">

                                <label for="name" class="form-label">Your Timezone</label>
                                <input type="text" name="timezone" id="timezone" value="" class="form-control" required aria-required="true">

                            </div>
                                <hr>
                             <div class="form-group col-md-3">
                                 <!--<input type="hidden" name="timezone" id="timezone" value="">-->
                                 <label for="name" class="form-label">Your Name</label>
                                 <input type="text" name="name" readonly class="form-control" placeholder="John Doe" required aria-required="true" value="{!! $name !!}">

                             </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Email (Discord Name with # number)</label>
                                <input type="text" class="form-control" name="discord" placeholder="John#1234" required aria-required="true">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Passport ID (Steam FiveM ID)</label>
                                <input type="text" readonly class="form-control" name="steam" placeholder="steam:112233445abc6de" pattern="^steam:+[a-zA-Z0-9]{13,16}" required aria-required="true" value="{!! $steamID !!}">
                                <div class="invalid-feedback">
                                    Invalid Steam FiveM ID
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Citizen ID</label>
                                <input type="text" class="form-control" readonly name="cid" placeholder="69420" pattern="[0-9]{1,6}" required aria-required="true" value="{!! $cid !!}">
                                <p class="form-help">use <code>/info</code> in city to get this</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Cell Phone</label>
                                <input type="text" class="form-control" readonly name="cell" placeholder="123-4567" pattern="[0-9]{3}-[0-9]{4}" required aria-required="true" value="{!! $cell !!}">
                                <p class="form-help">Use <code>/number</code> in city to get this</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">How long have you been a resident of Los Santos?</label>
                                <input type="text" class="form-control" name="duration" placeholder="4 Months 3 Days 47 Minutes and 37 Seconds" required aria-required="true">
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Tell us a little about yourself</label>
                                <textarea class="form-control col-md-12" name="about" maxlength="190" pattern="[a-zA-Z0-9\-\_\s]{1,255}" required aria-required="true"></textarea>
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
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Tell us about your Criminal Record!</label>
                                <textarea class="form-control col-md-12" name="record" maxlength="200" pattern="[a-zA-Z0-9\-\_\s]{1,230}" required aria-required="true"></textarea>
                                <p>For no criminal record put <code>None</code></p>
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
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <h4>𝐃𝐈𝐒𝐂𝐋𝐀𝐈𝐌𝐄𝐑</h4>
                                <p><strong>𝐍𝐎𝐓𝐄:</strong> Applicants may have to go through a CRB check. An applicant who fails to pass on any of the checks mentioned above may result in dismissal.</p>
                                <p>I confirm that my answers are accurate and complete to the best of my knowledge. If this application leads to my employment, I understand that false or dishonest information in my application or interview could lead to my dismissal. </p>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ack" id="flexRadioDefault2" required aria-required="true">
                                    <label class="form-check-label" for="flexRadioDefault2">I have read the disclaimer.</label>
                                </div>
                            </div>

                            {{Form::submit('Submit Application!',array('class'=>'btn btn-success'))}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bootstrap JS -->
            <script src="{{ url('/') }}/assets/js/bootstrap.bundle.min.js"></script>
            <!--plugins-->
            <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
            <!--app JS-->
            <script src="{{ url('/') }}/assets/js/app.js"></script>
            <script type="text/javascript">
                $(function () {
                    $("#apply").bootstrapValidator()

                    });
            </script>

            <script type="text/javascript" language="javascript">
                $(document).ready(function () {
                    $('input[name="timezone"]').val(new Date().toString().match(/\(([A-Za-z\s].*)\)/)[1]);
                });
            </script>

</body>
</html>

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
    <title>Harmony Repair CRM</title>
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
                            <img src="https://lh4.googleusercontent.com/HE6FG3wtnfQ6fo50rKMQFebcwHIHW20ysGWjwGIJuBPzsPIalLQqI84F5GkWbQDr-07_n9H11l-L-vwtoTvBdgQFW0QRWIstH_2-DxS6qpgFPl9EcjrhtlKi8mxRddRebQ" width="100%">
                            <hr>
                            <p><strong>Directions</strong>:
                                <ul>
                                <li>Please fill out the application COMPLETELY and ANSWER ALL QUESTIONS honestly.</li>
                                <li>Please allow upto 7 Business Days for a reply to your Application.</li>
                                </ul>
                            <strong>NOTE: Receipt of this Application form does not mean employment.</strong>
                        </p>
                            <strong>PRE-REQUIREMENTS</strong>
                            <ul>
                                <li>Must be willing to undergo any criminal background check that may be required.</li>
                                <li>Have the ability to work at least 4 hours per week (On-Duty)</li>
                            </ul>
                            <hr>
                            {{ Form::open(array('id'=>'apply','url' => 'apply', 'class' => 'row g-3')) }}
                                {{ csrf_field() }}
                             <div class="form-group col-md-3">
                                 <label for="name" class="form-label">Your Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="John Doe" required aria-required="true">

                             </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Email (Discord Name with # number)</label>
                                <input type="text" class="form-control" name="discord" placeholder="John#1234" required aria-required="true">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Passport ID (Steam FiveM ID)</label>
                                <input type="text" class="form-control" name="steam" placeholder="steam:112233445abc6de" pattern="^steam:+[a-zA-Z0-9]{13,16}" required aria-required="true">
                                <sub class="form-help"><a href="https://steamdb.info/calculator/" target="_blank">Click here to find this</a></sub>
                                <div class="invalid-feedback">
                                    Invalid Steam FiveM ID
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Citizen ID</label>
                                <input type="text" class="form-control" name="cid" placeholder="69420" pattern="[1-9]{1,6}" required aria-required="true">
                                <p class="form-help">use <code>/info</code> in city to get this</p>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="name" class="form-label">Your Cell Phone</label>
                                <input type="text" class="form-control" name="cell" placeholder="123-4567" pattern="[1-9]{3}-[1-9]{4}" required aria-required="true">
                                <p class="form-help">Use <code>/number</code> in city to get this</p>
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Tell us a little about yourself</label>
                                <textarea class="form-control col-md-12" name="about" maxlength="255" required aria-required="true"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Tell us why you want a job at Harmony and why we should hire you!</label>
                                <textarea class="form-control col-md-12" name="why" maxlength="255" required aria-required="true"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name" class="form-label">Tell us about your Criminal Record!</label>
                                <textarea class="form-control col-md-12" name="record" maxlength="255" required aria-required="true"></textarea>
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
                            <div class="form-group col-md-6">
                                <h4>𝐃𝐈𝐒𝐂𝐋𝐀𝐈𝐌𝐄𝐑</h4>
                                <p><strong>𝐍𝐎𝐓𝐄:</strong> Applicants may have to go through a CRB check. An applicant who fails to pass on any of the checks mentioned above will result in dismissal.</p>
                                <p>I confirm that my answers are accurate and complete to the best of my knowledge. If this applications leads to my employment, I understand that false or dishonest information in my application or interview could lead to my dismissal. </p>
                                <p>Please be aware that all new employees, unless explicitly stated during the interview stage, will start as Tow Truck Drivers. During this time, you will be evaluated on how active you work as well as receive mechanic training.  </p>
                            </div>
                            <div class="form-group col-md-12">
                                <p>I have read the disclaimer and am aware I will start as a Tow unless stated otherwise?</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="ack" id="flexRadioDefault2" required aria-required="true">
                                    <label class="form-check-label" for="flexRadioDefault2">Yes</label>
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
                    $("#apply").bootstrapValidator();
                );
            </script>
</body>

</html>

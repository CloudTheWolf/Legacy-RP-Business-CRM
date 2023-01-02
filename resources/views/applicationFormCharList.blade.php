<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ url('/') }}/assets/images/branding/{!! config('app.brandingPath') !!}/favicon-32x32.png" type="image/png" />
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

<div class="container-fluid">
            <div class="page-wrapper" style="margin-left: unset !important;">
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
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12" style="align-content: center">
                                <div class="card" style="position: absolute;left: 40%; margin-top: 5px; width: 25rem;height: 100px;">
                                    <div class="card-body">
                                        <h5 class="card-title">Apply As...</h5>
                                        {{ Form::open(array('id'=>'apply','url' => 'apply/form', 'class' => 'row g-3')) }}
                                        <label for="cid">Enter your Character ID (Use <code>/info</code> in city to get this)</label>
                                        <input type="hidden" value="{{Session::get('steamID')}}" name="steamId">
                                        <input type="text" placeholder="53676" name="cid">
                                        <button type="submit" class="btn btn-primary">Continue...</button>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>

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
                    $("#apply").bootstrapValidator(),

                    });
            </script>

            <script type="text/javascript" language="javascript">
                $(document).ready(function () {
                    $('input[name="timezone"]').val(new Date().toString().match(/\(([A-Za-z\s].*)\)/)[1]);
                });
            </script>

</body>
</html>

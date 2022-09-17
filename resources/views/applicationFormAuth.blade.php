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
                                <div class="d-grid">
                                    <button type="button" onclick="window.location='{!! url('/apply/auth/steam') !!}';" class="btn btn-primary">
                                        <svg class="svg-inline--fa fa-steam" width="32px" height="32px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="steam" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M496 256c0 137-111.2 248-248.4 248-113.8 0-209.6-76.3-239-180.4l95.2 39.3c6.4 32.1 34.9 56.4 68.9 56.4 39.2 0 71.9-32.4 70.2-73.5l84.5-60.2c52.1 1.3 95.8-40.9 95.8-93.5 0-51.6-42-93.5-93.7-93.5s-93.7 42-93.7 93.5v1.2L176.6 279c-15.5-.9-30.7 3.4-43.5 12.1L0 236.1C10.2 108.4 117.1 8 247.6 8 384.8 8 496 119 496 256zM155.7 384.3l-30.5-12.6a52.79 52.79 0 0 0 27.2 25.8c26.9 11.2 57.8-1.6 69-28.4 5.4-13 5.5-27.3 .1-40.3-5.4-13-15.5-23.2-28.5-28.6-12.9-5.4-26.7-5.2-38.9-.6l31.5 13c19.8 8.2 29.2 30.9 20.9 50.7-8.3 19.9-31 29.2-50.8 21zm173.8-129.9c-34.4 0-62.4-28-62.4-62.3s28-62.3 62.4-62.3 62.4 28 62.4 62.3-27.9 62.3-62.4 62.3zm.1-15.6c25.9 0 46.9-21 46.9-46.8 0-25.9-21-46.8-46.9-46.8s-46.9 21-46.9 46.8c.1 25.8 21.1 46.8 46.9 46.8z"></path></svg>
                                        </span> Login With Steam To Apply!</button>
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

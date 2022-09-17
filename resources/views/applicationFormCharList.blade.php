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
                        </div>
                    </div>
                                <div class="row">
                                    @foreach($characters as $character)
                                            <div class="col-sm-4">
                                                <div class="card" style="width: 18rem;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Apply As...</h5>
                                                        <p class="card-text">{!! $character->first_name !!} {!! $character->last_name !!} ({!! $character->character_id !!}).</p>
                                                        {{ Form::open(array('id'=>'apply','url' => 'apply/form', 'class' => 'row g-3')) }}
                                                        <input type="hidden" value="{!! $character->first_name !!} {!! $character->last_name !!}" name="name">
                                                        <input type="hidden" value="{!! $character->character_id !!}" name="cid">
                                                        <input type="hidden" value="{!! $character->phone_number !!}" name="cell">
                                                        <input type="hidden" value="{!! $character->steam_identifier !!}" name="steamID">
                                                        <button type="submit" class="btn btn-primary">Continue...</button>
                                                        {{Form::close()}}
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
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

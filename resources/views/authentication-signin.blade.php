<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/branding/{!! config('app.brandingPath') !!}/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>{{config('app.name','Harmony Repair CRM')}}</title>
</head>

<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="assets/images/branding/{!! config('app.brandingPath') !!}/logo-img2.png" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">{{__('auth.signin')}}</h3>
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
                                </div>
                                <div class="form-body">
                                    {{ Form::open(array('url' => 'login/')) }}
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">{{__('auth.username')}}</label>
                                        <input type="text" class="form-control" id="inputEmailAddress" name="email" placeholder="{{__('auth.username')}}">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">{{__('auth.password')}}</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" class="form-control border-end-0" id="inputChoosePassword" name="password" placeholder="'{{__('auth.password')}}'"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="rememberMe" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">{{__('auth.remember')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-success"><i class="bx bxs-lock-open"></i>{{__('auth.signin')}}</button>
                                        </div>
                                    </div>
                                    </form>
                                    <hr>
                                    <div class="d-grid">
                                        <button type="button" onclick="window.location='{!! url('/auth/steam') !!}';" class="btn btn-primary"><svg class="svg-inline--fa fa-steam" width="32px" height="32px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="steam" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M496 256c0 137-111.2 248-248.4 248-113.8 0-209.6-76.3-239-180.4l95.2 39.3c6.4 32.1 34.9 56.4 68.9 56.4 39.2 0 71.9-32.4 70.2-73.5l84.5-60.2c52.1 1.3 95.8-40.9 95.8-93.5 0-51.6-42-93.5-93.7-93.5s-93.7 42-93.7 93.5v1.2L176.6 279c-15.5-.9-30.7 3.4-43.5 12.1L0 236.1C10.2 108.4 117.1 8 247.6 8 384.8 8 496 119 496 256zM155.7 384.3l-30.5-12.6a52.79 52.79 0 0 0 27.2 25.8c26.9 11.2 57.8-1.6 69-28.4 5.4-13 5.5-27.3 .1-40.3-5.4-13-15.5-23.2-28.5-28.6-12.9-5.4-26.7-5.2-38.9-.6l31.5 13c19.8 8.2 29.2 30.9 20.9 50.7-8.3 19.9-31 29.2-50.8 21zm173.8-129.9c-34.4 0-62.4-28-62.4-62.3s28-62.3 62.4-62.3 62.4 28 62.4 62.3-27.9 62.3-62.4 62.3zm.1-15.6c25.9 0 46.9-21 46.9-46.8 0-25.9-21-46.8-46.9-46.8s-46.9 21-46.9 46.8c.1 25.8 21.1 46.8 46.9 46.8z"></path></svg></span> Login With Steam!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->

<!--plugins-->
<script src="assets/js/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
</body>

</html>

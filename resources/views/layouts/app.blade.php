<!doctype html>
<html lang="en" class="dark-theme">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="csrf-token" content="{{csrf_token()}}">-->
	<!--favicon-->
	<link rel="icon" href="{{ url('/') }}/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	@yield("style")
	<link href="{{ url('/') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ url('/') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ url('/') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ url('/') }}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ url('/') }}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ url('/') }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ url('/') }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ url('/') }}/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/header-colors.css" />
    <title>{{config('app.name','Harmony Repair CRM')}}</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		@include("layouts.header")
		<!--end header -->
		<!--navigation-->
		@include("layouts.nav")
		<!--end navigation-->
		<!--start page wrapper -->
		@yield("wrapper")
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">@lang('app.copyright',['year'=> now()->year ])</p>
		</footer>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ url('/') }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
	<script src="{{ url('/') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ url('/') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ url('/') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="{{ url('/') }}/assets/js/app.js"></script>
	@yield("script")
</body>

</html>

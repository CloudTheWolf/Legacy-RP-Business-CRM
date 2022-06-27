		@extends("layouts.app")

        @section("style")
            <link href="assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
        @endsection

		@section("wrapper")
		<div class="page-wrapper">
			<div class="page-content">

            <div class="container">
                <div class="row col-md-12">

                            @foreach($applications as $application)
                            <div class="col col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <h5 class="card-title">{{$application->name}} [{{$application->cid}}]</h5>
                                        </div>
                                        <p class="card-text">Email (Discord): {{$application->discord}}</p>
                                        <p class="card-text">Passport (Steam): {{$application->steam}}</p>
                                        <p class="card-text">About {{$application->about}}</p>
                                        <a href="{{url('/admin/application/'.$application->id)}}" class="btn btn-primary">Review Application</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!--end row-->
            </div>

        </div>
		@endsection





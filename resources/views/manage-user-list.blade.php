		@extends("layouts.app")

        @section("style")
            <link href="assets/plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
        @endsection

		@section("wrapper")
		<div class="page-wrapper">
			<div class="page-content">

            <div class="container">
                <div class="row">

                            @foreach($users as $user)
                            <div class="col col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <h5 class="card-title">{{$user->name}} [{{$user->cid}}]</h5>
                                        </div>
                                        <p class="card-text">{{$user->role}}</p>
                                        <p class="card-text">{{$user->disabled == 1 ? 'Removed' : 'Active'}}</p>
                                        <a href="{{url('/admin/users/'.$user->id)}}" class="btn btn-primary">Manage User</a>
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





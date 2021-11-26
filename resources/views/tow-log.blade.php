		@extends("layouts.app")

        @section("style")
            <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
            <link href="assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
            <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
        @endsection

        @section("wrapper")
		<div class="page-wrapper">
			<div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Tow Tools</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Tow Tracker</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
            </div>

            <div class="row">
                <div class="col-xl-7 mx-auto">

                    <h6 class="mb-0 text-uppercase">Tow Tracker</h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-truck me-1 font-22 text-danger"></i>
                                </div>
                                <h5 class="mb-0 text-danger">Track your Impound/Tow Actions</h5>
                            </div>
                            @if (\Session::has('status'))
                                <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-white">Success</h6>
                                            <div class="text-white">{!! \Session::get('status') !!}</div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <hr>
                            {{ Form::open(array('url' => 'tow/submit', 'class' => 'row g-3')) }}
                                <div class="col-md-2">
                                    <input type="number" min="0" class="form-control" value="{{$local ?? '0'}}" name="local">
                                    <button class="btn btn-outline-success col-md-12"><i class="bx bxs-plus-square"></i><br>Add Local</button>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" class="form-control" value="{{$citizen ?? '0'}}" name="citizen">
                                    <button class="btn btn-outline-info col-md-12"><i class="bx bx-user"></i><br>Add Citizen</button>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" class="form-control" value="{{$pd ?? '0'}}" name="pd">
                                    <button class="btn btn-outline-danger col-md-12"><i class="bx bx-error"></i><br>Add Police</button>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" class="form-control" value="{{$help ?? '0'}}" name="help">
                                    <button class="btn btn-outline-warning col-md-12"><i class="bx bxs-truck"></i><br>Add General Help</button>
                                </div>
                                <div class="col-12">
                                    <hr/>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Ready to submit</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-danger px-5">Log Tow Report</button>
                                </div>
                                <div class="col-md-6">
                                    <a type="submit" id="reset" class="btn btn-outline-primary px-5">Clear Tracker</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <h6 class="mb-0 text-uppercase">Recent Impounds</h6>
                    <hr/>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Vehicle</th>
                                        <th>Plate</th>
                                        <th>Type</th>
                                        <th>Payout</th>
                                        <th>Timestamp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($useApi)
                                        @foreach($apiTable as $users)
                                            @if($users->characterId == Auth::user('cid')->get)

                                                @foreach($users->towImpounds as $impound)
                                                    <tr>
                                                        <td>{{$impound->timestamp}}</td>
                                                        <td>{{$impound->modelName}}</td>
                                                        <td>{{$impound->plateNumber}}</td>
                                                        <td>{{$impound->playerVehicle == 1 ? "Citizen" : "Local"}}</td>
                                                        <td>{{$impound->reward}}</td>
                                                        <td>{{Carbon::parse($impound->timestamp)->setTimezone('PST')}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach

                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
		@endsection



        @section("script")
            <script type="text/javascript">

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(".btn-outline-success").click(function(e){

                    e.preventDefault();

                    var local = parseInt($("input[name=local]").val()) + 1;
                    var citizen = parseInt($("input[name=citizen]").val());
                    var pd = parseInt($("input[name=pd]").val());
                    var help = parseInt($("input[name=help]").val());

                    $.ajax({
                        type:'POST',
                        url:"{{ route('tow.tally') }}",
                        data:{local:local, citizen:citizen, pd:pd,help:help,_token: "{{ csrf_token() }}"},
                        success:function(data){
                            $("input[name=local]").val(local);
                            $("input[name=citizen]").val(citizen);
                            $("input[name=pd]").val(pd);
                            $("input[name=help]").val(help);
                        }
                    });

                });

                $(".btn-outline-info").click(function(e){

                    e.preventDefault();

                    var local = parseInt($("input[name=local]").val());
                    var citizen = parseInt($("input[name=citizen]").val()) + 1;
                    var pd = parseInt($("input[name=pd]").val());
                    var help = parseInt($("input[name=help]").val());

                    $.ajax({
                        type:'POST',
                        url:"{{ route('tow.tally') }}",
                        data:{local:local, citizen:citizen, pd:pd,help:help,_token: "{{ csrf_token() }}"},
                        success:function(data){
                            $("input[name=local]").val(local);
                            $("input[name=citizen]").val(citizen);
                            $("input[name=pd]").val(pd);
                            $("input[name=help]").val(help);
                        }
                    });

                });

                $(".btn-outline-danger").click(function(e){

                    e.preventDefault();

                    var local = parseInt($("input[name=local]").val());
                    var citizen = parseInt($("input[name=citizen]").val());
                    var pd = parseInt($("input[name=pd]").val()) + 1;
                    var help = parseInt($("input[name=help]").val());

                    $.ajax({
                        type:'POST',
                        url:"{{ route('tow.tally') }}",
                        data:{local:local, citizen:citizen, pd:pd,help:help,_token: "{{ csrf_token() }}"},
                        success:function(data){
                            $("input[name=local]").val(local);
                            $("input[name=citizen]").val(citizen);
                            $("input[name=pd]").val(pd);
                            $("input[name=help]").val(help);
                        }
                    });

                });

                $(".btn-outline-warning").click(function(e){

                    e.preventDefault();

                    var local = parseInt($("input[name=local]").val());
                    var citizen = parseInt($("input[name=citizen]").val());
                    var pd = parseInt($("input[name=pd]").val());
                    var help = parseInt($("input[name=help]").val()) + 1;

                    $.ajax({
                        type:'POST',
                        url:"{{ route('tow.tally') }}",
                        data:{local:local, citizen:citizen, pd:pd,help:help,_token: "{{ csrf_token() }}"},
                        success:function(data){
                            $("input[name=local]").val(local);
                            $("input[name=citizen]").val(citizen);
                            $("input[name=pd]").val(pd);
                            $("input[name=help]").val(help);
                        }
                    });

                });

                $("#reset").click(function(e){

                    e.preventDefault();

                    var local = 0;
                    var citizen = 0;
                    var pd = 0;
                    var help = 0;

                    $.ajax({
                        type:'POST',
                        url:"{{ route('tow.tally') }}",
                        data:{local:local, citizen:citizen, pd:pd,help:help,_token: "{{ csrf_token() }}"},
                        success:function(data){
                            $("input[name=local]").val(local);
                            $("input[name=citizen]").val(citizen);
                            $("input[name=pd]").val(pd);
                            $("input[name=help]").val(help);
                        }
                    });

                });

            </script>

            <script type="text/javascript">
                $(function(){
                    $(document).on('click','input[type=number]',function(){ this.select(); });
                });
            </script>

        @endsection

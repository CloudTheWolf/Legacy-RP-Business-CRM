@php
        use Carbon\Carbon;
        //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
        $html_tag_data = [];
        $title = 'Tow Tracker';
        $description= 'Historical Tow Data';
        $breadcrumbs = ["/"=>"Home","#"=>"Tow", "/tow/tracker" => "Tow Tracker"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
<style>
    .page-link{
        min-width: 25px;
        width: fit-content !important;
    }
</style>
@endsection

@section('js_vendor')

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

    <script>
        function resize() {
            if($(window).width() > 800) {
                $('td:nth-child(3),th:nth-child(3)').show();
                changeClasses('#localDiv',"3")
                changeClasses('#playerDiv',"3")
                changeClasses('#pdDiv',"3")
                changeClasses('#helpDiv',"3")
            }else{
                $('td:nth-child(3),th:nth-child(3)').hide();
                changeClasses('#localDiv',"3",true)
                changeClasses('#playerDiv',"3",true)
                changeClasses('#pdDiv',"3",true)
                changeClasses('#helpDiv',"3",true)
            }
        }

        function changeClasses($object,$mainSize,$small = false)
        {
            if($small)
            {
                $($object).addClass('col-12');
                $($object).removeClass('col-'+$mainSize);
                return;
            }
            $($object).addClass('col-'+$mainSize);
            $($object).removeClass('col-12');

        }


        $(window).on('resize', function(){
            resize();
        });


        $(function() {
            resize();
        })

    </script>

@endsection

@section('js_page')

@endsection

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <h1 class="mb-0 pb-0 display-4" id="title">{{ $title }}</h1>
                    @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs])
                </div>
                <!-- Title End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Content Start -->

        <div class="row g-4">
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
                        {{ Form::open(array('class' => 'row g-3')) }}
                        <div id="localDiv" class="col-3">
                            <input type="number" min="0" class="form-control" value="{{$local ?? '0'}}" name="local">
                            <button style="width: 100%;" class="btn btn-outline-success col-md-12"><span class="material-symbols-outlined">add_box</span><br>@lang('app.add') @lang('app.local')</button>
                        </div>
                        <div id="playerDiv" class="col-3">
                            <input type="number" min="0" class="form-control" value="{{$citizen ?? '0'}}" name="citizen">
                            <button style="width: 100%;" class="btn btn-outline-info col-md-12"><span class="material-symbols-outlined">person</span><br>@lang('app.add') @lang('app.citizen')</button>
                        </div>
                        <div id="pdDiv" class="col-3">
                            <input type="number" min="0" class="form-control" value="{{$pd ?? '0'}}" name="pd">
                            <button style="width: 100%;" class="btn btn-outline-danger col-md-12"><span class="material-symbols-outlined">local_police</span><br>@lang('app.add') @lang('app.police')</button>
                        </div>
                        <div id="helpDiv" class="col-3">
                            <input type="number" min="0" class="form-control" value="{{$help ?? '0'}}" name="help">
                            <button style="width: 100%;" class="btn btn-outline-warning col-md-12"><span class="material-symbols-outlined">help</span><br>@lang('app.add') @lang('app.genHelp')</button>
                        </div>
                        <div class="col-12">
                            <hr/>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                                <label class="form-check-label" for="flexSwitchCheckDefault">@lang('app.readyCheck')</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger px-5">@lang('app.logTow')</button>
                        </div>
                        <div class="col-md-6">
                            <a id="reset" class="btn btn-outline-primary px-5">@lang('app.clearTow')</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row g-4">
            <div class="col-1 col-sm-1 col-lg-1"></div>
            <div class="col-10 col-sm-10 col-lg-10">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Historical Impound Data</h4>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Vehicle</th>
                                <th>Plate</th>
                                <th>Type</th>
                                @if(Auth::user()->IsAdmin == '1')
                                    <th>Payout</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($towImpound as $impound)
                                <tr>
                                    <td>{{Carbon::parse($impound->timestamp)->setTimezone('GMT')}}</td>
                                    <td>{{$impound->modelName}}</td>
                                    <td>{{$impound->plateNumber}}</td>
                                    <td>{{$impound->playerVehicle == 1 ? "Citizen" : "Local"}}</td>
                                    @if(Auth::user()->IsAdmin == '1')
                                        <td>{{$impound->reward}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                            {{ $towImpound->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Content End -->
    </div>
@endsection

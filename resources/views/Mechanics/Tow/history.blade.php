@php
        use Carbon\Carbon;
        //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
        $html_tag_data = [];
        $title = 'Historical Tow Data';
        $description= 'Historical Tow Data';
        $breadcrumbs = ["/"=>"Home","#"=>"Tow", "tow/history" => "Historical Tow Data"]
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

@endsection

@section('js_page')
    <script>
        function resize() {
            if($(window).width() > 800) {
                $('td:nth-child(2),th:nth-child(2)').show();
                $('td:nth-child(3),th:nth-child(3)').show();
                $('td:nth-child(5),th:nth-child(5)').show();
            }else{
                $('td:nth-child(2),th:nth-child(2)').hide();
                $('td:nth-child(3),th:nth-child(3)').hide();
                $('td:nth-child(5),th:nth-child(5)').hide();
            }
        }

        $(window).on('resize', function(){
            resize();
        });


        $(function() {
            resize();
        })
    </script>
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
                                <th>Impounded By</th>
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
                                    <td>{{$impound->name}}</td>
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

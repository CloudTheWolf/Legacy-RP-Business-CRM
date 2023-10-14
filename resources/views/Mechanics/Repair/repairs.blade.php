@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Repairs';
    $description= 'Repairs';
    $breadcrumbs = ["/"=>"Home","#"=>"Mechanic", "mechanic/repairs" => "Repairs"]
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
                $('td:nth-child(3),th:nth-child(3)').show();
                $('td:nth-child(4),th:nth-child(4)').show();
                $('td:nth-child(7),th:nth-child(7)').show();
            }else{
                $('td:nth-child(3),th:nth-child(3)').hide();
                $('td:nth-child(4),th:nth-child(4)').hide();
                $('td:nth-child(7),th:nth-child(7)').hide();
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
                        <h4>All Repairs</h4>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mechanic</th>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Materials Used</th>
                                <th>Base Cost</th>
                                <th>Timestamp</th>
                                <!--<th>Receipt</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest as $repair)
                                <tr>
                                    <td>
                                        <a href="{{url("/mechanic/repairs")}}/{{$repair->id}}">{{$repair->id}}</a>
                                    </td>
                                    <td>{{$repair->name}}</td>
                                    <td>{{$repair->customer_name}}</td>
                                    <td>{{$repair->vehicle}}</td>
                                    <td>SC: {{$repair->scrap_used}} · AL: {{$repair->alum_used}} · ST: {{$repair->steel_used}} · GL: {{$repair->glass_used}} · RB: {{$repair->rubber_used}} · AK: {{$repair->advKit}} · O: {{$repair->oil}}</td>
                                    <td>${{$repair->cost}}</td>
                                    <td>{{$repair->timestamp}}</td>
                                    <!--<td>
                                        <a href="{{url('/repair/'.$repair->id)}}" >
                                            <span class="material-symbols-outlined">edit</span>
                                        </a> &nbsp;&nbsp;
                                        <a href="{{url('/receipt/'.$repair->id.'.'.$repair->cost)}}" target="_blank">
                                            <span class="material-symbols-outlined">receipt_long</span></a>
                                    </td>-->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                            {{ $latest->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Content End -->
    </div>
@endsection

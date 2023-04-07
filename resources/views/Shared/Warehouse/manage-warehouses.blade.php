@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'View Team';
    $description= 'View Team';
    $breadcrumbs = ["/"=>"Home","storage"=>"Storage"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')

@endsection

@section('js_page')
    <script>
        function resize() {
            if($(window).width() > 800) {
                $('td:nth-child(5),th:nth-child(5)').show();
                $('td:nth-child(6),th:nth-child(6)').show();
            }else{
                $('td:nth-child(5),th:nth-child(5)').hide();
                $('td:nth-child(6),th:nth-child(6)').hide();
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
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Storage</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width: 90%; margin-left: 5%">
                            <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Max Storage</th>
                            </thead>
                            <tbody>
                            @foreach($allStorageLocations as $location)
                                    <tr onclick="window.location.href='{{url("/storage/")."/".$location->id}}';" style="cursor: pointer">
                                        <td>{{$location->id}}</td>
                                        <td>{{$location->name}}</td>
                                        <td>{{$location->capacity}}</td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <!-- Content End -->
    </div>
@endsection

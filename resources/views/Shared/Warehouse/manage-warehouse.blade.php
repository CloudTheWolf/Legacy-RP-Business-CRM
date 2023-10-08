@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'View Team';
    $description= 'View Team';
    $breadcrumbs = ["/"=>"Home","storage"=>"Storage"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/select2.min.css"/>
    <link rel="stylesheet" href="/css/vendor/select2-bootstrap4.min.css"/>
@endsection

@section('js_vendor')
    <script src="/js/cs/scrollspy.js"></script>
    <script src="/js/vendor/select2.full.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/forms/controls.select2.js"></script>
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
                        <h4>{{$storage->name}}</h4>
                    </div>
                    <div class="card-body">

                        <form method="post" class="row g-3" autocomplete="off">
                        @csrf
                        <div class="col-md-9">
                            <label for="item">Item</label>
                            <select name="item" id="select2Basic" class="vehicle" style="width: 100% !important;" required>
                               <option selected disabled>Select Item</option>
                                   @foreach($items->data as $item)
                                       <option value="{{$item->label}}">{{$item->label}}</option>
                                   @endforeach
                           </select>
                        </div>
                        <div class="col-md-3">
                            <label for="item">Amount</label>
                           <input class="form-control" type="number" min="0" value="0">
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primarytt col-md-12">Add Item</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Items</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width: 90%; margin-left: 5%">
                            <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Max Storage</th>
                            </thead>
                            <tbody>
                            <tr onclick="window.location.href='{{url("/storage/")."/".$storage->id}}';" style="cursor: pointer">
                                <td>{{$storage->id}}</td>
                                <td>{{$storage->name}}</td>
                                <td>{{$storage->capacity}}</td>
                            </tr>
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

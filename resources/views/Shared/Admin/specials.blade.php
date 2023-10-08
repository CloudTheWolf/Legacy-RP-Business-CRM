@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Manage Specials';
    $description= 'Manage Specials';
    $breadcrumbs = ["/"=>"Admin","/admin/specials"=>"Manage Specials"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')

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
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card radius-10">
                        <div class="card-header">
                            <h4>Bar & Club Settings</h4>
                        </div>
                        <div class="card-body">
                            @if (\Session::has('message'))
                                <div class="alert alert-success border-0 border-start border-5 border-success fade show py-2">
                                    <div class="d-flex">
                                        <div class="font-35"><i class='bx bx-success'></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Success</h6>
                                            <div class="">{!! \Session::get('message') !!}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <div class="row">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </thead>
                                        @foreach($specials as $special)
                                        <tr>
                                            <td>{{$special->id}}</td>
                                            <td>{{$special->name}}</td>
                                            <td>{{$special->price}}</td>
                                            @if($special->deleted)
                                            <td><a href="{{url('/admin/specials/enable')}}/{{$special->id}}">Re-Add</a></td>
                                            @else
                                                <td><a href="{{url('/admin/specials/disable')}}/{{$special->id}}">Remove</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <hr>
                            <form method="post">
                                @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Add Special</h5>
                                <hr>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="app-name">Name</label>
                                    <input id="specialName" name="specialName" class="form-control" type="text" placeholder="My Special Item" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="app-name">Price ($)</label>
                                    <input id="specialPrice" name="specialPrice" class="form-control" type="text" placeholder="200" autocomplete="off">
                                </div>

                                <div class="form-group col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-outline-success col-md-12"><span class="material-symbols-outlined">add</span> Add</button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!--end row-->
        <!-- Content End -->
    </div>
@endsection

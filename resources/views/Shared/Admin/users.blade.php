@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Manage Users';
    $description= 'Manage Users';
    $breadcrumbs = ["/"=>"Home","#"=>"Admin","admin/users/"=>"Manage Users"]
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
                            <h4>Manage Users</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>CID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$user->cid}}</td>
                                            <td>{{$user->id}} - {{$user->name}}</td>
                                            <td>{{$user->role}}</td>
                                            <td><a class="btn btn-gradient-primary" href="{{url('/admin/users/')}}/{{$user->id}}">Manage</a></td>
                                        </tr>
                                        @php ++$i; @endphp
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

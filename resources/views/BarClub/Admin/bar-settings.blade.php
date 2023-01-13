@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Bar & Club Settings';
    $description= 'Manage Settings For The Site';
    $breadcrumbs = ["/"=>"Admin","/admin/bar-settings"=>"Bar & Club Settings"]
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
                            {{Form::open()}}
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Beer Price</label>
                                    <input id="beer-sell" name="beer-sell" class="form-control" type="text" value="{{Config('app.beer-sell')}}" placeholder="50" autocomplete="off">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Cider Price</label>
                                    <input id="cider-sell" name="cider-sell" class="form-control" type="text" value="{{Config('app.cider-sell')}}" placeholder="50" autocomplete="off">
                                </div>
                            </div>
                                <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Tequila Price</label>
                                        <input id="tequila-sell" name="tequila-sell" class="form-control" type="text" value="{{Config('app.tequila-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Wine Price</label>
                                        <input id="wine-sell" name="wine-sell" class="form-control" type="text" value="{{Config('app.wine-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                             <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Vodka Price</label>
                                        <input id="vodka-sell" name="vodka-sell" class="form-control" type="text" value="{{Config('app.vodka-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Absinthe Price</label>
                                        <input id="absinthe-sell" name="absinthe-sell" class="form-control" type="text" value="{{Config('app.absinthe-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Whiskey Price</label>
                                        <input id="whiskey-sell" name="whiskey-sell" class="form-control" type="text" value="{{Config('app.whiskey-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Rum Price</label>
                                        <input id="rum-sell" name="rum-sell" class="form-control" type="text" value="{{Config('app.rum-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Coke Price</label>
                                        <input id="coke-sell" name="coke-sell" class="form-control" type="text" value="{{Config('app.coke-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Smore Price</label>
                                        <input id="smore-sell" name="smore-sell" class="form-control" type="text" value="{{Config('app.smore-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="form-control-separator">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-outline-success col-md-12"><span class="material-symbols-outlined">save</span>Save</button>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>
        <!--end row-->
        <!-- Content End -->
    </div>
@endsection

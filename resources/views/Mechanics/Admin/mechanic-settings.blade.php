@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Mechanic Settings';
    $description= 'Manage Settings For The Site';
    $breadcrumbs = ["/"=>"Admin","/admin/mechanic-settings"=>"Mechanic Settings"]
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
                            <h4>Mechanic Settings</h4>
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
                            <form>
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Scrap Buying Price</label>
                                    <input id="scrap-buy" name="scrap-buy" class="form-control" type="text" value="{{Config('app.scrap-buy')}}" placeholder="50" autocomplete="off">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="app-name">Scrap Selling Price</label>
                                    <input id="scrap-sell" name="scrap-sell" class="form-control" type="text" value="{{Config('app.scrap-sell')}}" placeholder="50" autocomplete="off">
                                </div>
                            </div>
                                <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Aluminium Buying Price</label>
                                        <input id="aluminium-buy" name="aluminium-buy" class="form-control" type="text" value="{{Config('app.aluminium-buy')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Aluminium Selling Price</label>
                                        <input id="aluminium-sell" name="aluminium-sell" class="form-control" type="text" value="{{Config('app.aluminium-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                             <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Steel Buying Price</label>
                                        <input id="steel-buy" name="steel-buy" class="form-control" type="text" value="{{Config('app.steel-buy')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Steel Selling Price</label>
                                        <input id="steel-sell" name="steel-sell" class="form-control" type="text" value="{{Config('app.steel-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Glass Buying Price</label>
                                        <input id="glass-buy" name="glass-buy" class="form-control" type="text" value="{{Config('app.glass-buy')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Glass Selling Price</label>
                                        <input id="glass-sell" name="glass-sell" class="form-control" type="text" value="{{Config('app.glass-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Rubber Buying Price</label>
                                        <input id="rubber-buy" name="rubber-buy" class="form-control" type="text" value="{{Config('app.rubber-buy')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Rubber Selling Price</label>
                                        <input id="rubber-sell" name="rubber-sell" class="form-control" type="text" value="{{Config('app.rubber-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Advanced Repair Kit Price</label>
                                        <input id="adv-repair-kit-sell" name="adv-repair-kit-sell" class="form-control" type="text" value="{{Config('app.adv-repair-kit-sell')}}" placeholder="50" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="form-control-separator">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="app-name">Motor Oil Price</label>
                                        <input id="oil-sell" name="oil-sell" class="form-control" type="text" value="{{Config('app.oil-sell') ?? null}}" placeholder="600" autocomplete="off">
                                    </div>
                                </div>
                                <hr class="form-control-separator">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-outline-success col-md-12"><span class="material-symbols-outlined">save</span>Save</button>
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

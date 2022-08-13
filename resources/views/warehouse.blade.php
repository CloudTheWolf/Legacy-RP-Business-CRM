<?php
use \App\Http\Controllers\TowController;
use Carbon\Carbon
?>
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
                <div class="breadcrumb-title pe-3">Warehouses</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Warehouse Manager</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            @if (\Session::has('Error'))
            <div class="alert alert-danger" style="background-color: #f8d7da !important;" role="alert">
                {!! \Session::get('Error') !!}
            </div>
            @endif
            @if (\Session::has('Success'))
            <div class="alert alert-success" style="background-color: #d1e7dd !important;" role="alert">
                {!! \Session::get('Success') !!}
            </div>
            @endif
        <div class="row">
                <div class="col-md-8">
                    <div class="card radius-10">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h5>Warehouse Logs <span style="position: absolute ; right: 10px; top: 6px;"><a href="{!! url('/warehouse/') !!}" class="btn btn-sm btn-outline-info"><i class="bx bx-arrow-back"></i>Back</a></span></h5>
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Scrap</th>
                                    <th>Aluminium</th>
                                    <th>Steel</th>
                                    <th>Glass</th>
                                    <th>Rubber</th>
                                    <th>Issued To</th>
                                    <th>Issued By</th>
                                    <th>Issued At</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                        @php
                                            $from = $log->issuer == 0 ? $warehouse->name : (\App\Models\User::query()->where('id','=',$log->issuer)->first())->name;
                                            $to = $log->issuedTo ==  0 ? $warehouse->name : (\App\Models\User::query()->where('id','=',$log->issuedTo)->first())->name;;
                                        @endphp
                                        <tr>
                                            <td>{{$log->scrap}}</td>
                                            <td>{{$log->aluminium}}</td>
                                            <td>{{$log->steel}}</td>
                                            <td>{{$log->glass}}</td>
                                            <td>{{$log->rubber}}</td>
                                            <td>{{$to}}</td>
                                            <td>{{$from}}</td>
                                            <td>{{$log->tstamp}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="table-responsive">

                            <h5>Warehouse Status</h5>
                            <ul>
                                <li>Name: {!! $warehouse->name !!}<span></span></li>
                                @php
                                $scr = $warehouse->scrap;
                                $alm = $warehouse->aluminium;
                                $stl = $warehouse->steel;
                                $gls = $warehouse->glass;
                                $rbr = $warehouse->rubber;
                                $total = $scr + $alm + $stl + $gls + $rbr;
                                @endphp
                                <li>Capacity: <span>{!! $total !!}/{{$warehouse->capacity}}</span></li>
                            </ul>
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Scrap</th>
                                    <th>Aluminium</th>
                                    <th>Steel</th>
                                    <th>Glass</th>
                                    <th>Rubber</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$warehouse->scrap / 5 }}</td>
                                    <td>{{$warehouse->aluminium  / 5 }}</td>
                                    <td>{{$warehouse->steel  / 5 }}</td>
                                    <td>{{$warehouse->glass  / 5 }}</td>
                                    <td>{{$warehouse->rubber / 2}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <hr>
                            {!! Form::open() !!}
                                <div class="form-group">
                                    <label for="scrap">Scrap</label>
                                    <input class="form-control" type="number" value="0" name="scrap">
                                </div>
                            <div class="form-group">
                                <label for="aluminium">Aluminium</label>
                                <input class="form-control" type="number" value="0" name="aluminium">
                            </div>
                            <div class="form-group">
                                <label for="steel">Steel</label>
                                <input class="form-control" type="number" value="0" name="steel">
                            </div>
                            <div class="form-group">
                                <label for="glass">Glass</label>
                                <input class="form-control" type="number" value="0" name="glass">
                            </div>
                            <div class="form-group">
                                <label for="rubber">Rubber</label>
                                <input class="form-control" type="number" value="0" name="rubber">
                            </div>
                            <div class="form-group">
                                <label for="to">Issue To</label>
                                <select class="form-control" name="to" required>
                                    <option selected disabled>Please Select</option>
                                    <option value="0">{!! $warehouse->name !!}</option>
                                    @foreach($users as $user)
                                        <option value="{!! $user->id !!}">{!! $user->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="from">Issued By</label>
                                <select class="form-control" name="from">
                                    <option value="0">{!! $warehouse->name !!}</option>
                                    @foreach($users as $user)
                                        <option @if($user->id == Auth::user()->id) selected @endif value="{!! $user->id !!}">{!! $user->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div style="align-content: center; padding-left: 50px;">
                                <button class="btn btn-outline-success col-md-5" type="submit">Submit</button>
                                <button class="btn btn-outline-danger col-sm-5" type="reset">Reset</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                </div>
        </div>
        </div>

    </div>
@endsection


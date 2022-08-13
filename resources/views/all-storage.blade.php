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
            </div>

            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <h6 class="mb-0 text-uppercase">Warehouse Manager</h6>
                    <hr/>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">

                                    <h5>View Warehouses
                                        {!! Form::open() !!}
                                        <span style="position: absolute ; right: 50px; top: 6px;">
                                            <label style="font-size: .75em;">Create New Warehouse</label>
                                            <input class="form-control"  style="display: initial; width: 160px;" type="text" placeholder="Warehouse Name" name="warehouseName" required>
                                            <input class="form-control" style="display: initial; width: 150px;" type="number" placeholder="Capacity" name="warehouseCapacity" required>
                                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="bx bx-save"></i>Create</button>
                                        </span></h5>
                                        {!! Form::close() !!}
                                </h5>
                                <table id="example2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Capacity</th>
                                        <th>Scrap</th>
                                        <th>Aluminium</th>
                                        <th>Steel</th>
                                        <th>Glass</th>
                                        <th>Rubber</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($warehouses != null)
                                        @foreach($warehouses as $warehouse)
                                            <tr>
                                                <td>{{$warehouse->id}}</td>
                                                <td>{{$warehouse->name}}</td>
                                                <td><?php
                                                    $scr = $warehouse->scrap;
                                                    $alm = $warehouse->aluminium;
                                                    $stl = $warehouse->steel;
                                                    $gls = $warehouse->glass;
                                                    $rbr = $warehouse->rubber;
                                                    echo $scr + $alm + $stl + $gls + $rbr;
                                                ?>/{{$warehouse->capacity}}</td>
                                                <td>{{$warehouse->scrap / 5}}</td>
                                                <td>{{$warehouse->aluminium / 5}}</td>
                                                <td>{{$warehouse->steel / 5}}</td>
                                                <td>{{$warehouse->glass / 5}}</td>
                                                <td>{{$warehouse->rubber / 2}}</td>
                                                <td><a href="{!! url('/warehouse/') !!}/{{$warehouse->id}}"><i class="bx bx-edit"></i> Manage</a></td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
		@endsection


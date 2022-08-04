    @extends("layouts.app")
	@section("style")
	<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	@endsection



        @section("wrapper")
            <div class="page-wrapper">
                <div class="page-content">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Sales Overview</h6>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chart-container-0">
                                        <canvas id="chart7"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Order Status</h6>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="chart-container-0">
                                        <canvas id="chart-order-status"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->


                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
                        <div class="col">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">Total Orders</p>
                                            <h5 class="my-0">8052</h5>
                                        </div>
                                        <div class="text-primary ms-auto font-30"><i class='bx bx-cart-alt'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart1"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">Total Revenue</p>
                                            <h5 class="my-0">$6.2K</h5>
                                        </div>
                                        <div class="text-danger ms-auto font-30"><i class='bx bx-dollar' ></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart2"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">New Users</p>
                                            <h5 class="my-0">1.3K</h5>
                                        </div>
                                        <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart3"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">Sold Items</p>
                                            <h5 class="my-0">956</h5>
                                        </div>
                                        <div class="text-warning ms-auto font-30"><i class='bx bx-beer'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart4"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">Total Visits</p>
                                            <h5 class="my-0">12M</h5>
                                        </div>
                                        <div class="text-info ms-auto font-30"><i class='bx bx-camera-movie'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart5"></div>
                            </div>
                        </div>
                    </div><!--end row-->


                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-8">
                            <div class="card radius-10">
                                <div class="card-header bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Top Selling Country</h6>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="dashboard-map" style="height: 250px"></div>
                                    <hr>
                                    <div class="mb-4">
                                        <p class="mb-2"><i class="flag-icon flag-icon-us me-1"></i> USA <span class="float-end">50%</span></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 50%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <p class="mb-2"><i class="flag-icon flag-icon-ca me-1"></i> Canada <span class="float-end">65%</span></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-gradient-scooter" role="progressbar" style="width: 65%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <p class="mb-2"><i class="flag-icon flag-icon-gb me-1"></i> England <span class="float-end">85%</span></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 85%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <p class="mb-2"><i class="flag-icon flag-icon-au me-1"></i> Australia <span class="float-end">75%</span></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <p class="mb-2"><i class="flag-icon flag-icon-in me-1"></i> India <span class="float-end">45%</span></p>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar bg-gradient-cosmic" role="progressbar" style="width: 55%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 col-xl-4">
                            <div class="card radius-10">
                                <div class="card-header bg-transparent">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">Sales This Week</h6>
                                        </div>
                                        <div class="dropdown ms-auto">
                                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chart11" style="height:250px;"></div>
                                </div>
                            </div>

                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">Page Views</p>
                                            <h5 class="my-0">2050</h5>
                                        </div>
                                        <div class="text-info ms-auto font-30"><i class='bx bx-bookmark-alt'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart8"></div>
                            </div>

                            <div class="card radius-10 overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <p class="mb-0 text-secondary font-14">Bounce Rate</p>
                                            <h5 class="my-0">24.5%</h5>
                                        </div>
                                        <div class="text-success ms-auto font-30"><i class='bx bx-line-chart' ></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1" id="chart10"></div>
                            </div>
                        </div>
                    </div><!--End Row-->


                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Recent Orders</h6>
                                </div>
                                <div class="dropdown ms-auto">
                                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Photo</th>
                                        <th>Product ID</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Shipping</th>
                                    </tr>
                                    </thead>
                                    <tbody><tr>
                                        <td>Iphone 5</td>
                                        <td><img src="assets/images/products/01.png')  }}" class="product-img-2" alt="product img"></td>
                                        <td>#9405822</td>
                                        <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                                        <td>$1250.00</td>
                                        <td>03 Feb 2020</td>
                                        <td><div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
                                            </div></td>
                                    </tr>

                                    <tr>
                                        <td>Earphone GL</td>
                                        <td><img src="assets/images/products/02.png')  }}" class="product-img-2" alt="product img"></td>
                                        <td>#8304620</td>
                                        <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
                                        <td>$1500.00</td>
                                        <td>05 Feb 2020</td>
                                        <td><div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
                                            </div></td>
                                    </tr>

                                    <tr>
                                        <td>HD Hand Camera</td>
                                        <td><img src="assets/images/products/03.png')  }}" class="product-img-2" alt="product img"></td>
                                        <td>#4736890</td>
                                        <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
                                        <td>$1400.00</td>
                                        <td>06 Feb 2020</td>
                                        <td><div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 70%"></div>
                                            </div></td>
                                    </tr>

                                    <tr>
                                        <td>Clasic Shoes</td>
                                        <td><img src="assets/images/products/04.png')  }}" class="product-img-2" alt="product img"></td>
                                        <td>#8543765</td>
                                        <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                                        <td>$1200.00</td>
                                        <td>14 Feb 2020</td>
                                        <td><div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td>Sitting Chair</td>
                                        <td><img src="assets/images/products/06.png')  }}" class="product-img-2" alt="product img"></td>
                                        <td>#9629240</td>
                                        <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
                                        <td>$1500.00</td>
                                        <td>18 Feb 2020</td>
                                        <td><div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
                                            </div></td>
                                    </tr>
                                    <tr>
                                        <td>Hand Watch</td>
                                        <td><img src="assets/images/products/05.png')  }}" class="product-img-2" alt="product img"></td>
                                        <td>#8506790</td>
                                        <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
                                        <td>$1800.00</td>
                                        <td>21 Feb 2020</td>
                                        <td><div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 40%"></div>
                                            </div></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
		@endsection


    @section("script")
	<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
    <script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
    <script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
    <!--Morris JavaScript -->
    <script src="assets/plugins/raphael/raphael-min.js"></script>
    <script src="assets/plugins/morris/js/morris.js"></script>
    <script src="assets/js/index2.js"></script>
    @endsection

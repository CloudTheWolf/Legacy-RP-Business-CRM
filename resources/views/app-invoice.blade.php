<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="../../assets/images/branding/{!! (config('app.brandingPath')) !!}/favicon-32x32.png" type="image/png" />
    <!--plugins-->

    <link href="../../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="../../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="../../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="../../assets/css/pace.min.css" rel="stylesheet" />
    <script src="../../assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="../../assets/css/app.css" rel="stylesheet">
    <link href="../../assets/css/icons.css" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="../../assets/css/dark-theme.css" />
    <link rel="stylesheet" href="../../assets/css/semi-dark.css" />
    <link rel="stylesheet" href="../../assets/css/header-colors.css" />
    <title>{{config('app.name')}} - @lang('app.invoice')</title>
</head>

<body>


            <div class="page-wrapper">
                <div class="page-content">
                    <div class="card">
                        <div class="card-body">
                            <div id="invoice">
                                <div class="toolbar hidden-print">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-dark"><i class="fa fa-print"></i> Print</button>
                                        <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                                    </div>
                                    <hr/>
                                </div>
                                <div class="invoice overflow-auto">
                                    <div style="min-width: 600px">
                                        <header>
                                            <div class="row">
                                                <div class="col">
                                                    <a href="javascript:;">
                                                        <img src="../../assets/images/branding/{!! config('app.brandingPath') !!}/logo-icon2.png" width="128" alt="" />
                                                    </a>
                                                </div>
                                                <div class="col company-details">
                                                    <h2 class="name">
                                                        <a target="_blank" href="javascript:;">
                                                            {!! config('app.companyName') !!}
                                                        </a>
                                                    </h2>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </header>
                                        <main>
                                            <div class="row contacts">
                                                <div class="col invoice-to">
                                                    <div class="text-gray-light">INVOICE TO:</div>
                                                    <h2 class="to">{{$repair[0]->customer_name}}</h2>
                                                    <div class="address">Vehicle: {{$repair[0]->vehicle}}</div>
                                                    <div class="email">
                                                    </div>
                                                </div>
                                                <div class="col invoice-details">
                                                    <h1 class="invoice-id">INVOICE {!! strtoupper(str_replace(' ','-',config('app.companyName'))) !!}-{{$repair[0]->id}}</h1>
                                                    <div class="date">Date of Invoice: {{date('d/m/Y', strtotime($repair[0]->timestamp))}}</div>
                                                    <div class="date">Due Date: {{date('d/m/Y', strtotime($repair[0]->timestamp))}}</div>
                                                </div>
                                            </div>
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th class="text-left">#</th>
                                                    <th class="text-left">DESCRIPTION</th>
                                                    <th class="text-right" style="text-align: right !important;">MATERIAL PRICE</th>
                                                    <th class="text-right" style="text-align: right !important;">QTY</th>
                                                    <th class="text-right" style="text-align: right !important;">TOTAL</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="no">01</td>
                                                    <td class="text-left">
                                                        <h3>
                                                            Scrap
                                                        </h3>
                                                    <td class="unit">${!! config('mechanic.scrap.sell') !!}.00</td>
                                                    <td class="qty">{{$repair[0]->scrap_used}}</td>
                                                    <td class="total">${{config('mechanic.scrap.sell') * $repair[0]->scrap_used}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no">02</td>
                                                    <td class="text-left">
                                                        <h3>Aluminium</h3></td>
                                                    <td class="unit">${!! config('mechanic.aluminium.sell') !!}.00</td>
                                                    <td class="qty">{{$repair[0]->alum_used}}</td>
                                                    <td class="total">${{config('mechanic.aluminium.sell') * $repair[0]->alum_used}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no">03</td>
                                                    <td class="text-left">
                                                        <h3>Steel</h3></td>
                                                    <td class="unit">{!! config('mechanic.steel.sell') !!}.00</td>
                                                    <td class="qty">{{$repair[0]->steel_used}}</td>
                                                    <td class="total">${{config('mechanic.steel.sell') * $repair[0]->steel_used}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no">04</td>
                                                    <td class="text-left">
                                                        <h3>Glass</h3></td>
                                                    <td class="unit">${!! config('mechanic.glass.sell') !!}.00</td>
                                                    <td class="qty">{{$repair[0]->glass_used}}</td>
                                                    <td class="total">${{config('mechanic.glass.sell') * $repair[0]->glass_used}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="no">05</td>
                                                    <td class="text-left">
                                                        <h3>Rubber</h3></td>
                                                    <td class="unit">${!! config('mechanic.rubber.sell') !!}.00</td>
                                                    <td class="qty">{{$repair[0]->rubber_used}}</td>
                                                    <td class="total">${{config('mechanic.rubber.sell') * $repair[0]->rubber_used}}</td>
                                                </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td colspan="2">GRAND TOTAL</td>
                                                    <td>${{$repair[0]->cost}}</td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <div class="notices">
                                                <div>NOTICE:</div>
                                                <div class="notice">Migrated invoices will not show a cost per material breakdown</br>Grand Total shows base price before any Discount is applied.</div>
                                            </div>
                                        </main>
                                        <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                                    </div>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>

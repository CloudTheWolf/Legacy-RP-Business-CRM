		@extends("layouts.app")

        @section("style")
            <link href="../../assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
            <link href="../../assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
            <link href="../../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
        @endsection

        @section("wrapper")
		<div class="page-wrapper">
			<div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Repairs</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Repair Logs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
            </div>

            <div class="row">
                <div class="col-xl-7 mx-auto">

                    <h6 class="mb-0 text-uppercase">Repair Tracker</h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-wrench me-1 font-22 text-danger"></i>
                                </div>
                                <h5 class="mb-0 text-danger">Edit Repair</h5>
                            </div>
                            <hr>
                            {{ Form::open(array('url' => 'repair/'.$job->id, 'class' => 'row g-3')) }}
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">Logged By</label>
                                    <input type="hidden" class="form-control border-start-0" id="inputLastName1" name="id" value="{{$job->id}}" readonly />
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                        <select name="mechanic" class="single-select" required>
                                            <option disabled>-- Please Select  --</option>
                                            @foreach($mechanics as $mechanic)
                                                <option value="{{$mechanic->id}}" {{$job->mechanic == $mechanic->id ? 'selected' : ''}}>{{$mechanic->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputLastName2" class="form-label">Customer Name</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                    <input type="text" class="form-control border-start-0" id="inputLastName1" placeholder="John Doe" name="customer" value="{{$job->customer_name}}"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputPhoneNo" class="form-label">Vehicle</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-car' ></i></span>
                                        <select name="vehicle" id="vehicle" class="single-select" required>
                                            <option selected disabled>--- Please Selected ---</option>
                                            <optgroup label="Generic Types">
                                                <option value="Boat">Boat</option>
                                                <option value="Commercial">Commercial</option>
                                                <option value="Compact">Compact</option>
                                                <option value="Coupe">Coupe</option>
                                                <option value="Cycle">Cycle</option>
                                                <option value="Helicopter">Helicopter</option>
                                                <option value="Industrial">Industrial</option>
                                                <option value="Military">Military</option>
                                                <option value="Motorcycle">Motorcycle</option>
                                                <option value="Muscle Car">Muscle Car</option>
                                                <option value="Off-Road">Off-Road</option>
                                                <option value="Plane">Plane</option>
                                                <option value="Sedan">Sedan</option>
                                                <option value="Service">Service</option>
                                                <option value="Sports Car">Sports Car</option>
                                                <option value="Sports Classic">Sports Classic</option>
                                                <option value="Special">Special</option>
                                                <option value="Super Car">Super Car</option>
                                                <option value="SUV">SUV</option>
                                                <option value="Utility">Utility</option>
                                                <option value="Van">Van</option>
                                            </optgroup>
                                            <optgroup label="PDM">
                                                @foreach($vehicles->data->pdm as $pdm)
                                                <option value="{{$pdm->label}}">{{$pdm->label}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="EDM">
                                                @foreach($vehicles->data->edm as $edm)
                                                <option value="{{$edm->label}}">{{$edm->label}}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Addon">
                                                @foreach($vehicles->data->addon as $ao)
                                                    <option value="{{$ao->label == '' ? $ao->modelName : $ao->label }}">{{$ao->label == '' ? $ao->modelName : $ao->label }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Work Vehicles">
                                                <option value="Phantom">Phantom</option>
                                                <option value="Taxi">Taxi</option>
                                                <option value="EMS Vehicle">EMS Vehicle</option>
                                                <option value="PD Vehicle">PD Vehicle</option>
                                                <option value="Aircraft">Aircraft</option>
                                                <option value="Boat">Boat</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputEmailAddress" class="form-label">Scrap</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="scrap" name="scrap" onchange="multiply(this.value,75,'scrapCost')" value="{{$job->scrap_used}}" />
                                        <input type="hidden" class="form-control" id="scrapCost" value="0" onchange="finalValue()" onClick="this.setSelectionRange(0, this.value.length)" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputChoosePassword" class="form-label">Alum</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="alum" name="aluminium" value="{{$job->alum_used}}" onchange="multiply(this.value,100,'alumCost')"/>
                                        <input type="hidden" class="form-control" id="alumCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Steel</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="steel" name="steel" value="{{$job->steel_used}}" onchange="multiply(this.value,125,'steelCost')"/>
                                        <input type="hidden" class="form-control" id="steelCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Glass</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="glass" name="glass" value="{{$job->glass_used}}" onchange="multiply(this.value,40,'glassCost')"/>
                                        <input type="hidden" class="form-control" id="glassCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Rubber</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="rubber" name="rubber" value="{{$job->rubber_used}}" onchange="multiply(this.value,15,'rubberCost')"/>
                                        <input type="hidden" class="form-control" id="rubberCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress3" class="form-label">Total ($)</label>
                                    <div class="input-group">
                                        <input  type="currency" class="form-control" id="fullCost" name="FinalCost" value="0" readonly/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">10% Off</span></label>
                                    <div class="input-group">
                                        <input  type="currency" class="form-control" id="10Cost" name="10Cost" value="0" readonly/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">15% Off</span></label>
                                    <div class="input-group">
                                        <input  type="currency" class="form-control" id="15Cost" name="15Cost" value="0" readonly/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">20% Off</span></label>
                                    <div class="input-group">
                                        <input  type="currency" class="form-control" id="20Cost" name="20Cost" value="0" readonly/>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">25% Off</span></label>
                                    <div class="input-group">
                                        <input  type="currency" class="form-control" id="25Cost" name="25Cost" value="0" readonly/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr/>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Ready to submit</label>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <button type="submit" class="btn btn-danger px-5">Save Repair</button>
                                </div>
                                <div class="col-4">
                                    @if($job->deleted == 0)
                                        <a href="{{url('delete-repair/'.$job->id)}}" class="btn btn-outline-danger px-5"><i class="bx bx-trash"></i> Delete Repair</a>
                                    @else
                                        <a href="{{url('restore-repair/'.$job->id)}}" class="btn btn-outline-success px-5"><i class="bx bx-recycle"></i> Restore Repair</a>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-10 mx-auto">
                    <h6 class="mb-0 text-uppercase">Recent Repairs</h6>
                    <hr/>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mechanic</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Materials Used</th>
                                        <th>Base Cost</th>
                                        <th>Timestamp</th>
                                        <th>Receipt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latest as $repair)
                                    <tr>
                                        <td>{{$repair->id}}</td>
                                        <td>{{$repair->name}}</td>
                                        <td>{{$repair->customer_name}}</td>
                                        <td>{{$repair->vehicle}}</td>
                                        <td>SC: {{$repair->scrap_used}} · AL: {{$repair->alum_used}} · ST: {{$repair->steel_used}} · GL: {{$repair->glass_used}} · RB: {{$repair->rubber_used}}</td>
                                        <td>${{$repair->cost}}</td>
                                        <td>{{$repair->timestamp}}</td>
                                        <td><a href="{{url('/repair/'.$repair->id)}}" ><i class="bx bx-edit"></i></a> &nbsp;&nbsp; <a href="{{url('/receipt/'.$repair->id.'.'.$repair->cost)}}" target="_blank"><i class="bx bx-receipt"></i></a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mechanic</th>
                                        <th>Customer</th>
                                        <th>Vehicle</th>
                                        <th>Materials Used</th>
                                        <th>Base Cost</th>
                                        <th>Timestamp</th>
                                        <th>Receipt</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
		@endsection



        @section("script")
            <script src="../../assets/plugins/select2/js/select2.min.js"></script>
            <script>
                $('.single-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
                $('.multiple-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            </script>

            <script>
                function multiply(value,multiplier,element) {
                    console.log(value*multiplier);
                    const multiplicand = value || 0;
                    const product = parseInt(multiplicand) * parseInt(multiplier);
                    document.getElementById(element).value = product;
                    finalValue();
                }

                function finalValue()
                {
                    const scrap = document.getElementById('scrapCost').value;
                    const alum = document.getElementById('alumCost').value;
                    const steel = document.getElementById('steelCost').value;
                    const glass = document.getElementById('glassCost').value;
                    const rubber = document.getElementById('rubberCost').value;
                    const fullCost = parseInt(scrap)+parseInt(alum)+parseInt(steel)+parseInt(glass)+parseInt(rubber);
                    document.getElementById('fullCost').value = fullCost;
                    document.getElementById('10Cost').value = Math.floor(90/100*parseInt(fullCost));
                    document.getElementById('15Cost').value = Math.floor(85/100*parseInt(fullCost));
                    document.getElementById('20Cost').value = Math.floor(80/100*parseInt(fullCost));
                    document.getElementById('25Cost').value = Math.floor(75/100*parseInt(fullCost));
                }
            </script>

            <script src="../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="../../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                } );
            </script>
            <script>
                $(document).ready(function() {
                    var table = $('#example2').DataTable( {
                        lengthChange: false,
                        buttons: [ 'copy', 'excel', 'pdf', 'print'],
                        order: [[0,"desc"]]
                    } );

                    table.buttons().container()
                        .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
                } );
            </script>

            <script type="text/javascript">
                $(function(){
                    $(document).on('click','input[type=number]',function(){ this.select(); });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#vehicle').val('{{$job->vehicle}}');
                    $('#vehicle').trigger('change');
                    multiply(document.getElementById('scrap').value,75,'scrapCost');
                    multiply(document.getElementById('alum').value,100,'alumCost');
                    multiply(document.getElementById('steel').value,125,'steelCost');
                    multiply(document.getElementById('glass').value,40,'glassCost');
                    multiply(document.getElementById('rubber').value,15,'rubberCost');
                    finalValue();
                } );
            </script>


        @endsection

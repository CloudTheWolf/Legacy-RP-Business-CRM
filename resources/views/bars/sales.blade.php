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
                    <div class="breadcrumb-title pe-3">Point Of Sale</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Point Of Sale</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
            </div>

            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <h6 class="mb-0 text-uppercase">Sales Tracker</h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-money me-1 font-22 text-danger"></i>
                                </div>
                                <h5 class="mb-0 text-danger">Log New Sale</h5>
                            </div>
                            <hr>
                            {{ Form::open(array('class' => 'row g-3')) }}
                                <div class="col-md-6">
                                    <label for="inputLastName1" class="form-label">Sale By</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bxs-user'></i></span>
                                        <select name="mechanic" class="single-select" required>
                                            <option disabled>-- Please Select  --</option>
                                            @foreach($staff as $s)
                                                <option value="{{$s->id}}" {{Auth::id() == $s->id ? 'selected' : ''}}>{{$s->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-12">
                                    <h6><span class="center">Drinks</span></h6>
                                </div>
                                <div class="col-2">
                                    <label for="inputEmailAddress" class="form-label">Beer</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="beer" name="beer" onchange="multiply(this.value,25,'beerCost')" value="0" />
                                        <input type="hidden" class="form-control" id="beerCost" value="0" required="required" onchange="finalValue()" onClick="this.setSelectionRange(0, this.value.length)" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputChoosePassword" class="form-label">Cider</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="cider" name="cider" value="0" onchange="multiply(this.value,50,'ciderCost')"/>
                                        <input type="hidden" class="form-control" id="ciderCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Tequila</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="tequila" name="tequila" value="0" onchange="multiply(this.value,50,'tequilaCost')"/>
                                        <input type="hidden" class="form-control" id="tequilaCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Wine</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="wine" name="wine" value="0" onchange="multiply(this.value,75,'wineCost')"/>
                                        <input type="hidden" class="form-control" id="wineCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Vodka</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="vodka" name="vodka" value="0" onchange="multiply(this.value,120,'vodkaCost')"/>
                                        <input type="hidden" class="form-control" id="vodkaCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Absinthe</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="absinthe" name="absinthe" value="0" onchange="multiply(this.value,120,'absintheCost')"/>
                                        <input type="hidden" class="form-control" id="absintheCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Whiskey</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="whiskey" name="whiskey" value="0" onchange="multiply(this.value,150,'whiskeyCost')"/>
                                        <input type="hidden" class="form-control" id="whiskeyCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Rum</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="rum" name="rum" value="0" onchange="multiply(this.value,150,'rumCost')"/>
                                        <input type="hidden" class="form-control" id="rumCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <h6>Specials</h6>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Oiler Maker (Beer + Whiskey) </label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="oiler" name="oiler" value="0" onchange="multiply(this.value,150,'oilerCost')"/>
                                        <input type="hidden" class="form-control" id="oilerCost" value="0" required="required" onchange="finalValue()" />
                                    </div>
                                </div>
                                <hr>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 mx-auto">
                    <h6 class="mb-0 text-uppercase">&nbsp;</h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-money me-1 font-22 text-danger"></i>
                                </div>
                                <h5 class="mb-0 text-danger">Total Sale</h5>
                            </div>
                            <hr>
                            <div class="col-12">
                                <label for="inputAddress3" class="form-label">Total ($)</label>
                                <div class="input-group">
                                    <input  type="currency" class="form-control" id="fullCost" name="FinalCost" value="0" readonly/>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr/>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Ready to submit</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success col-md-12"><i class="bx bxs-game"></i> Log Sale</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
		@endsection



        @section("script")
            <script src="assets/plugins/select2/js/select2.min.js"></script>
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
                    const beer = document.getElementById('beerCost').value;
                    const cider = document.getElementById('ciderCost').value;
                    const tequila = document.getElementById('tequilaCost').value;
                    const wine = document.getElementById('wineCost').value;
                    const vodka = document.getElementById('vodkaCost').value;
                    const absinthe = document.getElementById('absintheCost').value;
                    const whiskey = document.getElementById('whiskeyCost').value;
                    const rum = document.getElementById('rumCost').value;
                    const oiler = document.getElementById('oilerCost').value;
                    const fullCost = parseInt(beer)+parseInt(cider)+parseInt(tequila)+parseInt(wine)+parseInt(vodka)+parseInt(absinthe)+parseInt(whiskey)+parseInt(rum)+parseInt(oiler);
                    document.getElementById('fullCost').value = fullCost;
                    /*
                    document.getElementById('10Cost').value = Math.floor(90/100*parseInt(fullCost));
                    document.getElementById('15Cost').value = Math.floor(85/100*parseInt(fullCost));
                    document.getElementById('20Cost').value = Math.floor(80/100*parseInt(fullCost));
                    document.getElementById('25Cost').value = Math.floor(75/100*parseInt(fullCost));
                    */
                }
            </script>

            <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
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

        @endsection

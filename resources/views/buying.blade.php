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
                    <div class="breadcrumb-title pe-3">Purchase Calculator</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Purchase Calculator</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
            </div>

            <div class="row">
                <div class="col-xl-7 mx-auto">

                    <h6 class="mb-0 text-uppercase">Purchase Calculator</h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-wrench me-1 font-22 text-danger"></i>
                                </div>
                                <h5 class="mb-0 text-danger">Purchase Materials</h5>
                            </div>
                            <hr>
                            {{ Form::open(array('url' => 'buying/', 'class' => 'row g-3', 'name'=>'buy')) }}
                                <div class="col-2">
                                    <label for="inputEmailAddress" class="form-label">Scrap</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="scrap" name="scrap" onchange="multiply(this.value,{!! config('mechanic.scrap.buy') !!},'scrapCost')" value="{{$matts->scrap}}" />
                                        <input type="hidden" class="form-control" id="scrapCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputChoosePassword" class="form-label">Aluminium</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="alum" name="aluminium" value="{{$matts->alum}}" onchange="multiply(this.value,{!! config('mechanic.aluminium.buy') !!},'alumCost')"/>
                                        <input type="hidden" class="form-control" id="alumCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Steel</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="steel" name="steel" value="{{$matts->steel}}" onchange="multiply(this.value,{!! config('mechanic.steel.buy') !!},'steelCost')"/>
                                        <input type="hidden" class="form-control" id="steelCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Glass</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="glass" name="glass" value="{{$matts->glass}}" onchange="multiply(this.value,{!! config('mechanic.glass.buy') !!},'glassCost')"/>
                                        <input type="hidden" class="form-control" id="glassCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label for="inputConfirmPassword" class="form-label">Rubber</label>
                                    <div class="input-group">
                                        <input type="number" min="0" class="form-control" id="rubber" name="rubber" value="{{$matts->rubber}}" onchange="multiply(this.value,{!! config('mechanic.rubber.buy') !!},'rubberCost')"/>
                                        <input type="hidden" class="form-control" id="rubberCost" value="0" onchange="finalValue()" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <label for="inputAddress3" class="form-label">Total to pay</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i class='bx bx-dollar'></i></span>
                                        <input  type="currency" class="form-control" id="fullCost" name="FinalCost" value="0" readonly/>
                                    </div>
                                </div>
                            <div class="col-9"></div>
                                    <div class="col-md-6">
                                        <button type="submit" id="submit" class="btn btn-outline-success px-5"><i class="bx bx-save"></i> @lang('app.saveValues')</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a id="reset" class="btn btn-outline-danger px-5">@lang('app.clearPurchase')</a>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
		@endsection

        @section('script')
            <script type="text/javascript">

                $("#reset").click(function(e){

                    e.preventDefault();

                    var scrap = 0;
                    var alum = 0;
                    var steel = 0;
                    var glass = 0;
                    var rubber = 0;
                    $("input[name=scrap]").val(scrap);
                    $("input[name=aluminium]").val(alum);
                    $("input[name=steel]").val(steel);
                    $("input[name=glass]").val(glass);
                    $("input[name=rubber]").val(rubber);
                    document.getElementById("submit").click();
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


                }
            </script>

            <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
            <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $(document).ready(function() {
                    multiply(document.getElementById('scrap').value,{!! config('mechanic.scrap.buy') !!},'scrapCost');
                    multiply(document.getElementById('alum').value,{!! config('mechanic.aluminium.buy') !!},'alumCost');
                    multiply(document.getElementById('steel').value,{!! config('mechanic.steel.buy') !!},'steelCost');
                    multiply(document.getElementById('glass').value,{!! config('mechanic.glass.buy') !!},'glassCost');
                    multiply(document.getElementById('rubber').value,{!! config('mechanic.rubber.buy') !!},'rubberCost');
                    finalValue();
                } );
            </script>



        @endsection

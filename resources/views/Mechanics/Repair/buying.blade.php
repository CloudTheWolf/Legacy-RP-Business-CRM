@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Purchase Calculator';
    $description= 'Calculate Material Values';
    $breadcrumbs = ["/"=>"Home","#"=>"Mechanic", "mechanic/purchase" => "Purchase Calculator"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
    <link rel="stylesheet" href="/css/vendor/select2.min.css"/>
    <link rel="stylesheet" href="/css/vendor/select2-bootstrap4.min.css"/>
@endsection

@section('js_vendor')
    <script src="/js/cs/scrollspy.js"></script>
    <script src="/js/vendor/select2.full.min.js"></script>
@endsection

@section('js_page')
    <script src="/js/forms/controls.select2.js"></script>

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


    <script>
        $(document).ready(function() {
            multiply(document.getElementById('scrap').value,{!! config('app.scrap-buy') !!},'scrapCost');
            multiply(document.getElementById('alum').value,{!! config('app.aluminium-buy') !!},'alumCost');
            multiply(document.getElementById('steel').value,{!! config('app.steel-buy') !!},'steelCost');
            multiply(document.getElementById('glass').value,{!! config('app.glass-buy') !!},'glassCost');
            multiply(document.getElementById('rubber').value,{!! config('app.rubber-buy') !!},'rubberCost');
            finalValue();
        } );
    </script>

    <script>
        function resize() {
            if($(window).width() > 800) {
                changeClasses('#scrapDiv',"2")
                changeClasses('#alumDiv',"2")
                changeClasses('#steelDiv',"2")
                changeClasses('#glassDiv',"2")
                changeClasses('#rubberDiv',"2")
                changeClasses('#totalDiv',"3")
                changeClasses('#saveDiv',"9")
            }else{
                changeClasses('#scrapDiv',"2",true)
                changeClasses('#alumDiv',"2",true)
                changeClasses('#steelDiv',"2",true)
                changeClasses('#glassDiv',"2",true)
                changeClasses('#rubberDiv',"2",true)
                changeClasses('#totalDiv',"3",true)
                changeClasses('#saveDiv',"9",true)
            }
        }

        function changeClasses($object,$mainSize,$small = false)
        {
            if($small)
            {
                $($object).addClass('col-12');
                $($object).removeClass('col-'+$mainSize);
                return;
            }
            $($object).addClass('col-'+$mainSize);
            $($object).removeClass('col-12');

        }


        $(window).on('resize', function(){
            resize();
        });


        $(function() {
            resize();
        })

    </script>
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
            <div class="col-3 col-sm-3 col-lg-3"></div>
            <div class="col-6 col-sm-6 col-lg-6">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Purchase Calculator</h4>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('class' => 'row g-3', 'name'=>'buy')) }}
                        <div id="scrapDiv" class="col-2">
                            <label for="inputEmailAddress" class="form-label">Scrap</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="scrap" name="scrap" onchange="multiply(this.value,{!! config('app.scrap-buy') !!},'scrapCost')" value="{{$matts->scrap}}" />
                                <input type="hidden" class="form-control" id="scrapCost" value="0" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="alumDiv" class="col-2">
                            <label for="inputChoosePassword" class="form-label">Aluminium</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="alum" name="aluminium" value="{{$matts->alum}}" onchange="multiply(this.value,{!! config('app.aluminium-buy') !!},'alumCost')"/>
                                <input type="hidden" class="form-control" id="alumCost" value="0" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="steelDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Steel</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="steel" name="steel" value="{{$matts->steel}}" onchange="multiply(this.value,{!! config('app.steel-buy') !!},'steelCost')"/>
                                <input type="hidden" class="form-control" id="steelCost" value="0" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="glassDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Glass</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="glass" name="glass" value="{{$matts->glass}}" onchange="multiply(this.value,{!! config('app.glass-buy') !!},'glassCost')"/>
                                <input type="hidden" class="form-control" id="glassCost" value="0" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="rubberDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Rubber</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="rubber" name="rubber" value="{{$matts->rubber}}" onchange="multiply(this.value,{!! config('app.rubber-buy') !!},'rubberCost')"/>
                                <input type="hidden" class="form-control" id="rubberCost" value="0" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="totalDiv" class="col-3">
                            <label for="inputAddress3" class="form-label">Total to pay</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><span class="material-symbols-outlined">payments</span></span>
                                <input  type="currency" class="form-control" id="fullCost" name="FinalCost" value="0" readonly/>
                            </div>
                        </div>
                        <div class="col-9"></div>
                        <div id="saveDiv" class="col-md-6">
                            <button type="submit" id="submit" class="btn btn-outline-success px-5" style="width: 100%"><span class="material-symbols-outlined">save</span> @lang('app.saveValues')</button>
                        </div>
                        <div class="col-md-6">
                            <a id="reset" class="btn btn-outline-danger px-5" style="width: 100%"> <span class="material-symbols-outlined">delete_sweep</span>@lang('app.clearPurchase')</a>
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

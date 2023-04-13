@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Repair Logger';
    $description= 'Log a Repair';
    $breadcrumbs = ["/"=>"Home","#"=>"Mechanic", "mechanic/repair-logger" => "Repair Logger"]
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

    <script>
        function multiply(value,multiplier,element) {
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

        $(".vehicle").on('select2:select', function () {
            checkKit($(this).find('option:selected').val());
        });

        function checkKit(type)
        {
            if(type == 'Advanced Repair Kit') {
                document.getElementById('scrap').value = 3;
                document.getElementById('aluminium').value = 2;
                document.getElementById('steel').value = 0;
                document.getElementById('glass').value = 2;
                document.getElementById('rubber').value= 4;
                multiply(3,{!! Config('app.scrap-sell')!!},'scrapCost')
                multiply(2,{!! Config('app.aluminium-sell') !!},'alumCost')
                multiply(0,{!! Config('app.steel-sell') !!},'steelCost')
                multiply(2,{!! Config('app.glass-sell') !!},'glassCost')
                multiply(4,{!! Config('app.rubber-sell') !!},'rubberCost')

                document.getElementById('fullCost').value = {!! Config('app.adv-repair-kit-sell') !!};
                document.getElementById('10Cost').value = {!! Config('app.adv-repair-kit-sell') !!};
                document.getElementById('15Cost').value = {!! Config('app.adv-repair-kit-sell') !!};
                document.getElementById('20Cost').value = {!! Config('app.adv-repair-kit-sell') !!};
                document.getElementById('25Cost').value = {!! Config('app.adv-repair-kit-sell') !!};

            }
        }
    </script>

    <script>
        function resize() {
            if($(window).width() > 800) {
                $('td:nth-child(2),th:nth-child(2)').show();
                $('td:nth-child(3),th:nth-child(3)').show();
                $('td:nth-child(4),th:nth-child(4)').show();
                $('td:nth-child(6),th:nth-child(6)').show();
                changeClasses('#scrapDiv',"2")
                changeClasses('#alumDiv',"2")
                changeClasses('#steelDiv',"2")
                changeClasses('#glassDiv',"2")
                changeClasses('#rubberDiv',"2")
                changeClasses('#totalDiv',"3")
                changeClasses('#10Div',"2",false,6)
                changeClasses('#15Div',"2",false,6)
                changeClasses('#20Div',"2",false,6)
                changeClasses('#25Div',"2",false,6)

            }else{
                $('td:nth-child(2),th:nth-child(2)').hide();
                $('td:nth-child(3),th:nth-child(3)').hide();
                $('td:nth-child(4),th:nth-child(4)').hide();
                $('td:nth-child(6),th:nth-child(6)').hide();
                changeClasses('#scrapDiv',"2",true)
                changeClasses('#alumDiv',"2",true)
                changeClasses('#steelDiv',"2",true)
                changeClasses('#glassDiv',"2",true)
                changeClasses('#rubberDiv',"2",true)
                changeClasses('#totalDiv',"3",true)
                changeClasses('#10Div',"2",true,6)
                changeClasses('#15Div',"2",true,6)
                changeClasses('#20Div',"2",true,6)
                changeClasses('#25Div',"2",true,6)
            }
        }

        function changeClasses($object,$mainSize,$small = false,$largeSize = 12)
        {
            if($small)
            {
                $($object).addClass('col-'+$largeSize);
                $($object).removeClass('col-'+$mainSize);
                return;
            }
            $($object).addClass('col-'+$mainSize);
            $($object).removeClass('col-'+$largeSize);

        }


        $(window).on('resize', function(){
            resize();
        });


        $(function() {
            resize();
            @if($repair->vehicle != null)
            $('#select2Basic').val('{{$repair->vehicle}}');
            $('#select2Basic').trigger('change');
            @endif
            multiply(document.getElementById('scrap').value,{!! config('app.scrap-sell') !!},'scrapCost');
            multiply(document.getElementById('aluminium').value,{!! config('app.aluminium-sell') !!},'alumCost');
            multiply(document.getElementById('steel').value,{!! config('app.steel-sell') !!},'steelCost');
            multiply(document.getElementById('glass').value,{!! config('app.glass-sell') !!},'glassCost');
            multiply(document.getElementById('rubber').value,{!! config('app.rubber-sell') !!},'rubberCost');
            finalValue();
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
            <div class="col-2 col-sm-2 col-lg-2"></div>
            <div class="col-7 col-sm-7 col-lg-7">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Repair Calculator</h4>
                    </div>
                    <div class="card-body">
                        {{ Form::open(array('class' => 'row g-3',"autocomplete"=>"off")) }}
                        <input autocomplete="false" name="hidden" type="text" style="display:none;">

                        <div class="col-md-6">
                                <label for="inputLastName1" class="form-label">Logged By</label>
                                <div class="input-group">
                                    <select name="mechanic" id="searchHidden" class="form-control" required>
                                        <option disabled>-- Please Select  --</option>
                                        @foreach($mechanics as $mechanic)
                                            <option value="{{$mechanic->id}}" {{$repair->mechanic == $mechanic->id ? 'selected' : ''}}>{{$mechanic->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputLastName2" class="form-label">Customer Name</label>
                                <div class="input">
                                    <input type="text" class="form-control" id="inputLastName1" placeholder="John Doe" value="{{$repair->customer_name}}" name="customer" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="inputPhoneNo" class="form-label">Vehicle</label>
                                <div class="input">
                                    <select name="vehicle" id="select2Basic" class="vehicle" style="width: 100% !important;" required>
                                        <option disabled selected value="null">--- Please Select ---</option>
                                        <optgroup label="Items">
                                            <option value="Advanced Repair Kit">Advanced Repair Kit</option>
                                        </optgroup>
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
                            <div id="scrapDiv" class="col-2">
                                <label for="inputEmailAddress" class="form-label">Scrap</label>
                                <div class="input">
                                    <input type="number" min="0" class="form-control" id="scrap" name="scrap" onchange="multiply(this.value,{!! Config('app.scrap-sell') !!},'scrapCost')" value="{{$repair->scrap_used}}" />
                                    <input type="hidden" class="form-control" id="scrapCost" value="0" required="required" onchange="finalValue()" onClick="this.setSelectionRange(0, this.value.length)" />
                                </div>
                            </div>
                            <div id="alumDiv" class="col-2">
                                <label for="inputChoosePassword" class="form-label">Alum</label>
                                <div class="input">
                                    <input type="number" min="0" class="form-control" id="aluminium" name="aluminium" value="{{$repair->alum_used}}" onchange="multiply(this.value,{!! Config('app.aluminium-sell') !!},'alumCost')"/>
                                    <input type="hidden" class="form-control" id="alumCost" value="0" required="required" onchange="finalValue()" />
                                </div>
                            </div>
                            <div id="steelDiv" class="col-2">
                                <label for="inputConfirmPassword" class="form-label">Steel</label>
                                <div class="input">
                                    <input type="number" min="0" class="form-control" id="steel" name="steel" value="{{$repair->steel_used}}" onchange="multiply(this.value,{!! Config('app.steel-sell') !!},'steelCost')"/>
                                    <input type="hidden" class="form-control" id="steelCost" value="0" required="required" onchange="finalValue()" />
                                </div>
                            </div>
                            <div id="glassDiv" class="col-2">
                                <label for="inputConfirmPassword" class="form-label">Glass</label>
                                <div class="input">
                                    <input type="number" min="0" class="form-control" id="glass" name="glass" value="{{$repair->glass_used}}" onchange="multiply(this.value,{!! Config('app.glass-sell') !!},'glassCost')"/>
                                    <input type="hidden" class="form-control" id="glassCost" value="0" required="required" onchange="finalValue()" />
                                </div>
                            </div>
                            <div id="rubberDiv" class="col-2">
                                <label for="inputConfirmPassword" class="form-label">Rubber</label>
                                <div class="input">
                                    <input type="number" min="0" class="form-control" id="rubber" name="rubber" value="{{$repair->rubber_used}}" onchange="multiply(this.value,{!! Config('app.rubber-sell') !!},'rubberCost')"/>
                                    <input type="hidden" class="form-control" id="rubberCost" value="0" required="required" onchange="finalValue()" />
                                </div>
                            </div>
                            <div class="col-2">

                            </div>
                            <div id="totalDiv" class="col-3">
                                <label for="inputAddress3" class="form-label">Total ($)</label>
                                <div class="input-group">
                                    <input  type="currency" class="form-control" id="fullCost" name="FinalCost" value="{{$repair->cost}}" readonly/>
                                </div>
                            </div>
                            <div id="10Div" class="col-2">
                                <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">10% Off</span></label>
                                <div class="input-group">
                                    <input  type="currency" class="form-control" id="10Cost" name="10Cost" value="0" readonly/>
                                </div>
                            </div>
                            <div id="15Div" class="col-2">
                                <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">15% Off</span></label>
                                <div class="input-group">
                                    <input  type="currency" class="form-control" id="15Cost" name="15Cost" value="0" readonly/>
                                </div>
                            </div>
                            <div id="20Div" class="col-2">
                                <label for="inputAddress3" class="form-label"><span class="badge rounded-pill bg-gradient-ibiza">20% Off</span></label>
                                <div class="input-group">
                                    <input  type="currency" class="form-control" id="20Cost" name="20Cost" value="0" readonly/>
                                </div>
                            </div>
                            <div id="25Div" class="col-2">
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
                            <div class="col-12">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-success px-5">Update Repair</button>
                                </div>
                                <hr>
                                <div class="col-md-4">
                                    <a href="{{url('mechanic/repairs')}}/{{$repair->id}}/delete" class="btn btn-outline-danger px-5">Delete Repair</a>
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

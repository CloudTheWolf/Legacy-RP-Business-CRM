@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'Sales Logger';
    $description= 'Log a Sale';
    $breadcrumbs = ["/"=>"Home","#"=>"Bar", "bar/repair-logger" => "Sales Logger"]
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
            const coke = document.getElementById('cokeCost').value;
            const smore = document.getElementById('smoreCost').value;

            @foreach($specials as $special)
const sp_{{$special->id}} = document.getElementById('sp_{{$special->id}}Cost').value;
            @endforeach

            const fullCost = parseInt(beer)+parseInt(cider)+parseInt(tequila)+parseInt(wine)+parseInt(vodka)+parseInt(absinthe)+parseInt(whiskey)+parseInt(rum)+parseInt(coke)+parseInt(smore)@foreach($specials as $special)+parseInt(sp_{{$special->id}})@endforeach;
            document.getElementById('fullCost').value = fullCost;
            /*
            document.getElementById('10Cost').value = Math.floor(90/100*parseInt(fullCost));
            document.getElementById('15Cost').value = Math.floor(85/100*parseInt(fullCost));
            document.getElementById('20Cost').value = Math.floor(80/100*parseInt(fullCost));
            document.getElementById('25Cost').value = Math.floor(75/100*parseInt(fullCost));
            */
        }
    </script>

    <script>
        function resize() {
            if($(window).width() > 852) {
                $('td:nth-child(2),th:nth-child(2)').show();
                $('td:nth-child(3),th:nth-child(3)').show();
                $('td:nth-child(4),th:nth-child(4)').show();
                $('td:nth-child(6),th:nth-child(6)').show();
                changeClasses('#beerDiv',"2")
                changeClasses('#ciderDiv',"2")
                changeClasses('#tequilaDiv',"2")
                changeClasses('#wineDiv',"2")
                changeClasses('#vodkaDiv',"2")
                changeClasses('#absintheDiv',"2")
                changeClasses('#whiskeyDiv',"2")
                changeClasses('#rumDiv',"2")
                changeClasses('#cokeDiv',"2")
                changeClasses('#smoreDiv',"2")

                @foreach($specials as $special)
changeClasses('#sp_{{$special->id}}Div',"6",false)
                @endforeach


            }else{
                $('td:nth-child(2),th:nth-child(2)').hide();
                $('td:nth-child(3),th:nth-child(3)').hide();
                $('td:nth-child(4),th:nth-child(4)').hide();
                $('td:nth-child(6),th:nth-child(6)').hide();
                changeClasses('#beerDiv',"2",true)
                changeClasses('#ciderDiv',"2",true)
                changeClasses('#tequilaDiv',"2",true)
                changeClasses('#wineDiv',"2",true)
                changeClasses('#vodkaDiv',"2",true)
                changeClasses('#absintheDiv',"2",true)
                changeClasses('#whiskeyDiv',"2",true)
                changeClasses('#rumDiv',"2",true)
                changeClasses('#cokeDiv',"2",true)
                changeClasses('#smoreDiv',"2",true)

                @foreach($specials as $special)
                changeClasses('#sp_{{$special->id}}Div',"6",true)
                @endforeach
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
                        <h4>Sales Calculator</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" class="row g-3" autocomplete="off">
                            @csrf
                        <input autocomplete="false" name="hidden" type="text" style="display:none;">

                        <div class="col-md-6">
                                <label for="inputLastName1" class="form-label">Sale By</label>
                                <div class="input-group">
                                    <select name="staff" id="searchHidden" class="form-control" required>
                                        <option disabled>-- Please Select  --</option>
                                        @foreach($staff as $user)
                                            <option value="{{$user->id}}" {{Auth::id() == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <h5>Menu</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">

                            </div>
                        <div id="beerDiv" class="col-2">
                            <label for="inputEmailAddress" class="form-label">Beer</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="beer" name="beer" onchange="multiply(this.value,{!! Config('app.beer-sell') !!},'beerCost')" value="0" />
                                <input type="hidden" class="form-control" id="beerCost" value="0" required="required" onchange="finalValue()" onClick="this.setSelectionRange(0, this.value.length)" />
                            </div>
                        </div>
                        <div id="ciderDiv" class="col-2">
                            <label for="inputChoosePassword" class="form-label">Cider</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="cider" name="cider" value="0" onchange="multiply(this.value,{!! Config('app.cider-sell') !!},'ciderCost')"/>
                                <input type="hidden" class="form-control" id="ciderCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="tequilaDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Tequila</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="tequila" name="tequila" value="0" onchange="multiply(this.value,{!! Config('app.tequila-sell') !!},'tequilaCost')"/>
                                <input type="hidden" class="form-control" id="tequilaCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="wineDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Wine</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="wine" name="wine" value="0" onchange="multiply(this.value,{!! Config('app.wine-sell') !!},'wineCost')"/>
                                <input type="hidden" class="form-control" id="wineCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="vodkaDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Vodka</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="vodka" name="vodka" value="0" onchange="multiply(this.value,{!! Config('app.vodka-sell') !!},'vodkaCost')"/>
                                <input type="hidden" class="form-control" id="vodkaCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="absintheDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Absinthe</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="absinthe" name="absinthe" value="0" onchange="multiply(this.value,{!! Config('app.absinthe-sell') !!},'absintheCost')"/>
                                <input type="hidden" class="form-control" id="absintheCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="whiskeyDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Whiskey</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="whiskey" name="whiskey" value="0" onchange="multiply(this.value,{!! Config('app.whiskey-sell') !!},'whiskeyCost')"/>
                                <input type="hidden" class="form-control" id="whiskeyCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="rumDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Rum</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="rum" name="rum" value="0" onchange="multiply(this.value,{!! Config('app.rum-sell') !!},'rumCost')"/>
                                <input type="hidden" class="form-control" id="rumCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="cokeDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Coke</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="coke" name="coke" value="0" onchange="multiply(this.value,{!! Config('app.coke-sell') !!},'cokeCost')"/>
                                <input type="hidden" class="form-control" id="cokeCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        <div id="smoreDiv" class="col-2">
                            <label for="inputConfirmPassword" class="form-label">Smore</label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="smore" name="smore" value="0" onchange="multiply(this.value,{!! Config('app.smore-sell') !!},'smoreCost')"/>
                                <input type="hidden" class="form-control" id="smoreCost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                            <hr>
                        <div class="col-md-12">
                            <h6>Specials</h6>
                        </div>
                        @foreach($specials as $special)
                        <div id="sp_{{$special->id}}Div" class="col-3">
                            <label for="inputConfirmPassword" class="form-label">{{$special->name}} </label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" id="sp_{{$special->id}}" name="sp_{{$special->id}}" value="0" onchange="multiply(this.value,{{$special->price}},'sp_{{$special->id}}Cost')"/>
                                <input type="hidden" class="form-control" id="sp_{{$special->id}}Cost" value="0" required="required" onchange="finalValue()" />
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        <div class="col-md-6">
                            <h5>Total Sale</h5>
                            <hr>
                        </div>
                        <div class="col-md-6">

                        </div>

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
                                <button type="submit" class="btn btn-success px-5 col-md-12">Log Sale</button>
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

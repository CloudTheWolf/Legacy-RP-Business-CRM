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
        function initializeSelect2() {
                $('#select_mechanic').select2({placeholder: ''});
                $('#select_mechanic').on('change', function() {
                    let selectedValue = $(this).val();
                    $('#input_mechanic').val(selectedValue);

                    // Dispatch the input event so that Livewire recognizes the change
                    document.querySelector('#input_mechanic').dispatchEvent(new Event('input', { bubbles: true }));
                });

                $('#select_vehicle').select2({placeholder: ''});
                $('#select_vehicle').on('change', function () {
                    let selectedValue = $(this).val();
                    $('#input_vehicle').val(selectedValue);
                    console.log(selectedValue);
                    // Dispatch the input event so that Livewire recognizes the change
                    document.querySelector('#input_vehicle').dispatchEvent(new Event('input', {bubbles: true}));
                });

                setInterval(reviveSelect2,2000)
        }

        function reviveSelect2()
        {
            if((!($('#select_mechanic').data('select2'))))
            {
                console.log('revive')
                initializeSelect2();
            }

            if((!($('#select_vehicle').data('select2'))))
            {
                console.log('revive')
                initializeSelect2();
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            initializeSelect2();
            $('#select_mechanic').trigger('change');
            $('#select_vehicle').trigger('change');
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('resetSelect2', (event) => {
                $('#select_vehicle').select2("destroy");
                $('#select_mechanic').select2("destroy");
                $('#select_mechanic').val({{ Auth::id() }}).trigger('change');
                $('#select_vehicle').val(null).trigger('change');
            });
        });



    </script>

    @stack('scripts')
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
            const advKit = document.getElementById('advKitCost').value;
            const oil = document.getElementById('oilCost').value;
            const fullCost = parseInt(scrap)+parseInt(alum)+parseInt(steel)+parseInt(glass)+parseInt(rubber)+parseInt(advKit)+parseInt(oil);
            document.getElementById('fullCost').value = fullCost;
            document.getElementById('10Cost').value = Math.floor(90/100*parseInt(fullCost));
            document.getElementById('15Cost').value = Math.floor(85/100*parseInt(fullCost));
            document.getElementById('20Cost').value = Math.floor(80/100*parseInt(fullCost));
            document.getElementById('25Cost').value = Math.floor(75/100*parseInt(fullCost));
            document.getElementById('fullCost').dispatchEvent(new Event('input', { bubbles: true }))
            setInterval(finalValue, 2000);
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
                changeClasses('#repairKitDiv',"2")
                changeClasses('#oilDiv',"2")
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
                changeClasses('#repairKitDiv',"2",true)
                changeClasses('#oilDiv',"2",true)
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
                        @if(Session::get('LiveMode') != null && Session::get('LiveMode') == "True")
                            <!-- Live Mode -->
                            <livewire:forms.mechanic.add-repair />
                        @else
                            @include('Mechanics/Repair/staticwire/add-repair')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <hr>
        <!-- Table Row -->
        <div class="row g-4">
            <div class="col-1 col-sm-1 col-lg-1"></div>
            <div class="col-10 col-sm-10 col-lg-10">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>My Recent Repairs</h4>
                    </div>
                    <div class="card-body">
                        @if(Session::get('LiveMode') != null && Session::get('LiveMode') == "True")
                            <livewire:tables.mechanic.recent-repairs lazy/>
                        @else
                            @include('Mechanics/Repair/staticwire/recent-repairs')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <!-- Content End -->
    </div>
@endsection

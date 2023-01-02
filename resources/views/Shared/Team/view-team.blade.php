@php
    //$html_tag_data = ["override"=>'{ "attributes" : { "placement" : "horizontal", "layout":"boxed"  }, "color": "dark-green" "storagePrefix" : "legacy-rp-", "showSettings" : true }'];
    $html_tag_data = [];
    $title = 'View Team';
    $description= 'View Team';
    $breadcrumbs = ["/"=>"Home","team"=>"View Team"]
@endphp
@extends('layout',['html_tag_data'=>$html_tag_data, 'title'=>$title, 'description'=>$description])

@section('css')
@endsection

@section('js_vendor')

@endsection

@section('js_page')
<script>
    function resize() {
        if($(window).width() > 800) {
            $('td:nth-child(5),th:nth-child(5)').show();
            $('td:nth-child(6),th:nth-child(6)').show();
        }else{
            $('td:nth-child(5),th:nth-child(5)').hide();
            $('td:nth-child(6),th:nth-child(6)').hide();
        }
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
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card radius-10">
                    <div class="card-header">
                        <h4>Team</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" style="width: 90%; margin-left: 5%">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Job Title</th>
                                <th>CID</th>
                                <th>Cell Phone</th>
                                @if(config('app.siteMode') == "Mechanic")
                                <th>Tow Plate(s)</th>
                                @endif
                                @if(Auth::user()->IsAdmin == 1)
                                <th>In City</th>
                                @endif
                                <th>On Duty</th>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->cid}}</td>
                                    <td>{{$user->cell}}</td>
                                    <td>{{$user->towID}}</td>
                                    @if(Auth::user()->IsAdmin == 1)
                                        <td>
                                            @php
                                                if($user->cid != '')
                                                {
                                                    $found = false;
                                                    $cid = $user->cid;
                                                    foreach($onlineUsers['data'] as $ou)
                                                        {
                                                            $c = $ou['character'];
                                                            $oCid = $c["id"] ??= 0;
                                                            $match = $cid == $oCid;
                                                            if($match)
                                                                {
                                                                   $found = true;
                                                                   break;
                                                                }
                                                        }
                                                }
                                                if($found) {
                                                        echo("<span style=\"color: greenyellow\">In <i class=\"bx bx-check\"></i></span>");
                                                     }
                                                else{
                                                         echo("<span style=\"color: orangered\">Out <i class=\"bx bx-x\"></i></span>");
                                                     }
                                            @endphp</td>
                                    @endif
                                    <td style="color: {{$user->onDuty == 1 ? "greenyellow" :  "orangered"}}">{{$user->onDuty == 1 ? $user->workingAs : "Off Duty"}}<i class="bx bx-{{$user->onDuty == 1 ? "check" : "x"}}"></i></td>
                                </tr>
                                @php ++$i; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <!-- Content End -->
    </div>
@endsection

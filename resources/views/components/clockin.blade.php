<div class="row row-cols-2 g-2 p-2">
    @if(config('app.siteMode') == "Mechanic")
        @if(Auth::user()->onDuty == 0)
            <div class="col text-center">
                <a href="{{url('clock-on/Tow')}}">
                    <div class="app-box mx-auto btn btn-warning text-white" style="width: 125px">
                        <span class="material-symbols-outlined">rv_hookup</span>
                        <div class="app-title">Tow</div>
                    </div></a>
            </div>
            @if(Auth::user()->role != "Tow Driver")
                <div class="col text-center">
                    <a href="{{url('clock-on/Mechanic')}}" >
                        <div class="app-box mx-auto btn btn-tertiary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">home_repair_service</span>
                            <div class="app-title">Mechanic</div>
                        </div></a>
                </div>
            @endif
            <div class="col text-center">
                <a href="{{url('clock-on/Scuba')}}">
                    <div class="app-box mx-auto btn btn-info text-white" style="width: 125px">
                        <span class="material-symbols-outlined">scuba_diving</span>
                        <div class="app-title">Scuba</div>
                    </div></a>
            </div>
            @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager" || Auth::user()->role == "Trainer")
                <div class="col text-center">
                    <a href="{{url('clock-on/Training')}}" >
                        <div class="app-box mx-auto btn btn-gradient-secondary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">school</span>
                            <div class="app-title">Trainer</div>
                        </div></a>
                </div>
            @endif
            @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")
                <div class="col text-center">
                    <a href="{{url('clock-on/Management')}}" >
                        <div class="app-box mx-auto btn btn-gradient-primary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Management</div>
                        </div></a>
                </div>
            @endif
        @else
            @if(Auth::user()->workingAs != __('app.mechanic') && Auth::user()->role != "Tow Driver")
                <div class="col text-center">
                    <a href="{{url('clock-on/Mechanic')}}" >
                        <div class="app-box mx-auto btn btn-tertiary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">home_repair_service</span>
                            <div class="app-title">Mechanic</div>
                        </div></a>
                </div>
            @endif
            @if(Auth::user()->workingAs != __('app.tow'))
                <div class="col text-center">
                    <a href="{{url('clock-on/Tow')}}">
                        <div class="app-box mx-auto btn btn-warning text-white" style="width: 125px">
                            <span class="material-symbols-outlined">rv_hookup</span>
                            <div class="app-title">Tow</div>
                        </div></a>
                </div>
            @endif
            @if(Auth::user()->workingAs != __('app.scuba'))
                <div class="col text-center">
                    <a href="{{url('clock-on/Scuba')}}">
                        <div class="app-box mx-auto btn btn-info text-white" style="width: 125px">
                            <span class="material-symbols-outlined">scuba_diving</span>
                            <div class="app-title">Scuba</div>
                        </div></a>
                </div>
            @endif
            @if((Auth::user()->workingAs != 'Trainer' && Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager" || Auth::user()->role == "Trainer"))
                <div class="col text-center">
                    <a href="{{url('clock-on/Training')}}" >
                        <div class="app-box mx-auto btn btn-gradient-secondary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">school</span>
                            <div class="app-title">Trainer</div>
                        </div></a>
                </div>
            @endif
            @if(Auth::user()->workingAs != __('app.mgmt') && Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")
                <div class="col text-center">
                    <a href="{{url('clock-on/Management')}}" >
                        <div class="app-box mx-auto btn btn-gradient-primary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Management</div>
                        </div></a>
                </div>
            @endif
        @endif
    @endif
    @if(config('app.siteMode') == "Arcade" || config('app.siteMode') == "Bar")
        @if(Auth::user()->onDuty == 0)
            <div class="col text-center">
                <a href="{{url('clock-on/Bar')}}" >
                    <div class="app-box mx-auto btn btn-gradient-primary text-white" style="width: 125px">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        <div class="app-title">Bar</div>
                    </div></a>
            </div>
            @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")

                <div class="col text-center">
                    <a href="{{url('clock-on/Management')}}" >
                        <div class="app-box mx-auto btn btn-gradient-secondary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Management</div>
                        </div></a>
                </div>


            @endif
        @else
            @if(Auth::user()->workingAs != 'Bar')
                <div class="col text-center">
                    <a href="{{url('clock-on/Bar')}}" >
                        <div class="app-box mx-auto btn btn-gradient-primary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Bar</div>
                        </div></a>
                </div>
            @endif
            @if(Auth::user()->workingAs != __('app.mgmt') && (Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager"))
                <div class="col text-center">
                    <a href="{{url('clock-on/Management')}}" >
                        <div class="app-box mx-auto btn btn-gradient-secondary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Management</div>
                        </div></a>
                </div>
            @endif
        @endif
    @endif
    @if(config('app.siteMode') == "Dealership")
        @if(Auth::user()->workingAs != 'On-Duty')
            <div class="col col-md-12 text-center">
                <a href="{{url('clock-on/On-Duty')}}" >
                    <div class="app-box mx-auto btn btn-danger text-white" style="width: 100%">
                        <span class="material-symbols-outlined">alarm_oon</span>
                        <div class="app-title">Clock On</div>
                    </div></a>
            </div>
        @endif
   @endif
    @if(Auth::user()->onDuty == 1)
        <div class="col col-md-12 text-center">
            <a href="{{url('clock-on/Off-Duty')}}" >
                <div class="app-box mx-auto btn btn-danger text-white" style="width: 100%">
                    <span class="material-symbols-outlined">alarm_off</span>
                    <div class="app-title">Clock Off</div>
                </div></a>
        </div>
    @endif
</div>

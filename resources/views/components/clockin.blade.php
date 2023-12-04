<div class="grid md:grid-cols-2  sm:grid-cols-1">
    @if(config('app.siteMode') == "Mechanic")
        <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Tow" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Tow')}}" >
                <div class="no-underline bg-orange-400 text-white hover:bg-orange-500 border-orange-500 min-w-full {{Auth()->user()->workingAs == "Tow" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">rv_hookup</span>
                    <div class="app-title">Tow</div>
                </div></a>
        </div>
        <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Mechanic" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Mechanic')}}" >
                <div class="no-underline bg-indigo-400 text-white hover:bg-indigo-500 border-indigo-500 min-w-full {{Auth()->user()->workingAs == "Mechanic" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">home_repair_service</span>
                    <div class="app-title">Mechanic</div>
                </div></a>
        </div>
        <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Scuba" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Scuba')}}" >
                <div class="no-underline bg-teal-400 text-white hover:bg-teal-500 border-teal-500 min-w-full {{Auth()->user()->workingAs == "Scuba" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">scuba_diving</span>
                    <div class="app-title">Scuba</div>
                </div></a>
        </div>
        @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager" || Auth::user()->role == "Trainer")
            <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Training" ? 'disable-link' : ''}}">
                <a href="{{url('clock-on/Training')}}" >
                    <div class="no-underline bg-lime-600 text-white hover:bg-lime-700 border-lime-700 min-w-full {{Auth()->user()->workingAs == "Training" ? 'disable-link' : ''}}">
                        <span class="material-symbols-outlined">school</span>
                        <div class="app-title">Trainer</div>
                    </div></a>
            </div>
        @endif
        @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")
            <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Management" ? 'disable-link' : ''}}">
                <a href="{{url('clock-on/Management')}}"  >
                    <div class="no-underline bg-fuchsia-600 text-white hover:bg-fuchsia-700 border-fuchsia-700 min-w-full {{Auth()->user()->workingAs == "Management" ? 'disable-link' : ''}}">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        <div class="app-title">Management</div>
                    </div></a>
            </div>
        @endif
   @endif

    @if(config('app.siteMode') == "Dealership" || config('app.siteMode') == "Shop")
        @if(Auth::user()->workingAs != 'On-Duty')
                <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs ==  "On-Duty" ? 'disable-link' : ''}}">
                <a href="{{url('clock-on/On-Duty')}}" >
                    <div class="no-underline bg-green-500 text-white hover:bg-green-600 border-green-600 min-w-full {{Auth()->user()->workingAs == "On-Duty" ? 'disable-link' : ''}}">
                        <span class="material-symbols-outlined">alarm_on</span>
                        <div class="app-title">Clock On</div>
                    </div></a>
            </div>
        @endif
    @endif

            <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs ==  "Off-Duty" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Off-Duty')}}" >
                <div class="no-underline bg-red-500 text-white hover:bg-red-600 border-red-600 min-w-full {{Auth()->user()->workingAs == "Off-Duty" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">alarm_off</span>
                    <div class="app-title">Clock Off</div>
                </div></a>
        </div>
</div>

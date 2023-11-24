<div class="grid md:grid-cols-2  sm:grid-cols-1">
    @if(config('app.siteMode') == "Mechanic")
        <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Tow" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Tow')}}" wire:navigate>
                <div class="no-underline bg-orange-400 text-white hover:bg-orange-500 border-orange-500 min-w-full {{Auth()->user()->workingAs == "Tow" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">rv_hookup</span>
                    <div class="app-title">Tow</div>
                </div></a>
        </div>
        <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Mechanic" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Mechanic')}}" wire:navigate>
                <div class="no-underline bg-indigo-400 text-white hover:bg-indigo-500 border-indigo-500 min-w-full {{Auth()->user()->workingAs == "Mechanic" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">home_repair_service</span>
                    <div class="app-title">Mechanic</div>
                </div></a>
        </div>
        <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Scuba" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Scuba')}}" wire:navigate>
                <div class="no-underline bg-teal-400 text-white hover:bg-teal-500 border-teal-500 min-w-full {{Auth()->user()->workingAs == "Scuba" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">scuba_diving</span>
                    <div class="app-title">Scuba</div>
                </div></a>
        </div>
        @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager" || Auth::user()->role == "Trainer")
            <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Training" ? 'disable-link' : ''}}">
                <a href="{{url('clock-on/Training')}}" wire:navigate>
                    <div class="no-underline bg-lime-600 text-white hover:bg-lime-700 border-lime-700 min-w-full {{Auth()->user()->workingAs == "Training" ? 'disable-link' : ''}}">
                        <span class="material-symbols-outlined">school</span>
                        <div class="app-title">Trainer</div>
                    </div></a>
            </div>
        @endif
        @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")
            <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs == "Management" ? 'disable-link' : ''}}">
                <a href="{{url('clock-on/Management')}}" wire:navigate >
                    <div class="no-underline bg-fuchsia-600 text-white hover:bg-fuchsia-700 border-fuchsia-700 min-w-full {{Auth()->user()->workingAs == "Management" ? 'disable-link' : ''}}">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        <div class="app-title">Management</div>
                    </div></a>
            </div>
        @endif
   @endif
    @if(config('app.siteMode') == "Arcade" || config('app.siteMode') == "Bar")
        @if(Auth::user()->onDuty == 0)
            <div class="relative flex-grow max-w-full flex-1 px-4 text-center">
                <a href="{{url('clock-on/Bar')}}" wire:navigate>
                    <div class="app-box mx-auto inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-gradient-primary text-white" style="width: 125px">
                        <span class="material-symbols-outlined">admin_panel_settings</span>
                        <div class="app-title">Bar</div>
                    </div></a>
            </div>
            @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")

                <div class="relative flex-grow max-w-full flex-1 px-4 text-center">
                    <a href="{{url('clock-on/Management')}}" wire:navigate>
                        <div class="app-box mx-auto inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-gradient-secondary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Management</div>
                        </div></a>
                </div>


            @endif
        @else
            @if(Auth::user()->workingAs != 'Bar')
                <div class="relative flex-grow max-w-full flex-1 px-4 text-center">
                    <a href="{{url('clock-on/Bar')}}" wire:navigate>
                        <div class="app-box mx-auto inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-gradient-primary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Bar</div>
                        </div></a>
                </div>
            @endif
            @if(Auth::user()->workingAs != __('app.mgmt') && (Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager"))
                <div class="relative flex-grow max-w-full flex-1 px-4 text-center">
                    <a href="{{url('clock-on/Management')}}" wire:navigate>
                        <div class="app-box mx-auto inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline btn-gradient-secondary text-white" style="width: 125px">
                            <span class="material-symbols-outlined">admin_panel_settings</span>
                            <div class="app-title">Management</div>
                        </div></a>
                </div>
            @endif
        @endif
    @endif
    @if(config('app.siteMode') == "Dealership")
        @if(Auth::user()->workingAs != 'On-Duty')
            <div class="relative flex-grow max-w-full flex-1 px-4 md:w-full pr-4 pl-4 text-center">
                <a href="{{url('clock-on/On-Duty')}}" wire:navigate>
                    <div class="app-box mx-auto inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-red-600 text-white hover:bg-red-700 text-white" style="width: 100%">
                        <span class="material-symbols-outlined">alarm_oon</span>
                        <div class="app-title">Clock On</div>
                    </div></a>
            </div>
        @endif
    @endif

            <div class="relative flex-grow min-w-full text-center {{Auth()->user()->workingAs ==  "Off-Duty" ? 'disable-link' : ''}}">
            <a href="{{url('clock-on/Off-Duty')}}" wire:navigate>
                <div class="no-underline bg-red-500 text-white hover:bg-red-600 border-red-600 min-w-full {{Auth()->user()->workingAs == "Off-Duty" ? 'disable-link' : ''}}">
                    <span class="material-symbols-outlined">alarm_off</span>
                    <div class="app-title">Clock Off</div>
                </div></a>
        </div>
</div>

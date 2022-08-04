<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ url('/') }}/assets/images/branding/{!! config('app.brandingPath') !!}/logo-icon2.png" class="logo-icon" style="filter: none !important;" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{config('app.companyName')}}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('index') }}" class="">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">@lang('pages.dashboard')</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-car"></i>
                </div>
                <div class="menu-title">@lang('pages.mechanicMenu')</div>
            </a>
            <ul>
                <li> <a href="{{ url('repairs') }}"><i class="bx bx-right-arrow-alt"></i>@lang('pages.repairLogger')</a>
                </li>
                <li> <a href="{{ url('repairsLog') }}"><i class="bx bx-right-arrow-alt"></i>@lang('pages.repairLog')</a>
                </li>
                <li> <a href="{{ url('buying') }}"><i class="bx bx-right-arrow-alt"></i>@lang('pages.purchaseCalc')</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bxs-truck'></i>
                </div>
                <div class="menu-title">@lang('pages.towMenu')</div>
            </a>
            <ul>
                <li> <a href="{{url('tow')}}"><i class="bx bx-right-arrow-alt"></i>@lang('pages.towTracker')</a>
                <li> <a href="{{url('tow-live')}}"><i class="bx bx-right-arrow-alt"></i>@lang('pages.liveImpoundTracker')</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bxs-group'></i>
                </div>
                <div class="menu-title">Team</div>
            </a>
            <ul>
                <li> <a href="{{url('team')}}"><i class="bx bx-right-arrow-alt"></i>Our Team</a>
                </li>
            </ul>
        </li>
        @if(Auth::user()->IsAdmin == 1)
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-book'></i>
                    </div>
                    <div class="menu-title">Admin</div>
                </a>
                <ul>
                    <li> <a href="{{url('/admin/applications')}}"><i class="bx bx-right-arrow-alt"></i>Applications</a></li>
                    <li> <a href="{{ url('admin/add-user') }}"><i class="bx bx-right-arrow-alt"></i>Add User</a></li>
                    <li> <a href="{{url('/admin/users/')}}"><i class="bx bx-right-arrow-alt"></i>Manage Users</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-server'></i>
                    </div>
                    <div class="menu-title">Warehouse</div>
                </a>
                <ul>
                    <li> <a href="{{ url('warehouse') }}"><i class="bx bx-right-arrow-alt"></i>Manage</a></li>
                </ul>
            </li>
        @endif
        <li>
            <a href="https://github.com/CloudTheWolf/HarmonyCRM/issues/new/choose" target="_blank" class="">
                <div class="parent-icon"><i class='bx bxl-github'></i>
                </div>
                <div class="menu-title">Bug Report</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->

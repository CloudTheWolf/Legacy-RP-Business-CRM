<div class="nav-content d-flex">
    <!-- Logo Start -->
    <div class="logo position-relative">
        <a href="/">
            <!-- Logo can be added directly -->
            <!--<img src="/img/logo/logo-white.svg" alt="logo" />-->
            <img src="/assets/images/branding/{!! config('app.brandingPath') !!}/logo-icon2.png" style="max-width: 100%; min-height: 20px !important;" alt="logo">

            <!-- Or added via css to provide different ones for different color themes -->
            <!--<div class="img"></div>-->
        </a>
    </div>
    <!-- Logo End -->

    <!-- User Menu Start -->
    <div class="user-container d-flex">
        <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="profile" alt="profile" src="https://eu.ui-avatars.com/api/?background=000&color=fff&name={{Auth::user()->name}}" />
            <div class="name">{{Auth::user()->name}}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-end user-menu wide">

            <div class="row mb-1 ms-0 me-0">
                <div class="col-12 p-1 mb-3 pt-3">
                    <div class="separator-light"></div>
                </div>
                <div class="col-6 pe-1 ps-1">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{url("/account/settings")}}">
                                <i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/logout')}}">
                                <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                                <span class="align-middle">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- User Menu End -->

    <!-- Icons Menu Start -->
    <ul class="list-unstyled list-inline text-center menu-icons">
        <li class="list-inline-item">
            <a href="#" id="pinButton" class="pin-button">
                <i data-acorn-icon="lock-on" class="unpin" data-acorn-size="18"></i>
                <i data-acorn-icon="lock-off" class="pin" data-acorn-size="18"></i>
            </a>
        </li>
        <li class="list-inline-item">
            <a href="#" id="colorButton">
                <i data-acorn-icon="light-on" class="light" data-acorn-size="18"></i>
                <i data-acorn-icon="light-off" class="dark" data-acorn-size="18"></i>
            </a>
        </li>
        @if(config('app.siteMode') == "Mechanic" || config('app.siteMode') == "Bar" || config('app.siteMode') == "Arcade")
        <li class="list-inline-item">
            <a href="#" data-bs-toggle="dropdown" data-bs-target="#notifications" aria-haspopup="true" aria-expanded="false" class="notification-button">
                <div class="position-relative d-inline-flex">
                    <i data-acorn-icon="clock" data-acorn-size="18"></i>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end " id="notifications">
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
        </li>
        @endif
    </ul>
    <!-- Icons Menu End -->

    <!-- Menu Start -->
    <div class="menu-container flex-grow-1">
        <ul id="menu" class="menu">
            <li>
                <a href="/dashboard">
                    <!--<i data-acorn-icon="dashboard" class="icon" data-acorn-size="18"></i>-->
                    <span class="icon material-symbols-outlined">home</span>
                    <span class="label">Dashboard</span>
                </a>
            </li>
            @if(Config("app.siteMode") == "Mechanic")
                <li>
                    <a href="#shop-mechanic" data-href="/Shop-Mechanic">
                        <span class="icon material-symbols-outlined">home_repair_service</span>
                        <span class="label">Mechanic Tools</span>
                    </a>
                    <ul id="shop-mechanic">
                        @if(Auth::user()->role != "Tow Driver")
                        <li>
                            <a href="/mechanic/repair-logger">
                                <span class="label">Repair Logger</span>
                            </a>
                        </li>
                        <li>
                            <a href="/mechanic/repairs">
                                <span class="label">All Repairs</span>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="/mechanic/purchase">
                                <span class="label">Purchase Calculator</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#tow" data-href="/Mechanic/Tow">
                        <span class="icon material-symbols-outlined">local_shipping</span>
                        <span class="label">Tow Tools</span>
                    </a>
                    <ul id="tow">
                        <li>
                            <a href="/tow/tracker">
                                <span class="label">Tow Tracker</span>
                            </a>
                        </li>
                        <li>
                            <a href="/tow/history">
                                <span class="label">Impound History</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Config("app.siteMode") == "Bar" || Config("app.siteMode") == "Arcade")
                <li>
                    <a href="#shop-bar" data-href="/Shop-Bar">
                        <span class="icon material-symbols-outlined">point_of_sale</span>
                        <span class="label">Sales</span>
                    </a>
                    <ul id="shop-bar">
                        <li>
                            <a href="/{{strtolower(Config("app.siteMode"))}}/sale-logger">
                                <span class="label">Sales Logger</span>
                            </a>
                        </li>
                        <!--TODO: Add All Sales Page? -->
                        <!--<li>
                            <a href="/{{strtolower(Config("app.siteMode"))}}/sales">
                                <span class="label">All Sales</span>
                            </a>
                        </li>-->
                    </ul>
                </li>
            @endif
            <li>
                <a href="/team" data-href="/Team">
                    <span class="icon material-symbols-outlined">diversity_1</span>
                    <span class="label">@if(config("app.siteMode") == "Motorcycle Club") Members @else Team @endif</span>
                </a>
            </li>
            @if(config("app.siteMode") == "Motorcycle Club" || config("app.siteMode") == "Mechanic")
                <li><a href="{{url("/storage")}}" data-href="/Storage">
                    <span class="icon material-symbols-outlined">warehouse</span>
                    <span class="label">Storage</span>
                </a></li>
            @endif
            @if(Auth::user()->IsAdmin == 1)
            <li>
                <a href="#admin" data-href="/Admin">
                    <i data-acorn-icon="settings-1" class="icon" data-acorn-size="18"></i>
                    <span class="label">Admin</span>
                </a>
                <ul id="admin">
                    @if(config('app.siteMode') == "Mechanic" || config('app.siteMode') == "Bar" || config('app.siteMode') == "Arcade")
                    <li>
                        <a href="/admin/applications">
                            <span class="label">Job Applications</span>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="/admin/add-user">
                            <span class="label">Add User</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/users">
                            <span class="label">Manage Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/settings">
                            <span class="label">Site Settings</span>
                        </a>
                    </li>
                    @if(Config("app.siteMode") == "Mechanic")
                    <li>
                        <a href="/admin/mechanic-settings">
                            <span class="label">Mechanic Settings</span>
                        </a>
                    </li>
                    @endif
                    @if(Config("app.siteMode") == "Bar")
                        <li>
                            <a href="/admin/bar-settings">
                                <span class="label">Bar Settings</span>
                            </a>
                        </li>
                    @endif
                    @if(Config("app.siteMode") == "Arcade")
                        <li>
                            <a href="/admin/arcade-settings">
                                <span class="label">Arcade Settings</span>
                            </a>
                        </li>
                    @endif
                    @if(Config("app.siteMode") == "Bar" || Config("app.siteMode") == "Arcade")
                        <li>
                            <a href="/admin/specials">
                                <span class="label">Manage Specials</span>
                            </a>
                        </li>
                    @endif
                </ul>

            </li>
            @endif
        </ul>
    </div>
    <!-- Menu End -->

    <!-- Mobile Buttons Start -->
    <div class="mobile-buttons-container">
        <!-- Scrollspy Mobile Button Start -->
        <a href="#" id="scrollSpyButton" class="spy-button" data-bs-toggle="dropdown">
            <i data-acorn-icon="menu-dropdown"></i>
        </a>
        <!-- Scrollspy Mobile Button End -->

        <!-- Scrollspy Mobile Dropdown Start -->
        <div class="dropdown-menu dropdown-menu-end" id="scrollSpyDropdown"></div>
        <!-- Scrollspy Mobile Dropdown End -->

        <!-- Menu Button Start -->
        <a href="#" id="mobileMenuButton" class="menu-button">
            <i data-acorn-icon="menu"></i>
        </a>
        <!-- Menu Button End -->
    </div>
    <!-- Mobile Buttons End -->
</div>
<div class="nav-shadow"></div>

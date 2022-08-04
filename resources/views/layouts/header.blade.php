<!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                        <div class="position-relative search-bar-box">

                        </div>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <!--<a class="nav-link" href="#">   <i class='bx bx-search'></i>
                                </a>-->
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-time'></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="row row-cols-3 g-3 p-3">
                                        @if(Auth::user()->onDuty == 0)
                                            <div class="col text-center">
                                                <a href="{{url('clock-on/Mechanic')}}" >
                                                <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-wrench'></i>
                                                </div>
                                                </a>
                                                    <div class="app-title">@lang('app.mechanic')</div>

                                            </div>
                                            <div class="col text-center">
                                                <a href="{{url('clock-on/Tow')}}" >
                                                <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bxs-truck'></i>
                                                </div>
                                                </a>
                                                <div class="app-title">@lang('app.tow')</div>

                                            </div>
                                            <div class="col text-center">
                                                <a href="{{url('clock-on/Scuba')}}" >
                                                <div class="app-box mx-auto bg-gradient-deepblue text-white"><i class="fa fa-swimmer"></i>
                                                </div></a>
                                                <div class="app-title">@lang('app.scuba')</div>
                                            </div>
                                                @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager" || Auth::user()->role == "Trainer")
                                                    <div class="col text-center">
                                                        <a href="{{url('clock-on/Trainer')}}" >
                                                            <div class="app-box mx-auto bg-gradient-scooter text-white"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3m6.82 6L12 12.72L5.18 9L12 5.28L18.82 9M17 16l-5 2.72L7 16v-3.73L12 15l5-2.73V16Z"/></svg>
                                                            </div></a>
                                                        <div class="app-title">Trainer</div>
                                                    </div>
                                                @endif
                                                @if(Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager")
                                                    <div class="col text-center">
                                                        <a href="{{url('clock-on/Management')}}" >
                                                            <div class="app-box mx-auto bg-gradient-scooter text-white"><i class="fa fa-user-shield"></i>
                                                            </div></a>
                                                        <div class="app-title">Management</div>
                                                    </div>
                                                @endif
                                            @else
                                                @if(Auth::user()->workingAs != __('app.mechanic'))
                                                    <div class="col text-center">
                                                        <a href="{{url('clock-on/Mechanic')}}" >
                                                            <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-wrench'></i>
                                                            </div>
                                                        </a>
                                                        <div class="app-title">@lang('app.mechanic')</div>

                                                    </div>
                                                @endif
                                                @if(Auth::user()->workingAs != __('app.tow'))
                                                    <div class="col text-center">
                                                        <a href="{{url('clock-on/Tow')}}" >
                                                            <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bxs-truck'></i>
                                                            </div>
                                                        </a>
                                                        <div class="app-title">@lang('app.tow')</div>

                                                    </div>
                                                @endif
                                                @if(Auth::user()->workingAs != __('app.scuba'))
                                                    <div class="col text-center">
                                                        <a href="{{url('clock-on/Scuba')}}" >
                                                            <div class="app-box mx-auto bg-gradient-deepblue text-white"><i class="fa fa-swimmer"></i>
                                                            </div></a>
                                                        <div class="app-title">Scuba</div>
                                                    </div>
                                                @endif
                                                @if((Auth::user()->workingAs != 'Trainer' && Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager" || Auth::user()->role == "Trainer"))
                                                        <div class="col text-center">
                                                            <a href="{{url('clock-on/Trainer')}}" >
                                                                <div class="app-box mx-auto bg-gradient-scooter text-white"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3m6.82 6L12 12.72L5.18 9L12 5.28L18.82 9M17 16l-5 2.72L7 16v-3.73L12 15l5-2.73V16Z"/></svg>
                                                                </div></a>
                                                            <div class="app-title">Trainer</div>
                                                        </div>
                                                @endif
                                                @if(Auth::user()->workingAs != __('app.mgmt') && Auth::user()->role == "Boss" || Auth::user()->role == "IT Support" || Auth::user()->role == "Veteran Manager" || Auth::user()->role == "Manager"))
                                                    <div class="col text-center">
                                                        <a href="{{url('clock-on/Management')}}" >
                                                            <div class="app-box mx-auto bg-gradient-scooter text-white"><i class="fa fa-user-shield"></i>
                                                            </div></a>
                                                        <div class="app-title">Management</div>
                                                    </div>
                                                @endif

                                            <div class="col text-center">
                                                <a href="{{url('clock-on/Off-Duty')}}" >
                                                <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
                                                </div></a>
                                                <div class="app-title">Off Duty</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">

                                    </a>
                                    <div class="header-notifications-list">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:;">
                                        <div class="msg-header">
                                            <p class="msg-header-title">Messages</p>
                                            <p class="msg-header-clear ms-auto">Marks all as read</p>
                                        </div>
                                    </a>
                                    <div class="header-message-list">
                                    </div>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://eu.ui-avatars.com/api/?background=C71585&color=fff&name={{Auth::user()->name}}" class="user-img" alt="user avatar">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{Auth::user()->name}}</p>
                                <p class="designattion mb-0">{{Auth::user()->role}}</p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{url('/edit-user')}}"><i class='bx bxs-user-detail'></i><span>Edit Profile</span></a>
                            </li>
                            <hr>
                            <li><a class="dropdown-item" href="{{url('/logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->

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
                                <a class="nav-link" href="#">   <i class='bx bx-search'></i>
                                </a>
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
                                                <div class="app-title">Mechanic</div>

                                        </div>
                                        <div class="col text-center">
                                            <a href="{{url('clock-on/Tow')}}" >
                                            <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bxs-truck'></i>
                                            </div>
                                            </a>
                                            <div class="app-title">Tow</div>

                                        </div>
                                        <div class="col text-center">
                                            <a href="{{url('clock-on/Scuba')}}" >
                                            <div class="app-box mx-auto bg-gradient-deepblue text-white"><i class="fa fa-swimmer"></i>
                                            </div></a>
                                            <div class="app-title">Scuba</div>
                                        </div>
                                        @else
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
                                <p class="designattion mb-0">{{Auth::user()->IsAdmin == 1 ? 'Admin' : 'User'}}</p>
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

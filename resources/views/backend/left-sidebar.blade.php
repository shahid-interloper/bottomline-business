<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('user.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('general.all.notifications') }}" class="waves-effect">
                        <i class="bx bx-bell"></i>
                        <span>Notifications</span>
                        <span
                            class="badge bg-danger rounded-pill float-end unreadnotifications">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                </li>

                
                @if (!Auth::user()->hasRole('Admin') && !Auth::user()->hasRole('Super Admin'))
                    <li>
                        <a href="{{ route('front.register.step1') }}" class="waves-effect" target="_blank">
                            <i class="bx bx-menu"></i>
                            <span>Add Students</span>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
                    <li>
                        <a href="{{ route('users.index') }}" class="waves-effect">
                            <i class="bx bx-menu"></i>
                            <span> Users </span>
                        </a>
                    </li>


                    {{-- <li>
                        <a href="{{ route('admin.all.students') }}" class="waves-effect">
                            <i class="bx bx-menu"></i>
                            <span> Courses </span>
                        </a>
                    </li> --}}


                    <li>
                        <a href="{{ route('admin.all.students') }}" class="waves-effect">
                            <i class="bx bx-menu"></i>
                            <span> Students </span>
                        </a>
                    </li>
                    <li class="menu-title" key="t-menu">CMS</li>
                    <li class="@if (Route::is('websetting')) {{ 'mm-active' }} @endif">
                        <a href="{{ route('websetting') }}" class="waves-effect">
                            <i class="bx bx-menu"></i>
                            <span>Web Settings</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

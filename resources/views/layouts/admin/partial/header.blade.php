<header class="main-header">
    <!-- Logo -->
    <a href="{{ URL::to('dashboard') }}" class="logo" aria-label="Admin dashboard">
        <!-- mini logo for sidebar mini -->
        <span class="logo-mini">
            <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="" />
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="" />
            <span>Grill and Thrill</span>
            <em class="gt-admin-tag" style="font-style: normal;">Admin</em>
        </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button -->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- View website -->
                <li class="gt-topnav-cta hidden-xs">
                    <a href="{{ URL::to('/') }}" target="_blank" rel="noopener" class="gt-topnav-site">
                        <i class="fa fa-external-link" aria-hidden="true"></i> View website
                    </a>
                </li>

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" class="user-image" alt="">
                        <span class="hidden-xs">Admin</span>
                        <i class="fa fa-angle-down hidden-xs" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User header -->
                        <li class="user-header">
                            <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="">
                            <p>
                                Admin
                                <small>Grill and Thrill</small>
                            </p>
                        </li>

                        <!-- Menu body -->
                        <li class="user-body">
                            <a href="{{ URL::to('dashboard') }}" class="gt-menu-link">
                                <i class="fa fa-th-large" aria-hidden="true"></i> Dashboard
                            </a>
                            <a href="{{ URL::to('/') }}" target="_blank" rel="noopener" class="gt-menu-link">
                                <i class="fa fa-external-link" aria-hidden="true"></i> View website
                            </a>
                        </li>

                        <!-- Menu footer -->
                        <li class="user-footer">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="gt-signout">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
@php
    $gtCustomer = session()->get('customer');
    $gtName = optional($gtCustomer)->first_name ?: 'My account';
    $gtInitial = mb_substr($gtName, 0, 1);
@endphp

<header class="main-header">
    <!-- Logo -->
    <a href="{{ URL::to('/') }}" class="logo" aria-label="Grill and Thrill home">
        <!-- mini logo for sidebar mini -->
        <span class="logo-mini">
            <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="" />
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="{{ asset('images/GrillandThrill-Logo.jpg') }}" alt="" />
            <span>Grill and Thrill</span>
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

                <!-- Order food -->
                <li class="gt-topnav-cta hidden-xs">
                    <a href="{{ URL::to('/') }}#menu-8" class="gt-topnav-order">
                        <i class="fa fa-cutlery" aria-hidden="true"></i> Order food
                    </a>
                </li>

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="gt-avatar" aria-hidden="true">{{ $gtInitial }}</span>
                        <span class="hidden-xs">{{ $gtName }}</span>
                        <i class="fa fa-angle-down hidden-xs" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User header -->
                        <li class="user-header">
                            <span class="gt-avatar gt-avatar--lg" aria-hidden="true">{{ $gtInitial }}</span>
                            <p>
                                {{ $gtName }}
                                <small>Grill and Thrill customer</small>
                            </p>
                        </li>

                        <!-- Menu body -->
                        <li class="user-body">
                            <a href="{{ URL::to('customer/dashboard') }}" class="gt-menu-link">
                                <i class="fa fa-th-large" aria-hidden="true"></i> Dashboard
                            </a>
                            <a href="{{ URL::to('/') }}#menu-8" class="gt-menu-link">
                                <i class="fa fa-cutlery" aria-hidden="true"></i> Order food
                            </a>
                            <a href="{{ URL::to('contact-us') }}" class="gt-menu-link">
                                <i class="fa fa-phone" aria-hidden="true"></i> Contact us
                            </a>
                        </li>

                        <!-- Menu footer -->
                        <li class="user-footer">
                            <a href="{{ URL::to('customerLogout') }}" class="gt-signout">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
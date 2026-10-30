@php
    $gtOrdersActive = ($pageName == 'customer_current_order' || $pageName == 'customer_completed_order' || $pageName == 'customer_cancelled_order' || $pageName == 'customer_order_details');
@endphp

<!-- Left side column -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">MY ACCOUNT</li>

            <li class="@if($pageName == 'CustomerDashboard') active @endif">
                <a href="{{ URL::to('customer/dashboard') }}">
                    <i class="fa fa-th-large"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="@if($gtOrdersActive) active menu-open @endif treeview">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i>
                    <span>My orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" @if($gtOrdersActive) style="display: block;" @endif>
                    <li class="@if($pageName == 'customer_current_order') active @endif">
                        <a href="{{ URL::to('customer/order-list') }}/current">
                            <i class="fa fa-clock-o"></i> Current
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--current">{{ $customerOrderCount['current'] }}</small>
                            </span>
                        </a>
                    </li>
                    <li class="@if($pageName == 'customer_completed_order') active @endif">
                        <a href="{{ URL::to('customer/order-list') }}/completed">
                            <i class="fa fa-check-circle-o"></i> Completed
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--done">{{ $customerOrderCount['completed'] }}</small>
                            </span>
                        </a>
                    </li>
                    <li class="@if($pageName == 'customer_cancelled_order') active @endif">
                        <a href="{{ URL::to('customer/order-list') }}/cancelled">
                            <i class="fa fa-times-circle-o"></i> Cancelled
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--cancel">{{ $customerOrderCount['cancelled'] }}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="header">MORE</li>

            <li>
                <a href="{{ URL::to('/') }}">
                    <i class="fa fa-globe"></i> <span>Back to website</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('customerLogout') }}">
                    <i class="fa fa-sign-out"></i> <span>Sign out</span>
                </a>
            </li>
        </ul>

        <!-- Promo card -->
        <div class="gt-side-promo">
            <strong>Hungry again? 🍔</strong>
            <small>Your favourites are a few taps away.</small>
            <a href="{{ URL::to('/') }}#menu-8">
                Order now
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </section>
</aside>
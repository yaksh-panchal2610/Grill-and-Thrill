@php
    $gtOrdActive = in_array($pageName, ['new_order', 'preparing_order', 'sent_to_delivery_order', 'completed_order', 'cancelled_order', 'order_details']);
    $gtCatActive = in_array($pageName, ['category_list', 'create_category', 'edit_category']);
    $gtProdActive = in_array($pageName, ['product_list', 'create_product', 'edit_product']);
@endphp

<!-- Left side column -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header">MAIN NAVIGATION</li>

            <li class="@if($pageName == 'dashboard') active @endif">
                <a href="{{ URL::to('dashboard') }}">
                    <i class="fa fa-th-large"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- ORDERS -->
            <li class="@if($gtOrdActive) active menu-open @endif treeview">
                <a href="#">
                    <i class="fa fa-shopping-bag"></i>
                    <span>Live orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" @if($gtOrdActive) style="display: block;" @endif>
                    <li class="@if($pageName == 'new_order') active @endif">
                        <a href="{{ URL::to('order-list') }}/new">
                            <i class="fa fa-bell-o"></i> New
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--new @if($orderCount['new'] > 0) gt-count--hot @endif">{{ $orderCount['new'] }}</small>
                            </span>
                        </a>
                    </li>
                    <li class="@if($pageName == 'preparing_order') active @endif">
                        <a href="{{ URL::to('order-list') }}/preparing">
                            <i class="fa fa-fire"></i> Preparing
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--prep">{{ $orderCount['preparing'] }}</small>
                            </span>
                        </a>
                    </li>
                    <li class="@if($pageName == 'sent_to_delivery_order') active @endif">
                        <a href="{{ URL::to('order-list') }}/sent_to_delivery">
                            <i class="fa fa-paper-plane-o"></i> Sent to delivery
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--sent">{{ $orderCount['sent_to_delivery'] }}</small>
                            </span>
                        </a>
                    </li>
                    <li class="@if($pageName == 'completed_order') active @endif">
                        <a href="{{ URL::to('order-list') }}/completed">
                            <i class="fa fa-check-circle-o"></i> Completed
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--done">{{ $orderCount['completed'] }}</small>
                            </span>
                        </a>
                    </li>
                    <li class="@if($pageName == 'cancelled_order') active @endif">
                        <a href="{{ URL::to('order-list') }}/cancelled">
                            <i class="fa fa-times-circle-o"></i> Cancelled
                            <span class="pull-right-container">
                                <small class="label gt-count gt-count--cancel">{{ $orderCount['cancelled'] }}</small>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="header">MENU</li>

            <!-- CATEGORY -->
            <li class="@if($gtCatActive) active menu-open @endif treeview">
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" @if($gtCatActive) style="display: block;" @endif>
                    <li class="@if($pageName == 'category_list') active @endif">
                        <a href="{{ URL::to('category') }}"><i class="fa fa-list-ul"></i> Category list</a>
                    </li>
                    <li class="@if($pageName == 'create_category') active @endif">
                        <a href="{{ URL::to('category') }}/create"><i class="fa fa-plus"></i> Create category</a>
                    </li>
                </ul>
            </li>

            <!-- PRODUCT -->
            <li class="@if($gtProdActive) active menu-open @endif treeview">
                <a href="#">
                    <i class="fa fa-cutlery"></i>
                    <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" @if($gtProdActive) style="display: block;" @endif>
                    <li class="@if($pageName == 'product_list') active @endif">
                        <a href="{{ URL::to('product') }}"><i class="fa fa-list-ul"></i> Product list</a>
                    </li>
                    <li class="@if($pageName == 'create_product') active @endif">
                        <a href="{{ URL::to('product') }}/create"><i class="fa fa-plus"></i> Create product</a>
                    </li>
                </ul>
            </li>

            <li class="header">MORE</li>

            <li>
                <a href="{{ URL::to('/') }}" target="_blank" rel="noopener">
                    <i class="fa fa-external-link"></i> <span>View website</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
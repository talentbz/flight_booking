<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">@lang('translation.Dashboards')</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.edit.profile')}}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-ecommerce">Admin</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-ecommerce">User Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript: void(0);" key="t-products">User List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-car-child-seat"></i>
                        <span key="t-ecommerce">Seat Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.seat.edit')}}" key="t-products">Seat Type</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-money-check-alt"></i>
                        <span key="t-ecommerce">Price Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.price.count_index')}}" key="t-products">By Count</a></li>
                        <li><a href="{{route('admin.price.date_index')}}" key="t-products">By Date</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-receipt"></i>
                        <span key="t-ecommerce">Booking History</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="javascript: void(0);" key="t-products">Booking List</a></li>
                        <li><a href="javascript: void(0);" key="t-products">Price Management</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.schedule.index')}}" class="waves-effect">
                        <i class="bx bx-calendar"></i>
                        <span key="t-ecommerce">Schedule</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

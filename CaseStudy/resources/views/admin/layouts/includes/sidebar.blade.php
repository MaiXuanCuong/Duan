<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('/') }}">
                <i class="ri-home-heart-fill"></i>
                <span>Trang Chủ</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if (Auth::user()->hasPermission('Admin_viewAny') ||
            Auth::user()->hasPermission('Admin_create') ||
            Auth::user()->hasPermission('Role_create') ||
            Auth::user()->hasPermission('Role_viewAny'))
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Quản Lý Admin</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (Auth::user()->hasPermission('Admin_viewAny'))
                        <li>
                            <a href="{{ route('users') }}">
                                <i class="bi bi-circle"></i><span>Danh Sách User</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermission('Admin_create'))
                        <li>
                            <a href="{{ route('users.add') }}">
                                <i class="bi bi-circle"></i><span>Thêm User</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->hasPermission('Role_create'))
                        <li>
                            <a href="{{ route('role.create') }}">
                                <i class="bi bi-circle"></i><span>Thêm Chức Vụ Và Quyền</span>
                            </a>
                        </li>
                        <li>
                    @endif
                    @if (Auth::user()->hasPermission('Role_viewAny'))
                        <a href="{{ route('role.index') }}">
                            <i class="bi bi-circle"></i><span>Xem Chức Vụ Và Quyền</span>
                        </a>
            </li>
        @endif
    </ul>
    @endif
    @if (Auth::user()->hasPermission('Category_viewAny') || Auth::user()->hasPermission('Category_create'))

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Danh Mục</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @if (Auth::user()->hasPermission('Category_viewAny'))
                    <li>
                        <a href="{{ route('categories') }}">
                            <i class="bi bi-circle"></i><span>Xem Danh Mục</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('Category_create'))
                    <li>
                        <a href="{{ route('categories.add') }}">
                            <i class="bi bi-circle"></i><span>Thêm Danh Mục</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li><!-- End Forms Nav -->
    @endif
    @if (Auth::user()->hasPermission('Product_viewAny') || Auth::user()->hasPermission('Product_create'))
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Sản Phẩm</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @if (Auth::user()->hasPermission('Product_viewAny'))
                    <li>
                        <a href="{{ route('products') }}">
                            <i class="bi bi-circle"></i><span>Xem Sản Phẩm</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('Product_create'))
                    <li>
                        <a href="{{ route('products.add') }}">
                            <i class="bi bi-circle"></i><span>Thêm Sản Phẩm</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->hasPermission('Product_viewAny'))
                    <li>
                        <a href="{{ route('products.OutOfStock') }}">
                            <i class="bi bi-circle"></i><span>Sản Phẩm Hết Hàng</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li><!-- End Tables Nav -->
    @endif

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-user-heart-fill"></i><span>Khách Hàng</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('customers') }}">
                    <i class="bi bi-circle"></i><span>Danh Sách Khác Hàng</span>
                </a>
            </li>
            {{-- <li>
                <a href="charts-apexcharts.html">
                    <i class="bi bi-circle"></i><span>Khách Hàng Vi Phạm</span>
                </a>
            </li> --}}
            {{-- <li>
                <a href="{{ route('customers') }}">
                    <i class="bi bi-circle"></i><span>Khách Hàng Thân Thiết</span>
                </a>
            </li> --}}
        </ul>
    </li><!-- End Charts Nav -->

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-gem"></i><span>Trang Shop</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{ route('shop.home') }}">
                    <i class="bi bi-circle"></i><span>Đến shop</span>
                </a>
            </li>
            {{-- <li>
                <a href="icons-remix.html">
                    <i class="bi bi-circle"></i><span>Remix Icons</span>
                </a>
            </li>
            <li>
                <a href="icons-boxicons.html">
                    <i class="bi bi-circle"></i><span>Boxicons</span>
                </a>
            </li> --}}
        </ul>
    </li><!-- End Icons Nav -->
    </ul>

</aside><!-- End Sidebar-->

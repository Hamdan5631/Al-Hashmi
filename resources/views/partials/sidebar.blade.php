<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @php
            $admin = \App\Models\Admin::query()->findOrFail(Auth::id());
        @endphp
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo mx-0">
                <a href="{{route('dashboard')}}" class="app-brand-link">
              <span class="app-brand-logo demo me-4">

              </span>
                    <span class="app-brand-text demo menu-text fw-bold ms-0 text-capitalize">
                       <img height="200" width="200" src="{{asset('assets/images/Color Logo in White BG.svg')}}"
                            style="margin-left: -50px">
                    </span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a
                        href="{{route('dashboard')}}"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                        <div data-i18n="Email">Dashboard</div>
                    </a>
                </li>
                @if($admin->isSuperAdmin())
                    <li class="menu-item {{  \Illuminate\Support\Facades\Route::is('employees.index','employees.show','employees.create') ? 'active' : '' }}">
                        <a
                            href="{{route('employees.index')}}"
                            class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Email">Employees</div>
                        </a>
                    </li>
                    <li class="menu-item {{  \Illuminate\Support\Facades\Route::is('categories.index','categories.create','categories.edit') ? 'active' : '' }}">
                        <a
                            href="{{route('categories.index')}}"
                            class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div data-i18n="Email">Categories</div>
                        </a>
                    </li>
                @endif
                <li class="menu-item {{  \Illuminate\Support\Facades\Route::is('stocks.index','stocks.show','stocks.create','stocks.edit') ? 'active' : '' }}">
                    <a
                        href="{{route('stocks.index')}}"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
                        <div data-i18n="Email">Stock</div>
                    </a>
                </li>
                @if($admin->isSuperAdmin())
                    <li class="menu-item {{  \Illuminate\Support\Facades\Route::is('sold-stocks.index') ? 'active' : '' }}">
                        <a
                            href="{{route('sold-stocks.index')}}"
                            class="menu-link">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div data-i18n="Email">Sold Stocks</div>
                        </a>
                    </li>
                @endif

                @if($admin->isSuperAdmin())
                    <li class="menu-item {{  \Illuminate\Support\Facades\Route::is('expenses.index','expenses.show','expenses.create','expenses.edit') ? 'active' : '' }}">
                        <a
                            href="{{route('expenses.index')}}"
                            class="menu-link">
                            <i class="menu-icon tf-icons bx bx-money"></i>
                            <div data-i18n="Email">Expenses</div>
                        </a>
                    </li>
                @endif
            </ul>
        </aside>
        <div class="layout-page">
            @include('partials.navbar')
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="page">
                        <div class="page-header">
                            @yield('header')
                        </div>
                        <div class="page-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="content-backdrop fade"></div>
            </div>

        </div>
    </div>

    <!-- Overlay -->
    {{--    <div class="layout-overlay layout-menu-toggle"></div>--}}
</div>


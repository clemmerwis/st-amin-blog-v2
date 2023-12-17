{{-- <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a class="{{ (request()->is('admin/dashboard')) ? 'active-menu' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>

            <li>
                <a class="{{ (request()->is('admin/posts')) ? 'active-menu' : '' }}" href="{{ route('admin.posts.index') }}"><i class="fa fa-table"></i> Posts</a>
            </li>
        </ul>
    </div>
</nav> --}}
<!-- /. NAV SIDE  -->
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <div class="sidebar-brand" href="index.html" style="display: grid;">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logos/schmoll-thoughts-rose-behind-x300.png') }}" alt=""
                    style="place-self: center; max-width: 200px;">
            </a>
        </div>

        <ul class="sidebar-nav">
            {{-- <li class="sidebar-header">
                Pages
            </li> --}}

            {{-- <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ request()->is('admin/posts*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.posts.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Posts</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.categories.index') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Categories</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

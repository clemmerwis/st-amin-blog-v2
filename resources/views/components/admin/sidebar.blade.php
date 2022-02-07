<nav class="navbar-default navbar-side" role="navigation">
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
</nav>
<!-- /. NAV SIDE  -->

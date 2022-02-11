<x-admin-layout>
    {{-- {{ dd($posts) }} --}}
    <div id="wrapper" class="admin-page-wrapper">
        <x-admin.topbar-nav/>

        <x-admin.sidebar-nav/>

        <div id="page-wrapper">
            <div class="header">
                <h1 class="page-header">
                    Dashboard <small>Welcome {{ auth()->user()->name }}</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                    <li class="active">Posts</li>
                </ol>
            </div>
            <div id="page-inner">
                <x-admin.innerpage-posts/>

                <footer>
                    <p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez.com</a></p>
                </footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
</x-admin-layout>

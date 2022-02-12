<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/plugins/images/favicon.png') }}">

    @if (!isset($active))
        <x-admin.head/>
    @else
        @if ($active === 'Posts')
            <x-admin.head-posts/>
        {{-- @elseif ($active === 'Users')
            <x-admin.innerpage-users/> --}}
        @endif
    @endif
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    {{-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> --}}

    {{-- <x-admin.page :posts="$posts"/> --}}
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
                    <li class="active">{{ $active ?? 'Dashboard'}}</li>
                </ol>
            </div>

            <div id="page-inner">
                @if (!isset($active))
                    <x-admin.innerpage/>
                @else
                    @if ($active === 'Posts')
                        <x-admin.innerpage-posts/>
                    {{-- @elseif ($active === 'Users')
                        <x-admin.innerpage-users/> --}}
                    @endif
                @endif

                <footer>
                    <p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez.com</a></p>
                </footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    @if (!isset($active))
        <x-admin.footerscripts/>
    @else
        @if ($active === 'Posts')
            <x-admin.footerscripts-posts/>
        {{-- @elseif ($active === 'Users')
            <x-admin.innerpage-users/> --}}
        @endif
    @endif
</body>
</html>

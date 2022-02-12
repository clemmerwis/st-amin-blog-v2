<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('css/admin/assets/img/icons/icon-48x48.png') }}" />

    <link href="{{ asset('css/admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    {{-- @if (!isset($active))
    <x-admin.head />
    @else
    @if ($active === 'Posts')
    <x-admin.head-posts /> --}}
    {{-- @elseif ($active === 'Users')
    <x-admin.innerpage-users /> --}}
    {{-- @endif
    @endif --}}
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

    {{-- <div id="wrapper" class="admin-page-wrapper">
        <x-admin.topbar-nav />

        <x-admin.sidebar-nav />

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
                <x-admin.innerpage />
                @else
                @if ($active === 'Posts')
                <x-admin.innerpage-posts :posts="$posts" />
                {{-- @elseif ($active === 'Users')
                <x-admin.innerpage-users /> --}}
                {{-- @endif
                @endif

                <footer>
                    <p>All right reserved. Template by: <a href="http://webthemez.com">WebThemez.com</a></p>
                </footer> --}}
                {{--
            </div> --}}
            <!-- /. PAGE INNER  -->
            {{--
        </div> --}}
        <!-- /. PAGE WRAPPER  -->
        {{--
    </div> --}}
    <!-- /. WRAPPER  -->
    <div class="wrapper">
        <x-admin.sidebar-nav />

        <div class="main">
            <x-admin.topbar-nav />

            <main class="content">
                @if (!isset($active))
                    <x-admin.innerpage />
                @else
                    @if ($active === 'Posts')
                        <x-admin.innerpage-posts :posts="$posts" />
                    {{-- @elseif ($active === 'Users')
                        <x-admin.innerpage-users /> --}}
                    @endif
                @endif
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/"
                                    target="_blank"><strong>AdminKit</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @if (!isset($active))
        <x-admin.footerscripts />
    @else
        @if ($active === 'Posts')
            <x-admin.footerscripts-posts />
            {{-- @elseif ($active === 'Users')
            <x-admin.innerpage-users /> --}}
        @endif
    @endif
</body>

</html>

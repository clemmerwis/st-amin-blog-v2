<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('css/admin/assets/img/icons/icon-48x48.png') }}" />

    <link href="{{ asset('css/admin/assets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <title>Admin | Dashboard</title>

    {{-- @if (!isset($active))
    <x-admin.head />
    @else
    @if ($active === 'Posts')
    <x-admin.head-posts /> --}}
    {{-- @elseif ($active === 'Users')
    <x-admin.innerpage-users /> --}}
    {{-- @endif
    @endif --}}
    <style>
        html {
            overflow-y: hidden !important;
        }

        .container-fluid {
            max-width: 1450px;
            margin: auto;
        }

        tbody th {
            vertical-align: middle;
        }

        /* admin sideabr - overwrite vuetify link color */
        #app .v-application #sidebar a:not(:hover) {
            color: rgba(233,236,239,.5);
        }

        @media (max-width: 767px) {
            .content {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <v-app>
            <div class="wrapper">
                <x-admin.sidebar-nav />

                <div class="main">
                    <x-admin.topbar-nav />

                    <main class="content" v-cloak>
                        <div class="container-fluid p-0">

                            @switch($active ?? null)
                                @case('Posts')
                                    <innerpage-posts :posts="{{ json_encode($posts) }}"></innerpage-posts>                                    
                                    @break
                                @case('PostEdit')
                                    <admin-post-edit :post="{{ json_encode($post) }}"></admin-post-detail>
                                    @break
                                @default
                                    <x-admin.innerpage />
                            @endswitch
                            
                        </div>
                        
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
        </v-app>
    </div>
    @if (isset($active)) 
        @switch($active ?? null)
            @case('Posts')
                <x-admin.footerscripts-posts />                               
                @break
            @case('PostEdit')
                <x-admin.footerscripts-posts />
                @break
            @default
                <x-admin.footerscripts />
        @endswitch
    @else
        <x-admin.footerscripts />
    @endif
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>

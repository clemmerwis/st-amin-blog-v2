<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/plugins/images/favicon.png') }}">

    <!-- Admin Styles -->
    <link href="{{ asset('css/admin/assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="{{ asset('css/admin/assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="{{ asset('css/admin/assets/js/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="{{ asset('css/admin/assets/css/custom-styles.css') }}" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{ asset('css/admin/assets/js/Lightweight-Chart/cssCharts.css') }}">
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


    {{ $slot }}

    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{ asset('css/admin/assets/js/jquery-1.10.2.js') }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset('css/admin/assets/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Js -->
    <script src="{{ asset('css/admin/assets/js/jquery.metisMenu.js') }}"></script>
    <!-- Morris Chart Js -->
    <script src="{{ asset('css/admin/assets/js/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('css/admin/assets/js/morris/morris.js') }}"></script>


	<script src="{{ asset('css/admin/assets/js/easypiechart.js') }}"></script>
	<script src="{{ asset('css/admin/assets/js/easypiechart-data.js') }}"></script>

	<script src="{{ asset('css/admin/assets/js/Lightweight-Chart/jquery.chart.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('css/admin/assets/js/custom-scripts.js') }}"></script>

    <!-- Chart Js -->
    <script type="text/javascript" src="{{ asset('css/admin/assets/js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('css/admin/assets/js/chartjs.js') }}"></script>
</body>

</html>

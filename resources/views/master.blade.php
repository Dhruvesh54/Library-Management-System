<html>

<head>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::to('/') }}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ URL::to('/') }}/assets/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ URL::to('/') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ URL::to('/') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
{{-- *Data table --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ URL::to('/') }}/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> --}}

</head>

<body class="g-sidenav-show  bg-gray-200" style="background-color: rgb(174, 194, 212)">

    {{-- <main> --}}
    @yield('content')

    </main>

    <script src="{{ URL::to('/') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/js/core/bootstrap.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="{{ URL::to('/') }}/assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ URL::to('/') }}/assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-migrate-3.4.1.js"
        integrity="sha256-CfQXwuZDtzbBnpa5nhZmga8QAumxkrhOToWweU52T38=" crossorigin="anonymous"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="    https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="    https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="    https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="    https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="    https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="    https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="    https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

</body>
@yield('script')


</html>

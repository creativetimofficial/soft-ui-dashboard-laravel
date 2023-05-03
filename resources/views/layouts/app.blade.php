<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Maxxi Econômica Farmácias - Digital
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.4" rel="stylesheet" />
    <link href="../assets/scss/soft-ui-dashboard/plugins/pro/_sweetalert2.scss" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-100">
    @auth
        @yield('auth')
    @endauth
    @guest
        @yield('guest')
    @endguest

    @if (session('status'))
        <div class="notificationOnline" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show">
            <div class="offBar bg-success text-white">
                <div class="ofBar-content"> {{ session('status') }}</div>
            </div>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="notificationOnline" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show">
            <div class="offBar bg-success text-white">
                <div class="ofBar-content"> {{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="notificationOnline" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3500)" x-show="show">
            <div class="offBar bg-warning text-white">
                <div class="offBar-content"> {{ session('error') }}</div>
            </div>
        </div>
    @endif

    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/plugins/alpine.js"></script>
    <script src="../assets/js/plugins/flatpickr.min.js"></script>
    <script src="../assets/js/plugins/sweetalert.min.js"></script>
    <script src="../assets/js/plugins/jquery.js"></script>
    <script src="../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../assets/js/plugins/jkanban/jkanban.js"></script>

    @if (Request::is('custo-de-produtos'))
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js""></script>
    @endif

    @stack('dashboard')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    @stack('script')
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/soft-ui-dashboard.js?v=1.0.3"></script>
</body>

</html>

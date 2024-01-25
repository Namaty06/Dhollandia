<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="menuitem-active">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="shortcut icon" href="{{ asset('img/icon.png') }}" type="image/png">
    <title>{{ config('app.name', 'Dhollandia') }}</title>

    <link rel="stylesheet" href="{{ asset('css/dataTables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/viewer.css') }}">

    @yield('style')

</head>

<body id="body" data-layout-color="light" data-layout-mode="fluid" data-rightbar-onstart="true"
    data-leftbar-theme="dark" style="">



    <div class="wrapper" id="content">
        @include('dashboard.sidebar')
        <div class="content-page">
            <div class="content">
                @include('dashboard.navbar')
                <div class="container-fluid m-0 p-0 mt-1 ">
                    @include('errors.alert')
                    @yield('content')
                </div>
            </div>

            <footer class="footer mt-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            Dhollandia - Powered by IS-TECH
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- dataTables --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script src="{{ asset('js/dataTables.js/dataTables.js') }}"></script>

    {{-- editor --}}

    <script>
        $(document).ready(function() {
            // Initialize Select2 here
            $('.select2-class').select2();
        });
        $(document).ready(function() {
            var allTables = $('table.dataTable').DataTable();
            allTables.column(0).search('mySearchTerm').draw();
            $('#myTable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"
                },
                // dom: 'Bfrtip',
                // buttons: [
                //     'copy', 'csv', 'excel', 'pdf', 'print'
                // ],
                // pagingType: "numbers"
            });
            $('#myTable2').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"
                } //,
                // pagingType: "numbers"
            });

        });
    </script>
    @yield('script')



</body>

</html>

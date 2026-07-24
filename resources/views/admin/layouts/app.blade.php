<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exbhix Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .main-wrapper {
            margin-left: 270px;
            width: calc(100% - 270px);
            transition: margin-left .25s ease, width .25s ease;
        }

        .main-wrapper.sidebar-collapsed {
            margin-left: 84px;
            width: calc(100% - 84px);
        }
    </style>
</head>

<body>

    <div class="d-flex bg-light">

        @include('admin.partials.sidebar')

        <div class="flex-grow-1 d-flex flex-column min-vh-100 main-wrapper">

            @include('admin.partials.navbar')

            <main class="flex-grow-1 p-4">

                @yield('content')

            </main>

            @include('admin.partials.footer')

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>

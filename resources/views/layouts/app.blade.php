<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/fonts/icomoon/style.css">

    <link rel="stylesheet" href="/css/auth/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/auth/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="/css/auth/style.css">

    <title>@yield('title')</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/auth/jquery-3.3.1.min.js"></script>
    <script src="/js/auth/popper.min.js"></script>
    <script src="/js/auth/bootstrap.min.js"></script>
    <script src="/js/auth/main.js"></script>
</body>

</html>

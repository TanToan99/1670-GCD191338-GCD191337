<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    @yield('custom-css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="index.html">
                        FPT TRAINER
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        FPT TRAINER
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="/images/profile.png" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="/images/profile.png" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                                <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                            </div>
                            <a class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user()->isStaff() ||
    auth()->user()->isAdmin())
                        <li class="nav-item nav-category">Manager</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('management.index') }}">
                                <i class="menu-icon mdi mdi-floor-plan"></i>
                                <span class="menu-title">User Management</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="menu-icon mdi mdi-floor-plan"></i>
                                <span class="menu-title">Cousers Management</span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->isStaff() || auth()->user()->isAdmin() || auth()->user()->isTrainer())
                    <li class="nav-item nav-category">Trainer</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trainer.trainer_course') }}">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">My Courses</span>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->isStaff() || auth()->user()->isAdmin() || auth()->user()->isTrainee())
                    <li class="nav-item nav-category">Trainee</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trainer.trainer_course') }}">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">My Courses</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">

                    @if (session('class'))
                        <div class="alert alert-{{ session('class') }}">
                            <li>{{ session('message') }}</li>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="/js/light-layout/off-canvas.js"></script>
    <script src="/js/light-layout/hoverable-collapse.js"></script>
    <script src="/js/light-layout/template.js"></script>
    <script src="/js/light-layout/jquery.cookie.js" type="text/javascript"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/js/light-layout/dashboard.js"></script>
    @yield('custom-js')
    <!-- End custom js for this page-->
</body>

</html>

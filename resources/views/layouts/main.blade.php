<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>waqud.net</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> --}}
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/modern-vertical/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('images/logo3.png') }}" />
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" /> --}}
    @yield('style')

</head>
@if (App::isLocale('en'))

    <body style="background-color: black;overflow: hidden;">
    @else

        <body class="rtl" style="background-color: black;overflow: hidden;">
@endif

<div class="container-scroller">

    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="index.html"
                style="color: white;text-decoration: none">@lang('messages.Manasa')</a>
            <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{ asset('images/logo3.png') }}"
                    alt="logo" /></a>
        </div>
        <ul class="nav" style="height: 1000px">
            {{-- <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li> --}}



            {{-- dashboard --}}


            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-house" style="color: white"></i>
                    </span>
                    <span class="menu-title">@lang('messages.Dashboard')</span>
                </a>
            </li>



            {{-- users --}}


            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                    aria-controls="tables">
                    <span class="menu-icon">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <span class="menu-title">@lang('messages.users')</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                        <i class="fa-solid fa-arrow-down" style="line-height: 1;margin-left: auto;margin-right: 0"></i>
                    @else
                        <i class="fa-solid fa-arrow-down" style="margin-left: 0;margin-right: auto;line-height: 1"></i>
                    @endif
                </a>
                <div class="collapse" id="tables">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('users.index') }}">@lang('messages.show users')</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('users.create') }}">
                                @lang('messages.add user')</a></li>

                    </ul>
                </div>
            </li>


            {{-- roles and permissions --}}

            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#rolesAndPermissions" aria-expanded="true"
                    aria-controls="rolesAndPermissions">
                    <span class="menu-icon">
                        <i class="fa-solid fa-user-lock"></i>
                    </span>
                    <span class="menu-title">@lang('messages.rolesAndPermissions')</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                        <i class="fa-solid fa-arrow-down" style="line-height: 1;margin-left: auto;margin-right: 0"></i>
                    @else
                        <i class="fa-solid fa-arrow-down" style="margin-left: 0;margin-right: auto;line-height: 1"></i>
                    @endif
                </a>
                <div class="collapse" id="rolesAndPermissions">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('roles.index') }}">@lang('messages.showRoles')</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('permissions.index') }}">
                                @lang('messages.showPermissions')</a></li>

                    </ul>
                </div>
            </li>


            {{-- companies --}}

            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#company" aria-expanded="true"
                    aria-controls="company">
                    <span class="menu-icon">
                        <i class="fa-solid fa-building"></i>
                    </span>
                    <span class="menu-title">@lang('messages.companies')</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                        <i class="fa-solid fa-arrow-down" style="line-height: 1;margin-left: auto;margin-right: 0"></i>
                    @else
                        <i class="fa-solid fa-arrow-down" style="margin-left: 0;margin-right: auto;line-height: 1"></i>
                    @endif
                </a>
                <div class="collapse" id="company">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('company.index') }}">@lang('messages.showCompanies')</a></li>
                        {{-- <li class="nav-item"> <a class="nav-link"
                                href="{{ route('permissions.index') }}">
                                @lang('messages.showPermissions')</a></li> --}}

                    </ul>
                </div>
            </li>


            {{-- Main car --}}

            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#mainCar" aria-expanded="true"
                    aria-controls="mainCar">
                    <span class="menu-icon">
                        <i class="fa-solid fa-car"></i>
                    </span>
                    <span class="menu-title">@lang('messages.cars')</span>
                    {{-- <i class="menu-arrow"></i> --}}
                    @if (LaravelLocalization::getCurrentLocale() == 'en')
                        <i class="fa-solid fa-arrow-down" style="line-height: 1;margin-left: auto;margin-right: 0"></i>
                    @else
                        <i class="fa-solid fa-arrow-down" style="margin-left: 0;margin-right: auto;line-height: 1"></i>
                    @endif
                </a>
                <div class="collapse" id="mainCar">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('main-cars.index') }}">@lang('messages.mainCars')</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('subcar.index') }}">
                                @lang('messages.companyCars')</a></li>

                    </ul>
                </div>


            {{-- dashboard --}}


            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('petrol.index') }}">
                    <span class="menu-icon">
                        <i class="fa-solid fa-gas-pump" style="color: white"></i>
                    </span>
                    <span class="menu-title">@lang('messages.follow petrol')</span>
                </a>
            </li>


            </li>

        </ul>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('images/logo.png') }}"
                        style="width: 200px;height:50px" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                {{-- <ul class="navbar-nav w-100">
                    <li class="nav-item w-100">
                        <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                            <input type="text" class="form-control" placeholder="Search products">
                        </form>
                    </li>
                </ul> --}}
                <ul class="navbar-nav navbar-nav-right">
                    {{-- <li class="nav-item dropdown d-none d-lg-block">
                        <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" href="#">+ Create New Project</a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="createbuttonDropdown">
                            <h6 class="p-3 mb-0">Projects</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-file-outline text-primary"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">Software Development</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-web text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">UI Development</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-layers text-danger"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">Software Testing</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <p class="p-3 mb-0 text-center">See all projects</p>
                        </div>
                    </li> --}}
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-view-grid"></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown border-left">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email"></i>
                            <span class="count bg-success"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../assets/images/faces/face4.jpg" alt="image"
                                        class="rounded-circle profile-pic">
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                                    <p class="text-muted mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../assets/images/faces/face2.jpg" alt="image"
                                        class="rounded-circle profile-pic">
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                                    <p class="text-muted mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="../assets/images/faces/face3.jpg" alt="image"
                                        class="rounded-circle profile-pic">
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                                    <p class="text-muted mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <p class="p-3 mb-0 text-center">4 new messages</p>
                        </div>
                    </li> --}}
                    <li class="nav-item dropdown border-left">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            {{ LaravelLocalization::getCurrentLocale() }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0 text-center">
                                @if (LaravelLocalization::getCurrentLocale() == 'en')
                                    choose Language
                                @else
                                    اختر اللغة
                                @endif
                            </h6>
                            <ul style="list-style-type: none;text-alignt:center">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            style="text-decoration:none;color: white;tex"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>

                                    </li>
                                @endforeach
                            </ul>



                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                            <div class="navbar-profile">
                                {{-- <img class="img-xs rounded-circle" src="../assets/images/faces/face15.jpg" alt=""> --}}
                                <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ auth()->user()->name }}</p>
                                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                            aria-labelledby="profileDropdown">
                            <h6 class="p-3 mb-0">@lang('messages.profile')</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item" href={{ route('profile.show') }}>
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="fa-solid fa-gear"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">@lang('messages.settings')</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout', app()->getLocale()) }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">@lang('messages.logout')</p>
                                    </div>
                                </button>
                                <div class="dropdown-divider"></div>
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')

            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->

<script src="{{ asset('backend/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('backend/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('backend/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('backend/assets/js/misc.js') }}"></script>
<script src="{{ asset('backend/assets/js/settings.js') }}"></script>
<script src="{{ asset('backend/assets/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('backend/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> --}}
<script src="{{ asset('backend/assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/file-upload.js') }}"></script>
<script src="{{ asset('backend/assets/js/typeahead.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2.js') }}"></script>
</script>
<!-- End custom js for this page -->
@yield('script')
</body>


</html>

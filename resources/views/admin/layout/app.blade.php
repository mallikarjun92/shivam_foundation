<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('favicon.png')}}" rel="icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
            height: 100% !important;
            overflow-y: auto;
            position: fixed;

            /* Hide scrollbar – Firefox */
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        /* Hide scrollbar – Chrome, Edge, Safari */
        .sidebar::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
        /* Hide scrollbar by default */
        .sidebar::-webkit-scrollbar {
            width: 0;
        }

        /* Show scrollbar on hover */
        .sidebar:hover::-webkit-scrollbar {
            width: 8px;
        }

        /* Scrollbar track */
        .sidebar::-webkit-scrollbar-track {
            background: #1e1e1e;
        }

        /* Scrollbar thumb */
        .sidebar::-webkit-scrollbar-thumb {
            background: #555;
            border-radius: 8px;
            border: 2px solid #1e1e1e;
        }

        /* Hover effect for thumb */
        .sidebar:hover::-webkit-scrollbar-thumb {
            background: #777;
        }

        /* Firefox support */
        .sidebar {
            scrollbar-width: none; /* hidden by default */
        }

        .sidebar:hover {
            scrollbar-width: thin;               
            scrollbar-color: #555 #1e1e1e;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1rem;
            margin: 0.125rem 0;
            border-radius: 0.375rem;
        }
        .sidebar .badge {
            font-size: 0.7rem;
            padding: 4px 6px;
            border-radius: 8px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
        }
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s;
        }
        @media (min-width: 768px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .card-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse position-fixed" id="sidebar" style="width: fit-content;">
                <div class="position-sticky pt-3">
                    <div class="px-3 pb-2 mb-3 border-bottom">
                        <h5 class="text-white">Admin Panel</h5>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-door"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}" 
                               href="{{ route('admin.blogs.index') }}">
                                <i class="bi bi-journal-text"></i> Blogs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" 
                               href="{{ route('admin.events.index') }}">
                                <i class="bi bi-calendar-event"></i> Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.volunteers.*') ? 'active' : '' }}" 
                               href="{{ route('admin.volunteers.index') }}">
                                <i class="bi bi-people"></i> Volunteers
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.causes.*') ? 'active' : '' }}" 
                               href="#">
                                <i class="bi bi-heart"></i> Causes
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}" 
                               href="{{ route('admin.galleries.index') }}">
                                <i class="bi bi-images"></i> Gallery
                            </a>
                        </li>
                        
                        @php
                            $unreadCount = \App\Models\Contact::where('is_new', true)->count();
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" 
                               href="{{ route('admin.contacts.index') }}">
                                <i class="bi bi-envelope"></i> Contact Messages
                                @if($unreadCount > 0)
                                    <span class="badge bg-danger">{{ $unreadCount }}</span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.donations.*') ? 'active' : '' }}" 
                               href="{{ route('admin.donations.index') }}">
                                <i class="bi bi-wallet-fill"></i> Donations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}" 
                               href="{{ route('admin.hero.index') }}">
                                <i class="bi bi-image"></i> Hero Content
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.donors.*') ? 'active' : '' }}" 
                               href="{{ route('admin.donors.index') }}">
                                <i class="bi bi-image"></i> Featured Donors
                            </a>
                        </li> --}}

                        @php
                            $newEnrollmentsCount = \App\Models\ProgramsEnrollment::where('is_new', true)->count();
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.programs-enrollments.*') ? 'active' : '' }}" 
                               href="{{ route('admin.programs-enrollments.index') }}">
                                <i class="bi bi-people"></i> Program Enrollments
                                @if($newEnrollmentsCount > 0)
                                    <span class="badge bg-danger">{{ $newEnrollmentsCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}" 
                               href="{{ route('admin.statistics.index') }}">
                                <i class="bi bi-people"></i> Statistics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.impact-reports.*') ? 'active' : '' }}" 
                               href="{{ route('admin.impact-reports.index') }}">
                                <i class="bi bi-journal-text"></i> Impact Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}" 
                               href="{{ route('admin.teams.index') }}">
                                <i class="bi bi-people"></i> Manage Teams
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.maintenance.*') ? 'active' : '' }}" 
                            href="{{ route('admin.maintenance.index') }}">
                                <i class="bi bi-wrench"></i> Maintenance
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.maintenance.migrations') }}">
                                <i class="bi bi-database-gear"></i> Database Migrations
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-start w-100">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('header', 'Dashboard')</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    
    <script>
        // Initialize CSRF token for AJAX requests
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
        
        // Set up CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Helpdesk System</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    {{-- Top Navbar --}}
    <nav class="navbar top-navbar px-4">
        <div class="container-fluid">

            <a href="#" class="brand">
                <i class="bi bi-headset me-2"></i>
                Helpdesk System
            </a>

            <div class="d-flex align-items-center gap-4">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i>
                        Admin
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/login/logout">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>


    {{-- Sidebar --}}
    <aside class="sidebar">

        <div class="sidebar-heading">Main Menu</div>

        <a href="/dashboard" class="sidebar-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>


        {{-- All Inbox --}}
        <div class="sidebar-menu">

            <div class="d-flex align-items-center">

                {{-- Main link: navigates to all inbox --}}
                <a href="/tickets" class="sidebar-link flex-grow-1 {{ request()->is('tickets*') ? 'active' : '' }}">
                    <i class="bi bi-inbox"></i>
                    <span>All Inbox</span>
                </a>

                {{-- Dropdown toggle --}}
                <button class="sidebar-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#inboxSubmenu"
                    aria-expanded="{{ request()->is('tickets*') ? 'true' : 'false' }}" aria-controls="inboxSubmenu">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>

            {{-- Submenu --}}
            <div class="collapse {{ request()->is('tickets*') ? 'show' : '' }}" id="inboxSubmenu">

                <div class="ms-4">

                    <a href="/tickets?status=open" class="sidebar-link">
                        <i class="bi bi-circle"></i>
                        <span>Open</span>
                    </a>

                    <a href="/tickets?status=assigned" class="sidebar-link">
                        <i class="bi bi-person-check"></i>
                        <span>Assigned</span>
                    </a>

                    <a href="/tickets?status=closed" class="sidebar-link">
                        <i class="bi bi-check-circle"></i>
                        <span>Closed</span>
                    </a>

                </div>
            </div>

        </div>


        <a href="/tickets/create" class="sidebar-link">
            <i class="bi bi-plus-circle"></i>
            <span>Submit Ticket</span>
        </a>


        <div class="sidebar-heading">Management</div>

        <a href="#" class="sidebar-link {{ request()->routeIs('category.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            <span>Categories</span>
        </a>

        <a href="#" class="sidebar-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Users</span>
        </a>

        <a href="#" class="sidebar-link {{ request()->routeIs('setting.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span>Settings</span>
        </a>

    </aside>


    {{-- Main Content --}}
    <main class="main-content">

        @yield('content')

    </main>


    {{-- Bootstrap JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
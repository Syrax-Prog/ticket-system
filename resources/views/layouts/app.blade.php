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

        <a href="#" class="sidebar-link">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a href="/tickets" class="sidebar-link active">
            <i class="bi bi-ticket-perforated"></i>
            <span>All Tickets</span>
        </a>

        <a href="/tickets/create" class="sidebar-link">
            <i class="bi bi-plus-circle"></i>
            <span>Submit Ticket</span>
        </a>


        <div class="sidebar-heading">Management</div>

        <a href="#" class="sidebar-link">
            <i class="bi bi-tags"></i>
            <span>Categories</span>
        </a>

        <a href="#" class="sidebar-link">
            <i class="bi bi-people"></i>
            <span>Users</span>
        </a>

        <a href="#" class="sidebar-link">
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
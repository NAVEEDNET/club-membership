<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   

    <link rel="icon" href="{{ asset('annoor.png') }}">
    <title>Admin Portal - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { overflow-x: hidden; }
        .sidebar { width: 220px; height: 100vh; background: #343a40; color: #fff; }
        .sidebar a { color: #fff; text-decoration: none; }
        .sidebar a:hover { background: #495057; color: #fff; }
        .content { margin-left: 220px; padding: 20px; }
        .navbar-custom { background: #007bff; color: #fff; }
    </style>
     
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3 position-fixed">
        <h4 class="text-center mb-4">Club Admin</h4>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-2"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
            <li class="nav-item mb-2"><a href="{{ route('admin.members.create') }}" class="nav-link">Add Member</a></li>
            <li class="nav-item mb-2"><a href="{{ route('admin.members.index') }}" class="nav-link">View Members</a></li>
            <li class="nav-item mb-2"><a href="{{ route('admin.logout') }}" class="nav-link text-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a></li>
        </ul>
    </div>

    <!-- Logout Form (hidden) -->
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- Main Content -->
    <div class="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand navbar-custom mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">@yield('page-title')</span>
                <div class="d-flex">
                    <span class="me-3">Admin: {{ auth('admin')->user()?->name ?? 'Guest' }}</span>
                    <a href="{{ route('admin.logout') }}" class="btn btn-sm btn-light"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        @yield('content')
    </div>

</body>
</html>

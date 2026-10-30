<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') | Golden Blade</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">
    <aside class="sidebar">
        <a href="{{ route('home') }}" class="sidebar-brand">
            GOLDEN BLADE <small>HAIR CUTTING CENTER</small>
        </a>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">Services</a>
            <a href="{{ route('admin.staff.index') }}" class="{{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">Staff</a>
            <a href="{{ route('admin.assignments.index') }}" class="{{ request()->routeIs('admin.assignments.*') ? 'active' : '' }}">Staff-Service Assignment</a>
            @php
                $__newAppts = auth()->user()->unreadNotifications->filter(fn ($n) => isset($n->data['appointment_id']))->count();
                $__newMsgs  = \App\Models\ContactMessage::whereNull('read_at')->count();
            @endphp
            <a href="{{ route('admin.appointments.index') }}" class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">Appointments @if($__newAppts)<span class="nav-badge">{{ $__newAppts }}</span>@endif</a>
            <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">Messages @if($__newMsgs)<span class="nav-badge">{{ $__newMsgs }}</span>@endif</a>
            <a href="{{ route('home') }}">View Website</a>
        </nav>
        <form action="{{ route('logout') }}" method="POST" class="sidebar-logout">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </aside>

    <div class="admin-main">
        <div class="admin-topbar">
            @include('partials.notification-bell')
            <span>{{ auth()->user()->name }} (Admin)</span>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    <div id="confirm-modal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h3>Are you sure?</h3>
        <p id="confirm-text">This action cannot be undone.</p>
        <div class="modal-actions">
            <button type="button" id="confirm-cancel" class="btn btn-outline">Cancel</button>
            <button type="button" id="confirm-ok" class="btn btn-danger">Yes, Delete</button>
        </div>
    </div>
</div>

<button type="button" class="admin-menu-btn" id="admin-menu-btn" aria-label="Menu">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
</button>

<script>
    let pendingForm = null;
    const modal = document.getElementById('confirm-modal');

    document.querySelectorAll('form.delete-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            pendingForm = form;
            document.getElementById('confirm-text').textContent =
                form.dataset.message || 'This action cannot be undone.';
            modal.style.display = 'flex';
        });
    });

    document.getElementById('confirm-cancel').addEventListener('click', function () {
        modal.style.display = 'none';
        pendingForm = null;
    });

    document.getElementById('confirm-ok').addEventListener('click', function () {
        if (pendingForm) pendingForm.submit();
    });
</script>

<script>
    document.getElementById('admin-menu-btn').addEventListener('click', function () {
        document.querySelector('.sidebar').classList.toggle('open');
    });
</script>
<script>
    document.querySelectorAll('.alert-success, .alert-error').forEach(function (el) {
        setTimeout(function () {
            el.classList.add('alert-hide');
            setTimeout(function () { el.remove(); }, 500);
        }, 4000);
    });
</script>
</body>
</html>

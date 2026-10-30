<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Golden Blade Hair Cutting Center')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
    document.querySelectorAll('.alert-success, .alert-error').forEach(function (el) {
        setTimeout(function () {
            el.classList.add('alert-hide');
            setTimeout(function () { el.remove(); }, 500);
        }, 4000);
    });
</script>

<div id="confirm-modal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h3>Are you sure?</h3>
        <p id="confirm-text">This action cannot be undone.</p>
        <div class="modal-actions">
            <button type="button" id="confirm-cancel" class="btn btn-outline">No, Keep It</button>
            <button type="button" id="confirm-ok" class="btn btn-danger">Yes, Cancel</button>
        </div>
    </div>
</div>

<script>
    let pendingForm = null;
    const modal = document.getElementById('confirm-modal');

    document.querySelectorAll('form.confirm-form').forEach(function (form) {
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
    document.querySelectorAll('.toggle-eye').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const input = document.getElementById(btn.dataset.target);
            input.type = input.type === 'password' ? 'text' : 'password';
            btn.style.color = input.type === 'text' ? 'var(--forest)' : '';
        });
    });
</script>

<script>
    document.getElementById('nav-toggle').addEventListener('click', function () {
        document.getElementById('site-header').classList.toggle('open');
    });
</script>
</body>
</html>

@auth
@php
    $__unread = auth()->user()->unreadNotifications()->count();
    $__items  = auth()->user()->notifications()->latest()->take(8)->get();
@endphp
<link rel="stylesheet" href="{{ asset('css/notifications.css') }}">

<div class="notif" id="notif">
    <button type="button" class="notif-btn" id="notif-btn" aria-label="Notifications" aria-expanded="false">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.7 21a2 2 0 0 1-3.4 0"/></svg>
        <span class="notif-badge" id="notif-badge" @if(!$__unread) hidden @endif>{{ $__unread }}</span>
    </button>

    <div class="notif-panel" id="notif-panel" hidden>
        <div class="notif-head">
            <strong>Notifications</strong>
            @if($__unread)
                <form method="POST" action="{{ route('notifications.readAll') }}">
                    @csrf
                    <button type="submit" class="notif-link">Mark all as read</button>
                </form>
            @endif
        </div>
        <div class="notif-list">
            @forelse($__items as $n)
                <a href="{{ route('notifications.open', $n->id) }}" class="notif-item {{ $n->read_at ? '' : 'unread' }}">
                    <span class="t">{{ $n->data['title'] ?? 'Notification' }}</span>
                    <span class="m">{{ $n->data['message'] ?? '' }}</span>
                    <span class="d">{{ $n->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <p class="notif-empty">No notifications yet.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="notif-toast" id="notif-toast"></div>

<script>
(function () {
    var btn = document.getElementById('notif-btn');
    var panel = document.getElementById('notif-panel');
    var badge = document.getElementById('notif-badge');
    var toast = document.getElementById('notif-toast');
    var last = {{ (int) $__unread }};

    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        panel.hidden = !panel.hidden;
        btn.setAttribute('aria-expanded', String(!panel.hidden));
    });
    document.addEventListener('click', function (e) {
        if (!panel.hidden && !panel.contains(e.target)) { panel.hidden = true; }
    });

    // check for new notifications every 20 seconds (no page reload needed)
    function poll() {
        if (document.hidden) return;
        fetch(@json(route('notifications.count')), {headers: {'Accept': 'application/json'}, credentials: 'same-origin'})
            .then(function (r) { return r.ok ? r.json() : null; })
            .then(function (d) {
                if (!d) return;
                badge.textContent = d.count;
                badge.hidden = d.count === 0;
                if (d.count > last && d.latest) {
                    toast.textContent = d.latest + ' - reload the page to see details';
                    toast.classList.add('show');
                    setTimeout(function () { toast.classList.remove('show'); }, 8000);
                }
                last = d.count;
            })
            .catch(function () {});
    }
    setInterval(poll, 20000);
})();
</script>
@endauth

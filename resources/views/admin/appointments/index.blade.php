@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<h1>All Appointments</h1>

<form method="GET" action="{{ route('admin.appointments.index') }}" class="search-form" style="margin-bottom:16px;">
    <select name="status" onchange="this.form.submit()">
        <option value="">All Statuses</option>
        @foreach($statuses as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <input type="date" name="date" value="{{ request('date') }}" onchange="this.form.submit()">
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline">Reset</a>
</form>

<table class="data">
    <tr><th>#</th><th>Customer</th><th>Service</th><th>Barber</th><th>Date & Time</th><th>Status</th><th>Action</th></tr>
    @forelse($appointments as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td>{{ $a->user->name }}</td>
            <td>{{ $a->service->name }}</td>
            <td>{{ $a->staff->name }}</td>
            <td>{{ $a->appointment_date }} {{ $a->appointment_time }}</td>
            <td><span class="status status-{{ strtolower($a->status) }}">{{ $a->status }}</span></td>
            <td>
                @if($a->status === 'Pending')
                    <form action="{{ route('admin.appointments.update', $a) }}" method="POST" style="display:inline;">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="Confirmed">
                        <button type="submit" class="btn btn-gold btn-sm">Confirm</button>
                    </form>
                    <form action="{{ route('admin.appointments.update', $a) }}" method="POST" style="display:inline;">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="Cancelled">
                        <button type="submit" class="btn btn-outline btn-sm">Cancel</button>
                    </form>
                @endif
                <a href="{{ route('admin.appointments.edit', $a) }}" class="btn btn-outline btn-sm">Details</a>
                <button type="button" class="btn btn-danger btn-sm js-delete"
                        data-action="{{ route('admin.appointments.destroy', $a) }}"
                        data-id="{{ $a->id }}"
                        data-customer="{{ $a->user->name }}">Delete</button>
            </td>
        </tr>
    @empty
        <tr><td colspan="7">No appointments found.</td></tr>
    @endforelse
</table>

<div style="margin-top:16px;">{{ $appointments->links() }}</div>

{{-- Delete confirmation dialog --}}
<style>
    .dlg-overlay{position:fixed;inset:0;background:rgba(0,0,0,.65);display:none;align-items:center;justify-content:center;z-index:9999;padding:16px;}
    .dlg-overlay.open{display:flex;}
    .dlg-box{background:#1a1f2b;color:#e8e8e8;border:1px solid #c9a24b;border-radius:12px;max-width:420px;width:100%;padding:28px 26px 22px;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.6);animation:dlgIn .18s ease-out;}
    @keyframes dlgIn{from{opacity:0;transform:translateY(8px) scale(.97);}to{opacity:1;transform:none;}}
    .dlg-icon{width:54px;height:54px;border-radius:50%;background:rgba(220,53,69,.15);color:#ff5c6c;font-size:28px;line-height:54px;margin:0 auto 14px;}
    .dlg-box h3{margin:0 0 8px;font-size:20px;color:#fff;}
    .dlg-box p{margin:0 0 22px;color:#b8bcc6;font-size:14px;line-height:1.5;}
    .dlg-actions{display:flex;gap:10px;justify-content:center;}
    .dlg-actions .btn{min-width:110px;cursor:pointer;}
</style>

<div class="dlg-overlay" id="deleteDialog" role="dialog" aria-modal="true" aria-labelledby="dlgTitle">
    <div class="dlg-box">
        <div class="dlg-icon">&#9888;</div>
        <h3 id="dlgTitle">Delete appointment?</h3>
        <p id="dlgText"></p>
        <form method="POST" id="deleteForm" class="dlg-actions">
            @csrf @method('DELETE')
            <button type="button" class="btn btn-outline" id="dlgCancel">No, keep it</button>
            <button type="submit" class="btn btn-danger">Yes, delete</button>
        </form>
    </div>
</div>

<script>
(function () {
    var dialog = document.getElementById('deleteDialog');
    var form = document.getElementById('deleteForm');
    var text = document.getElementById('dlgText');

    function openDialog(btn) {
        form.action = btn.dataset.action;
        text.textContent = 'Appointment #' + btn.dataset.id + ' (' + btn.dataset.customer + ') will be permanently deleted. This cannot be undone.';
        dialog.classList.add('open');
        document.getElementById('dlgCancel').focus();
    }
    function closeDialog() { dialog.classList.remove('open'); }

    document.querySelectorAll('.js-delete').forEach(function (b) {
        b.addEventListener('click', function () { openDialog(b); });
    });
    document.getElementById('dlgCancel').addEventListener('click', closeDialog);
    dialog.addEventListener('click', function (e) { if (e.target === dialog) closeDialog(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeDialog(); });
})();
</script>
@endsection
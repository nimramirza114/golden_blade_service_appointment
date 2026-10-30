@extends('layouts.admin')

@section('title', 'Edit Staff')

@section('content')
<h1>Edit Staff</h1>
<form action="{{ route('admin.staff.update', $staff) }}" method="POST" enctype="multipart/form-data" class="card" style="max-width:600px;">
    @csrf
    @method('PUT')
    @include('admin.staff._form')
</form>
@endsection

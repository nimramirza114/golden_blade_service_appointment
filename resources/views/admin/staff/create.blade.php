@extends('layouts.admin')

@section('title', 'Add Staff')

@section('content')
<h1>Add Staff</h1>
<form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data" class="card" style="max-width:600px;">
    @csrf
    @include('admin.staff._form')
</form>
@endsection

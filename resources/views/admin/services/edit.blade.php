@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<h1>Edit Service</h1>
<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="card" style="max-width:600px;">
    @csrf
    @method('PUT')
    @include('admin.services._form')
</form>
@endsection

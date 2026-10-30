@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<h1>Add Service</h1>
<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="card" style="max-width:600px;">
    @csrf
    @include('admin.services._form')
</form>
@endsection

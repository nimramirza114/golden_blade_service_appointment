@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<h1>Edit Category</h1>
<form action="{{ route('admin.categories.update', $category) }}" method="POST" class="card" style="max-width:600px;">
    @csrf
    @method('PUT')
    @include('admin.categories._form')
</form>
@endsection

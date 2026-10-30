@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<h1>Add Category</h1>
<form action="{{ route('admin.categories.store') }}" method="POST" class="card" style="max-width:600px;">
    @csrf
    @include('admin.categories._form')
</form>
@endsection

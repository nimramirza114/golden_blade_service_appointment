@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="page-head">
    <h1>Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-gold">Add Category</a>
</div>

<table class="data">
    <tr><th>#</th><th>Name</th><th>Description</th><th>Services</th><th>Actions</th></tr>
    @forelse($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->services_count }}</td>
            <td>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline btn-sm">Edit</a>
                 <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
      class="inline-form delete-form"
      data-message="Delete category '{{ $category->name }}'?">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
</form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5">No categories yet.</td></tr>
    @endforelse
</table>
@endsection

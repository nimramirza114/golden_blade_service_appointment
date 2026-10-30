<label>Name</label>
<input type="text" name="name" value="{{ old('name', $category->name ?? '') }}">
@error('name') <span class="error">{{ $message }}</span> @enderror

<label>Description</label>
<textarea name="description" rows="3">{{ old('description', $category->description ?? '') }}</textarea>
@error('description') <span class="error">{{ $message }}</span> @enderror

<button type="submit" class="btn btn-gold">Save</button>
<a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Cancel</a>

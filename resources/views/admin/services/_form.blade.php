<label>Category</label>
<select name="category_id">
    <option value="">-- Select category --</option>
    @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id', $service->category_id ?? '') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
    @endforeach
</select>
@error('category_id') <span class="error">{{ $message }}</span> @enderror

<label>Name</label>
<input type="text" name="name" value="{{ old('name', $service->name ?? '') }}">
@error('name') <span class="error">{{ $message }}</span> @enderror

<label>Description</label>
<textarea name="description" rows="3">{{ old('description', $service->description ?? '') }}</textarea>
@error('description') <span class="error">{{ $message }}</span> @enderror

<label>Price (PKR)</label>
<input type="text" name="price" value="{{ old('price', $service->price ?? '') }}">
@error('price') <span class="error">{{ $message }}</span> @enderror

<label>Duration (minutes)</label>
<input type="text" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes ?? '') }}">
@error('duration_minutes') <span class="error">{{ $message }}</span> @enderror

<label>Image (optional, jpg/png, max 2MB)</label>
@if(!empty($service->image))
    <img src="{{ asset('storage/' . $service->image) }}" alt="" style="width:120px;border-radius:6px;display:block;margin-bottom:8px;">
@endif
<input type="file" name="image">
@error('image') <span class="error">{{ $message }}</span> @enderror

<button type="submit" class="btn btn-gold">Save</button>
<a href="{{ route('admin.services.index') }}" class="btn btn-outline">Cancel</a>

<label>Name</label>
<input type="text" name="name" value="{{ old('name', $staff->name ?? '') }}">
@error('name') <span class="error">{{ $message }}</span> @enderror

<label>Email</label>
<input type="text" name="email" value="{{ old('email', $staff->email ?? '') }}">
@error('email') <span class="error">{{ $message }}</span> @enderror

 @php
    $fullPhone = old('phone_code') . old('phone_number');
    $existing = isset($staff) ? preg_replace('/^\+92/', '', $staff->phone) : '';
    $code = old('phone_code', substr($existing, 0, 3));
    $number = old('phone_number', substr($existing, 3));
@endphp

<label>Phone</label>
<div class="phone-group">
    <span class="phone-prefix">+92</span>
    <input type="text" name="phone_code" class="phone-code" inputmode="numeric" maxlength="3"
           placeholder="300" value="{{ $code }}"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
    <input type="text" name="phone_number" class="phone-number" inputmode="numeric" maxlength="7"
           placeholder="1234567" value="{{ $number }}"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
</div>
@error('phone_code') <span class="error">{{ $message }}</span> @enderror
@error('phone_number') <span class="error">{{ $message }}</span> @enderror

<label for="image">Photo</label>

@if(isset($staff) && $staff->image)
    <img src="{{ asset('storage/' . $staff->image) }}" alt="{{ $staff->name }}"
         style="width:110px;height:140px;object-fit:cover;border-radius:8px;margin-bottom:10px;display:block;">
@endif

<input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp">
<small style="display:block;margin-top:6px;color:#6b645a;">JPG, PNG or WEBP, up to 2 MB. Portrait photo works best. Leave empty to keep the current photo.</small>
@error('image') <span class="error">{{ $message }}</span> @enderror


<button type="submit" class="btn btn-gold">Save</button>
<a href="{{ route('admin.staff.index') }}" class="btn btn-outline">Cancel</a>

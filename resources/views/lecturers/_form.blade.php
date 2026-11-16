@php
    $isEditing = isset($lecturer);
@endphp

<form
    action="{{ $isEditing ? route('lecturers.update', $lecturer->id) : route('lecturers.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if ($isEditing)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">User account</label>
        <select name="user_id" class="form-select" required>
            <option value="">Choose a user</option>

            @foreach ($users as $user)
                <option
                    value="{{ $user->id }}"
                    {{ old('user_id', $lecturer->user_id ?? '') == $user->id ? 'selected' : '' }}
                >
                    {{ $user->name }} — {{ $user->email }}
                </option>
            @endforeach
        </select>
        @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Employee number</label>
        <input
            type="text"
            name="employee_number"
            class="form-control"
            value="{{ old('employee_number', $lecturer->employee_number ?? '') }}"
            required
        >
        @error('employee_number') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Department</label>
        <input
            type="text"
            name="department"
            class="form-control"
            value="{{ old('department', $lecturer->department ?? '') }}"
            required
        >
        @error('department') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Academic rank</label>
        <input
            type="text"
            name="academic_rank"
            class="form-control"
            value="{{ old('academic_rank', $lecturer->academic_rank ?? '') }}"
            required
        >
        @error('academic_rank') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Office room</label>
        <input
            type="text"
            name="office_room"
            class="form-control"
            value="{{ old('office_room', $lecturer->office_room ?? '') }}"
            required
        >
        @error('office_room') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select" required>
            <option value="1" {{ old('is_active', $lecturer->is_active ?? '1') == '1' ? 'selected' : '' }}>
                Active
            </option>
            <option value="0" {{ old('is_active', $lecturer->is_active ?? '1') == '0' ? 'selected' : '' }}>
                Inactive
            </option>
        </select>
        @error('is_active') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    @if ($isEditing && $lecturer->photo)
        <div class="mb-3">
            <label class="form-label">Current photo</label><br>
            <img
                src="{{ asset('storage/' . $lecturer->photo) }}"
                alt="Lecturer photo"
                width="120"
            >
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">
            {{ $isEditing ? 'Choose a new photo (optional)' : 'Photo (optional)' }}
        </label>
        <input
            type="file"
            name="photo"
            class="form-control"
            accept="image/*"
        >
        @error('photo') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $isEditing ? 'Update Lecturer' : 'Save Lecturer' }}
    </button>

    <a href="{{ route('lecturers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
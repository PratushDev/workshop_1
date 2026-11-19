@props(['course' => null])

<x-form-input name="name" label="Course Name" :value="$course?->name" required maxlength="255" />

<x-form-textarea name="description" label="Description" :value="$course?->description" />

<x-form-input name="duration" label="Duration (weeks)" type="number" :value="$course?->duration" required min="1" />

<x-form-input name="fee" label="Fee" type="number" :value="$course?->fee" required min="0" step="0.01" />

<div class="form-group">
    <label for="difficulty">Difficulty</label>
    <select id="difficulty" name="difficulty" required>
        <option value="">-- Select difficulty --</option>
        @foreach (['Easy', 'Medium', 'Hard'] as $level)
            <option value="{{ $level }}" @selected(old('difficulty', $course?->difficulty) === $level)>{{ $level }}</option>
        @endforeach
    </select>
    @error('difficulty')
        <span class="error">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <input type="hidden" name="is_active" value="0">
    <label>
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $course?->is_active ?? true))>
        Active
    </label>
    @error('is_active')
        <span class="error">{{ $message }}</span>
    @enderror
</div>

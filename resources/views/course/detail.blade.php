<x-layouts.app :title="$course->name">
    <h1>{{ $course->name }}</h1>

    <table class="detail-table">
        <tr>
            <th>Description</th>
            <td>{{ $course->description ?? 'Not available' }}</td>
        </tr>
        <tr>
            <th>Duration</th>
            <td>{{ $course->duration }} weeks</td>
        </tr>
        <tr>
            <th>Fee</th>
            <td>{{ $course->fee }}</td>
        </tr>
        <tr>
            <th>Difficulty</th>
            <td>{{ $course->difficulty }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $course->is_active ? 'Active' : 'Inactive' }}</td>
        </tr>
    </table>

    <div class="actions">
        <a href="{{ route('courses.edit', $course) }}" class="btn">Edit</a>
        <x-delete-form :action="route('courses.destroy', $course)" />
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to list</a>
    </div>
</x-layouts.app>

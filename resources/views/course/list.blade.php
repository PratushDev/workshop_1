<x-layouts.app title="Courses">
    <div class="page-header">
        <h1>Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn">Add Course</a>
    </div>

    @if ($courses->isEmpty())
        <p>No courses found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Fee</th>
                    <th>Difficulty</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->duration }} weeks</td>
                        <td>{{ $course->fee }}</td>
                        <td>{{ $course->difficulty }}</td>
                        <td>{{ $course->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-small">View</a>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-small">Edit</a>
                            <x-delete-form :action="route('courses.destroy', $course)" class="btn-small" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layouts.app>

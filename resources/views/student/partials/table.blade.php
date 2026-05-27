<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Degree</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->userAccount?->username }}</td>
                    <td>{{ $student->degree?->degree_title ?? 'Not assigned' }}</td>
                    <td>{{ $student->contactno }}</td>
                    <td class="actions">
                        <a href="{{ route('student.show', $student) }}">View</a>
                        <a href="{{ route('student.edit', $student) }}">Edit</a>
                        <button type="button" class="btn-link danger delete-student-btn" data-id="{{ $student->id }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $students->links() }}
</div>

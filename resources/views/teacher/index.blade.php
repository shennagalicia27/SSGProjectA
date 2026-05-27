@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Teachers</h1>
            </div>
            <a href="{{ route('teacher.create') }}" class="btn">Add Teacher</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->full_name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->userAccount?->username }}</td>
                            <td>{{ $teacher->contactno }}</td>
                            <td class="actions">
                                <a href="{{ route('teacher.show', $teacher) }}">View</a>
                                <a href="{{ route('teacher.edit', $teacher) }}">Edit</a>
                                <form method="POST" action="{{ route('teacher.destroy', $teacher) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-link danger" onclick="return confirm('Delete this teacher?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">No teachers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $teachers->links() }}
    </section>
@endsection

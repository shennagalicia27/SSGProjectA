@extends('layouts.app')

@section('content')
    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Admin Management</p>
                <h1>Degrees</h1>
            </div>
            <a href="{{ route('degree.create') }}" class="btn">Add Degree</a>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($degrees as $degree)
                        <tr>
                            <td>{{ $degree->degree_title }}</td>
                            <td>{{ $degree->created_at?->format('M d, Y') }}</td>
                            <td class="actions">
                                <a href="{{ route('degree.show', $degree) }}">View</a>
                                <a href="{{ route('degree.edit', $degree) }}">Edit</a>
                                <form method="POST" action="{{ route('degree.destroy', $degree) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-link danger" onclick="return confirm('Delete this degree?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-state">No degrees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $degrees->links() }}
    </section>
@endsection

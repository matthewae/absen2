@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Work Progress</h5>
                    @can('create', App\Models\WorkProgress::class)
                    <a href="{{ route('work-progress.create') }}" class="btn btn-primary">Create New</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('work-progress.index') }}" method="GET" class="d-flex gap-2">
                            <select name="status" class="form-select w-auto">
                                <option value="">All Status</option>
                                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="On Progress" {{ request('status') === 'On Progress' ? 'selected' : '' }}>On Progress</option>
                                <option value="Revision" {{ request('status') === 'Revision' ? 'selected' : '' }}>Revision</option>
                                <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <button type="submit" class="btn btn-secondary">Filter</button>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Staff</th>
                                    <th>Status</th>
                                    <th>Files</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($workProgresses as $progress)
                                <tr>
                                    <td>{{ $progress->title }}</td>
                                    <td>{{ $progress->staff->user->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $progress->status === 'completed' ? 'success' : ($progress->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($progress->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $progress->files->count() }}</td>
                                    <td>{{ $progress->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('view', $progress)
                                            <a href="{{ route('work-progress.show', $progress) }}" class="btn btn-sm btn-info">View</a>
                                            @endcan
                                            @can('update', $progress)
                                            <a href="{{ route('work-progress.edit', $progress) }}" class="btn btn-sm btn-primary">Edit</a>
                                            @endcan
                                            @can('delete', $progress)
                                            <form action="{{ route('work-progress.destroy', $progress) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No work progress found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $workProgresses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
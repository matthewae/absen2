@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('create', App\Models\WorkProgress::class)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Quick Add Work Progress</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('work-progress.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="project_topic" class="form-label">Project Topic</label>
                                <input type="text" class="form-control @error('project_topic') is-invalid @enderror" id="project_topic" name="project_topic" value="{{ old('project_topic') }}" required>
                                @error('project_topic')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                                @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="files" class="form-label">Attachments</label>
                                <input type="file" class="form-control @error('files.*') is-invalid @enderror" id="files" name="files[]" multiple>
                                @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="work_description" class="form-label">Work Description</label>
                            <textarea class="form-control @error('work_description') is-invalid @enderror" id="work_description" name="work_description" rows="3" required>{{ old('work_description') }}</textarea>
                            @error('work_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit Work Progress</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcan

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
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
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
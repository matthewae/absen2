@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Work Progress Details</h5>
                        <div>
                            @can('update', $workProgress)
                            <a href="{{ route('work-progress.edit', $workProgress) }}" class="btn btn-primary">Edit</a>
                            @endcan
                            <a href="{{ route('work-progress.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">Title</h6>
                        <p>{{ $workProgress->title }}</p>

                        <h6 class="fw-bold">Description</h6>
                        <p>{{ $workProgress->description }}</p>

                        <h6 class="fw-bold">Status</h6>
                        <p>
                            <span class="badge bg-{{ $workProgress->status === 'completed' ? 'success' : ($workProgress->status === 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($workProgress->status) }}
                            </span>
                        </p>

                        <h6 class="fw-bold">Staff</h6>
                        <p>{{ $workProgress->staff->user->name }}</p>

                        @if($workProgress->feedback)
                        <h6 class="fw-bold">Feedback</h6>
                        <p>{{ $workProgress->feedback }}</p>
                        @endif

                        <h6 class="fw-bold">Created At</h6>
                        <p>{{ $workProgress->created_at->format('Y-m-d H:i') }}</p>

                        <h6 class="fw-bold">Last Updated</h6>
                        <p>{{ $workProgress->updated_at->format('Y-m-d H:i') }}</p>
                    </div>

                    @if($workProgress->files->count() > 0)
                    <div class="mb-3">
                        <h6 class="fw-bold">Attachments</h6>
                        <div class="list-group">
                            @foreach($workProgress->files as $file)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ route('work-progress.files.stream', $file) }}" target="_blank" class="text-decoration-none">
                                        {{ $file->original_name }}
                                    </a>
                                    <small class="text-muted ms-2">({{ number_format($file->file_size / 1024, 2) }} KB)</small>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('work-progress.files.download', $file) }}" class="btn btn-sm btn-secondary">Download</a>
                                    @can('delete', $file)
                                    <form action="{{ route('work-progress.files.destroy', $file) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
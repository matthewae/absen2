@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Work Progress</h5>
                        <a href="{{ route('work-progress.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('work-progress.update', $workProgress) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $workProgress->title) }}" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $workProgress->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @can('update', $workProgress)
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="pending" {{ old('status', $workProgress->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status', $workProgress->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $workProgress->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="rejected" {{ old('status', $workProgress->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea class="form-control @error('feedback') is-invalid @enderror" id="feedback" name="feedback" rows="3">{{ old('feedback', $workProgress->feedback) }}</textarea>
                            @error('feedback')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endcan

                        <div class="mb-3">
                            <label for="files" class="form-label">Add New Attachments</label>
                            <input type="file" class="form-control @error('files.*') is-invalid @enderror" id="files" name="files[]" multiple>
                            <div class="form-text">You can upload multiple files. Maximum size per file: 10MB</div>
                            @error('files.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($workProgress->files->count() > 0)
                        <div class="mb-3">
                            <label class="form-label">Current Attachments</label>
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

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Work Progress</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
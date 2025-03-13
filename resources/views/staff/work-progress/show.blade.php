@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Work Progress Details</h1>
        <a href="{{ route('staff.work-progress.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Work Progress Information</h5>
                    <dl class="row">
                        <dt class="col-sm-4">Title</dt>
                        <dd class="col-sm-8">{{ $workProgress->title }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge badge-{{ $workProgress->status === 'completed' ? 'success' : ($workProgress->status === 'revision' ? 'warning' : 'info') }}">
                                {{ $workProgress->status }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Submitted</dt>
                        <dd class="col-sm-8">{{ $workProgress->created_at->format('Y-m-d H:i') }}</dd>
                    </dl>
                </div>

                <div class="col-md-12 mt-4">
                    <h5>Description</h5>
                    <div class="border rounded p-3 bg-light">
                        {{ $workProgress->description }}
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <h5>Attached Files</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workProgress->files as $file)
                                    <tr>
                                        <td>{{ $file->original_name }}</td>
                                        <td>{{ $file->mime_type }}</td>
                                        <td>{{ number_format($file->size / 1024 / 1024, 2) }} MB</td>
                                        <td>
                                            <a href="{{ route('staff.work-progress.download-file', $file) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No files attached</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create Work Progress</h5>
                        <a href="{{ route('work-progress.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('work-progress.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="project_topic" class="form-label">Project Topic</label>
                            <input type="text" class="form-control @error('project_topic') is-invalid @enderror" id="project_topic" name="project_topic" value="{{ old('project_topic') }}" required>
                            @error('project_topic')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                            @error('company_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="work_description" class="form-label">Work Description</label>
                            <textarea class="form-control @error('work_description') is-invalid @enderror" id="work_description" name="work_description" rows="4" required>{{ old('work_description') }}</textarea>
                            <div class="form-text">Please provide at least 100 characters of description.</div>
                            @error('work_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="files" class="form-label">Attachments</label>
                            <input type="file" class="form-control @error('files.*') is-invalid @enderror" id="files" name="files[]" multiple>
                            <div class="form-text">You can upload multiple files. Maximum size per file: 10MB</div>
                            @error('files.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit Work Progress</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
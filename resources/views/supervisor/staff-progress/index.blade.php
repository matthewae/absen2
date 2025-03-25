@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Staff Progress Files</h5>
                    <form action="{{ route('supervisor.staff-progress.download') }}" method="POST" id="downloadForm">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Download Selected Files
                        </button>
                    </form>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select-all" class="form-check-input">
                                    </th>
                                    <th>Staff Name</th>
                                    <th>Company Name</th>
                                    <th>Project Topic</th>
                                    <th>Work Description</th>
                                    <th>Status</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workProgresses as $progress)
                                    <tr>
                                        <td>
                                            @foreach($progress->files as $file)
                                                <div class="form-check">
                                                    <input type="checkbox" name="selected_files[]" 
                                                           value="{{ $file->id }}" 
                                                           class="form-check-input file-checkbox"
                                                           form="downloadForm">
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>{{ $progress->staff->name }}</td>
                                        <td>{{ $progress->company_name }}</td>
                                        <td>{{ $progress->project_topic }}</td>
                                        <td>{{ $progress->work_description }}</td>
                                        <td>
                                            <span class="badge bg-{{ $progress->status === 'completed' ? 'success' : ($progress->status === 'in_progress' ? 'primary' : 'warning') }}">
                                                {{ $progress->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @foreach($progress->files as $file)
                                                <div class="mb-1">
                                                    {{ $file->original_name }}
                                                    <span class="text-muted">({{ number_format($file->file_size / 1024, 2) }} KB)</span>
                                                </div>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('.file-checkbox').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endpush
@endsection
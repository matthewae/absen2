<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - New Work Progress</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: rgb(250, 233, 135);
            --secondary-color: #000000;
            --text-light: #ffffff;
            --text-dark: #000000;
        }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--primary-color);
            min-height: 100vh;
            position: relative;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: -250px;
            z-index: 1000;
            padding: 48px 0 0;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
            background-color: var(--secondary-color);
            width: 250px;
            transition: left 0.3s ease-in-out;
        }
        .sidebar.show {
            left: 0;
        }
        @media (min-width: 768px) {
            .sidebar {
                left: 0;
            }
        }
        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: var(--primary-color);
            padding: 0.875rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: var(--secondary-color);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--accent-color);
        }
        .main-content {
            margin-left: 0;
            padding: 2rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }
        @media (min-width: 768px) {
            .main-content {
                margin-left: 250px;
            }
        }
        .navbar {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 99;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            background-color: #fff;
            padding: 0.75rem 1rem;
        }
        @media (min-width: 768px) {
            .navbar {
                left: 250px;
                padding: 0.75rem 2rem;
            }
        }
        .card {
            border: 2px solid var(--secondary-color);
            background-color: var(--text-light);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.2);
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .card-body {
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 0.375rem;
            border: 1px solid var(--border-color);
            padding: 0.625rem 0.875rem;
        }
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--secondary-color);
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            color: var(--secondary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        .btn-secondary {
            background-color: #95a5a6;
            border-color: #95a5a6;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
        }
        .breadcrumb {
            margin-bottom: 1.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button id="sidebarToggle" class="btn btn-link d-md-none position-fixed" style="top: 0.5rem; left: 0.5rem; z-index: 1001;">
        <i class="fas fa-bars text-dark"></i>
    </button>
    

    <nav class="sidebar">
        <div class="sidebar-sticky">
            <div class="px-3 mb-4">
                <img src="{{ asset(path: 'images/logo fix2.png') }}" alt="Company Logo" class="img-fluid" style="max-width: 100px; height: auto;">
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}" href="{{ route('staff.dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.work-progress.*') ? 'active' : '' }}" href="{{ route('staff.work-progress.index') }}">
                        <i class="fas fa-tasks"></i> Work Progress
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.attendance') ? 'active' : '' }}" href="{{ route('staff.attendance') }}">
                        <i class="fas fa-calendar-check"></i> Attendance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('staff.profile') ? 'active' : '' }}" href="{{ route('staff.profile') }}">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="navbar">
        <div class="d-flex justify-content-between w-100 align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('staff.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('staff.work-progress.index') }}" class="text-decoration-none">Work Progress</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Entry</li>
                </ol>
            </nav>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-dark text-decoration-none" type="button" id="userDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-user me-2"></i> {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('staff.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <h2 class="card-title h4 mb-4">Create New Work Progress</h2>
                    <form action="{{ route('staff.work-progress.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="project_topic" class="form-label">Project Topic <span class="text-danger">*</span></label>
                            <select name="project_topic" id="project_topic" class="form-select @error('project_topic') is-invalid @enderror" required>
                                <option value="">Select Project Topic</option>
                                <option value="Perencanaan" {{ old('project_topic') == 'Perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                                <option value="Pengawasan" {{ old('project_topic') == 'Pengawasan' ? 'selected' : '' }}>Pengawasan</option>
                                <option value="Kajian" {{ old('project_topic') == 'Kajian' ? 'selected' : '' }}>Kajian</option>
                                <option value="Other" {{ old('project_topic') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('project_topic')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                            <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" value="{{ old('company_name') }}" required>
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="work_description" class="form-label">Work Description <span class="text-danger">*</span></label>
                            <textarea name="work_description" id="work_description" rows="5" class="form-control @error('work_description') is-invalid @enderror" required>{{ old('work_description') }}</textarea>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <small class="text-muted">Minimum 50 characters required</small>
                                <small id="charCount" class="text-muted">0 characters</small>
                            </div>
                            @error('work_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Select Status</option>
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="OnProgress" {{ old('status') == 'OnProgress' ? 'selected' : '' }}>On Progress</option>
                                <option value="Revision" {{ old('status') == 'Revision' ? 'selected' : '' }}>Revision</option>
                                <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Upload Files <span class="text-danger">*</span></label>
                            <div id="file-upload-container">
                                <div class="file-input-group mb-2">
                                    <div class="input-group">
                                        <input type="file" name="files[]" class="form-control @error('files.*') is-invalid @enderror" required>
                                        <button type="button" class="btn btn-danger remove-file" style="display: none;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-2" id="add-file-btn">
                                <i class="fas fa-plus me-2"></i>Add Another File
                            </button>
                            <small class="text-muted d-block mt-2">Maximum file size: 500MB per file</small>
                            @error('files.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Submit Work Progress
                            </button>
                            <a href="{{ route('staff.work-progress.index') }}" class="btn btn-danger ms-2">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="progress mb-3 d-none" id="upload-progress">
        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <div class="progress mb-3 d-none" id="upload-progress">
        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('show');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 768 && 
            !sidebar.contains(event.target) && 
            !sidebarToggle.contains(event.target) && 
            sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });

    // File upload handling
    const form = document.querySelector('form');
    const progressBar = document.querySelector('#upload-progress');
    const progressBarInner = progressBar.querySelector('.progress-bar');
    const submitBtn = form.querySelector('button[type="submit"]');
    const fileContainer = document.querySelector('#file-upload-container');
    const addFileBtn = document.querySelector('#add-file-btn');
    const maxFileSize = 512000000; // 500MB in bytes

    // File input validation
    function validateFiles() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let isValid = true;
        let totalSize = 0;

        fileInputs.forEach(input => {
            if (input.files.length > 0) {
                const file = input.files[0];
                totalSize += file.size;

                // Check file size
                if (file.size > maxFileSize) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    const feedback = input.closest('.file-input-group').querySelector('.invalid-feedback');
                    if (!feedback) {
                        const div = document.createElement('div');
                        div.className = 'invalid-feedback';
                        div.textContent = 'File size exceeds 500MB limit';
                        input.parentNode.appendChild(div);
                    }
                } else {
                    input.classList.remove('is-invalid');
                    const feedback = input.closest('.file-input-group').querySelector('.invalid-feedback');
                    if (feedback) feedback.remove();
                }
            }
        });

        return isValid;
    }

    // Add file input
    addFileBtn.addEventListener('click', function() {
        const fileGroup = document.createElement('div');
        fileGroup.className = 'file-input-group mb-2';
        fileGroup.innerHTML = `
            <div class="input-group">
                <input type="file" name="files[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-file">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        fileContainer.appendChild(fileGroup);

        // Show remove button for all file inputs except the first one
        document.querySelectorAll('.remove-file').forEach(btn => btn.style.display = 'block');

        // Add event listener for the new file input
        const newInput = fileGroup.querySelector('input[type="file"]');
        newInput.addEventListener('change', validateFiles);
    });

    // Remove file input
    fileContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-file')) {
            e.target.closest('.file-input-group').remove();
            // Hide remove button if only one file input remains
            const fileInputs = document.querySelectorAll('.file-input-group');
            if (fileInputs.length === 1) {
                fileInputs[0].querySelector('.remove-file').style.display = 'none';
            }
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate files before submission
        if (!validateFiles()) {
            alert('Please check file sizes. Maximum allowed size per file is 500MB.');
            return;
        }

        // Check if at least one file is selected
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let hasFiles = false;
        fileInputs.forEach(input => {
            if (input.files.length > 0) hasFiles = true;
        });

        if (!hasFiles) {
            alert('Please select at least one file to upload.');
            return;
        }

        progressBar.classList.remove('d-none');
        submitBtn.disabled = true;

        // Clear previous error messages
        document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBarInner.style.width = percentComplete + '%';
                progressBarInner.textContent = Math.round(percentComplete) + '%';
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200 || xhr.status === 302) {
                const response = xhr.responseText ? JSON.parse(xhr.responseText) : {};
                window.location.href = response.redirect || form.getAttribute('action');
            } else if (xhr.status === 422) { // Validation errors
                const response = JSON.parse(xhr.responseText);
                progressBar.classList.add('d-none');
                submitBtn.disabled = false;
                
                // Display validation errors
                const errors = response.errors || {};
                Object.keys(errors).forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const feedback = input.closest('.form-group').querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = errors[field][0];
                            feedback.style.display = 'block';
                        }
                    }
                });
            } else {
                progressBar.classList.add('d-none');
                submitBtn.disabled = false;
                alert('Upload failed. Please try again.');
            }
        });

        xhr.addEventListener('error', function() {
            progressBar.classList.add('d-none');
            submitBtn.disabled = false;
            alert('Network error occurred. Please try again.');
        });

        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('input[name="_token"]').value);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.send(formData);
    });

    // Add event listener for initial file input
    document.querySelector('input[type="file"]').addEventListener('change', validateFiles);
});
</script>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('show');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 768 && 
            !sidebar.contains(event.target) && 
            !sidebarToggle.contains(event.target) && 
            sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });

    // File upload handling
    const form = document.querySelector('form');
    const progressBar = document.querySelector('#upload-progress');
    const progressBarInner = progressBar.querySelector('.progress-bar');
    const submitBtn = form.querySelector('button[type="submit"]');
    const fileContainer = document.querySelector('#file-upload-container');
    const addFileBtn = document.querySelector('#add-file-btn');
    const maxFileSize = 512000000; // 500MB in bytes

    // File input validation
    function validateFiles() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let isValid = true;
        let totalSize = 0;

        fileInputs.forEach(input => {
            if (input.files.length > 0) {
                const file = input.files[0];
                totalSize += file.size;

                // Check file size
                if (file.size > maxFileSize) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    const feedback = input.closest('.file-input-group').querySelector('.invalid-feedback');
                    if (!feedback) {
                        const div = document.createElement('div');
                        div.className = 'invalid-feedback';
                        div.textContent = 'File size exceeds 500MB limit';
                        input.parentNode.appendChild(div);
                    }
                } else {
                    input.classList.remove('is-invalid');
                    const feedback = input.closest('.file-input-group').querySelector('.invalid-feedback');
                    if (feedback) feedback.remove();
                }
            }
        });

        return isValid;
    }

    // Add file input
    addFileBtn.addEventListener('click', function() {
        const fileGroup = document.createElement('div');
        fileGroup.className = 'file-input-group mb-2';
        fileGroup.innerHTML = `
            <div class="input-group">
                <input type="file" name="files[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-file">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        fileContainer.appendChild(fileGroup);

        // Show remove button for all file inputs except the first one
        document.querySelectorAll('.remove-file').forEach(btn => btn.style.display = 'block');

        // Add event listener for the new file input
        const newInput = fileGroup.querySelector('input[type="file"]');
        newInput.addEventListener('change', validateFiles);
    });

    // Remove file input
    fileContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-file')) {
            e.target.closest('.file-input-group').remove();
            // Hide remove button if only one file input remains
            const fileInputs = document.querySelectorAll('.file-input-group');
            if (fileInputs.length === 1) {
                fileInputs[0].querySelector('.remove-file').style.display = 'none';
            }
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate files before submission
        if (!validateFiles()) {
            alert('Please check file sizes. Maximum allowed size per file is 500MB.');
            return;
        }

        // Check if at least one file is selected
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let hasFiles = false;
        fileInputs.forEach(input => {
            if (input.files.length > 0) hasFiles = true;
        });

        if (!hasFiles) {
            alert('Please select at least one file to upload.');
            return;
        }

        progressBar.classList.remove('d-none');
        submitBtn.disabled = true;

        // Clear previous error messages
        document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBarInner.style.width = percentComplete + '%';
                progressBarInner.textContent = Math.round(percentComplete) + '%';
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200 || xhr.status === 302) {
                const response = xhr.responseText ? JSON.parse(xhr.responseText) : {};
                window.location.href = response.redirect || form.getAttribute('action');
            } else if (xhr.status === 422) { // Validation errors
                const response = JSON.parse(xhr.responseText);
                progressBar.classList.add('d-none');
                submitBtn.disabled = false;
                
                // Display validation errors
                const errors = response.errors || {};
                Object.keys(errors).forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const feedback = input.closest('.form-group').querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = errors[field][0];
                            feedback.style.display = 'block';
                        }
                    }
                });
            } else {
                progressBar.classList.add('d-none');
                submitBtn.disabled = false;
                alert('Upload failed. Please try again.');
            }
        });

        xhr.addEventListener('error', function() {
            progressBar.classList.add('d-none');
            submitBtn.disabled = false;
            alert('Network error occurred. Please try again.');
        });

        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('input[name="_token"]').value);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.send(formData);
    });

    // Add event listener for initial file input
    document.querySelector('input[type="file"]').addEventListener('change', validateFiles);
});
</script>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileContainer = document.getElementById('file-upload-container');
    const addFileBtn = document.getElementById('add-file-btn');

    function createFileInput() {
        const div = document.createElement('div');
        div.className = 'file-input-group mb-2';
        div.innerHTML = `
            <div class="input-group">
                <input type="file" name="files[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-file">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        div.querySelector('.remove-file').addEventListener('click', function() {
            div.remove();
            updateRemoveButtons();
        });

        return div;
    }

    function updateRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-file');
        const firstRemoveButton = removeButtons[0];
        
        if (removeButtons.length === 1) {
            firstRemoveButton.style.display = 'none';
        } else {
            firstRemoveButton.style.display = 'block';
        }
    }

    addFileBtn.addEventListener('click', function() {
        fileContainer.appendChild(createFileInput());
        updateRemoveButtons();
    });

    // Initialize the first remove button state
    updateRemoveButtons();
});
</script>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('show');
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 768 && 
            !sidebar.contains(event.target) && 
            !sidebarToggle.contains(event.target) && 
            sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });

    // File upload handling
    const form = document.querySelector('form');
    const progressBar = document.querySelector('#upload-progress');
    const progressBarInner = progressBar.querySelector('.progress-bar');
    const submitBtn = form.querySelector('button[type="submit"]');
    const fileContainer = document.querySelector('#file-upload-container');
    const addFileBtn = document.querySelector('#add-file-btn');
    const maxFileSize = 512000000; // 500MB in bytes

    // File input validation
    function validateFiles() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let isValid = true;
        let totalSize = 0;

        fileInputs.forEach(input => {
            if (input.files.length > 0) {
                const file = input.files[0];
                totalSize += file.size;

                // Check file size
                if (file.size > maxFileSize) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    const feedback = input.closest('.file-input-group').querySelector('.invalid-feedback');
                    if (!feedback) {
                        const div = document.createElement('div');
                        div.className = 'invalid-feedback';
                        div.textContent = 'File size exceeds 500MB limit';
                        input.parentNode.appendChild(div);
                    }
                } else {
                    input.classList.remove('is-invalid');
                    const feedback = input.closest('.file-input-group').querySelector('.invalid-feedback');
                    if (feedback) feedback.remove();
                }
            }
        });

        return isValid;
    }

    // Add file input
    addFileBtn.addEventListener('click', function() {
        const fileGroup = document.createElement('div');
        fileGroup.className = 'file-input-group mb-2';
        fileGroup.innerHTML = `
            <div class="input-group">
                <input type="file" name="files[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-file">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        fileContainer.appendChild(fileGroup);

        // Show remove button for all file inputs except the first one
        document.querySelectorAll('.remove-file').forEach(btn => btn.style.display = 'block');

        // Add event listener for the new file input
        const newInput = fileGroup.querySelector('input[type="file"]');
        newInput.addEventListener('change', validateFiles);
    });

    // Remove file input
    fileContainer.addEventListener('click', function(e) {
        if (e.target.closest('.remove-file')) {
            e.target.closest('.file-input-group').remove();
            // Hide remove button if only one file input remains
            const fileInputs = document.querySelectorAll('.file-input-group');
            if (fileInputs.length === 1) {
                fileInputs[0].querySelector('.remove-file').style.display = 'none';
            }
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Validate files before submission
        if (!validateFiles()) {
            alert('Please check file sizes. Maximum allowed size per file is 500MB.');
            return;
        }

        // Check if at least one file is selected
        const fileInputs = document.querySelectorAll('input[type="file"]');
        let hasFiles = false;
        fileInputs.forEach(input => {
            if (input.files.length > 0) hasFiles = true;
        });

        if (!hasFiles) {
            alert('Please select at least one file to upload.');
            return;
        }

        progressBar.classList.remove('d-none');
        submitBtn.disabled = true;

        // Clear previous error messages
        document.querySelectorAll('.invalid-feedback').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

        const formData = new FormData(this);
        const xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBarInner.style.width = percentComplete + '%';
                progressBarInner.textContent = Math.round(percentComplete) + '%';
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200 || xhr.status === 302) {
                const response = xhr.responseText ? JSON.parse(xhr.responseText) : {};
                window.location.href = response.redirect || form.getAttribute('action');
            } else if (xhr.status === 422) { // Validation errors
                const response = JSON.parse(xhr.responseText);
                progressBar.classList.add('d-none');
                submitBtn.disabled = false;
                
                // Display validation errors
                const errors = response.errors || {};
                Object.keys(errors).forEach(field => {
                    const input = document.querySelector(`[name="${field}"]`);
                    if (input) {
                        input.classList.add('is-invalid');
                        const feedback = input.closest('.form-group').querySelector('.invalid-feedback');
                        if (feedback) {
                            feedback.textContent = errors[field][0];
                            feedback.style.display = 'block';
                        }
                    }
                });
            } else {
                progressBar.classList.add('d-none');
                submitBtn.disabled = false;
                alert('Upload failed. Please try again.');
            }
        });

        xhr.addEventListener('error', function() {
            progressBar.classList.add('d-none');
            submitBtn.disabled = false;
            alert('Network error occurred. Please try again.');
        });

        xhr.open('POST', form.action);
        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('input[name="_token"]').value);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.send(formData);
    });

    // Add event listener for initial file input
    document.querySelector('input[type="file"]').addEventListener('change', validateFiles);
});
</script>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileContainer = document.getElementById('file-upload-container');
    const addFileBtn = document.getElementById('add-file-btn');

    function createFileInput() {
        const div = document.createElement('div');
        div.className = 'file-input-group mb-2';
        div.innerHTML = `
            <div class="input-group">
                <input type="file" name="files[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-file">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        div.querySelector('.remove-file').addEventListener('click', function() {
            div.remove();
            updateRemoveButtons();
        });

        return div;
    }

    function updateRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-file');
        const firstRemoveButton = removeButtons[0];
        
        if (removeButtons.length === 1) {
            firstRemoveButton.style.display = 'none';
        } else {
            firstRemoveButton.style.display = 'block';
        }
    }

    addFileBtn.addEventListener('click', function() {
        fileContainer.appendChild(createFileInput());
        updateRemoveButtons();
    });

    // Initialize the first remove button state
    updateRemoveButtons();
});
</script>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for work description
    const workDescription = document.getElementById('work_description');
    const charCount = document.getElementById('charCount');
    const minChars = 50;

    function updateCharCount() {
        const count = workDescription.value.length;
        charCount.textContent = count + ' characters';
        charCount.classList.toggle('text-danger', count < minChars);
        charCount.classList.toggle('text-success', count >= minChars);
    }

    workDescription.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count
});
</script>
</html>
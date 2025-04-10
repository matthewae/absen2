<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Staff Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-indigo-800 text-white w-64 py-6 flex flex-col">
            <!-- Company Logo/Name -->
            <div class="px-6 mb-8">
                <h1 class="text-2xl font-bold">PT. Mandajaya Rekayasa Konstruksiaa</h1>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1">
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('staff.attendance') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Attendance
                </a>
                <a href="{{ route('staff.schedule') }}" class="flex items-center px-6 py-3 bg-indigo-900">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Schedule
                </a>
                <a href="{{ route('staff.progress.index') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Work Progress
                </a>
                <a href="{{ route('staff.profile') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Profile
                </a>
                <a href="{{ route('staff.settings') }}" class="flex items-center px-6 py-3 hover:bg-indigo-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>

            <!-- Logout Button -->
            <div class="px-6 py-4 border-t border-indigo-700">
                <form action="{{ route('staff.logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm hover:bg-indigo-700 rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Schedule Management</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                            <span class="text-sm font-medium text-gray-900">{{ $staff->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Create Assignment Button -->
                <div class="mb-6">
                    <button type="button" onclick="openAssignmentPanel()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Assignment
                    </button>
                </div>

                <!-- Calendar -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
                    <div id="calendar"></div>
                </div>

                <!-- Upcoming Assignments -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Upcoming Assignments</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach($upcomingAssignments as $assignment)
                        <div class="p-6 hover:bg-opacity-90 transition-colors duration-200 {{ $assignment->priority === 'high' ? 'bg-red-100' : ($assignment->priority === 'medium' ? 'bg-yellow-100' : 'bg-blue-100') }}">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-medium text-gray-900">{{ $assignment->title }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">{{ $assignment->description }}</p>
                                    <div class="mt-2 flex items-center space-x-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $assignment->start_datetime->format('d M Y') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $assignment->start_datetime->format('H:i') }} - {{ $assignment->end_datetime->format('H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slide-out Assignment Panel -->
    <div id="assignmentPanel" class="fixed inset-y-0 right-0 w-96 bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Create New Assignment</h3>
                <button type="button" onclick="closeAssignmentPanel()" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="assignmentForm" action="{{ route('staff.assignments.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter assignment title">
                        <div id="titleError" class="mt-1 text-sm text-red-600 hidden"></div>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter assignment description"></textarea>
                        <div id="descriptionError" class="mt-1 text-sm text-red-600 hidden"></div>
                    </div>
                    <div class="grid grid-cols-1 gap-y-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date <span class="text-red-500">*</span></label>
                            <input type="date" name="start_date" id="start_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <div id="startDateError" class="mt-1 text-sm text-red-600 hidden"></div>
                        </div>
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time <span class="text-red-500">*</span></label>
                            <input type="time" name="start_time" id="start_time" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <div id="startTimeError" class="mt-1 text-sm text-red-600 hidden"></div>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date <span class="text-red-500">*</span></label>
                            <input type="date" name="end_date" id="end_date" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <div id="endDateError" class="mt-1 text-sm text-red-600 hidden"></div>
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time <span class="text-red-500">*</span></label>
                            <input type="time" name="end_time" id="end_time" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <div id="endTimeError" class="mt-1 text-sm text-red-600 hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                        <span class="normal-state">Create Assignment</span>
                        <span class="loading-state hidden">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAssignmentPanel() {
            document.getElementById('assignmentPanel').classList.remove('translate-x-full');
            resetForm();
        }

        function closeAssignmentPanel() {
            document.getElementById('assignmentPanel').classList.add('translate-x-full');
            resetForm();
        }

        function resetForm() {
            const form = document.getElementById('assignmentForm');
            form.reset();
            document.querySelectorAll('.text-red-600').forEach(el => el.classList.add('hidden'));
            document.querySelector('.loading-state').classList.add('hidden');
            document.querySelector('.normal-state').classList.remove('hidden');
        }

        function showLoading() {
            document.querySelector('.loading-state').classList.remove('hidden');
            document.querySelector('.normal-state').classList.add('hidden');
        }

        function hideLoading() {
            document.querySelector('.loading-state').classList.add('hidden');
            document.querySelector('.normal-state').classList.remove('hidden');
        }

        function showError(field, message) {
            const errorDiv = document.getElementById(field + 'Error');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.classList.remove('hidden');
            }
        }

        document.getElementById('assignmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();

            // Clear previous errors
            document.querySelectorAll('.text-red-600').forEach(el => el.classList.add('hidden'));

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Assignment created successfully');
                        closeAssignmentPanel();
                        calendar.refetchEvents();
                        refreshSchedule();
                    } else if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            showError(field, data.errors[field][0]);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error('An error occurred while creating the assignment');
                })
                .finally(() => {
                    hideLoading();
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: {!! json_encode($calendarEvents) !!},
                eventDidMount: function(info) {
                    // Set background color based on priority
                    switch(info.event.extendedProps.priority) {
                        case 'high':
                            info.el.style.backgroundColor = '#FCA5A5'; // Light red
                            break;
                        case 'medium':
                            info.el.style.backgroundColor = '#FDE68A'; // Light yellow
                            break;
                        case 'low':
                            info.el.style.backgroundColor = '#93C5FD'; // Light blue
                            break;
                    }
                },
                eventClick: function(info) {
                    // Show event details using toastr
                    const event = info.event;
                    const startTime = event.start ? event.start.toLocaleTimeString() : '';
                    const endTime = event.end ? event.end.toLocaleTimeString() : '';
                    const title = event.title;
                    const description = event.extendedProps.description || 'No description available';
                    const priority = event.extendedProps.priority || 'normal';
                    
                    toastr.info(
                        `<strong>Time:</strong> ${startTime} - ${endTime}<br>
                        <strong>Description:</strong> ${description}<br>
                        <strong>Priority:</strong> ${priority}`,
                        title,
                        {
                            closeButton: true,
                            timeOut: 5000,
                            extendedTimeOut: 2000,
                            progressBar: true,
                            escapeHtml: false
                        }
                    );
                }
            });
            calendar.render();

            // Configure toastr
            toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right',
                timeOut: 3000
            };

            // Auto-refresh calendar and upcoming assignments every 30 seconds
            function refreshSchedule() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');

                        // Update calendar events
                        const newEvents = JSON.parse(doc.querySelector('#calendar').getAttribute('data-events'));
                        calendar.removeAllEvents();
                        calendar.addEventSource(newEvents);

                        // Update upcoming assignments
                        const upcomingAssignmentsContainer = document.querySelector('.divide-y.divide-gray-100');
                        const newUpcomingAssignments = doc.querySelector('.divide-y.divide-gray-100');
                        if (upcomingAssignmentsContainer && newUpcomingAssignments) {
                            upcomingAssignmentsContainer.innerHTML = newUpcomingAssignments.innerHTML;
                        }
                    })
                    .catch(error => console.error('Error refreshing schedule:', error));
            }

            // Refresh every 30 seconds
            setInterval(refreshSchedule, 30000);
        });
    </script>
</body>

</html>
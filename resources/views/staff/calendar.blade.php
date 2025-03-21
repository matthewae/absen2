<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Calendar | Staff Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-indigo-800 text-white fixed h-full">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-8">Staff Dashboard</h1>
                <nav class="space-y-4">
                    <a href="{{ route('staff.dashboard') }}" class="flex items-center space-x-2 text-indigo-100 hover:text-white">
                        <i class="fas fa-home w-6"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('staff.calendar') }}" class="flex items-center space-x-2 text-white bg-indigo-900 rounded-lg p-2">
                        <i class="fas fa-calendar w-6"></i>
                        <span>My Calendar</span>
                    </a>
                </nav>
            </div>
            <div class="absolute bottom-0 w-full p-6">
                <form method="POST" action="{{ route('staff.logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 text-indigo-100 hover:text-white w-full">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Header -->
            <div class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">My Calendar</h2>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar Area -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("staff.calendar.events") }}',
                eventClick: function(info) {
                    window.location.href = '/staff/assignments/' + info.event.id;
                }
            });
            calendar.render();
        });
    </script>
</body>
</html>
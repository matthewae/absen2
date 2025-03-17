<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-indigo-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo or Company Name -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-800">Supervisor Portal</h1>
            <p class="text-gray-600 mt-2">Access your management dashboard</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <div class="mb-6 text-center">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-shield text-2xl text-indigo-600"></i>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800">Welcome Back</h2>
                <p class="text-gray-600 text-sm mt-1">Please sign in to continue</p>
            </div>

            <form method="POST" action="{{ route('supervisor.login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="supervisor_id" class="block text-sm font-medium text-gray-700">Supervisor ID</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-id-card text-gray-400"></i>
                        </div>
                        <input id="supervisor_id" type="text" name="supervisor_id" value="{{ old('supervisor_id') }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 @error('supervisor_id') border-red-500 @enderror"
                            required autofocus>
                    </div>
                    @error('supervisor_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 @error('password') border-red-500 @enderror"
                            required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    @if (Route::has('supervisor.password.request'))
                        <a href="{{ route('supervisor.password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Forgot password?</a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center mt-6 text-gray-600 text-sm">
            &copy; {{ date('Y') }} Your Company. All rights reserved.
        </p>
    </div>
</body>
</html>
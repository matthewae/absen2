<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-background {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .floating-label {
            transform-origin: 0 0;
            transition: transform 0.2s ease-in-out;
        }
        .floating-input:focus-within label,
        .floating-input input:not(:placeholder-shown) + label {
            transform: translateY(-1.5rem) scale(0.75);
            color: #4f46e5;
        }
        .form-container {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.75);
        }
    </style>
</head>
<body class="gradient-background min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">PT. Mandajaya</h1>
            <p class="text-indigo-100 text-sm">Sign in to access your account</p>
        </div>

        <!-- Login Form -->
        <div class="form-container rounded-2xl p-8 shadow-xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div class="floating-input relative">
                    <input id="email" type="email" name="email" class="peer w-full px-4 py-3 rounded-lg border @error('email') border-red-500 @else border-gray-300 @enderror bg-white/50 backdrop-blur-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-transparent" placeholder=" " value="{{ old('email') }}" required autofocus>
                    <label for="email" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        {{ __('Email Address') }}
                    </label>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="floating-input relative">
                    <input id="password" type="password" name="password" class="peer w-full px-4 py-3 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror bg-white/50 backdrop-blur-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-transparent" placeholder=" " required>
                    <label for="password" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        {{ __('Password') }}
                    </label>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 text-sm text-gray-600">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition-colors duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Sign in') }}
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="mt-8 text-center text-sm text-indigo-100">
            © {{ date('Y') }} PT. Mandajaya. All rights reserved.
        </p>
    </div>
</body>
</html>

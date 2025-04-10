<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Supervisor Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        .gradient-background {
            background: linear-gradient(45deg, #1a237e, #0d47a1);
            position: relative;
            overflow: hidden;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
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
            position: relative;
            z-index: 2;
            animation: fadeIn 0.5s ease-out;
        }
        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #1a237e, #0d47a1);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeOut 0.5s ease-in-out 2s forwards;
        }
        .splash-content {
            text-align: center;
            color: white;
            animation: scaleIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }
        @keyframes scaleIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="gradient-background min-h-screen flex items-center justify-center p-6">
    <!-- Splash Screen -->
    <div class="splash-screen">
        <div class="splash-content">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold mb-2">PT. Mandajaya</h1>
            <p class="text-sm text-indigo-200">Loading...</p>
        </div>
    </div>

    <!-- Particles.js Container -->
    <div id="particles-js"></div>

    <div class="w-full max-w-md">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80, density: { enable: true, value_area: 800 } },
                    color: { value: '#ffffff' },
                    shape: { type: 'circle' },
                    opacity: { value: 0.5, random: false },
                    size: { value: 3, random: true },
                    line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.4, width: 1 },
                    move: { enable: true, speed: 6, direction: 'none', random: false, straight: false, out_mode: 'out', bounce: false }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: { onhover: { enable: true, mode: 'repulse' }, onclick: { enable: true, mode: 'push' }, resize: true },
                    modes: { repulse: { distance: 100, duration: 0.4 }, push: { particles_nb: 4 } }
                },
                retina_detect: true
            });
        });
    </script>
        <!-- Logo and Title -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">PT. Mandajaya</h1>
            <p class="text-indigo-100 text-sm">Supervisor Portal</p>
        </div>

        <!-- Login Form -->
        <div class="form-container rounded-2xl p-8 shadow-xl">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Supervisor ID Input -->
                <div class="floating-input relative">
                    <input id="supervisor_id" type="text" name="supervisor_id" class="peer w-full px-4 py-3 rounded-lg border @error('supervisor_id') border-red-500 @else border-gray-300 @enderror bg-white/50 backdrop-blur-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-transparent" placeholder=" " value="{{ old('supervisor_id') }}" required autofocus>
                    <label for="supervisor_id" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        {{ __('Supervisor ID') }}
                    </label>
                    @error('supervisor_id')
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

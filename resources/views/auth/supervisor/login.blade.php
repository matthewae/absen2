<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Login | PT. Mandajaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            position: relative;
            z-index: 1;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .floating-input:focus-within label,
        .floating-input input:not(:placeholder-shown) + label {
            @apply bg-white text-indigo-600 font-medium;
            transform: translateY(-1.5rem) scale(0.75);
            background-color: white;
            padding: 0 0.25rem;
        }
        .floating-label {
            transform-origin: 0 0;
            transition: transform 0.2s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 via-indigo-700 to-indigo-800 min-h-screen flex items-center justify-center p-4 relative overflow-y-auto">
    <div id="particles-js"></div>
    <div class="w-full max-w-md">
        <!-- Logo and Branding -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 rounded-full bg-white/10 mb-4">
                <i class="fas fa-building text-4xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3 tracking-tight">PT. Mandajaya Rekayasa Konstruksi</h1>
            <p class="text-indigo-200 text-lg font-medium tracking-wide uppercase">Supervisor Portal</p>
        </div>

        <!-- Login Form -->
        <div class="form-container rounded-2xl p-8 shadow-xl">
            <div class="mb-6 text-center">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-shield text-2xl text-indigo-600"></i>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800">Welcome Back</h2>
                <p class="text-gray-500 text-sm mt-1">Please sign in to your supervisor account</p>
            </div>

            <form method="POST" action="{{ route('supervisor.login') }}" class="space-y-6">
                @csrf
                <div class="floating-input relative">
                    <input id="supervisor_id" type="text" name="supervisor_id" class="peer w-full px-4 py-3 rounded-lg border @error('supervisor_id') border-red-500 @else border-gray-300 @enderror bg-white/50 backdrop-blur-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-transparent" placeholder=" " value="{{ old('supervisor_id') }}" required autofocus>
                    <label for="supervisor_id" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        <i class="fas fa-id-card mr-2"></i>Supervisor ID
                    </label>
                    @error('supervisor_id')
                        <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="floating-input relative">
                    <input id="password" type="password" name="password" class="peer w-full px-4 py-3 rounded-lg border @error('password') border-red-500 @else border-gray-300 @enderror bg-white/50 backdrop-blur-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-transparent" placeholder=" " required>
                    <label for="password" class="floating-label absolute left-4 top-3 text-gray-500 pointer-events-none">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="text-gray-600 group-hover:text-gray-800">Remember me</span>
                    </label>
                    @if (Route::has('supervisor.password.request'))
                        <a href="{{ route('supervisor.password.request') }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 text-white py-4 px-6 rounded-xl font-semibold hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center space-x-3 shadow-lg mb-4">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Sign In</span>
                </button>

                <a href="{{ route('staff.login') }}" class="w-full bg-white/10 backdrop-blur-sm text-black py-4 px-6 rounded-xl font-semibold hover:bg-white/20 focus:outline-none focus:ring-4 focus:ring-white/30 transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center space-x-3 shadow-lg border border-white/20">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Staff Login</span>
                </a>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center mt-6 text-indigo-100 text-sm">
            &copy; {{ 2022 }} PT. Mandajaya Rekayasa Konstruksi. All rights reserved.
        </p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80, density: { enable: true, value_area: 800 } },
                    color: { value: '#ffffff' },
                    shape: { type: 'circle' },
                    opacity: { value: 0.5, random: false },
                    size: { value: 3, random: true },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#ffffff',
                        opacity: 0.4,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: 'none',
                        random: false,
                        straight: false,
                        out_mode: 'bounce',
                        bounce: true
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: { enable: true, mode: 'grab' },
                        onclick: { enable: true, mode: 'push' },
                        resize: true
                    },
                    modes: {
                        grab: {
                            distance: 140,
                            line_linked: { opacity: 0.8 }
                        },
                        push: { particles_nb: 4 }
                    }
                },
                retina_detect: true
            });

            // Add fade-in class to elements
            document.querySelector('.form-container').classList.add('fade-in');
        });
    </script>
</body>
</html>
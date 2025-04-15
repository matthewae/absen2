<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Staff Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(45deg, #ffd700, #000000);
            font-family: 'Times New Roman', serif;
            overflow: hidden;
            letter-spacing: -0.011em;
        }

        body * {
            font-family: inherit;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #ffd700, #000000);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeOut 1s ease-in-out 2s forwards;
        }

        .splash-content {
            text-align: center;
            color: white;
        }

        .splash-logo {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: scaleIn 1s ease-in-out;
            font-family: 'Times New Roman', serif;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .splash-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            animation: fadeIn 1s ease-in-out 2.5s forwards;
        }

        .login-card {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }

        .login-header h1, .splash-logo {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            line-height: 1.25;
            margin-bottom: 0.75rem;
            font-family: 'Times New Roman', serif;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid #ffd700;
            border-radius: 8px;
            padding: 15px;
            color: #ffd700;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            letter-spacing: -0.01em;
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 0 0 2px #ffd700;
            color: #ffd700;
        }

        .form-label {
            color: white;
            font-weight: 500;
            font-size: 0.9375rem;
            letter-spacing: -0.01em;
        }

        .btn-login {
            background: #ffd700;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            color: #000000;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #ffed4a;
            transform: translateY(-2px);
        }

        .form-check-label {
            color: white;
        }

        .forgot-password {
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
            padding: 10px;
            display: inline-block;
        }

        .forgot-password:hover {
            color: #ffed4a;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Splash Screen -->
    <div class="splash-screen">
        <div class="splash-content">
            <div class="splash-logo">PT. MANDAJAYA REKAYASA KONSTRUKSI</div>
            <div class="splash-spinner"></div>
        </div>
    </div>

    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Login Form -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">PT. MANDAJAYA REKAYASA KONSTRUKSI</h1>
            </div>

            <form method="POST" action="{{ route('staff.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="staff_id" class="form-label">Staff ID</label>
                    <input id="staff_id" type="text" class="form-control @error('staff_id') is-invalid @enderror"
                        name="staff_id" value="{{ old('staff_id') }}" required autocomplete="staff_id" autofocus>
                    @error('staff_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <!-- <input class="form-check-input" type="checkbox" name="remember"
                            id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label> -->
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-login text-white">
                        Login
                    </button>
                </div>

                <div class="mb-3 text-center">
                    <a href="{{ route('supervisor.login') }}" class="btn btn-outline-light w-100">
                        Login as Supervisor
                    </a>
                </div>

                <div class="text-center">
                    <!-- <a class="forgot-password" href="{{ route('staff.password.request') }}">
                        Forgot Your Password?
                    </a> -->
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
    <script>
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#ffffff'
                },
                shape: {
                    type: 'circle'
                },
                opacity: {
                    value: 0.5,
                    random: false
                },
                size: {
                    value: 3,
                    random: true
                },
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
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'repulse'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                }
            },
            retina_detect: true
        });
    </script>
</body>

</html>
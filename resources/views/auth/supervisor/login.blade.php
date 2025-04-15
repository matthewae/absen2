<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Supervisor Login</title>
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

        .login-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 15px 45px rgba(255, 215, 0, 0.2);
            border: 2px solid rgba(255, 215, 0, 0.25);
        }

        .login-header {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 215, 0, 0.5);
            border-radius: 12px;
            padding: 15px;
            color: #ffd700;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.5px;
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
        }

        .btn-login {
            background: linear-gradient(45deg, #ffd700, #ffed4a);
            border: none;
            padding: 16px;
            width: 100%;
            border-radius: 12px;
            font-weight: 700;
            color: #000000;
            font-size: 18px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        }

        .btn-login:hover {
            background: #ffed4a;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; visibility: hidden; }
        }

        @keyframes scaleIn {
            from { transform: scale(0); }
            to { transform: scale(1); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>


    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Login Form -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1 style="font-family: 'Times New Roman', serif; font-size: 2rem; font-weight: 700; text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.6); letter-spacing: 0.5px;">PT. MANDAJAYA REKAYASA KONSTRUKSI</h1>
                <p class="text-warning mt-2">Supervisor Portal</p>
            </div>

            <form method="POST" action="{{ route('supervisor.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="supervisor_id" class="form-label">Supervisor ID</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-2 border-warning text-warning"><i class="fas fa-id-card"></i></span>
                        <input id="supervisor_id" type="text" class="form-control @error('supervisor_id') is-invalid @enderror" name="supervisor_id" value="{{ old('supervisor_id') }}" required autofocus>
                    </div>
                    @error('supervisor_id')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-dark border-2 border-warning text-warning"><i class="fas fa-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        <button type="button" class="btn btn-outline-warning" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>

                <a href="{{ route('staff.login') }}" class="btn btn-outline-warning w-100">
                    <i class="fas fa-arrow-left me-2"></i>Back to Staff Login
                </a>
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

        particlesJS('particles-js', {
            particles: {
                number: { value: 100, density: { enable: true, value_area: 1000 } },
                color: { value: '#ffd700' },
                shape: { type: ['circle', 'triangle', 'star'] },
                opacity: { value: 0.6, random: true },
                size: { value: 4, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#ffd700',
                    opacity: 0.3,
                    width: 1.5
                },
                move: {
                    enable: true,
                    speed: 3,
                    direction: 'none',
                    random: true,
                    straight: false,
                    out_mode: 'bounce',
                    bounce: true
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: true, mode: 'push' },
                    resize: true
                }
            },
            retina_detect: true
        });
    </script>
</body>
</html>
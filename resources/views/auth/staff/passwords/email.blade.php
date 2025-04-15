<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT. Mandajaya - Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
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

        .company-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .reset-container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-card {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .reset-header {
            text-align: center;
            color: white;
            margin-bottom: 2rem;
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

        .btn-reset {
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

        .btn-reset:hover {
            background: #ffed4a;
            transform: translateY(-2px);
        }

        .back-to-login {
            color: #ffd700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: block;
            text-align: center;
            margin-top: 1rem;
        }

        .back-to-login:hover {
            color: #ffed4a;
        }

        .alert {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.2);
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
        }
    </style>
</head>

<body>
    <!-- Particles Background -->
    <div id="particles-js"></div>

    <!-- Reset Password Form -->
    <div class="reset-container">
        <div class="reset-card">
            <div class="reset-header">
                <h1 class="company-title">PT. MANDAJAYA REKAYASA KONSTRUKSI</h1>
                <p class="text-white mt-3">Reset Password</p>
            </div>

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('staff.password.email') }}">
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
                    <button type="submit" class="btn btn-reset">
                        Send Password Reset Link
                    </button>
                </div>

                <a href="{{ route('staff.login') }}" class="back-to-login">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Login
                </a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
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
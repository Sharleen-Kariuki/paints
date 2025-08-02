<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', sans-serif;
        }

        #particles-js {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: #1e293b;
        }

        .form-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .reset-card input {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Particle background -->
    <div id="particles-js"></div>

    <div class="container form-container">
        <div class="reset-card">
            <h2 class="mb-4 text-center">Reset Password</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Hidden token input -->
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    value="{{ old('email') }}" 
                    placeholder="Email Address" 
                    required>

                <!-- New Password -->
                <div class="input-group mb-3">
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="New Password" 
                        id="password"
                        required>
                    <span class="input-group-text p-0">
                        <button class="btn btn-outline-secondary border-0" type="button" id="togglePassword" tabindex="-1" style="box-shadow:none;">
                            <span id="togglePasswordIcon" class="bi bi-eye-slash"></span>
                        </button>
                    </span>
                </div>

                <!-- Confirm Password -->
                <div class="input-group mb-3">
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="form-control" 
                        placeholder="Confirm Password" 
                        id="password_confirmation"
                        required>
                    <span class="input-group-text p-0">
                        <button class="btn btn-outline-secondary border-0" type="button" id="togglePasswordConfirmation" tabindex="-1" style="box-shadow:none;">
                            <span id="togglePasswordConfirmationIcon" class="bi bi-eye-slash"></span>
                        </button>
                    </span>
                </div>

                <!-- Bootstrap Icons CDN for eye icon -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Toggle for New Password
                        const passwordInput = document.getElementById('password');
                        const togglePassword = document.getElementById('togglePassword');
                        const togglePasswordIcon = document.getElementById('togglePasswordIcon');
                        togglePassword.addEventListener('click', function () {
                            const type = passwordInput.type === 'password' ? 'text' : 'password';
                            passwordInput.type = type;
                            togglePasswordIcon.classList.toggle('bi-eye');
                            togglePasswordIcon.classList.toggle('bi-eye-slash');
                        });

                        // Toggle for Confirm Password
                        const passwordConfirmationInput = document.getElementById('password_confirmation');
                        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
                        const togglePasswordConfirmationIcon = document.getElementById('togglePasswordConfirmationIcon');
                        togglePasswordConfirmation.addEventListener('click', function () {
                            const type = passwordConfirmationInput.type === 'password' ? 'text' : 'password';
                            passwordConfirmationInput.type = type;
                            togglePasswordConfirmationIcon.classList.toggle('bi-eye');
                            togglePasswordConfirmationIcon.classList.toggle('bi-eye-slash');
                        });
                    });
                </script>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

    <!-- Initialize particles.js -->
    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 90,
                    "density": { "enable": true, "value_area": 900 }
                },
                "color": { "value": ["#ff6b6b", "#ffd93d", "#6bcB77", "#4d96ff"] },
                "shape": {
                    "type": "circle",
                    "stroke": { "width": 0, "color": "#000" }
                },
                "opacity": {
                    "value": 0.8,
                    "random": true
                },
                "size": {
                    "value": 7,
                    "random": true
                },
                "line_linked": {
                    "enable": false
                },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": { "enable": true, "mode": "repulse" },
                    "onclick": { "enable": true, "mode": "push" }
                },
                "modes": {
                    "repulse": { "distance": 100 },
                    "push": { "particles_nb": 4 }
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>

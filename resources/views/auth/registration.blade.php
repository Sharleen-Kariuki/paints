<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - PaintsCo.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        html, body {
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

        .card {
            background-color: rgba(255, 255, 255, 0.95);
        }

        .register-image {
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80') center center/cover no-repeat;
            min-height: 400px;
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem;
        }

        @media (max-width: 767.98px) {
            .register-image {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Paint particles background -->
    <div id="particles-js"></div>

    <!-- Audio element for paint sound -->
    <audio id="paint-sound" src="https://cdn.pixabay.com/download/audio/2022/03/15/audio_aa2f5aa2d6.mp3?filename=paintbrush-swish-1-101349.mp3" preload="auto"></audio>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="row g-0">
                        <div class="col-md-6 register-image d-none d-md-block"></div>
                        <div class="col-md-6">
                            <div class="card-body p-4">
                                <hr>
                                <h4 class="mb-4 text-center">Start Your Journey With Us</h4>
                                <form action="{{ route('register-user') }}" method="POST">
                                    @if(Session::has('success'))
                                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                                    @endif
                                    @if(Session::has('fail'))
                                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                                    @endif
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{ old('name') }}">
                                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" placeholder="Enter Email Address" name="email" value="{{ old('email') }}">
                                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">
                                                <span id="togglePasswordIcon" class="bi bi-eye-slash"></span>
                                            </button>
                                        </div>
                                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                    </div>

                                    <div class="d-grid mb-3">
                                        <button class="btn btn-primary" type="submit">Register</button>
                                    </div>

                                    <div class="text-center">
                                        <span>Already registered? <a href="/">Login Here</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

    <script>
        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            togglePassword.addEventListener('click', function () {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                togglePasswordIcon.className = type === 'password' ? 'bi bi-eye-slash' : 'bi bi-eye';
            });
        });

        // Initialize particles.js
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 90,
                    "density": { "enable": true, "value_area": 900 }
                },
                "color": { "value": ["#ff6b6b", "#ffd93d", "#6bcB77", "#4d96ff"] },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.8, "random": true },
                "size": { "value": 7, "random": true },
                "line_linked": { "enable": false },
                "move": {
                    "enable": true,
                    "speed": 2,
                    "random": true,
                    "out_mode": "out"
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

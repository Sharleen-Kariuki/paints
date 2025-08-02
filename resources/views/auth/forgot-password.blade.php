<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
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

        .forgot-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Particle background -->
    <div id="particles-js"></div>

    <div class="container form-container">
        <div class="forgot-card">
            <h2 class="mb-4 text-center">Forgot Password</h2>
            <form method="POST" action="{{ route('password.request') }}">
                @if(Session::has('status'))
                    <div class="alert alert-success">{{ Session::get('status') }}</div>
                @endif
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
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

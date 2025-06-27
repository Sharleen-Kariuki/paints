
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Hidden token input -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email input -->
        <div>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                placeholder="Email Address" 
                required>
        </div>

        <!-- New Password -->
        <div>
            <input 
                type="password" 
                name="password" 
                placeholder="New Password" 
                required>
        </div>

        <!-- Confirm Password -->
        <div>
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="Confirm Password" 
                required>
        </div>

        <button type="submit">Reset Password</button>
    </form>
</body>
</html>

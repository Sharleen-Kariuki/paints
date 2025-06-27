<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>
<body>
    <form method="POST" action="{{ route('password.request') }}">
          @if(Session::has('status'))
                      <div class="alert alert-success">{{Session::get('status')}}</div>
                    @endif
                   
    @csrf
    <input type="email" name="email" placeholder="Your Email">
    <button type="submit">Send Password Reset Link</button>
</form>

</body>
</html>
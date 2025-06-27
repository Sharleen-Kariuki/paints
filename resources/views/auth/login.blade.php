<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom Authentication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style = "margin-top:20px">
                <hr>
                <h4>Login</h4>
                <form action="{{route('login-user')}}" method="POST">
                    @if(Session::has('success'))
                      <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                  @endif
                    {{-- secures the application --}}
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter Email Address" name="email" value="{{old('email')}}">
                        <span class="text-danger">@error('email') {{$message}} @enderror</span>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" value="{{old('password')}}">
                        <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    </div>
                    <br>
                    
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit">Login</button>
                    </div>
                    <br>
                    <p><a href="{{ route('password.request') }}">Forgot your password?</a></p>
                    <br>
                   <p>New User !!<a href="registration">Register Here</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
{{-- import ajax jquery --}}
{{-- import toastr for responses --}}
{{-- Handle the submission --}}
<script>
    $(document).ready(function(){
        // handle validation and return reqiored errors
        // collect the data
        // const email = document.getelement by id ('#email').value();
        // const email = $('#email').val();

        const loginPayload = {

        }
        // initialise url
        // initialise token
        // send the request
        // $ajax{
            // header:
            // TOKEN
            // data=payload
        // }
        // handle sucess
        // handle errors
        //


    });    
</script>    

</html>

{{-- //controller --}}
{{-- tr{
return sucess
}catch{
return error
} --}}
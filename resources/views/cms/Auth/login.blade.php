<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="BucketAdmin/html/images/favicon.png">

    <title>Login</title>

    <!--Core CSS -->
    <link href="{{ asset('BucketAdmin/html/bs3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('BucketAdmin/html/css/bootstrap-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('BucketAdmin/html/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('BucketAdmin/html/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('BucketAdmin/html/css/style-responsive.css') }}" rel="stylesheet" />

    
</head>

<body class="login-body">

    <div class="container">

        @if(Session::has('error'))
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('error') }}</strong>
        </div>
        @endif


        <form class="form-signin" method="post" action="{{ route('cms.login') }}">
            @csrf
            <h2 class="form-signin-heading">Đăng nhập</h2>
            <div class="login-wrap">
                <div class="user-login-info">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="User name" autofocus>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-lg btn-login btn-block" type="submit">Đăng nhập</button>
            </div>
        </form>

    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="{{ asset('BucketAdmin/html/js/jquery.js') }}"></script>
    <script src="{{ asset('BucketAdmin/html/bs3/js/bootstrap.min.js') }}"></script>


</body>

</html>
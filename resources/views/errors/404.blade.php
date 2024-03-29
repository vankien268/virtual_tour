<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="{{ asset('BucketAdmin/html/images/favicon.ico') }}">

    <title>404</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('BucketAdmin/html/bs3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('BucketAdmin/html/css/bootstrap-reset.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('BucketAdmin/html/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('BucketAdmin/html/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('BucketAdmin/html/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>




<body class="body-404">

<div class="error-head"> </div>

<div class="container ">

    <section class="error-wrapper text-center">
        <h1><img src="{{asset('BucketAdmin/html/images/404.png')}}" alt=""></h1>
        <div class="error-desk">
            <h2>Bạn không có quyền truy cập chức năng</h2>
            <p class="nrml-txt">Vui lòng liên hệ bộ phận chăm sóc để biết thêm chi tiết</p>
        </div>
        <a href="{{ route('cms.login') }}" class="back-btn"><i class="fa fa-home"></i> Quay lại trang chủ</a>
    </section>

</div>


</body>
</html>

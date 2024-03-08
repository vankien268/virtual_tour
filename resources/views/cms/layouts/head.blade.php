<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="ThemeBucket">

<meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
<meta http-equiv=”X-UA-Compatible” content=”IE=9”>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('BucketAdmin') }}/html/images/favicon.png">
<title>Admin</title>
<!--Core CSS -->
<link href="{{ asset('BucketAdmin') }}/html/bs3/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/css/bootstrap-reset.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/css/style.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/css/style-responsive.css" rel="stylesheet"/>
{{-- table --}}
<link href="{{ asset('BucketAdmin') }}/html/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="{{ asset('BucketAdmin') }}/html/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('BucketAdmin') }}/html/js/data-tables/DT_bootstrap.css" />
{{-- toast --}}
<link href="{{ asset('BucketAdmin') }}/html/css/toastr.css" rel="stylesheet">
{{-- loading --}}
<link href="{{ asset('BucketAdmin') }}/html/gif/css/Rolling.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/css/header-text.css" rel="stylesheet">
<link href="{{ asset('BucketAdmin') }}/html/css/eye-icon.css" rel="stylesheet">
{{-- <link href="{{ asset('BucketAdmin') }}/html/css/mobile.css" rel="stylesheet"> --}}
<link href="{{ asset('BucketAdmin') }}/html/css/table-responsive.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .btn-full-width{
            width: 100%;
        }
    a:hover{
        color: #337ab7;
    }
</style>
@stack('css')
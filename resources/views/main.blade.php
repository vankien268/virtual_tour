<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-W6KZT5B');</script>
    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="NewwayPMS"/>
{{--    <meta name="description" content="{{$settings? $h? $h->value : null : null}}">--}}
    <!-- Document title -->
    @yield('description')
    <title>@yield('title')</title>
    <!-- Stylesheets & Fonts -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,800,700,600|Montserrat:400,500,600,700|Raleway:100,300,600,700,800"
        rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link href="{{asset('assets/css/style2.css')}}" rel="stylesheet">
    @stack('style')

</head>
@stack('head')

<body onload="myFunction()" >
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6KZT5B"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@if(Session::has('currentLanguage') == null)
    <div id="modalLang" class="modal modal-auto-open text-center" data-delay="1000" data-target="#staticBackdrop">
        <div class="list-lang">
            <h4 class="text-primary">{{$fs? $fs->value: 'Vui lòng chọn ngôn ngữ/Please choose your language.'}}</h4>
            <div class="form-group">
                <ul class="list-icon list-icon-colored text-left">
                    @foreach($langs as $key=>$item)
                        <li style="margin-left: 0">
                            <a class="list-entry btn btn-xs btn-lang" href="?language={{$item->code}}">
                                {{--                                        {{$lang->name}}/--}}
                                {{$item->localization}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endif
<!-- Wrapper -->
<div id="wrapper" onscroll="setHeightOnScroll">

    <!-- Header -->
@include('navbar')
<!-- end: Header -->

@yield('content')
<!--End: Modal trigger button-->


    <!-- Footer -->
@include('footer')
<!-- end: Footer -->

</div>


<!-- end: Wrapper -->

<!-- Go to top button -->
<a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>
<!--Plugins-->
<script src="{{asset('assets/js/jquery.js')}}"></script>
{{--<script src="{{asset('assets/js/oyoplayer.js')}}"></script>--}}
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!--Template functions-->
<script src="{{asset('assets/js/functions.js')}}"></script>

<!-- Let it snow -->
<script src="{{asset('assets/js/plugins/components/let-it-snow.min.js')}}"></script>
<link src="{{asset('assets/js/plugins/components/let-it-snow.css')}}" rel="stylesheet">
<script>

    // window.addEventListener('scroll', () => {
    //     const element = document.querySelector('#modalText');
    //     element.style.height = `${window.innerHeight}px !important`;
    //     console.log(element);
    // });

    $.letItSnow('#slider', {
        stickyFlakes: 'lis-flake--js',
        makeFlakes: true,
        sticky: true
    });

    $(document).ready(function () {
        $('.mfp-content').click(function () {
            console.log('vẫn click');
            // return false;
        });

        // if ($("#modalLang").attr("class") == 'mfp-hide') {
        //     console.log('đã ẩn')
        // }
        // else{
        //     console.log('đã hiện')
        // }
    });

</script>
@stack('scripts')
</body>
</html>

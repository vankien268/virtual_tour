@extends('main')
@section('description')
    <meta name="description" content="{{$presentation? $presentation->overview : $pre_default->overview}}">
@endsection
@section('title',$presentation? $presentation->overview : $pre_default->overview)
@push('style')
    <link href="{{asset('assets/css/audioplayer.css')}}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        /**{*/
        /*    margin: 0;*/
        /*    padding: 0;*/
        /*    box-sizing: border-box;*/
        /*    font-family: 'Poppins', sans-serif;*/
        /*}*/
        .nav-list .wrapper {
            /*position: fixed;*/
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            /*background: linear-gradient(-135deg, #c850c0, #4158d0);*/
            background: #fff;
            /* background: linear-gradient(375deg, #1cc7d0, #2ede98); */
            /* clip-path: circle(25px at calc(0% + 45px) 45px); */
            clip-path: circle(25px at calc(100% - 45px) 45px);
            transition: all 0.3s ease-in-out;
        }

        .nav-list #active:checked ~ .wrapper {
            clip-path: circle(75%);
        }

        .nav-list .menu-btn {
            position: fixed;
            /*position: absolute;*/
            z-index: 2;
            right: 20px;
            /* left: 20px; */
            /*top: 20px;*/
            /*top: -20px;*/
            top: 82px;
            height: 40px;
            width: 40px;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            font-size: 20px;
            color: #fff;
            cursor: pointer;
            background: linear-gradient(-135deg, #000000, #a57865);
            /*background: linear-gradient(-135deg, #c850c0, #4158d0);*/
            /* background: linear-gradient(375deg, #1cc7d0, #2ede98); */
            transition: all 0.3s ease-in-out;
        }

        .nav-list #active:checked ~ .menu-btn {
            background: #a57865;
            color: #ffffff;
        }

        .nav-list #active:checked ~ .menu-btn i:before {
            content: "\f00d";
        }

        .nav-list .wrapper ul {
            position: absolute;
            top: 80px;
            /*left: 50%;*/
            /*transform: translate(-50%, -50%);*/
            list-style: none;
            text-align: left;
            width: 100%;
            padding-left: 0;
        }

        .nav-list .wrapper ul li {
            /*padding: 5px;*/
            width: 100%;
            /*border-bottom: 1px solid #f0f0f0;*/
        }

        .nav-list .wrapper ul li a {
            display: block;
            color: none;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            padding: 5px 5px;
            /*color: #fff;*/
            position: relative;
            /*line-height: 50px;*/
            /*transition: all 0.3s ease;*/
            margin: 0 10px;
        }

        .nav-list .wrapper ul li a span {
            color: #031e30;
            font-weight: 600;
        }

        .nav-list .wrapper ul li a:after {
            position: absolute;
            content: "";
            background: #fff;
            width: 100%;
            height: 50px;
            left: 0;
            border-radius: 50px;
            transform: scaleY(0);
            z-index: -1;
            /*transition: transform 0.3s ease;*/
        }

        .nav-list .wrapper ul li a:hover:after {
            transform: scaleY(1);
        }

        /*.nav-list .wrapper ul li a:hover {*/
        /*    color: #4158d0;*/
        /*    background: #b7845d;*/
        /*    border-radius: 4px;*/
        /*}*/
        .nav-list .wrapper ul li a:active {
            color: #4158d0;
            background: #b7845d;
            border-radius: 4px;
        }

        .nav-list input[type="checkbox"] {
            display: none;
        }

        .nav-list .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            text-align: center;
            width: 100%;
            color: #202020;
        }

        .nav-list .content .title {
            font-size: 40px;
            font-weight: 700;
        }

        .nav-list .content p {
            font-size: 35px;
            font-weight: 600;
        }

    </style>
@endpush
@section('content')
    <!-- Page Content -->
    <section id="page-content" class="sidebar-right">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb text-left list-lo" style="margin-bottom: 5px; display: flex">
                        <li style="width: 74px"><a href="{{route('home')}}"> <i
                                    class="fa fa-home"></i>
                                {{$settings? $h? $h->value : null : null}}</a>
                        </li>
                        <li class="active"
                            style="width: calc(100% - 74px)">{{$presentation ? $presentation->name : null}}</li>
                    </ol>
                    {{--------------------------------------------------------------------------MENU---------------------------------}}
                    @if($zone_locations)
                        <div class="nav-list text-right">
                            <input type="checkbox" id="active">
                            <label for="active" class="menu-btn" id="menu-close"><i class="fas fa-bars"></i></label>
                            <label class="menu-btn-2" id="menu-close-2"><i class="fas fa-bars"></i></label>
                            <label class="menu-btn-3 dl-hidden" id="menu-close-3"><i class="fas fa-bars"></i></label>
                            <div class="wrapper" id="wrapper-menu">
                                <ul>
                                    @foreach($zone_locations as $key=>$item)
                                        @foreach($presentation_zones as $key2=>$present)
                                            @if($item->id == $present->location_id)

                                                @if($present->id == $presentation->id)
                                                    {{--                                            <li style="background: #d1c2bc;">--}}
                                                    <li>
                                                        <a href="{{route('locations',['id'=>$present->location_id])}}"
                                                           style="    background: #b7845d;border-radius: 4px;">
                                                    <span class="text-primary">{{$present->name}}
                                                        {{--                                                    <i class="fa fa-flag"></i>--}}
                                                    </span>

                                                        </a></li>
                                                @else
                                                    <li>
                                                        <a href="{{route('locations',['id'=>$present->location_id])}}">
                                                            <span>{{$present->name}}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            </div>

            <div class="row test">
                <!-- content -->
                <div class="content col-md-12" style="margin-bottom: 10px">
                    <!-- Blog -->
                    <div id="blog" class="single-post" style="margin-bottom: 10px">
                        <!-- Post single item-->
                        @if($presentation)
                            <div class="post-item">
                                <div class="post-item-wrap">
                                    {{--                                    @if($presentation != null && $presentation->audio)--}}
                                    {{--                                        <div id="audio-max"></div>--}}
                                    <div class="post-audio" style="margin-top: 15px" id="audio-max">
                                        @if($presentation != null && $presentation->audio)
                                            {{--                                            <audio--}}
                                            {{--                                                src="{!! asset($presentation->audio) !!}"--}}
                                            {{--                                                preload="auto"/>--}}
                                            <audio id="myAudio" autoplay controls muted>
{{--                                                <source--}}
{{--                                                    src="https://vtg.hotelaas.com/audios/3W8C79NM5fLysbfCvEPxRrcdoLAxubNHsj7r5XGQ.mp3">--}}
                                                                                                <source src="{!! asset($presentation->audio) !!}">
                                            </audio>
                                        @else
                                        @endif
                                    </div>
                                    {{--                                    @endif--}}

                                    {{--                                    <div class="post-image">--}}
                                    {{--                                        <img src="{{$presentation? $presentation->image : null}}" alt="">--}}
                                    {{--                                    </div>--}}

                                    <div class="post-item-description">
                                        <h2 style="margin-top: 10px">{{$presentation? $presentation->name : null}}</h2>
                                        <div>
                                            {!! $presentation? $presentation->content :null !!}
                                        </div>

                                    </div>
                                    @if($presentation != null && $presentation->video)
                                        <div class="post-video">
                                            <iframe width="560" height="315"
                                                    src="{{$presentation? $presentation->video : null}}" frameborder="0"
                                                    allowfullscreen></iframe>
                                        </div>
                                    @endif
                                </div>
                                <!-- end: content -->
                            </div>
                        @else
                            <div style="margin-top: 30px">
                                <p class="alert alert-danger">
                                    @if($currentLanguageObj)
                                        {{$settings? $al? $al->value : null : null}}
                                        {{$currentLanguageObj->localization}}
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            {{--           ------------------------------------------------------- danh sach dia diem lan can--}}
            <div class="row test">
                <h5>{{$settings? $lrl? $lrl->value : null : null}}</h5>
                @if($presentation_next)
                    @foreach($presentation_next as $item)
                        <div class="col-md-4">
                            <div class="location-link">
                                <a href="{{route('locations',['id'=>$item->location_id])}}">
                                    {{$item->name}}
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{$settings? $arl? $arl->value : null : null}}
                @endif
            </div>
            {{--           ------------------------------------------------------- danh sach dia diem cung he thống --}}

            <div class="row test" style="margin-top: 10px">
                <h5>{{$settings? $lrz? $lrz->value : null : null}}</h5>
                @if($zone_locations)
                    @foreach($zone_locations as $key=>$item)
                        @foreach($presentation_zones as $key2=>$present)
                            @if($item->id == $present->location_id)
                                <div class="col-md-4">
                                    @if($present->id == $presentation->id)
                                        <div class="location-link">
                                            <a href="{{route('locations',['id'=>$present->location_id])}}"
                                               class="text-primary">
                                                {{$present->name}}
                                            </a>
                                        </div>
                                    @else
                                        <div class="location-link">
                                            <a href="{{route('locations',['id'=>$present->location_id])}}">
                                                {{$present->name}}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    {{$settings? $arz? $arz->value : null : null}}
                @endif
            </div>
        </div>
    </section>
    <!-- end: Page Content -->

    @if(Session::has('currentLanguage') != null &&  $presentation != null &&  $presentation->audio != null)

        <div class="modal-play modal-open" id="modal-2" tabindex="-1" role="modal" data-delay="1000"
             aria-labelledby="modal-label-2" aria-hidden="true">
            <div class="modal-body box-play">
                <div class="img-play">
                    {{--                                    <img src="{{asset('assets/images/play.png')}}" alt="" style="width: 100%">--}}
                    <i class="fa fa-play-circle animate__zoomIn"></i><br>
                    <span class="d-block">Listen</span>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/audioplayer.js')}}"></script>
    <script>

        $(document).ready(function () {
            // $(function () {
            //     $('audio').audioPlayer();
            // });

            // // var x = document.getElementById("myAudio");
            var media = document.getElementById("myAudio");
            const x = media.play();
            if (x !== undefined) {
                x.then(_ => {
                    media.muted = false;
                    $("#modal-2").addClass("dl-hidden");

                    // Autoplay started!
                }).catch(error => {
                    console.log('Lỗi')
                    // console.log('Muted sau:',media.muted);
                    setTimeout(autoPlay, 200)
                });
            }
        });

        function autoPlay() {
            console.log('Autoplay');
            // document.getElementById("myAudio").autoplay = true;
            document.getElementById("myAudio").muted = false;
            document.getElementById("myAudio").autoplay = true;
            document.addEventListener('click', musicPlay);
        }

        // choi nhac
        function musicPlay() {
            console.log('vao ')
            document.getElementById("myAudio").play();
            document.removeEventListener('click', musicPlay);
            $("#modal-2").addClass("dl-hidden");
        }


    </script>
    <script>
        $('.menu-btn').click(function () {
            if ($("#wrapper-menu").attr("class") == 'wrapper') {
                $("#wrapper-menu").addClass("dl-fixed");
                $("#wrapper-menu").addClass("dl-path-none");
                $("#menu-close").addClass("dl-fixed");
                $("#menu-close").addClass("top-20");
                $("#header").addClass("dl-hidden");
                // $("#page-content").addClass("dl-hidden");
                $("#footer").addClass("dl-hidden");
                $(".test").addClass("dl-hidden");
                $(".test").addClass("dl-hidden");
                $(".list-lo").addClass("dl-hidden");
                console.log('đã click menu')
            } else {
                $("#wrapper-menu").removeClass("dl-fixed");
                $("#wrapper-menu").removeClass("dl-path-none");
                $("#menu-close").removeClass("dl-fixed");
                $("#menu-close").removeClass("top-20");
                $("#header").removeClass("dl-hidden");
                // $("#page-content").removeClass("dl-hidden");
                $("#footer").removeClass("dl-hidden");
                $(".test").removeClass("dl-hidden");
                $(".list-lo").removeClass("dl-hidden");
                console.log('ko click menu')
            }// alert()
        })

        $('.menu-btn-2').click(function () {
            if ($("#wrapper-menu").attr("class") == 'wrapper' ||$("#wrapper-menu").attr("class") == 'wrapper dl-path-none dl-hidden') {
                $("#wrapper-menu").addClass("dl-fixed");
                $("#wrapper-menu").removeClass("dl-hidden");
                $("#wrapper-menu").addClass("dl-path-none");
                $("#menu-close").addClass("dl-hidden");
                $("#menu-close").addClass("top-20");
                $("#header").addClass("dl-hidden");
                $("#footer").addClass("dl-hidden");
                $(".test").addClass("dl-hidden");
                $(".test").addClass("dl-hidden");
                $(".list-lo").addClass("dl-hidden");
                $(".menu-btn-2").addClass("dl-hidden");
                $(".menu-btn-3").addClass("dl-fixed");
                $(".menu-btn-3").removeClass("dl-hidden");
                console.log('đã click menu')
            } else {
                $("#wrapper-menu").removeClass("dl-fixed");
                $("#wrapper-menu").removeClass("dl-path-none");
                $("#menu-close").removeClass("top-20");
                $("#header").removeClass("dl-hidden");
                $("#footer").removeClass("dl-hidden");
                $(".test").removeClass("dl-hidden");
                $(".list-lo").removeClass("dl-hidden");
                $(".menu-btn-2").removeClass("dl-hidden");
                $(".menu-btn-3").removeClass("dl-hidden");

                console.log('ko click menu')
            }// alert()
        })
        $('.menu-btn-3').click(function () {
            $("#wrapper-menu").removeClass("dl-fixed");
            $(".menu-btn-3").addClass("dl-hidden");
            $("#header").removeClass("dl-hidden");
            $("#footer").removeClass("dl-hidden");
            $(".test").removeClass("dl-hidden");
            $(".list-lo").removeClass("dl-hidden");
            $(".menu-btn-2").removeClass("dl-hidden");
            $(".wrapper").addClass("dl-hidden");

        });


            if ($("#wrapper-menu").attr("class") == 'wrapper') {
            console.log('có class ẩn')
        }else{
            console.log('chưa có class ẩn')
        }
    </script>


@endpush

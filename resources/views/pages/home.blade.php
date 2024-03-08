@extends('main')
@section('description')
    <meta name="description" content="{{$settings? $h? $h->value : null : null}}">
@endsection
@section('title',$settings? $h? $h->value : null : null)
@section('content')
    <!-- BLOG -->
    <section id="section4" class="background-grey">
        <div class="container">
            <div class="heading heading-center m-b-40">
                <h2 class="text-medium m-t-0">{{$settings? $tl? $tl->value : null :null}}</h2>
                {{--            <span class="lead">We do blogging sometimes!</span>--}}
            </div>
            @if($top_locations)
                <div id="blog">
                    <!-- Blog post-->
                    <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
                    @foreach($top_locations as $key=>$item)
                        @foreach($presentations as $key2=>$presentation)
                            @if($item->id == $presentation->location_id)
                                <!-- Post item-->
                                    <div class="post-item border">
                                        <div class="post-item-wrap">
                                            <div class="post-image">
                                                <a href="{{route('locations',['id'=>$presentation->location_id])}}">
                                                    <img src="{{$presentation? $presentation->image : null}}" alt=""
                                                         class="img-present-home">
                                                </a>
                                                {{--                            <span class="post-meta-category"><a href="">Lifestyle</a></span>--}}
                                            </div>
                                            <div class="post-item-description">
                                                <h2>
                                                    <a href="{{route('locations',['id'=>$presentation->location_id])}}">{{$presentation? $presentation->name : null}}
                                                    </a></h2>
                                                <p> {!! $presentation? $presentation->overview :null !!}</p>

                                                <a href="{{route('locations',['id'=>$presentation->location_id])}}"
                                                   class="item-link">
                                                    {{$settings? $d? $d->value : null :null}}
                                                    <i class="fa fa-arrow-right"></i></a>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end: Post item-->
                                @endif
                            @endforeach
                        @endforeach

                    </div>
                    <!-- end: Blog post-->
                </div>
            @endif

        </div>
    </section>
    <!-- end: BLOG -->

    <section>
        <div class="container">
            <div class="heading heading-center m-b-40">
                <h2 class="text-medium m-t-0">{{$settings? $tn ? $tn->value : null : null}}</h2>
                <div class="seperator"><i class="fa fa-dot-circle-o"></i></div>
            </div>
            @if($posts)
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-3">
                            <div class="room">
                                <div class="room-image">
                                    <a href="{{route('post',['slug'=>$post->slug])}}" class=" item-link">
                                        <img src="{{$post? $post->image : null}}" alt="#" style="max-width: 100%">
                                    </a>
                                    <div class="room-title">
                                        <h4>
                                            {{$post? $post->name : null}}
                                        </h4>
                                    </div>
                                </div>
                                <div class="room-details">
                                    <p>
                                        {{$post? $post->overview : null}}
                                    </p>
                                    <div class="pull-left">
                                        <a href="{{route('post',['slug'=>$post->slug])}}" class=" item-link">
                                            {{$settings? $d? $d->value : null : null}}
                                            <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            @if($posts && count($posts) > 7)
                <div class="row">
                    <div class="btn-more text-center">
                        <a class="btn btn-outline " href="{{route('posts')}}">
                            {{$settings? $sm? $sm->value : null :null}}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@extends('main')
@section('description')
    <meta name="description" content="{{$settings? $tn? $tn->value : null : null}}">
@endsection
@section('title',$settings? $tn? $tn->value : null : null)
@section('content')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb text-left" style="margin-bottom: 5px; display: flex">
                        <li style="width: 74px"><a href="{{route('home')}}"> <i
                                    class="fa fa-home"></i>
                                {{$settings? $h? $h->value : null : null}}
                            </a></li>
                        <li class="active" style="width: calc(100% - 74px)">{{$settings? $tn? $tn->value : null :null}}</li>
                    </ol>
                </div>
            </div>
            <div class="heading heading-center m-b-40">
                <h2 class="text-medium m-t-0">{{$settings? $tn? $tn->value : null : null}}</h2>
                <div class="seperator"><i class="fa fa-dot-circle-o"></i></div>
            </div>
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
                                    </a>
                                </div>
                                <div class="pull-right">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="paginate-link">
                    {!! $posts->render('custom') !!}
                </div>
            </div>
        </div>
    </section>

@endsection

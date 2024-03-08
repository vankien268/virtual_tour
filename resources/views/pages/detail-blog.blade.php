@extends('main')
@section('description')
    <meta name="description" content="{{$post? $post->overview : null}}">
@endsection
@section('title',$post? $post->name : null)
@section('content')

    <!-- Page Content -->
    <section id="page-content" class="sidebar-right">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb text-left" style="margin-bottom: 5px; display: flex">
                        <li style="width: 74px">
                            <a href="{{route('home')}}">
                                <i class="fa fa-home"></i>
                                {{$settings? $h? $h->value : null: null}}
                            </a>
                        </li>
                        <li class="active" style="width: calc(100% - 74px)"> {{$post? $post->name : null}}</li>
                    </ol>
                </div>
                <!-- content -->
                <div class="content col-md-12" style="margin-bottom: 10px">
                    <!-- Blog -->
                    <div id="blog" class="single-post" style="margin-bottom: 10px">
                        <!-- Post single item-->
                        @if($post)
                            <div class="post-item">
                                <div class="post-item-wrap">
{{--                                    <div class="post-image">--}}
{{--                                        <img src="{{$post? $post->image : null}}" alt="">--}}
{{--                                    </div>--}}

                                    <div class="post-item-description">
                                        <h2 style="margin-top: 10px">{{$post? $post->name : null}}</h2>
                                        <div>
                                            {!! $post? $post->content :null !!}
                                        </div>

                                    </div>
                                </div>
                                <!-- end: content -->
                            </div>
                        @else
                            <div style="margin-top: 30px">
                                <p class="alert alert-danger">
                                    Sai địa chỉ.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- end: Page Content -->

@endsection
@push('scripts')
<script>
    var lang = {{$currentLanguage? $currentLanguage : '0'}} ;
    console.log(lang);
</script>
@endpush

@extends('cms.layouts.app')
@section('menu-presentation','active')
@section('content')
@push('css')
    <link href="{{asset('assets/css/audioplayer.css')}}" rel="stylesheet">
    <style>
        .post-item-description img{
            width: 100% !important;
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            $(document).on('change', '#audio', function(){
                console.log($(this).val());
                $('#audio-input').val($(this).val());
            })
        });
    </script>
   <script src="{{ asset('assets/js/audioplayer.js') }}"></script>
   <script>
       $(document).ready(function() {
           $(function() {
               $('audio').audioPlayer();
           });
           // var x = document.getElementById("myAudio");
           // var y = document.getElementById("audioSource").getAttribute("src");
           var media = document.getElementById("myAudio");
           const x = media.play();
           // console.log(x);
           if (x !== undefined) {
               x.then(_ => {
                   console.log('auto băt dâu');
                   // Autoplay started!
               }).catch(error => {
                   console.log('Lỗi')
                   audio = document.getElementById("myAudio");
                   audio.muted = false;
                   // audio.play()
                   // x.muted = false;

                   // Autoplay was prevented.
                   // Show a "Play" button so that user can start playback.
               });
           }



           // console.log(y)
           // playAudio(y);
       });

       function playAudio(y) {
           var audio = new Audio(y);
           audio.play();

       }
   </script>
   <script>
       $('.menu-btn').click(function() {
           if ($("#wrapper-menu").attr("class") == 'wrapper') {
               $("#wrapper-menu").addClass("dl-fixed");
               $("#menu-close").addClass("dl-fixed");
               $("#menu-close").addClass("top-20");
               $("#header").addClass("dl-hidden");
               // $("#page-content").addClass("dl-hidden");
               $("#footer").addClass("dl-hidden");
               $(".test").addClass("dl-hidden");
           } else {
               $("#wrapper-menu").removeClass("dl-fixed");
               $("#menu-close").removeClass("dl-fixed");
               $("#menu-close").removeClass("top-20");
               $("#header").removeClass("dl-hidden");
               // $("#page-content").removeClass("dl-hidden");
               $("#footer").removeClass("dl-hidden");
               $(".test").removeClass("dl-hidden");
           }
           // alert()
       })
   </script>
   <script type="text/javascript">
    CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: "{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.php') }}",
        filebrowserImageBrowseUrl: "{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.php?type=Images') }}",
        // filebrowserUploadUrl: "{{ asset('BucketAdmin/html/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        // filebrowserImageUploadUrl: "{{ asset('BucketAdmin/html/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        // filebrowserFlashBrowseUrl: "{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.html?type=Flash') }}",
        // filebrowserFlashUploadUrl: "{{ asset('BucketAdmin/html/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
    } );
</script>
@endpush

<div class="row">
    <form id="" action="{{ route('cms.presentations.update') }}" method="post" role="form" enctype="multipart/form-data">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa thuyết minh
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <div class="form-group">
                        <label for="location">Chọn địa điểm<span class="text-danger">( * )</span> </label>
                        <select name="location_id" id="location" class="form-control" disabled>
                            <option value="">--Chọn địa điểm--</option>
                            @foreach ($locations as $key => $value)
                                <option value="{{ $value->id }}" {{ $record->location_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Chọn ngôn ngữ<span class="text-danger">( * )</span> </label>
                        <select name="language_id" id="language" class="form-control" disabled>
                            <option value="">--Chọn ngôn ngữ--</option>
                            @foreach ($languages as $key => $value)
                                <option value="{{ $value->id }}" {{ $record->language_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="form-group">
                        <label for="name">Tên<span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{ $record->name }}" class="form-control" id="name" placeholder="Nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="overview">Tổng quan </label>
                        <input type="text" name="overview" value="{{ $record->overview }}" class="form-control" id="overview" placeholder="Nhập tổng quan">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Ảnh đại diện<span class="text-danger">( * )</span> </label><br>
                        @if ($record->image)
                            <div>
                                <img style="width:200px" src="{{ asset($record->image) }}" alt="a">
                            </div><br>
                        @endif
                        <input type="file" name="image" value="{{ $record->image }}" class="form-control" id="avatar" placeholder="Nhập tổng quan">
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Nội dung <span class="text-danger">( * )</span>
                            </strong></label>
                        <div class="display_textarea"><br>
                            <textarea id="content" class="form-control ckeditor" rows="10" name="content" title="Nhập nội dung">{{ $record->content }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="video">Link video</label>
                        <input type="text" name="video" value="{{ $record->video }}" class="form-control" id="video" placeholder="Nhập link video">
                    </div>
                    <div class="form-group">
                        <label for="audio">Âm thanh<span class="text-danger">( * )</span> </label>
                        @if ($record->audio)
                            <input type="text" disabled value="{{ $record->audio }}" class="form-control" id="audio" placeholder="Nhập tổng quan"><br>
                        @endif
                        <input type="file" name="audio" value="{{ $record->audio }}" class="form-control" id="audio-input" placeholder="Nhập tổng quan">
                    </div>
                    <div class="form-group">
                        <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                        <select name="status" id="" class="form-control">
                            <option {{ $record->status == 0 ? 'selected' : '' }} value="0">Không hiện thị</option>
                            <option {{ $record->status == 1 ? 'selected' : '' }} value="1">Hiện thị</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div style="display: flex; justify-content: space-between">
                        <div>
                            <a href="#myModal" data-toggle="modal" class="btn btn-primary" >Preview</a>
                            <button type="submit" class="btn btn-primary">Ghi lại</button>
                            <a href="{{ route('cms.locations.index') }}" type="submit" class="btn btn-default">Hủy</a>
                        </div>
                        <div>
                            <a href="{{ route('cms.presentations.destroy', ['id' => $record->id]) }}" class="btn btn-danger"
                                onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
                                Xóa
                            </a>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Xem trước bài thuyết trình</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <section id="page-content" class="sidebar-right">
                            <div class="">
                                <div class="row test">
                                    <!-- content -->
                                    <div class="content col-md-12" style="margin-bottom: 10px">
                                        <!-- Blog -->
                                        <div id="blog" class="single-post" style="margin-bottom: 10px">
                                            <!-- Post single item-->
                                            @if ($presentation)
                                                <div class="post-item">
                                                    <div class="post-item-wrap">
                                                        <div class="post-audio" style="margin-top: 15px" id="audio-max">
                                                            @if ($presentation != null && $presentation->audio)
                                                            <audio id="myAudio" controls="controls" muted>
                                                                <source src="{!! asset($presentation->audio) !!}">
                                                            </audio>
                                                            @endif
                                                        </div>
                                                        <div class="post-item-description">
                                                            <h2 style="margin-top: 10px">{{ $presentation ? $presentation->name : null }}</h2>
                                                            <div>
                                                                {!! $presentation ? $presentation->content : null !!}
                                                            </div>
                                                        </div>
                                                        @if ($presentation != null && $presentation->video)
                                                            <div class="post-video">
                                                                <iframe width="560" height="315"
                                                                    src="{{ $presentation ? $presentation->video : null }}" frameborder="0"
                                                                    allowfullscreen></iframe>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
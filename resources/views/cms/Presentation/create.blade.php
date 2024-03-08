@extends('cms.layouts.app')
@section('menu-presentation','active')
@push('js')
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
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.presentations.store') }}" method="post" role="form" enctype="multipart/form-data">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thuyết minh
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="location">Chọn địa điểm<span class="text-danger">( * )</span> </label>
                        <select name="location_id" id="location" class="form-control" disabled>
                            <option value="">--Chọn địa điểm--</option>
                            @foreach ($locations as $key => $value)
                            <option value="{{ $value->id }}" {{ $location->id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                            <input type="hidden" name="location_id" value="{{ $location->id }}">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Chọn ngôn ngữ<span class="text-danger">( * )</span> </label>
                        <select name="language_id" id="language" class="form-control">
                            <option value="">--Chọn ngôn ngữ--</option>
                            @foreach ($languages as $key => $value)
                                <option value="{{ $value->id }}" {{ old('language_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                                {{-- <input type="hidden" value="{{ $location->->id }}" name="language"> --}}
                        </select>
                    </div>
                 
                    <div class="form-group">
                        <label for="name">Tên<span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="overview">Tổng quan </label>
                        <input type="text" name="overview" value="{{old('overview')}}" class="form-control" id="overview" placeholder="Nhập tổng quan">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Ảnh đại diện<span class="text-danger">( * )</span> </label>
                        <input type="file" name="image" value="{{old('image')}}" class="form-control" id="avatar" placeholder="Nhập tổng quan">
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Nội dung <span class="text-danger">( * )</span>
                            </strong></label>
                        <div class="display_textarea"><br>
                            <textarea id="content" class="form-control ckeditor" rows="10" name="content" title="Nhập nội dung">{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="video">Link video </label>
                        <input type="text" name="video" value="{{old('video')}}" class="form-control" id="video" placeholder="Nhập link video">
                    </div>
                    <div class="form-group">
                        <label for="audio">Âm thanh<span class="text-danger">( * )</span> </label>
                        <input type="file" name="audio" value="{{old('audio')}}" class="form-control" id="audio" placeholder="Nhập tổng quan">
                    </div>
                    <div class="form-group">
                        <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                        <select name="status" id="" class="form-control">
                            <option value="1">Hiện thị</option>
                            <option value="0">Không hiện thị</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        @if (App\Helpers\Helper::countLanguage($location) > 1)
                            <button type="submit" value="language" name="btn" class="btn btn-primary">Ghi lại và thêm ngôn ngữ</button>
                        @endif
                        <button type="submit" value="submit" name="btn" class="btn btn-primary">Ghi lại</button>
                        <a href="{{ route('cms.locations.index') }}" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
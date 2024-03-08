@extends('cms.layouts.app')
@section('menu-new','active')
@push('js')
<script type="text/javascript">
    CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: "{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.html') }}",
        filebrowserImageBrowseUrl: "{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.html?type=Images') }}",
        // filebrowserUploadUrl: "{{ asset('BucketAdmin/html/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        // filebrowserImageUploadUrl: "{{ asset('BucketAdmin/html/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
        // filebrowserFlashBrowseUrl: "{{ asset('BucketAdmin/html/js/ckfinder/ckfinder.html?type=Flash') }}",
        // filebrowserFlashUploadUrl: "{{ asset('BucketAdmin/html/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
    } );
</script>
@endpush
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.news.store') }}" method="post" role="form" enctype="multipart/form-data">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm thuyết minh
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="location">Chọn địa điểm </label>
                        <select name="location_id" id="location" class="form-control">
                            <option value="">--Chọn địa điểm--</option>
                            @foreach ($locations as $key => $value)
                                <option value="{{ $value->id }}" {{ old('location_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="language">Chọn ngôn ngữ<span class="text-danger">( * )</span> </label>
                        <select name="language_id" id="language" class="form-control">
                            <option value="">--Chọn ngôn ngữ--</option>
                            @foreach ($languages as $key => $value)
                                <option value="{{ $value->id }}" {{ old('language_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="form-group">
                        <label for="name">Tên<span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập tên">
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
                        <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                        <select name="status" id="" class="form-control">
                            <option value="1">Hiện thị</option>
                            <option value="0">Không hiện thị</option>
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ghi lại</button>
                        <a href="{{ route('cms.news.index') }}" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection
@extends('cms.layouts.app')
@section('menu-new','active')
@section('content')
@push('js')
   
@endpush

<div class="row">
    <form id="" action="{{ route('cms.news.update') }}" method="post" role="form" enctype="multipart/form-data">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa bài tin
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <div class="form-group">
                        <label for="location">Chọn địa điểm </label>
                        <select name="location_id" id="location" class="form-control">
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
                        <input type="text" name="name" value="{{ old('name') ? old('name') : $record->name }}" class="form-control" id="name" placeholder="Nhập tên">
                    </div>
                    <div class="form-group">
                        <label for="avatar">Ảnh đại diện<span class="text-danger">( * )</span> </label>
                        @if ($record->image)
                            <div>
                                <img style="width:200px" src="{{ asset($record->image) }}" alt="a">
                            </div><br>
                        @endif
                        <input type="file" name="image" value="{{ $record->images }}" class="form-control" id="avatar" placeholder="Nhập tổng quan">
                    </div>
                   
                    <div class="form-group">
                        <label for="content"><strong>Nội dung <span class="text-danger">( * )</span>
                            </strong></label>
                        <div class="display_textarea"><br>
                            <textarea id="content" class="form-control ckeditor" rows="10" name="content" title="Nhập nội dung">{{ old('content') ? old('content') : $record->content }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                        <select name="status" id="" class="form-control">
                            <option {{ $record->status == 0 ? 'selected' : '' }} value="0">Ngừng</option>
                            <option {{ $record->status == 1 ? 'selected' : '' }} value="1">Sử dụng</option>
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
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
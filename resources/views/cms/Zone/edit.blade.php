@extends('cms.layouts.app')
@section('menu-zones','active')
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
    <form id="" action="{{ route('cms.zones.update') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa khu vực
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <div class="form-group">
                        <label for="name">Tên khu vực <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{ old('name') ? old('name') : $record->name }}" class="form-control" id="name" placeholder="Nhập tên khu vực">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ khu vực <span class="text-danger">( * )</span> </label>
                        <input type="text" name="address" value="{{ old('address') ? old('address') : $record->address }}" class="form-control" id="address" placeholder="Nhập địa chỉ khu vực">
                    </div>
                    <div class="form-group">
                        <label for="content"><strong>Mô tả khu vực <span class="text-danger">( * )</span>
                            </strong></label>
                        <div class="display_textarea"><br>
                            <textarea id="content" class="form-control ckeditor" rows="10" name="overview" title="Nhập nội dung">{{ old('overview') ? old('overview') : $record->overview }}</textarea>
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
                        <a href="{{ route('cms.zones.index') }}" type="submit" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
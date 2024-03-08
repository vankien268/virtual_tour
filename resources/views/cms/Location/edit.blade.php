@extends('cms.layouts.app')
@section('menu-location','active')
@push('js')
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                placeholder: "Chọn địa điểm liên quan",
            });
        })

    </script>
    <script type="text/javascript">
        CKEDITOR.replace( 'overview', {
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
    <form id="" action="{{ route('cms.locations.update') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật địa điểm
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <div class="form-group">
                        <label for="zone">Chọn vùng<span class="text-danger">( * )</span> </label>
                        <select name="zone_id" id="zone" class="form-control" disabled>
                            @foreach ($zones as $key => $value)
                                <option 
                                {{ $record->zone_id == $value->id ? 'selected' : '' }}
                                value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{ old('name') ? old('name') : $record->name }}" class="form-control" id="name" placeholder="Nhập tên địa điểm">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" value="{{ old('address') ? old('address') : $record->address }}" class="form-control" id="address" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group">
                        <label for="lat">Lat </label>
                        <input type="number" step="any" name="lat" value="{{ old('lat') ? old('lat') : $record->lat }}" class="form-control" id="lat" placeholder="Nhập lat">
                    </div>
                    <div class="form-group">
                        <label for="long">Long </label>
                        <input type="number" step="any" name="long" value="{{ old('long') ? old('long') : $record->long}}" class="form-control" id="long" placeholder="Nhập long">
                    </div>
                    <div class="form-group">
                        <label for="overview"><strong>Mô tả 
                            </strong></label>
                        <div class="display_textarea"><br>
                            <textarea id="overview" class="form-control ckeditor" rows="10" name="overview" title="Nhập nội dung">{{ old('overview') ? old('overview') : $record->overview }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position">Vị trí <span class="text-danger">( * )</span> </label>
                        <input type="number" name="position" value="{{ old('position') ? old('position') : $record->position }}" class="form-control" id="position" placeholder="Nhập vị trí">
                    </div>
                    <div class="form-group">
                        <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                        <select name="status" id="" class="form-control">
                            <option {{ $record->status == 0 ? 'selected' : '' }} value="0">Không hiện thị</option>
                            <option {{ $record->status == 1 ? 'selected' : '' }} value="1">Hiện thị</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="overview">Địa điểm liên quan </label>
                        <select name="related[]" id="" class="form-control select2" multiple>
                            @foreach ($locations as $key => $value)
                                <option
                                @foreach ($record->relatedLoactions as $relatedKey => $related)
                                    @if ($related->related_location_id == $value->id)
                                        selected
                                    @endif
                                @endforeach   
                                value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ghi lại</button>
                        <a href="{{ route('cms.locations.index') }}" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
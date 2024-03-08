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
    <form id="" action="{{ route('cms.locations.store') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm địa điểm
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    @if (count($zones) == 1)
                        <div class="form-group">
                            <label for="zone">Chọn vùng<span class="text-danger">( * )</span> </label>
                            <select name="zone_id" id="zone" class="form-control" disabled>
                                @foreach ($zones as $key => $value)
                                    <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                                    <input type="hidden" name="zone_id" value="{{ $value->id }}">
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="zone">Chọn vùng<span class="text-danger">( * )</span> </label>
                            <select name="zone_id" id="zone" class="form-control">
                                <option value="">--Chọn vùng--</option>
                                @foreach ($zones as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Tên <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập tên địa điểm">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group">
                        <label for="lat">Lat </label>
                        <input type="number" step="any" name="lat" value="{{old('lat')}}" class="form-control" id="lat" placeholder="Nhập lat">
                    </div>
                    <div class="form-group">
                        <label for="long">Long </label>
                        <input type="number" step="any" name="long" value="{{old('long')}}" class="form-control" id="long" placeholder="Nhập long">
                    </div>
                    <div class="form-group">
                        <label for="overview"><strong>Mô tả 
                            </strong></label>
                        <div class="display_textarea"><br>
                            <textarea id="overview" class="form-control ckeditor" rows="10" name="overview" title="Nhập nội dung">{{ old('overview') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position">Vị trí <span class="text-danger">( * )</span> </label>
                        <input type="number" name="position" value="{{old('position')}}" class="form-control" id="position" placeholder="Nhập vị trí">
                    </div>
                    <div class="form-group">
                        <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                        <select name="status" id="" class="form-control">
                            <option value="1">Hiện thị</option>
                            <option value="0">Không hiện thị</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="overview">Địa điểm liên quan</label>
                        <select name="related[]" id="" class="form-control select2" multiple>
                            @foreach ($locations as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" value="language" name="btn" class="btn btn-primary">Ghi lại và thêm ngôn ngữ</button>
                        <button type="submit" value="location" name="btn" class="btn btn-primary">Ghi lại</button>
                        <a href="{{ route('cms.locations.index') }}" type="submit" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
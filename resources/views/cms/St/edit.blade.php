@extends('cms.layouts.app')
@section('menu-zones','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.settings.update') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="location">Chọn địa điểm<span class="text-danger">( * )</span> </label>
                        <select name="location_id" id="location" class="form-control" disabled>
                            <option value="">--Chọn địa điểm--</option>
                            @foreach ($locations as $key => $value)
                            <option value="{{ $value->id }}" {{ $record->location->id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="location_id" value="{{ $record->location->id }}" id="">
                        <input type="hidden" name="id" value="{{ $record->id }}" id="">
                    </div>
                    <div class="form-group">
                        <label for="language">Chọn ngôn ngữ<span class="text-danger">( * )</span> </label>
                        <select name="language_id" id="language" class="form-control" disabled>
                            <option value="">--Chọn ngôn ngữ--</option>
                            @foreach ($languages as $key => $value)
                                <option value="{{ $value->id }}" {{ $record->language->id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                            <input type="hidden" name="language_id" value="{{ $record->language->id }}" id="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="key">Key <span class="text-danger">( * )</span> </label>
                        <input type="text" name="key" value="{{ $record->key }}" class="form-control" id="key" placeholder="Nhập địa chỉ vùng">
                    </div>
                    <div class="form-group">
                        <label for="value">Value <span class="text-danger">( * )</span> </label>
                        <input type="text" name="value" value="{{ $record->value }}" class="form-control" id="value" placeholder="Nhập mô tả vùng">
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ghi lại</button>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection
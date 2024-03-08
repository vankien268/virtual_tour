@extends('cms.layouts.app')
@section('menu-related','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.related.locations.update') }}" method="post" role="form">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa địa điểm liên quan
                </header>
                <div class="panel-body position-center">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $record->id }}" name="id">
                    <div class="form-group">
                        <label for="location">Chọn địa điểm<span class="text-danger">( * )</span> </label>
                        <select name="location_id" id="location" class="form-control">
                            <option value="">--Chọn địa điểm--</option>
                            @foreach ($locations as $key => $value)
                                <option value="{{ $value->id }}" {{ $record->location_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="related">Chọn địa điểm liên quan<span class="text-danger">( * )</span> </label>
                        <select name="related_location_id" id="related" class="form-control">
                            <option value="">--Chọn địa điểm liên quan--</option>
                            @foreach ($locations as $key => $value)
                                <option value="{{ $value->id }}" {{ $record->related_location_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="form-group">
                        <label for="position">Vị trí<span class="text-danger">( * )</span> </label>
                        <input type="text" name="position" value="{{ $record->position }}" class="form-control" id="position" placeholder="Nhập vị trí">
                    </div>
                   
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Xác Nhận Chỉnh Sửa Địa Điểm Liên Quan</button>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection
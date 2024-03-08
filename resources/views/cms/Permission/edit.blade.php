@extends('cms.layouts.app')
@section('menu-zones','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.zones.update') }}" method="post" role="form">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa vùng
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <div class="form-group">
                        <label for="name">Tên vùng <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{ $record->name }}" class="form-control" id="name" placeholder="Nhập tên vùng">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ vùng <span class="text-danger">( * )</span> </label>
                        <input type="text" name="address" value="{{ $record->address }}" class="form-control" id="address" placeholder="Nhập địa chỉ vùng">
                    </div>
                    <div class="form-group">
                        <label for="overview">Mô tả vùng <span class="text-danger">( * )</span> </label>
                        <input type="text" name="overview" value="{{ $record->overview }}" class="form-control" id="overview" placeholder="Nhập mô tả vùng">
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cập Nhật Vùng</button>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection
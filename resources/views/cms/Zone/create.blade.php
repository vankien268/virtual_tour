@extends('cms.layouts.app')
@section('menu-zones','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.zones.store') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm khu vực
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Tên khu vực <span class="text-danger">( * )</span> </label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập tên khu vực">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ khu vực <span class="text-danger">( * )</span> </label>
                                <input type="text" name="address" value="{{old('address')}}" class="form-control" id="address" placeholder="Nhập địa chỉ khu vực">
                            </div>
                            <div class="form-group">
                                <label for="overview">Mô tả khu vực <span class="text-danger">( * )</span> </label>
                                <input type="text" name="overview" value="{{old('overview')}}" class="form-control" id="overview" placeholder="Nhập mô tả khu vực">
                            </div>
                            <div class="form-group">
                                <label for="overview">Trạng thái<span class="text-danger">( * )</span> </label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Sử dụng</option>
                                    <option value="0">Ngừng</option>
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ghi lại</button>
                                <a href="{{ route('cms.zones.index') }}" type="submit" class="btn btn-default">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
@extends('cms.layouts.app')
@section('menu-user','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.manager.users.store') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm người dùng
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Tên <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập tên người dùng">
                    </div>
                    <div class="form-group">
                        <label for="address">Username <span class="text-danger">( * )</span> </label>
                        <input type="text" name="email" value="{{old('email')}}" class="form-control" id="address" placeholder="Nhập username">
                    </div>
                    <div class="form-group">
                        <label for="overview">Password <span class="text-danger">( * )</span> </label>
                        <input type="text" name="password" value="{{old('overview')}}" class="form-control" id="overview" placeholder="Nhập password">
                    </div>
                    <div class="form-group">
                        <label for="overview">Vai trò<span class="text-danger">( * )</span> </label>
                        <select name="role" id="" class="form-control">
                            <option value="">-- Chọn vai trò --</option>
                            @foreach ($roles as $value)
                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ghi lại</button>
                        <a href="{{ route('cms.manager.users.index') }}" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection
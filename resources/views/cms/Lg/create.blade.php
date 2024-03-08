@extends('cms.layouts.app')
@section('menu-language','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.languages.store') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm ngôn ngữ
                </header>
                <div class="panel-body ">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Tên tiếng việt <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập tên tiếng việt">
                    </div>
                    <div class="form-group">
                        <label for="localization">Tên theo ngôn ngữ <span class="text-danger">( * )</span> </label>
                        <input type="text" name="localization" value="{{old('localization')}}" class="form-control" id="localization" placeholder="Nhập tên theo ngôn ngữ">
                    </div>
                    <div class="form-group">
                        <label for="code">Mã ngôn ngữ <span class="text-danger">( * )</span> </label>
                        <input type="text" name="code" value="{{old('code')}}" class="form-control" id="code" placeholder="Nhập mã ngôn ngữ">
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
                        <a href="{{ route('cms.languages.index') }}" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-4"></div>
    </form>
</div>

@endsection
@extends('cms.layouts.app')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.manager.roles.store') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Thêm vai trò
                </header>
                <div class="panel-body position-center" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Tên <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" required value="{{old('name')}}" class="form-control" id="name" placeholder="Nhập vai trò">
                    </div>
                    <br>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ghi lại</button>
                        <a href="{{ route('cms.manager.roles.index') }}" class="btn btn-default">Hủy</a>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>

@endsection
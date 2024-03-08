@extends('cms.layouts.app')
@section('menu-zones','active')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.manager.users.update') }}" method="post" role="form">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Chỉnh sửa người dùng
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <div class="form-group">
                        <label for="name">Tên <span class="text-danger">( * )</span> </label>
                        <input type="text" name="name" value="{{ $record->name }}" class="form-control" id="name" placeholder="Nhập tên vùng">
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
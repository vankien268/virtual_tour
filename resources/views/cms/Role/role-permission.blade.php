@extends('cms.layouts.app')
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.manager.roles.permission.store') }}" method="post" role="form">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm quyền cho vai trò: <span class="text-primary">{{ $role->name }}</span>
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $role->id }}" name="id">
                    <div class="row">
                       @foreach ($permissions as $key => $value)
                       <div class="col-md-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="{{ $value->id }}" value="{{ $value->name }}"
                                    @foreach ($rolePermissions as $keyP => $per)
                                        @if ($value->id == $per->id)
                                                checked
                                        @endif
                                    @endforeach
                                    name="permissions[]"> {{ $value->name }}
                                </label>
                            </div>
                        </div>
                       @endforeach
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
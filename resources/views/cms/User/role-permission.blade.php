@extends('cms.layouts.app')
@section('menu-user','active')
@push('js')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.cbox-role', function(){
                var roleId = [];
                $('.cbox-role').each(function(){
                    if($(this).is(':checked')){
                        // console.log($(this));
                        roleId.push($(this).val())
                    }
                });
                // console.log(roleId);
                //ajax
                $.ajax({
                    type: 'GET',
                    url: '{{ route('cms.manager.users.render.permission') }}',
                    data: {roleIds: roleId},
                    success: function (data) {
                        console.log(data);
                        $('#load').html(data.html);
                        
                    },
                    error: function (data) {
                        console.log('lỗi');
                    }
                });
            });
        });
    </script>
@endpush
@section('content')

<div class="row">
    <form id="" action="{{ route('cms.manager.users.role.permission.store') }}" method="post" role="form">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm quyền và vai trò cho người dùng: <span class="text-primary">{{ $user->name }}</span>
                </header>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $user->id }}" name="id">
                    <h4><strong>Vai trò:</strong></h4>
                    <div class="row">
                       @foreach ($roles as $key => $value)
                       <div class="col-md-2 ">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" class="cbox-role" id="{{ $value->id }}" value="{{ $value->id }}"
                                    @foreach ($userRoles as $keyR => $role)
                                        @if ($value->id == $role->id)
                                                checked
                                        @endif
                                    @endforeach
                                    name="roles[]"> {{ $value->name }}
                                </label>
                            </div>
                        </div>
                       @endforeach
                    </div>
                    <hr>
                    <h4><strong>Quyền:</strong></h4>
                    <div class="row" id="load">
                        @include('cms.User.Component.user-permission')
                       
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
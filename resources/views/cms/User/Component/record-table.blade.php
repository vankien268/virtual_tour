<td data-title="ID" class="">
    <a class="btn btn-primary disabled">
        {{ App\Helpers\Helper::getSerial($records->currentPage(),$records->perPage(),$key+1) }}
    </a>
</td>
<td data-title="{{__("Tên")}}">
    <strong>{{ $record->name }}</strong>
</td>
<td data-title="{{__("Email")}}">
    <strong>{{ $record->email }}</strong>
</td>
{{-- <td data-title="{{__("Mật khẩu")}}">
    <strong>{{ $record->password }}</strong>
</td> --}}
<td data-title="{{__("Vai trò")}}">
    @foreach ($record->roles as $key => $value)
        <span class="badge">{{ $value->name }}</span>
    @endforeach
</td>
<td data-title="{{__("Quyền")}}">
    @foreach ($record->permissions as $key => $value)
        <span class="badge">{{ $value->name }}</span>
@endforeach
</td>
<td data-title="Hành Động">
   <div class="row">
    <div class="col-md-12">
            
            <a href="{{ route('cms.manager.users.role.permission', ['id' => $record->id]) }}" 
                class="btn btn-primary btn-full-width m-bot15" ><i class="fa fa-users"></i>  Phân quyền</a>
            <a href="{{ route('cms.manager.users.edit', ['id' => $record->id]) }}" 
                class="btn btn-primary btn-full-width m-bot15" ><i class="fa fa-edit"></i>  Chỉnh sửa</a>
            <a
                href="#change-password-{{ $record->id }}" data-toggle="modal"
                class="btn btn-primary btn-full-width m-bot15" ><i class="fa fa-exchange"></i>  Đổi mật khẩu</a>
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="change-password-{{ $record->id }}" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">Đổi mật khẩu của user: <strong>{{ $record->name }}</strong></h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('cms.manager.users.change.password', ['id' => $record->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $record->id }}" name="id">
                                        <div class="form-group">
                                            <label for="name"><strong>Nhập mật khẩu mới</strong> <span class="text-danger">( * )</span> </label>
                                            <input type="text" name="password" value="" class="form-control" id="name" placeholder="Nhập mật khẩu mới" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Ghi lại</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('cms.manager.users.destroy') }}" method="post" class="m-bot15">
                    @csrf
                    <input type="hidden" name="id" value="{{ $record->id }}">
                    <button type="submit" class="btn btn-danger btn-full-width"
                    onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
                    <i class="fa fa-trash-o"></i> Xóa
                </button>
            </form>
    </div>
   </div>
</td>
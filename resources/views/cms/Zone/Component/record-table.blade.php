<td data-title="ID" class="text-center">
    <a class="btn btn-primary disabled">
        {{ $record->id }}
    </a>
</td>
<td data-title="{{__("Tên")}}">
    <strong>{{ $record->name }}</strong>
</td>
<td data-title="{{__("Địa chỉ")}}">
    <strong>{{ $record->address }}</strong>
</td>
<td data-title="{{__("Mô tả")}}">
    <strong>{!! $record->overview !!}</strong>
</td>
<td data-title="Hành Động">
   <div class="row">
    <div class="col-md-12">
        <a href="{{ route('cms.zones.edit', ['id' => $record->id]) }}" 
            class="btn btn-primary btn-full-width m-bot15" ><i class="fa fa-edit"></i> Chỉnh sửa</a>
        <form action="{{ route('cms.zones.destroy') }}" method="post">
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
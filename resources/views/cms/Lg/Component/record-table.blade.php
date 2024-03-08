<td data-title="ID" class="text-center">
    <a class="btn btn-primary disabled">
        {{ $record->id }}
    </a>
   
</td>
<td data-title="{{__("Tên tiếng việt")}}">
    <strong>{{ $record->name }}</strong>
</td>
<td data-title="{{__("Tên theo ngôn ngữ")}}">
    <strong>{{ $record->localization }}</strong>
</td>
<td data-title="{{__("Mã ngôn ngữ")}}">
    <strong>{{ $record->code }}</strong>
</td>
<td data-title="Hành Động">
    <a href="{{ route('cms.languages.edit', ['id' => $record->id]) }}" 
        class="btn btn-primary btn-block m-bot15" ><i class="fa fa-edit"></i> Chỉnh sửa</a>
    <button 
        class="btn-def btn btn-primary btn-block m-bot15
        {{ $record->status == 0 ? 'disabled' : '' }}
        " 
        data-id="{{ $record->id }}"><i class="fa fa-check"></i> Mặc định</button>
    <form action="{{ route('cms.languages.destroy') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $record->id }}">
        <button type="submit" class="btn btn-danger btn-block"
            onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
            <i class="fa fa-trash-o"></i>Xóa
        </button>
    </form>
</td>
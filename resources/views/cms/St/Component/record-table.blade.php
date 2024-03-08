<td data-title="ID" class="">
    <a class="btn btn-primary disabled text-center">
        {{ $record->id }}
    </a>

</td>
<td data-title="{{__("Ngôn ngữ")}}">
    <strong>{{ $record->location->name }}</strong>
</td>
<td data-title="{{__("Địa điểm")}}">
    <strong>{{ $record->language->name }}</strong>
</td>
<td data-title="{{__("Key")}}">
    <strong>{{ $record->key }}</strong>
</td>
<td data-title="{{__("Value")}}">
    <strong>{{ $record->value }}</strong>
</td>
<td data-title="Hành Động">
   <div class="row">
    <div class="col-md-12">
        <a href="{{ route('cms.settings.edit', ['id' => $record->id]) }}" 
            class="btn btn-success btn-full-width m-bot15" ><i class="fa fa-edit"></i>  Chỉnh sửa</a>
        <form action="{{ route('cms.settings.destroy') }}" method="post">
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
<td data-title="ID" class="text-center">
    <a class="btn btn-primary disabled">
        {{ $record->id }}
    </a>
   
</td>
<td data-title="{{__("Địa điểm")}}">
    <strong>{{ $record->location->name }}</strong>
</td>
<td data-title="{{__("Địa điểm liên quan")}}">
    <strong>{{ $record->related->name }}</strong>
</td>
<td data-title="{{__("Vị trí")}}">
    <strong>{{ $record->position }}</strong>
</td>
<td data-title="Hành Động">
    <a href="{{ route('cms.related.locations.edit', ['id' => $record->id]) }}" 
        class="btn btn-success btn-block m-bot15" >Chỉnh sửa</a>
    <form action="{{ route('cms.related.locations.destroy') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $record->id }}">
        <button type="submit" class="btn btn-danger btn-block"
            onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
            Xóa
        </button>
    </form>
</td>
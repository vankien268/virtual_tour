<td data-title="ID" class="text-center">
    <a class="btn btn-primary disabled">
        {{ $record->id }}
    </a>
    
</td>
<td data-title="{{__("Ảnh")}}">
    <img width="100px" src="{{ asset($record->image) }}" alt="">
</td>
<td data-title="{{__("Tên")}}">
    <strong>{{ $record->name }}</strong>
</td>
<td data-title="{{__("TT bài tin")}}">
    <strong>Ngôn ngữ: </strong>{{ $record->language->name }}<br>
    <strong>Địa điểm: </strong>{{ isset($record->location->name) ? $record->location->name : '' }}<br>
    <strong>Slug: </strong>{{ $record->slug }}<br>
</td>
<td data-title="Hành Động">
    <a href="{{ route('cms.news.edit', ['id' => $record->id]) }}" 
        class="btn btn-primary btn-block m-bot15" ><i class="fa fa-edit"></i>  Chỉnh sửa</a>
    <form action="{{ route('cms.news.destroy') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $record->id }}">
        <button type="submit" class="btn btn-danger btn-block"
            onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
            <i class="fa fa-trash-o"></i> Xóa
        </button>
    </form>
</td>
<td data-title="ID" class="text-center">
    <a class="btn btn-primary disabled">
        {{ $record->id }}
    </a>
    
</td>
<td data-title="{{__("Ảnh đại diện")}}">
    <img width="100px" src="{{ asset($record->image) }}" alt="">
</td>
<td data-title="{{__("TT bài thuyết minh")}}">
    <strong>Ngôn ngữ: {{ $record->language->name }}</strong><br>
    <strong>Địa điểm: {{ $record->location->name }}</strong><br>
</td>
<td data-title="{{__("Nội dung")}}">
    {!! $record->content !!}
</td>
<td data-title="{{__("Video")}}">
    {{ $record->video }}
</td>
<td data-title="{{__("Audio")}}">
    <audio style="width: 100%" controls>
        <source src="{{ asset($record->audio) }}">
    </audio>
</td>
<td data-title="Hành Động">
    <a href="{{ route('cms.presentations.edit', ['id' => $record->id]) }}" 
        class="btn btn-success btn-block m-bot15" >Chỉnh sửa</a>
    <form action="{{ route('cms.presentations.destroy') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $record->id }}">
        <button type="submit" class="btn btn-danger btn-block"
            onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
            Xóa
        </button>
    </form>
</td>
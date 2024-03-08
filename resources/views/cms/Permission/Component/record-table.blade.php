<td data-title="ID" class="">
    <a class="btn btn-primary disabled">
        {{ $record->id }}
    </a>
    
</td>
<td data-title="{{__("Tên")}}">
    <strong>{{ $record->name }}</strong>
</td>
<td data-title="Hành Động">
   <div class="row">
    <div class="col-md-12">
        <a href="{{ route('cms.manager.permissions.edit', ['id' => $record->id]) }}" 
            class="btn btn-success btn-full-width m-bot15" >Chỉnh sửa</a>
        <form action="{{ route('cms.manager.permissions.destroy') }}" method="post" class="m-bot15">
                @csrf
                <input type="hidden" name="id" value="{{ $record->id }}">
                <button type="submit" class="btn btn-danger btn-full-width"
                onclick="return(confirm('Bạn có chắc muốn xóa không?'));">
                Xóa
            </button>
        </form>
       
    </div>
   </div>
</td>
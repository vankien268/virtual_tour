<td data-title="ID" class="">
    <a class="btn btn-primary disabled ">
        {{ App\Helpers\Helper::getSerial($records->currentPage(),$records->perPage(),$key+1) }}
    </a>
</td>
<td data-title="{{__("Tên")}}">
    <strong>{{ $record->name }}</strong>
</td>
<td data-title="Hành Động">
   <div class="row">
    <div class="col-md-12">
   
        <a href="{{ route('cms.manager.roles.permission', ['id' => $record->id]) }}" 
            class="btn btn-primary btn-full-width m-bot15" ><i class="fa fa-users"></i> Phân quyền</a>
    </div>
   </div>
</td>
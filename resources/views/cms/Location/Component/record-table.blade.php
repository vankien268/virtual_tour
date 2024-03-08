<section class="panel">
    <header class="panel-heading">
        <div>
            Danh sách địa điểm: <span class="text-danger">
                {{ $records->count() }}
                /
                {{ $records->total() }} Địa điểm</span>
        </div>
        @if (count($zones) > 1)
        {{-- <div>
            <button data-toggle="modal" data-target="#search" class="btn btn-btn-primary">
                <i class="fa fa-filter"></i> Bộ lọc
            </button>
        </div>  --}}
        <div class="row">
           <div class="col-md-12">
            <h4>Khu vực:</h4>
            <div style="display: flex; flex-wrap: wrap; flex-shrink: 1">
            @foreach ($zones as $key => $item)
            <div style="padding-right: 40px;" >
                 <input id="{{ $key }}" class="zone_id" type="checkbox" name="zone_id[]"  value="{{ $item->id }}"
                    @if (isset($zoneIds))
                        @if (in_array($item->id, $zoneIds))
                            checked
                        @endif
                    @endif
                 >
                 <label for="{{ $key }}">{{ $item->name }}</label>
             </div>
            @endforeach
            </div>
           </div>
        </div>
        @endif
    </header>
        <div class="panel-body" >
            <div class="row" >
                <div class="col-md-12" id="no-more-tables" >
                    <table class="table table-bordered table-striped table-hover" id="">
                        <thead class="fc">
                            <tr>
                                <th class="text-center" width="">{{__("ID")}}</th>
                                <th class="text-center" width="">{{__("TT địa điểm")}}</th>
                                <th class="text-center" width="20%">{{__("Ngôn ngữ")}}</th>
                                @if (count($zones) > 1)
                                    <th class="text-center" width="">{{__("Khu vực")}}</th>
                                @endif
                                <th class="text-center" width="">{{__("Vị trí")}}</th>
                                <th class="text-center" width="">{{__("Lượt xem")}}</th>
                                <th class="text-center" width="35%">{{__("URL")}}</th>
                                <th class="text-center" width="10%">{{__("Hành động")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $key => $record)
                                <tr id="tr-record-{{$record->id}}">
                                    <td data-title="ID" class="text-center">
                                        <a class="btn btn-primary disabled">
                                            {{ $record->id }}
                                        </a>

                                    </td>
                                    <td data-title="{{__("TT địa điểm")}}">
                                        <strong>Tên: {{ $record->name }}</strong><br>
                                        <strong>Lat: {{ $record->lat }}</strong><br>
                                        <strong>Long: {{ $record->long }}</strong><br>
                                        <strong>Địa chỉ: {{ $record->address }}</strong><br>
                                    </td>
                                    <td data-title="{{__("Ngôn ngữ")}}">
                                        @if ($record->presentations)
                                        <ul>
                                            <div class="row">
                                                @foreach ($record->presentations as $keyP => $presentation)
                                                   <div class="col-md-12 m-bot15">
                                                    <li>
                                                        <a href="{{ route('cms.presentations.edit', $presentation->id) }}">{{ $presentation->language->name }}</a>
                                                    </li>
                                                   </div>
                                                @endforeach
                                            </div>
                                        </ul>
                                        @endif
                                    </td>
                                    @if (count($zones) > 1)
                                    <td data-title="{{__("Khu vực")}}">
                                        <strong>{{ isset($record->zone->name) ? $record->zone->name : '' }}</strong>
                                    </td>
                                    @endif
                                    <td data-title="{{__("Vị trí")}}" style="text-align: right">
                                        <strong>{{ $record->position }}</strong>
                                    </td>
                                    <td data-title="{{__("Lượt xem")}}" style="text-align: right">
                                        <strong>{{ number_format($record->scannings_count, 0, "", ".") }}</strong>
                                    </td>
                                    <td data-title="{{__("URL")}}">
                                        <div style="display: flex; justify-content: space-between">
                                            <strong id="id-{{ $record->id }}">{{ route('locations', $record->id) }}</strong>
                                            <i style="margin-top: 4px" class="btn fa  fa-copy btn-click" data-id="id-{{ $record->id }}"></i>
                                        </div>
                                    </td>
                                    <td data-title="Hành Động">
                                        {{-- {{ dd(App\Helpers\Helper::countLanguage($record)); }} --}}
                                        @if (App\Helpers\Helper::countLanguage($record) == 0)
                                        <a href="{{ route('cms.presentations.create', ['id' => $record->id])}}"
                                            class="btn btn-primary btn-block m-bot15 disabled" style="background-color: #c7cbd6; border-color: #c7cbd6"><i class="fa fa-plus-square"></i>  Thêm ngôn ngữ</a>
                                        @else
                                        <a href="{{ route('cms.presentations.create', ['id' => $record->id])}}"
                                            class="btn btn-primary btn-block m-bot15" ><i class="fa fa-plus-square"></i>  Thêm ngôn ngữ</a>
                                        @endif
                                        <button data-toggle="modal" data-id="{{ $record->id }}"
                                            class="btn btn-primary btn-block m-bot15 btn-qr" id="qr-{{ $record->id }}" ><i class="fa fa-qrcode"></i>  Mã QR</button>

                                        <a href="{{ route('cms.locations.edit', ['id' => $record->id]) }}"
                                            class="btn btn-primary btn-block m-bot15" ><i class="fa fa-edit"></i>  Chỉnh sửa</a>
                                        <form action="{{ route('cms.locations.destroy') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $record->id }}">
                                            <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return(confirm('Bạn có chắc chắn muốn xóa địa điểm và các bài thuyết minh của địa điểm không?'));">
                                                <i class="fa fa-trash-o"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        {{ $records->appends(Request::all())->links() }}
                    </div>
                </div>
            </div>
        </div>
</section>

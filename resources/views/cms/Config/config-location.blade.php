@extends('cms.layouts.app')
@push('js')
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                placeholder: "Chọn địa điểm top",
            });
            $(document).on('submit', '#form-top-location', function(e){
                e.preventDefault();
                var formData= new FormData(this);
                var url = $(this).attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if(data.error){
                            alert(data.error)
                        }else {
                            $('#load').load(' #load');
                        }
                    },
                    error: function (data) {
                        console.log('Lỗi');
                    }
                });
            });
            $(document).on('click', '.btn-delete', function(e){
                e.preventDefault();
                var url = '{{ route('cms.config.locations.delete') }}';
                var id = $(this).data('id');
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {id:id},
                    success: function (data) {
                            $('#load').load(' #load');
                    },
                    error: function (data) {
                        console.log('Lỗi');
                    }
                });
            });
            $(document).on('click', '.btn-up', function(e){
                e.preventDefault();
                var url = '{{ route('cms.config.locations.up') }}';
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {id:id},
                    success: function (data) {
                            $('#load').load(' #load');
                            console.log(data);
                    },
                    error: function (data) {
                        console.log('Lỗi');
                    }
                });
            });
            $(document).on('click', '.btn-down', function(e){
                e.preventDefault();
                var url = '{{ route('cms.config.locations.down') }}';
                var id = $(this).data('id');
                $.ajax({
                    type: 'get',
                    url: url,
                    data: {id:id},
                    success: function (data) {
                            $('#load').load(' #load');
                    },
                    error: function (data) {
                        console.log('Lỗi');
                    }
                });
            });
        })

    </script>
    <script>
          $(document).ready(function() {
            $(document).ajaxStart(function() {
                $("#loading").show();
            });
            $(document).ajaxStop(function() {
                $("#loading").hide();
            });
        });
    </script>
@endpush
@section('content')


<div id="load">
    <div class="row" >
        <div class="col-lg-8">
            <section class="panel">
                <header class="panel-heading">
                    Danh sách địa điểm
                </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12" id="no-more-tables">
                                <table class="table table-bordered table-striped table-hover" id="">
                                    <thead class="fc">
                                        <tr>
                                            {{-- <th class="text-center" width="10%">{{__("ID")}}</th> --}}
                                            <th class="text-center" width="">{{__("Tên")}}</th>
                                            <th class="text-center" width="">{{__("Vị trí")}}</th>
                                            <th class="text-center" width="30%">{{__("Hành Động")}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locations as $key => $record)
                                            <tr id="tr-record-{{$record->id}}">
                                                {{-- <td data-title="ID" class="">
                                                    <a class="btn btn-primary disabled ">
                                                        {{ $record->id }}
                                                    </a>
                                                </td> --}}
                                                <td data-title="{{__("Tên")}}" class="">
                                                    <strong>{{ $record->name }}</strong>
                                                </td>
                                                <td data-title="{{__("Vị trí")}}">
                                                    <strong>{{ $record->top }}</strong>
                                                </td>
                                                <td data-title="Hành Động">
                                                   <div class="row">
                                                    <div class="col-md-12" >
                                                            <div class="btn-group btn-group" style="display: flex; justify-content: center">
                                                                @if ($key != 0)
                                                                    <a href="" data-id="{{ $record->id }}" class="btn btn-primary btn-up"><i class="fa  fa-caret-square-o-up"></i> Lên</a>
                                                                @else
                                                                    <a href="" data-id="{{ $record->id }}" class="btn btn-primary btn-up disabled"><i class="fa  fa-caret-square-o-up"></i> Lên</a>
                                                                @endif
                                                                @if ($key != $count)
                                                                    <a href="" data-id="{{ $record->id }}" class="btn btn-warning btn-down"><i class="fa  fa-caret-square-o-down"></i> Xuống</a>
                                                                @else
                                                                    <a href="" data-id="{{ $record->id }}" class="btn btn-warning btn-down disabled"><i class="fa  fa-caret-square-o-down"></i> Xuống</a>
                                                                @endif
                                                                <a href="" data-id={{ $record->id }} class="btn btn-danger btn-delete"><i class="fa fa-trash-o"></i> Xóa</a>
                                                                {{-- <a class="btn btn-success" href="#">Left</a>
                                                                <a class="btn btn-info" href="#">Middle</a>
                                                                <a class="btn btn-danger" href="#">Right</a> --}}
                                                            </div>
                                                    </div>
                                                   </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
        <div class="col-md-4">
            <section class="panel">
                <header class="panel-heading">
                    Chọn địa điểm top
                </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12" id="no-more-tables">
                               <form action="{{ route('cms.config.locations.add') }}" id="form-top-location" method="post">
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="overview">Địa điểm top</label>
                                        <select name="location_id" id="" class="form-control select2">
                                            @foreach ($locationsView as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" value="location" name="btn" class="btn btn-primary">Ghi lại</button>
                                    </div>
                               </form>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</div>
@endsection

@extends('cms.layouts.app')
@section('menu-language','active')
@push('js')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.btn-def', function(e){
                e.preventDefault();
                var url = '{{ route('cms.languages.default') }}'
                var data = $(this).data('id');
                $.ajax({
                    url:url,
                    type:'GET',
                    data:{id:data},
                    success:function (data) {
                        $('#load').load(' #load');
                        // $('#modal-qr').modal('show');
                        console.log('ok');
                    },
                    error:function (data) {
                        console.log('lỗi');
                    }
                })
            });
        });
    </script>
@endpush
@section('content')

<div id="load">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="row">
                        {{-- <div class="col-md-9"></div>
                        <div class="col-md-3">
                                
                        </div> --}}
                        {{-- <div class="col-md-3">
                            <button class="btn btn-primary btn-full-width" type="button"
                                    id="show-search-advanced">{{__("Tìm Kiếm")}}</button>
                        </div> --}}
                        <div class="text-right" style="margin-right: 24px">
                            <a href="{{ route('cms.languages.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Thêm ngôn ngữ</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Danh sách ngôn ngữ: <span class="text-danger">
                        {{ $records->count() }} 
                        /
                        {{ $records->total() }} ngôn ngữ</span>
            
                </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12" id="no-more-tables">
                                <table class="table table-bordered table-striped table-hover" id="">
                                    <thead class="fc">
                                        <tr>
                                            <th class="text-center" width="">{{__("ID")}}</th>
                                            <th class="text-center" width="">{{__("Tên tiếng việt")}}</th>
                                            <th class="text-center" width="">{{__("Tên theo ngôn ngữ")}}</th>
                                            <th class="text-center" width="">{{__("Mã ngôn ngữ")}}</th>
                                            <th class="text-center" width="10%">{{__("Hành động")}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $key => $record)
                                            <tr id="tr-record-{{$record->id}}">
                                                @include('cms.Lg.Component.record-table')
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
        </div>
    </div>
</div>
@endsection

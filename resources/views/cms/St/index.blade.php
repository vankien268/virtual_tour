@extends('cms.layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                            {{-- <a href="{{ route('cms.settings.create') }}" class="btn btn-primary btn-block btn-full-width">Thêm</a> --}}
                    </div>
                    {{-- <div class="col-md-3">
                        <button class="btn btn-primary btn-full-width" type="button"
                                id="show-search-advanced">{{__("Tìm Kiếm")}}</button>
                    </div> --}}
                    <div class="text-right" style="margin-right: 24px">
                        <a href="{{ route('cms.settings.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Thêm</a>
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
                Danh sách vùng: <span class="text-danger">
                    {{ $records->count() }} 
                    /
                    {{ $records->total() }} Vùng</span>
             
            </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12" id="no-more-tables">
                            <table class="table table-bordered table-striped table-hover" id="">
                                <thead class="fc">
                                    <tr>
                                        <th class="text-center" width="">{{__("ID")}}</th>
                                        <th class="text-center" width="">{{__("Ngôn ngữ")}}</th>
                                        <th class="text-center" width="">{{__("Địa điểm")}}</th>
                                        <th class="text-center" width="">{{__("Key")}}</th>
                                        <th class="text-center" width="">{{__("Value")}}</th>
                                        <th class="text-center" width="10%">{{__("Hành Động")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $key => $record)
                                        <tr id="tr-record-{{$record->id}}">
                                            @include('cms.St.Component.record-table')
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
@endsection

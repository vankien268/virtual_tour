@extends('cms.layouts.app')
@section('menu-zones','active')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    {{-- <div class="col-md-9"></div> --}}
                    {{-- <div class="col-md-3"> --}}
                        {{-- </div> --}}
                        {{-- <div class="col-md-3">
                            <button class="btn btn-primary btn-full-width" type="button"
                            id="show-search-advanced">{{__("Tìm Kiếm")}}</button>
                        </div> --}}
                    <div class="text-right" style="margin-right: 24px">
                        <a href="{{ route('cms.zones.create') }}" class="btn btn-primary text-right" >  <i class="fa fa-plus-square"></i>Thêm vùng</a>
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
                Danh sách khu vực: <span class="text-danger">
                    {{ $records->count() }} 
                    /
                    {{ $records->total() }} khu vực</span>
            </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12" id="no-more-tables">
                            <table class="table table-bordered table-striped table-hover" id="">
                                <thead class="fc">
                                    <tr>
                                        <th class="text-center" width="">{{__("ID")}}</th>
                                        <th class="text-center" width="">{{__("Tên")}}</th>
                                        <th class="text-center" width="">{{__("Địa chỉ")}}</th>
                                        <th class="text-center" width="">{{__("Mô tả")}}</th>
                                        <th class="text-center" width="">{{__("Hành động")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $key => $record)
                                        <tr id="tr-record-{{$record->id}}">
                                            @include('cms.Zone.Component.record-table')
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

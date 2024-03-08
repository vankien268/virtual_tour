@extends('cms.layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                            <a href="{{ route('cms.manager.permissions.create') }}" class="btn btn-primary btn-block btn-full-width">Thêm quyền</a>
                    </div>
                    {{-- <div class="col-md-3">
                        <button class="btn btn-primary btn-full-width" type="button"
                                id="show-search-advanced">{{__("Tìm Kiếm")}}</button>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Danh sách quyền: <span class="text-danger">
                    {{ $records->count() }} 
                    /
                    {{ $records->total() }} quyền</span>
                <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                </span>
            </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12" id="no-more-tables">
                            <table class="table table-bordered table-striped table-hover" id="">
                                <thead class="fc">
                                    <tr>
                                        <th class="text-center" width="">{{__("ID")}}</th>
                                        <th class="text-center" width="">{{__("Tên")}}</th>
                                        <th class="text-center" width="">{{__("Hành Động")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $key => $record)
                                        <tr id="tr-record-{{$record->id}}">
                                            @include('cms.Permission.Component.record-table')
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

@extends('cms.layouts.app')
@section('menu-user','active')
@push('css')
    <style>
        td{
            word-break: break-word;
        }
    </style>
@endpush
@section('content')

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    {{-- <div class="col-md-9"></div>
                    <div class="col-md-3">
                            <a href="{{ route('cms.manager.users.create') }}" class="btn btn-primary btn-block btn-full-width">Thêm người dùng</a>
                    </div> --}}
                    {{-- <div class="col-md-3">
                        <button class="btn btn-primary btn-full-width" type="button"
                                id="show-search-advanced">{{__("Tìm Kiếm")}}</button>
                    </div> --}}
                    <div class="text-right" style="margin-right: 24px">
                        <a href="{{ route('cms.manager.users.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Thêm người dùng</a>
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
                Danh sách người dùng: <span class="text-danger">
                    {{ $records->count() }} 
                    /
                    {{ $records->total() }} người dùng</span>
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
                                        <th class="text-center" width="5%">{{__("STT")}}</th>
                                        <th class="text-center" width="10%">{{__("Tên")}}</th>
                                        <th class="text-center" width="10%">{{__("UserName")}}</th>
                                        {{-- <th class="text-center" width="">{{__("Mật khẩu")}}</th> --}}
                                        <th class="text-center" width="">{{__("Vai trò")}}</th>
                                        <th class="text-center" width="">{{__("Quyền")}}</th>
                                        <th class="text-center" width="10%">{{__("Hành Động")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $key => $record)
                                        <tr id="tr-record-{{$record->id}}">
                                            @include('cms.User.Component.record-table')
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

@extends('cms.layouts.app')
@section('menu-presentation','active')
@section('content')
@push('css')
    <style>
        td {
            word-break: break-word;
        }
    </style>
@endpush

<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                            <a href="{{ route('cms.presentations.create') }}" class="btn btn-primary btn-block btn-full-width">Thêm thuyết minh</a>
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
                Danh sách thuyết minh: <span class="text-danger">
                    {{ $records->count() }} 
                    /
                    {{ $records->total() }} thuyết minh</span>
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
                                        <th class="text-center" width="">{{__("Ảnh đại diện")}}</th>
                                        <th class="text-center" width="10%">{{__("TT bài thuyết minh")}}</th>
                                        <th class="text-center" width="50%">{{__("Nội dung")}}</th>
                                        <th class="text-center" width="">{{__("Video")}}</th>
                                        <th class="text-center" width="">{{__("Audio")}}</th>
                                        <th class="text-center" width="">{{__("Hành Động")}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $key => $record)
                                        <tr id="tr-record-{{$record->id}}">
                                            @include('cms.Presentation.Component.record-table')
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

@extends('cms.layouts.app')
@section('menu-location','active')
@push('css')
    <style>
        td{
            /* word-break: break-all; */
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.zone_id', function(){
                console.log($('.zone_id').length);
                var zoneId = [];
                $('.zone_id').each(function(){
                    if($(this).is(':checked')){
                        // console.log($(this));
                        zoneId.push($(this).val())
                    }
                });
                //ajax
                $.ajax({
                    type: 'GET',
                    url: '{{ route('cms.locations.render.table') }}',
                    data: {zoneIds: zoneId},
                    // cache: false,
                    // contentType: false,
                    // processData: false,
                    success: function (data) {
                        console.log(data);
                        $('#load').html(data.html);
                        
                    },
                    error: function (data) {
                        console.log('lỗi');
                    }
                });
            })
            $(document).on('click','.btn-click', function(){
                var element = '#'+$(this).data('id');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($($(element)).html()).select();
                document.execCommand("copy");
                $temp.remove();
            });
            $(document).on('click', '.btn-qr', function(){
                var url = '{{ route('cms.locations.modal.qr') }}'
                var data = $(this).data('id');
                console.log(data);
                $.ajax({
                    url:url,
                    type:'GET',
                    data:{id:data},
                    success:function (data) {
                        $('#modal-qr').html(data.html);
                        $('#modal-qr').modal('show');
                    },
                    error:function (data) {
                        console.log('lỗi');
                    }
                })
            });
            $(document).on('click', '.btn-down', function(){
                var url = '{{ route('cms.locations.download') }}'
                var data = $(this).data('id');
                console.log(data);
                $.ajax({
                    url:url,
                    type:'GET',
                    data:{id:data},
                    success:function (data) {
                        // $('#modal-qr').html(data.html);
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

<div>
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <div class="row">
                   
                        <div class="text-right" style="margin-right: 24px">
                            <a href="{{ route('cms.locations.create') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Thêm địa điểm</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <div class="row" >
        <div class="col-lg-12" id="load">
            @include('cms.Location.Component.record-table')
        </div>
    </div>
</div>

{{-- modal-qr-code --}}
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-qr" class="modal fade">
   
</div>

@endsection

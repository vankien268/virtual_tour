 <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Mã QR</strong></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php
                           echo $qrcode;
                        ?>
                     
                       <div class="text-center">
                            <a href="{{ route('cms.locations.download', ['id' => $location->id]) }}" data-id="{{ $location->id }}" class="btn btn-primary btn-down"> Tải xuống</a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
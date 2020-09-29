<div class="modal-header">
    <h4 class="modal-title">REJECT RFP <?php echo $rows->no_rfp ?></h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form id="frm-reject" method="post">
        <div class="form-group">
        <input type="hidden" name="id_rfp" value="<?php echo $rows->id ?>">
            <textarea name="notes" class="form-control" style="resize: none" placeholder="Notes..."></textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="javascript:void(0)" onclick="set_reject_request_rfp()" class="btn btn-danger btn-block"><i class="far fa-check-circle"></i> YA</a>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-success btn-block" data-dismiss="modal"><i class="far fa-times-circle"></i> TIDAK</button>
            </div>
        </div>
    </form>
</div>

<script>
   

    function set_reject_request_rfp() {
    // var data = $('#frm-create').serialize();
    var form = $('#frm-reject')[0];
    var data = new FormData(form);
        $.ajax({
            type: "post",
            url: "rfp_controller/set_reject_request",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('#modal-reject-rfp').modal('hide');
            },
            success: function (res) {
                var isValid = res.isValid,
                    isPesan = res.isPesan;
                if(isValid == 0) {
                    $('.btn_post_request').html('<a href="javascript:void(0)" class="btn btn-secondary"><i class="fas fa-spinner fa-pulse"></i> Proses</a> <a href="javascript:void(0)" onclick="confirm_reject()" class="btn btn-danger"><i class="far fa-times-circle"></i> Reject</a>');
                    $('.pesan').html(isPesan);
                }else {
                    $('.pesan').html(isPesan);
                    $('#modal-approve-rfp').modal('hide');
                    reload_table();
                }
            }
        });
    }
</script>
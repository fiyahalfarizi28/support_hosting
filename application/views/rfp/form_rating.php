<div class="modal-header">
    <h4 class="modal-title">KONFIRMASI PERMINTAAN</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form id="frm-rating" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
        <div class="row">
            <div class="col-md-12">
                <label>REQUEST TYPE :</label>
                <select name="" class="form-control" required disabled>
                    <?php
                        $this->db->where('id', $rows->problem_type);
                        $pt_id = $this->db->get(TB_PROBLEM_TYPE)->row();
                        
                        $this->db->where('id', $rows->request_type);
                        $rt_id = $this->db->get(TB_REQUEST_TYPE)->row();
                    ?>
                    <option value="<?php echo $rows->request_type ?>"><?php echo $rt_id->request_type ?></option>
                </select>
            </div>

            <div class="col-md-6">
                    <label style="margin-top: 8px">APPLICATION :</label>
                    <select name="" class="form-control" required disabled>
                        <?php
                            $this->db->where('id', $rows->project_id);
                            $projectList = $this->db->get(TB_PROJECT)->row();
                        ?>
                        <option value="<?php echo $rows->project_id ?>"><?php echo $projectList->project_name ?></option>
                    </select>
                </div>

            <div style="margin-top: 8px"class="col-md-6">
                <label>PROBLEM TYPE :</label>
                <select name="" class="form-control" required disabled>
                    <option value="<?php echo $rows->problem_type ?>"><?php echo $pt_id->problem_type ?></option>
                </select>
            </div>
        </div>

        <div style ="margin-top: 15px"class="form-group">
            <label>SUBJECT :</label>
            <input type="text" name="" class="form-control" placeholder="Subject. . ." value="<?php echo $rows->subject ?>" required readonly>
        </div>

        <div class="form-group">
            <textarea name="" class="form-control" style="resize: none" placeholder="Detail. . ." rows="5" required readonly><?php echo $rows->rfp_detail ?></textarea>
        </div>
        
        <div class="form-group text-primary">
            <i class="far fa-clock"></i> <?php echo date('d-m-Y') ?>
        </div>

        <div class="form-group">
        <?php
            $no = 1;
            $this->db->where('rfp_id', $rows->id);
            $qAtt = $this->db->get(TB_ATTACHMENT_RFP);
            foreach($qAtt->result() as $rAtt){
                $nama_file = $rAtt->filename;
                $explode_file_ext = explode(".", $nama_file);
                $file_ext = $explode_file_ext[1];
                if($file_ext =='jpg' or $file_ext =='jpeg' or $file_ext =='png' or $file_ext =='PNG' or $file_ext =='gif' or $file_ext =='GIF'){
        ?>
                <span id="name_id<?php echo $rAtt->id ?>">
                    <a title="<?php echo $rAtt->filename ?>" target="_blank" href="<?php echo $rAtt->data_file ?>" class=""><i class="far fa-image fa-2x"></i></a>
                </span>
        <?php
            }elseif($file_ext =='docx' or $file_ext =='docm' or $file_ext =='dotx' or $file_ext =='dotm'){
        ?>
                <span id="name_id<?php echo $rAtt->id?>">
                    <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file-word fa-2x"></i></a>
                </span>
        <?php
            }elseif($file_ext =='xlsx' or $file_ext =='xlsm' or $file_ext =='xltx' or $file_ext =='xltm' or $file_ext =='xlsb' or $file_ext =='xlam'){
        ?>
                <span id="name_id<?php echo $rAtt->id?>">
                    <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file-excel fa-2x"></i></a>
                </span>
        <?php
            }else{
        ?>
                <span id="name_id<?php echo $rAtt->id?>">
                    <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file fa-2x"></i></a>
                    </label>
                </span>
        <?php
                }
            }
        ?>
        </div>
        
        <?php if(!empty($rows->approve_notes)): ?>
        <div class="form-group">
            <label>Notes : <?php echo $notes_name_approve->nama." | ".$rows->approve_date ?></label>
            <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->approve_notes ?></textarea>
        </div>
        <?php endif ?>
        
        <?php if(!empty($rows->receive_notes)): ?>
        <div class="form-group">
            <label>Notes : <?php echo $notes_name_receive->nama." | ".$rows->receive_date ?></label>
            <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->receive_notes ?></textarea>
        </div>
        <?php endif ?>
        
        <?php if(!empty($rows->done_notes)): ?>
        <div class="form-group">
            <label>Notes : <?php echo $notes_name_receive->nama." | ".$rows->done_date ?></label>
            <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->done_notes ?></textarea>
        </div>
        <?php endif ?>
        
        <div>
            Konfirmasi Penyelesaian:
        </div>

        <div class="row" style="margin-top: 8px">
            <div class="col-md-6">
                <button name="iya" id="iya" type="button" class="btn btn-success btn-block"><i class="far fa-times-circle"></i> SESUAI </button>
            </div>

            <div class="col-md-6">
                <button name="tidak" id="tidak" type="button" class="btn btn-danger btn-block"><i class="far fa-times-circle"></i> TIDAK SESUAI </button>
            </div>
        </div> 

        <div class="form-group collapse" style="margin-top: 15px" id="collapseNo">
            <label id="notesID">Tulis Notes :</label>
            <textarea name="notes" placeholder="Notes..." rows="2" style="resize: none" class="form-control" require></textarea>
        </div>

        <div class="form-group text-center collapse" style="margin-top: 15px" id="collapseYes">
            <span class="star-rating star-5">
                <input type="radio" name="rates" value="1" data-toggle="tooltip" data-placement="bottom" title="Buruk!"><i></i>
                <input type="radio" name="rates" value="2" data-toggle="tooltip" data-placement="bottom" title="Kurang bagus!"><i></i>
                <input type="radio" name="rates" value="3" data-toggle="tooltip" data-placement="bottom" title="Cukup bagus!"><i></i>
                <input type="radio" name="rates" value="4" data-toggle="tooltip" data-placement="bottom" title="Bagus!"><i></i>
                <input type="radio" name="rates" value="5" data-toggle="tooltip" data-placement="bottom" title="Sangat bagus!"><i></i>
            </span>
        </div>

        <div class="form-group collapse" style="margin-top: 30px" id="collapseKirim">
            <input type="hidden" name="id_rfp" value="<?php echo $rows->id ?>">
            <input type="hidden" name="isOk" id="isOk" value="tidak">
            <div class="btn_post_request">
                <a href="javascript:void(0)" onclick="set_rating_request_rfp()" class="btn btn-primary btn-block"><i class="far fa-check-circle"></i> Kirim</a>
            </div>
        </div>

    </form>
</div>

<script>
    var buttonYes = document.getElementById('iya');
    var buttonNo = document.getElementById('tidak');

    buttonYes.addEventListener('click', function() {
        $('#isOk').val("iya");
        $('#notesID').text('Tulis Notes :');
        $('#collapseYes').collapse('show');
        $('#collapseNo').collapse('show');
        $('#collapseKirim').collapse('show');
    });

    buttonNo.addEventListener('click', function() {
        $('#isOk').val("tidak");
        $('#notesID').text('Tulis Notes Revisi :');
        $('#collapseYes').collapse('hide');
        $('#collapseNo').collapse('show');
        $('#collapseKirim').collapse('show');
    });

    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });

    function set_rating_request_rfp() {
    // var data = $('#frm-rating').serialize();
    var form = $('#frm-rating')[0];
    var data = new FormData(form);
    $.ajax({
        type: "post",
        url: "rfp_controller/set_rating_request",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        dataType: "json",
        beforeSend: function() {
            $('.btn_post_request').html('<a href="javascript:void(0)" class="btn btn-secondary btn-block"><i class="fas fa-spinner fa-pulse"></i> Proses</a>');
        },
        success: function (res) {
            var isValid = res.isValid,
                isPesan = res.isPesan;
            if(isValid == 0) {
                $('.btn_post_request').html('<a href="javascript:void(0)" onclick="set_rating_request()" class="btn btn-success btn-block"><i class="far fa-check-circle"></i> Simpan</a>');
                $('.pesan').html(isPesan);
            }else {
                $('.pesan').html(isPesan);
                $('#modal-rating-rfp').modal('hide');
                reload_table();
            }
        }
    });
}
//-------------------------------------
</script>


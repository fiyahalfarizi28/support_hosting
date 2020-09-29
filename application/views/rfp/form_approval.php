<div class="modal-header">
    <h4 class="modal-title">APPROVE RFP</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">

    <?php     
        if ( $rows->request_status == STT_APPROVED && $rows->receive_date != NULL) {
            $selectProjectType = '<select id="project_id" name="project_id" class="form-control" required>';
            $selectRequestType = '<select id="request_type" name="request_type" class="form-control" required>';
            $selectProblemType = '<select id="problem_type" name="problem_type" class="form-control" required>';
        } else {
            $selectProjectType = '<select id="project_id" name="project_id" class="form-control" required>';
            $selectRequestType = '<select id="request_type" name="request_type" class="form-control" required>';
            $selectProblemType = '<select id="problem_type" name="problem_type" class="form-control" required>';
        }
    ?>

    <form id="frm-app" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
            <div class="row">
                <div class="col-md-12">
                    <label>REQUEST TYPE :</label>
                    <?php echo $selectRequestType?>
                        <?php
                            $this->db->where('id', $rows->problem_type);
                            $pt_id = $this->db->get(TB_PROBLEM_TYPE)->row();
                            
                            $this->db->where('id', $rows->request_type);
                            $rt_id = $this->db->get(TB_REQUEST_TYPE)->row();			    $this->db->where('id', $rows->project_id);                            $projectList = $this->db->get(TB_PROJECT)->row();
                        ?>
                        <option value="<?php echo $rows->request_type ?>"><?php echo $rt_id->request_type ?></option>
                    </select>
                </div>

                <div class="col-md-6">
                <label style="margin-top: 8px">APPLICATION :</label>
                    <?php echo $selectProjectType?>
                        <option value="<?php echo $rows->project_id ?>" selected="selected"><?php echo $projectList->project_name ?></option>                        <?php foreach($project_list->result() as $r): ?>                            <?php if ($r->id !== $rows->project_id) {?>                                <option value="<?php echo $r->id ?>"><?php echo $r->project_name ?></option>                            <?php } ?>                        <?php endforeach ?>                    </select>
                </div>

                <div class="col-md-6">           
                <label style="margin-top: 8px">PROBLEM TYPE :</label> 
                    <?php echo $selectProblemType?>
                        <option value="<?php echo $rows->problem_type ?>" selected="selected"><?php echo $pt_id->problem_type ?></option>                         <?php foreach($problem_type->result() as $r): ?>                            <?php if ($rows->problem_type != $r->id) {?>                                 <?php if ($rows->request_type == 3  ) {?>                                    <?php if ($rows->project_id > 0) { ?>                                        <?php if ($r->id > 8 && $r->id < 11) {?>                                            <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>                                        <?php } ?>                                    <?php } ?>                                <?php } ?>                            <?php } ?>                        <?php endforeach ?>                    </select>
                </div>
        </div>

        <div class="form-group">
            <label style="margin-top: 8px">SUBJECT :</label>
            <input type="text" name="subject" class="form-control" placeholder="Subject. . ." value="<?php echo $rows->subject ?>" required <?php echo $readonly ?>>
        </div>

        <div class="form-group">
            <textarea name="detail" class="form-control" style="resize: none" placeholder="Detail. . ." rows="5" required <?php echo $readonly ?>><?php echo $rows->rfp_detail ?></textarea>
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

        <?php if(!empty($rows->confirm_notes)): ?>
        <div class="form-group">
            <label>Notes Revisi: <?php echo $notes_name_confirm->nama ?></label>
            <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->confirm_notes ?></textarea>
        </div>
        <?php endif ?>
        
        <div class="form-group">
            <label>Tulis Notes :</label>
            <textarea name="notes" placeholder="Notes..." rows="2"  style="resize: none" class="form-control"></textarea>
        </div>
        
        <?php $SESSION_USER_JABATAN = $this->session->userdata('USER_JABATAN'); 
        if($rows->receive_by == '3:855:' && ($SESSION_USER_JABATAN === 'HEAD IT' || $SESSION_USER_JABATAN === 'SUPERVISOR IT')): ?>
        <div class="form-group">
            <label>Cara penyelesaian :</label>
            <textarea id ="penyelesaian" name="penyelesaian" style="resize: none" placeholder="Cara penyelesaian case tersebut..." rows="2" class="form-control"></textarea>
        </div>
        <?php endif ?>

        <div class="row">
            <div class="col-md-6">
            
            </div>

            <div class="col-md-6 text-right pt-4">
                <input type="hidden" name="id_rfp" value="<?php echo $rows->id ?>">
                <input type="hidden" name="problem_type_hidden" value="<?php echo $rows->problem_type ?>">
                <input type="hidden" name="project_id_hidden" value="<?php echo $rows->project_id ?>">
                <input type="hidden" name="subject" value="<?php echo $rows->subject ?>">
                <input type="hidden" name="detail" value="<?php echo $rows->rfp_detail ?>">

                <!-- btn_kirim -->
                <div class="btn_post_request">
                    <a href="javascript:void(0)" onclick="<?php echo $onclick ?>" class="btn btn-primary"><i class="far fa-check-circle"></i> <?php echo $btnText ?></a>

                    <a href="javascript:void(0)" onclick="confirm_reject()" class="btn btn-danger" <?php echo $reject_aa ?>><i class="far fa-times-circle"></i> Reject</a>

                    <a href="javascript:void(0)" onclick="<?php echo $onclickReject ?>" class="btn btn-danger" <?php echo $closeModal ?>><i class="far fa-times-circle"></i> <?php echo $btnTextReject ?></a>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
     //----- confirm reject request-------
     function confirm_reject() {
        var data = $('#frm-app').serialize();
        $.ajax({
            type : 'post',
            url : 'rfp_controller/btn_reject',
            data :  data,
            cache: false,
            success : function(res) {
                $('#modal-reject-rfp').modal('show');
                $('#view-reject-rfp').html(res);
            }
        });
    }

    //----- rfp approve request-------
    function set_app_request() {
        // var data = $('#frm-create').serialize();
        var form = $('#frm-app')[0];
        var data = new FormData(form);
        $.ajax({
            type: "post",
            url: "rfp_controller/set_app_request",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('.btn_post_request').html('<a href="javascript:void(0)" class="btn btn-secondary"><i class="fas fa-spinner fa-pulse"></i> Proses</a>');
            },
            success: function (res) {
                var isValid = res.isValid,
                    isPesan = res.isPesan;
                if(isValid == 0) {
                    $('.btn_post_request').html('<a href="javascript:void(0)" onclick="set_app_request_rfp()" class="btn btn-success"><i class="far fa-check-circle"></i> Approve</a> <a href="javascript:void(0)" onclick="" class="btn btn-success"><i class="far fa-times-circle"></i> Reject</a>');
                    $('.pesan').html(isPesan);
                }else {
                    $('.pesan').html(isPesan);
                    $('#modal-approve-rfp').modal('hide');
                    reload_table();
                }
            }
        });
    }

    //----- rfp assign request-------
    function set_assign_request() {
        // var data = $('#frm-create').serialize();
        var form = $('#frm-app')[0];
        var data = new FormData(form);
        $.ajax({
            type: "post",
            url: "rfp_controller/set_assign_request",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('.btn_post_request').html('<a href="javascript:void(0)" class="btn btn-secondary"><i class="fas fa-spinner fa-pulse"></i> Proses</a>');
            },
            success: function (res) {
                var isValid = res.isValid,
                    isPesan = res.isPesan;
                if(isValid == 0) {
                    $('.btn_post_request').html('<a href="javascript:void(0)" onclick="set_assign_request_rfp()" class="btn btn-success"><i class="far fa-check-circle"></i> Assign</a> <a href="javascript:void(0)" onclick="" class="btn btn-danger"><i class="far fa-times-circle"></i> Reject</a>');
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
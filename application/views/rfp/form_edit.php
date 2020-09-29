<div class="modal-header">
    <h4 class="modal-title">EDIT RFP</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form id="frm-edit" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
            <div class="row">
                     
                <div class="col-md-12">
                    <label>REQUEST TYPE :</label>
                    <select name="request_type" class="form-control" required>
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
                    <select id="project_id"name="project_id" class="form-control" required>
                        <?php
                            $this->db->where('id', $rows->project_id);
                            $projectList = $this->db->get(TB_PROJECT)->row();
                        ?>
                        <option value="<?php echo $rows->project_id ?>"><?php echo $projectList->project_name ?></option>
                        
                    </select>
                </div>

                <div class="col-md-6">           
                    <label style="margin-top: 8px">PROBLEM TYPE :</label> 
                    <select id ="problem_type"name="problem_type" class="form-control"  id="problem_type" required>
                        <option value="<?php echo $rows->problem_type ?>" selected="selected"><?php echo $pt_id->problem_type ?></option>
                        <?php foreach($problem_type->result() as $r): ?>
                            <?php if ($rows->problem_type != $r->id) {?>
                                <?php if ($rows->request_type == 3) {?>
                                    <?php if ($rows->project_id > 2) { ?>
                                        <?php if ($r->id > 8 && $r->id < 11) {?>
                                            <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>
                                        <?php } ?>
                                    <?php } else if ($rows->project_id == 1) { ?>
                                        <?php if ($r->id > 10) {?>
                                            <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div style ="margin-top: 8px"class="form-group">
                <label>SUBJECT :</label>
                <input type="text" name="subject" class="form-control" placeholder="Subject. . ." value="<?php echo $rows->subject ?>" required>
            </div>

            <div class="form-group">
                <textarea name="detail" class="form-control" style="resize: none" placeholder="Detail. . ." rows="5" required><?php echo $rows->rfp_detail ?></textarea>
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
                        <label for='check_remove<?php echo $rAtt->id ?>'>
                        <sub class="supx" data-id='<?php echo $rAtt->id ?>'>x</sub>
                        </label>
                        <input type="checkbox" class="check_remove" id='check_remove<?php echo $rAtt->id?>' name="removeAtt[]" value="<?php echo $rAtt->id?>">
                    </span>
                <?php }elseif($file_ext =='docx' or $file_ext =='docm' or $file_ext =='dotx' or $file_ext =='dotm'){
                ?>
                    <span id="name_id<?php echo $rAtt->id?>">
                        <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file-word fa-2x"></i></a>
                        <label for='check_remove<?php echo $rAtt->id?>'>
                        <sub class="supx" data-id='<?php echo $rAtt->id?>'>x</sub>
                        </label>
                        <input type="checkbox" class="check_remove" id='check_remove<?php echo $rAtt->id?>' name="removeAtt[]" value="<?php echo $rAtt->id?>">
                    </span>
                <?php }elseif($file_ext =='xlsx' or $file_ext =='xlsm' or $file_ext =='xltx' or $file_ext =='xltm' or $file_ext =='xlsb' or $file_ext =='xlam'){
                ?>
                    <span id="name_id<?php echo $rAtt->id?>">
                        <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file-excel fa-2x"></i></a>
                        <label for='check_remove<?php echo $rAtt->id?>'>
                        <sub class="supx" data-id='<?php echo $rAtt->id?>'>x</sub>
                        </label>
                        <input type="checkbox" class="check_remove" id='check_remove<?php echo $rAtt->id?>' name="removeAtt[]" value="<?php echo $rAtt->id?>">
                    </span>
                <?php }else{
                ?>
                    <span id="name_id<?php echo $rAtt->id?>">
                        <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file fa-2x"></i></a>
                        <label for='check_remove<?php echo $rAtt->id?>'>
                        <sub class="supx" data-id='<?php echo $rAtt->id?>'>x</sub>
                        </label>
                        <input type="checkbox" class="check_remove" id='check_remove<?php echo $rAtt->id?>' name="removeAtt[]" value="<?php echo $rAtt->id?>">
                    </span>
                <?php }
                    }
                ?>
            </div>

            <div id="files"></div>

            <div class="row">
                <div class="col-md-6">
                    Attachment: <a href="javascript:void(0)" class="btn btn-warning text-white" onclick="addFile_rfp();"><i class="fa fa-paperclip"></i></a>         
                </div>

                <div class="col-md-6 text-right">
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('USER_ID') ?>" readonly>

                    <input type="hidden" name="id_rfp" value="<?php echo $rows->id ?>" readonly>
                    
                    <input type="hidden" name="kode_cabang" value="<?php echo $this->session->userdata('USER_KODE_CABANG') ?>" readonly>
                    
                    <input type="hidden" name="head_id" value="<?php echo $this->session->userdata('USER_INDUK') ?>" readonly>

                    <!-- btn_kirim -->
                    <div class="btn_post_request">
                        <a href="javascript:void(0)" onclick="set_post_request_rfp()" class="btn btn-success"><i class="fa fa-check"></i> Update</a>
                    </div>
                </div>
            </div>

    </form>
</div>

<script>
    
    //-----edit rfp post request-------
function set_post_request_rfp() {
    // var data = $('#frm-create').serialize();
    var form = $('#frm-edit')[0];
    var data = new FormData(form);
    $.ajax({
        type: "post",
        url: "rfp_controller/set_post_request",
        data: data,
        processData: false,
        contentType: false,
        dataType: "json",
        cache: false,
        beforeSend: function() {
            $('.btn_post_request').html('<a href="javascript:void(0)" class="btn btn-secondary"><i class="fas fa-spinner fa-pulse"></i> Proses</a>');
        },
        success: function (res) {
            var isValid = res.isValid,
                isPesan = res.isPesan;
            if(isValid == 0) {
                $('.btn_post_request').html('<a href="javascript:void(0)" onclick="set_post_request()" class="btn btn-success"><i class="fa fa-check"></i> Kirim</a>');
                $('.pesan').html(isPesan);
            }else {
                $('.pesan').html(isPesan);
                $('#modal-edit-rfp').modal('hide');
                reload_table();
            }
        }
    });
}

$('.supx').click(function(){
    var data_id = $(this).data('id');
    var name_id = "#name_id"+ data_id;
    $(name_id).hide();
})

var fileId = 0;
function addFile_rfp() {
    fileId++;
    var html =  '<input type="file" name="attachment[]" />'+
                ' <a href="javascript:void(0)" onclick="javascript:removeElement(\'file-' + fileId + '\'); return false;">'+
                '<i class="far fa-window-close fa-lg text-danger"></i></a>';
    addElement('files', 'p', 'file-' + fileId, html);
}

</script>
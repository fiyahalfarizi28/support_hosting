<div class="modal-header">
    <h4 class="modal-title">ADD DAILY ACTIVITY</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <?php 
        $selectProjectType = '<select id="project_id" name="project_id" class="form-control" disabled required>';
    ?>
    <form id="frm-activity" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
        <div class="row">
            <div class="col-md-6">
                <label>APPLICATION :</label>
                <?php echo $selectProjectType?>
                    <?php
                        $this->db->where('id', $rows->project_id);
                        $projectList = $this->db->get(TB_PROJECT)->row();
                    ?>
                    <option value="<?php echo $rows->project_id ?>"><?php echo $projectList->project_name ?></option>
                </select>
            </div>

            <div class="col-md-6">
                <label>TARGET DATE</label>
                <input type="text" name="target_date" class="form-control" value="<?php echo date("d-m-Y",strtotime( $rows->target_date)) ?>" required <?php echo $readonly ?>>
            </div>
        </div>

        <div class="form-group">
            <label style="margin-top: 8px">TASK :</label>
            <input type="text" name="task_name" class="form-control" placeholder="Task. . ." value="<?php echo $rows->task_name ?>" required <?php echo $readonly ?>>
        </div>

        <div class="form-group">
            <textarea name="detail" class="form-control" style="resize: none" placeholder="Detail. . ." rows="5" required <?php echo $readonly ?>><?php echo $rows->detail ?></textarea>
        </div>

        <div class="form-group text-primary">
            <i class="far fa-clock"></i> <?php echo date('d-m-Y') ?>
        </div>

        <div class="form-group">
            <?php
                $no = 1;
                $this->db->where('task_id', $rows->id);
                $qAtt = $this->db->get(TB_ATTACHMENT_PROJECT);
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

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option disabled selected="selected">- Pilih Status -</option>
                <option value="ON PROGRESS">ON PROGRESS</option>
                <option value="DONE">DONE</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <input type="textarea" class="form-control" id="keterangan" style="resize: none" placeholder="Keterangan... " name="keterangan"></input>
        </div>

        <div class="form-group">
            <label for="PIC">PIC : </label>
            <?php echo strtoupper($this->session->userdata('USER_FULLNAME')) ?>
        </div>

        <div class="form-group">
            <input type="hidden" name="task_id" value="<?php echo $rows->id ?>">
            <input type="hidden" name="project_id_hidden" value="<?php echo $rows->project_id ?>">
            <input type="hidden" name="task_name" value="<?php echo $rows->task_name ?>">
            <input type="hidden" name="detail" value="<?php echo $rows->detail ?>">
        </div>
    </form>

    <div class="modal-footer"> 
        <div class="btn_post_request">
            <a href="javascript:void(0)" onclick="add_daily_task()" class="btn btn-success"><i class="fa fa-check"></i> Add</a>
        </div>
    </div>
</div>
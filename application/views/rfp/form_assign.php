<div class="modal-header">
    <h4 class="modal-title">TAMBAH TASK BARU</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form id="frm-create" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
        
        <?php     
        if ( $rows->request_status == STT_APPROVED && $rows->receive_date != NULL) {
            $selectProjectType = '<select id="project_id" name="project_id" class="form-control" disabled required>';
            $selectRequestType = '<select id="request_type" name="request_type" class="form-control" disabled required>';
            $selectProblemType = '<select id="problem_type" name="problem_type" class="form-control" disabled required>';
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
                            $rt_id = $this->db->get(TB_REQUEST_TYPE)->row();
                        ?>
                        <option value="<?php echo $rows->request_type ?>"><?php echo $rt_id->request_type ?></option>
                    </select>
                </div>

                <div class="col-md-6">
                <label style="margin-top: 8px">APPLICATION :</label>
                    <?php echo $selectProjectType?>
                        <?php
                            $this->db->where('id', $rows->project_id);
                            $projectList = $this->db->get(TB_PROJECT)->row();
                        ?>
                        <option value="<?php echo $rows->project_id ?>"><?php echo $projectList->project_name ?></option>
                    </select>
                </div>

                <div class="col-md-6">           
                <label style="margin-top: 8px">PROBLEM TYPE :</label> 
                    <?php echo $selectProblemType?>
                        <option value="<?php echo $rows->problem_type ?>" selected="selected"><?php echo $pt_id->problem_type ?></option>
                        <?php foreach($problem_type->result() as $r): ?>
                            <?php if ($rows->problem_type != $r->id) {?>
                                <?php if ($rows->request_type == 3  ) {?>
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
        
        <?php if (!empty($taskList->result())) { ?>
            <table>
                <thead class ="table">
                    <tr>
                        <th>TASK</th>
                        <th>DETAIL</th>
                        <th>PIC</th>
                        <th>TARGET DATE</th>
                    </tr>
                </thead>
                
                <tbody class ="table">
                    <?php foreach($taskList->result() as $row): ?>
                        <tr>
                            <td>
                                <?php echo $row->task_name; ?>
                            </td>
                            <td>
                                <?php echo $row->detail; ?>
                            </td>
                            <td>
                            <?php 
                                $this->db->where('user_id', $row->assign_to);
                                 echo $this->db->get(TB_USER)->row()->nama;
                            ?>
                            </td>
                            <td>
                                <?php echo date("d-m-Y",strtotime( $row->target_date))?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php } ?>

        <div class="panel-body">
            <div class="form-group" id="formTask">
                <button type="button" class="btn btn-info" id="tambahTask" onclick="addTask()">Tambah Task</button>
                <div id="task" style="margin: 8px 15px !important;">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <input type="hidden" name="id_rfp" value="<?php echo $rows->id ?>">
            <input type="hidden" name="project_id_hidden" value="<?php echo $rows->project_id ?>">
        </div>
        
        <div class="col-md-12 text-right">
            <div class="btn_post_request">
                <a href="javascript:void(0)" onclick="post_assign_rfp()" class="btn btn-success"><i class="fa fa-check"></i> Assign</a>
            </div>
        </div>

    </form>
</div>

<script>

    var idField = 0;
    function addTask() {
        idField++;
        
        $.ajax({
            type : 'post',
            url : 'rfp_controller/add_field_task',
            data :  {
                idfield: idField
            },
            cache: false,
            success : function(res) {
                $("#task").append(res);
            }
        });

    }
</script>
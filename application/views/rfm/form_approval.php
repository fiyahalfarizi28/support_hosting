<div class="modal-header">
    <h4 class="modal-title">APPROVE RFM</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">

    <?php
    if ($rows->request_status == STT_APPROVED) {
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
                <?php echo $selectRequestType ?>
                <?php
                $this->db->where('id', $rows->problem_type);
                $pt_id = $this->db->get(TB_PROBLEM_TYPE)->row();

                $this->db->where('id', $rows->request_type);
                $rt_id = $this->db->get(TB_REQUEST_TYPE)->row();
                
                $this->db->where('id', $rows->project_id);
                $projectList = $this->db->get(TB_PROJECT)->row();
                ?>
                <option value="<?php echo $rows->request_type ?>"><?php echo $rt_id->request_type ?></option>
                </select>
            </div>

            <div class="col-md-6">
                <label style="margin-top: 8px">APPLICATION :</label>
                <?php echo $selectProjectType ?>
                <option value="<?php echo $rows->project_id ?>" selected="selected"><?php echo $projectList->project_name ?></option>
                    <?php $SESSION_USER_JABATAN = $this->session->userdata('USER_JABATAN'); ?>
                    <?php if ($SESSION_USER_JABATAN == 'HEAD IT' || $SESSION_USER_JABATAN == 'SUPERVISOR IT') { ?>
                        <?php foreach ($project_list->result() as $r) : ?> 
                            <?php if ($r->id !== $rows->project_id) { ?> 
                                <option value="<?php echo $r->id ?>"><?php echo $r->project_name ?></option> 
                            <?php } ?> 
                        <?php endforeach ?> 
                    <?php } ?> 
                    </select>
            </div>

            <div class="col-md-6">
                <label style="margin-top: 8px">PROBLEM TYPE :</label>
                <?php echo $selectProblemType ?>
                <option value="<?php echo $rows->problem_type ?>" selected="selected"><?php echo $pt_id->problem_type ?></option>
                <?php foreach ($problem_type->result() as $r) : ?>
                    <?php if ($rows->problem_type != $r->id) { ?>
                        <?php if ($rows->request_type == 2) { ?>
                            <?php if ($rows->project_id > 2) { ?>
                                <?php if ($r->id < 6) { ?>
                                    <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>
                                <?php } ?>
                            <?php } else if ($rows->project_id == 2) { ?>
                                <?php if ($r->id > 5 && $r->id < 9) { ?>
                                    <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($rows->project_id > 2) { ?>
                                <?php if ($r->id > 8 && $r->id < 11) { ?>
                                    <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>
                                <?php } ?>
                            <?php } else if ($rows->project_id == 1) { ?>
                                <?php if ($r->id > 10) { ?>
                                    <option value="<?php echo $r->id ?>"><?php echo $r->problem_type ?></option>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php endforeach ?>
                </select>
            </div>

            <?php if ($rows->risk_type != NULL) { ?>
                <div class="col-md-12">
                    <label style="margin-top: 8px">MEMPENGARUHI FINANCIAL :</label>
                    <select id="risk_type" name="risk_type" class="form-control" required>
                        <option value="<?php echo $rows->risk_type ?>" selected="selected"><?php echo $rows->risk_type ?></option>
                        <?php foreach (RISK_TYPE as $type_risk) : ?>
                            <?php if ($rows->risk_type != $type_risk) { ?>
                                <option value="<?php echo $type_risk ?>"><?php echo $type_risk ?></option>
                            <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php } ?>
        </div>

        <div class="form-group">
            <label style="margin-top: 8px">SUBJECT :</label>
            <input type="text" name="subject" class="form-control" placeholder="Subject. . ." value="<?php echo $rows->subject ?>" required <?php echo $readonly ?>>
        </div>

        <div class="form-group">
            <textarea name="detail" class="form-control" style="resize: none" placeholder="Detail. . ." rows="5" required <?php echo $readonly ?>><?php echo $rows->rfm_detail ?></textarea>
        </div>
        <div class="form-group text-primary">
            <i class="far fa-clock"></i> <?php echo date('d-m-Y') ?>
        </div>

        <div class="form-group">
            <?php
            $no = 1;
            $this->db->where('rfm_id', $rows->id);
            $qAtt = $this->db->get(TB_ATTACHMENT_RFM);
            foreach ($qAtt->result() as $rAtt) {
                $nama_file = $rAtt->filename;
                $explode_file_ext = explode(".", $nama_file);
                $file_ext = $explode_file_ext[1];
                if ($file_ext == 'jpg' or $file_ext == 'jpeg' or $file_ext == 'png' or $file_ext == 'PNG' or $file_ext == 'gif' or $file_ext == 'GIF') {
            ?>
                    <span id="name_id<?php echo $rAtt->id ?>">
                        <a title="<?php echo $rAtt->filename ?>" target="_blank" href="<?php echo $rAtt->data_file ?>" class=""><i class="far fa-image fa-2x"></i></a>
                    </span>
                <?php
                } elseif ($file_ext == 'docx' or $file_ext == 'docm' or $file_ext == 'dotx' or $file_ext == 'dotm') {
                ?>
                    <span id="name_id<?php echo $rAtt->id ?>">
                        <a title="<?php echo $rAtt->filename ?>" target="_blank" href="<?php echo $rAtt->data_file ?>" class=""><i class="far fa-file-word fa-2x"></i></a>
                    </span>
                <?php
                } elseif ($file_ext == 'xlsx' or $file_ext == 'xlsm' or $file_ext == 'xltx' or $file_ext == 'xltm' or $file_ext == 'xlsb' or $file_ext == 'xlam') {
                ?>
                    <span id="name_id<?php echo $rAtt->id ?>">
                        <a title="<?php echo $rAtt->filename ?>" target="_blank" href="<?php echo $rAtt->data_file ?>" class=""><i class="far fa-file-excel fa-2x"></i></a>
                    </span>
                <?php
                } else {
                ?>
                    <span id="name_id<?php echo $rAtt->id ?>">
                        <a title="<?php echo $rAtt->filename ?>" target="_blank" href="<?php echo $rAtt->data_file ?>" class=""><i class="far fa-file fa-2x"></i></a>
                        </label>
                    </span>
            <?php
                }
            }
            ?>
        </div>

        <?php if (!empty($rows->approve_notes)) : ?>
            <div class="form-group">
                <label>Notes : <?php echo $notes_name_approve->nama . " | " . $rows->approve_date ?></label>
                <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->approve_notes ?></textarea>
            </div>
        <?php endif ?>

        <?php if (!empty($rows->receive_notes)) : ?>
            <div class="form-group">
                <label>Notes : <?php echo $notes_name_receive->nama . " | " . $rows->receive_date ?></label>
                <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->receive_notes ?></textarea>
            </div>
        <?php endif ?>

        <?php if (!empty($rows->confirm_notes)) : ?>
            <div class="form-group">
                <label>Notes Revisi: <?php echo $notes_name_confirm->nama ?></label>
                <textarea placeholder="Notes..." rows="2" class="form-control" style="resize: none" readonly><?php echo $rows->confirm_notes ?></textarea>
            </div>
        <?php endif ?>

        <div class="form-group">
            <label>Tulis Notes :</label>
            <textarea name="notes" placeholder="Notes..." rows="2" style="resize: none" class="form-control"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?php if ($rows->receive_by == '3:855:') : ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label>PIC :</label>
                            <select name="assign_pic" class="form-control">
                                <option disabled value="">PILIH P.I.C</option>
                                <?php foreach ($select_pic->result() as $r) : ?>
                                    <option value="<?php echo $r->user_id ?>"><?php echo $r->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>TARGET DATE :</label>
                            <input type="date" name="target_date" class="form-control"></input>
                        </div>
                    </div>
                <?php endif ?>
            </div>

            <div class="col-md-6 text-right pt-4">
                <input type="hidden" name="id_rfm" value="<?php echo $rows->id ?>">
                <input type="hidden" name="risk_type" value="<?php echo $rows->risk_type ?>">
                <input type="hidden" name="problem_type_hidden" value="<?php echo $rows->problem_type ?>">
                <input type="hidden" name="project_id_hidden" value="<?php echo $rows->project_id ?>">
                <input type="hidden" name="subject" value="<?php echo $rows->subject ?>">
                <input type="hidden" name="detail" value="<?php echo $rows->rfm_detail ?>">

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

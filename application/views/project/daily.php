<div class="card mb-3" id="table">
    <div class="card-header">
        <b>DAFTAR TASK PROJECT </b>
    </div>

    <div class="card-body">
        <div class="pesan"></div>

        <table class="colapse-table res3" id="tb_detail_project" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>NO. RFP</th>
                <th>PROJECT</th>
                <th>TASK</th>
                <th>DETAIL</th>
                <th>TARGET DATE</th>
                <th>STATUS</th>
                <th>OPTION</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($project_activity as $r): ?>
                <tr>
                        <td>
                            <?php
                                if (!empty($r->rfp_id)) {
                                    $rfp_id = $r->rfp_id;
                                    $thisRfp = $this->db->where('id', $rfp_id)->get(TB_RFP)->row();
                                    $no_rfp = $thisRfp->no_rfp;
                                    echo $no_rfp;
                                } else {
                                    echo "-";
                                }
                                ?>
                        </td>
                        <td>
                            <?php 
                                foreach($ProjectList as $row):
                                    if ($r->project_id == $row->id) {
                                        $tableDataProjectName = $row->project_name;
                                        break;
                                    }
                                endforeach;
                                echo $tableDataProjectName;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $r->task_name;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo $r->detail;
                            ?>
                        </td>
                        <td>
                            <?php 
                            if ($r->target_date != NULL)
                            {
                                echo date("d-m-Y",strtotime( $r->target_date));
                            } else {
                                echo "-";
                            }
                            ?>
                            </td>
                        <td>
                            <?php
                                echo $r->status;
                            ?>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" id="btn_activity" data-toggle="modal" data-id='<?php echo $r->id ?>' data-target="#modal-task-activity">
                                <i class="far fa-comments"></i> Activity
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function (event) {
            $('#tb_detail_project').DataTable({
                "bSort" : false
            });
        });
    </script>
</div>

<div class="modal fade" id="modal-task-activity">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="view-task-activity"></div>
    </div>
</div>
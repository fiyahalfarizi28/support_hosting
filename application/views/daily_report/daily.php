<div class="card mb-3" id="table">
    <div class="card-header">
        <button class="btn btn-success btn-sm" id="btn_create" data-toggle="modal" data-target="#modal-create-daily">
            <i class="far fa-comments"></i> Tulis Activity
        </button>
    </div>
	
    <div class="card-body">
        <div class="pesan"></div>

            <table class="colapse-table res3" id="tb_detail_dr" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>HARI</th>
                        <th>TANGGAL</th>
                        <th>WAKTU</th>
                        <th>PROJECT</th>
                        <th>TASK</th>
                        <th>No. RFM</th>
                        <th>STATUS</th>
                        <th>KETERANGAN</th>
                    </tr>
                </thead>

                <?php foreach($daily_activities->result() as $r): ?>
                    <tr>
                        <td>
                        <?php
                            $hari = date('l',strtotime($r->date_activity));
                            switch($hari){
                                case 'Sunday':
                                    $hari = "Minggu";
                                break;
                        
                                case 'Monday':			
                                    $hari = "Senin";
                                break;
                        
                                case 'Tuesday':
                                    $hari = "Selasa";
                                break;
                        
                                case 'Wednesday':
                                    $hari = "Rabu";
                                break;
                        
                                case 'Thursday':
                                    $hari = "Kamis";
                                break;
                        
                                case 'Friday':
                                    $hari = "Jumat";
                                break;
                        
                                case 'Saturday':
                                    $hari = "Sabtu";
                                break;
                                
                                default:
                                    $hari= "Tidak di ketahui";		
                                break;
                            }
                            echo $hari;
                        ?>
                        </td>

                        <td><?php echo date("d-m-Y",strtotime( $r->date_activity)) ?></td>

                        <td>
                            <?php echo date("H:i",strtotime( $r->last_update)) ?>
                        </td>

                        <td>
                            <?php 
                                $tableDataProjectName = null;
                                if (!empty($r->project_id))
                                {
                                    foreach($projectList->result() as $row):
                                        if ($r->project_id == $row->id) {
                                            $tableDataProjectName = $row->project_name;
                                            break;
                                        }
                                    endforeach;
                                }
                                else {
                                    $tableDataProjectName = "-";
                                }
                                echo $tableDataProjectName;
                            ?>
                        </td>
                        
                        <td>
                            <?php $tableTaskName = null;
                                if (!empty($r->task_id))
                                {
                                    foreach($DataTaskList->result() as $row):
                                        if ($r->task_id == $row->id) {
                                            $tableTaskName = $row->task_name;
                                            break;
                                        }
                                    endforeach;
                                }
                                else {
                                    $tableTaskName = "-";
                                }
                                echo $tableTaskName;
                            ?>
                        </td>
                        <td>
                            <?php $tableDataNoRFM = null;
                                if (!empty($r->rfm_id))
                                {
                                    foreach($rfmList->result() as $row):
                                        if ($r->rfm_id == $row->id) {
                                            $tableDataNoRFM = $row->no_rfm;
                                            break;
                                        }
                                    endforeach;
                                }
                                else {
                                    $tableDataNoRFM = "-";
                                }
                                echo $tableDataNoRFM;
                            ?>
                        </td>
                        
                        <td><?php echo $r->status ?></td>
                        <td><?php echo $r->keterangan ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-daily">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="view-create-daily"></div>
	</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function (event) {
    $('#tb_detail_dr').DataTable({
            "bSort" : false
        });
    });
</script>
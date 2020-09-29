<div class="card mb-3" id="table">
    <div class="card-header"><b>TRACKING RFP</b></div>

    <div class="card-body">
    <div class="pesan"></div>
    <form class="mb-2" action="" method="post"></form>

    <!-- table table-bordered table-hover -->
        <table class="colapse-table res3" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>REQUEST BY</th>
                <th>NO.RFP</th>
                <th>DATE</th>
                <th>REQUEST STATUS</th>
                <th>RESULT STATUS</th>
                <th>OPTION</th>
            </tr>
            </thead>

            <tbody>
                <?php foreach($track_rfp->result() as $r): ?>
                    <tr>
                        <td>
                            <?php 
                                $this->db->where('user_id', $r->request_by);
                                echo $this->db->get(TB_USER)->row()->nama;
                            ?>
                        </td>
                        <td>
                            <?php echo $r->no_rfp?>
                        </td>
                        <td>
                            <?php echo date("d-m-Y",strtotime( $r->request_date)) ?>
                        </td>
                        <td>
                            <?php echo $r->request_status ?>
                        </td>
                        <td>
                            <?php echo $r->result_status ?>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" id="btn_track" data-id="<?php echo $r->no_rfp ?>" data-toggle="modal" data-target="#modal-track-rfp">
                                <i class="far fa-eye"></i> Track
                            </button>
                        </td>
                        
                    </tr>

                    <div class="modal fade" id="modal-track-rfp">
                        <div class="modal-dialog modal-m">
                            <div class="modal-content" id="view-track-rfp"> 
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </tbody>
        </table>
        
    </div>
</div>

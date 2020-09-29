<style>
.progressbar {
  margin-left: 50px;
  padding: 0;
  counter-reset: step;
}
.progressbar li {
  list-style-type: none;
  /* width: 25%; */
  /* float: left; */
  font-size: 13px;
  position: relative;
  text-align: left;
  text-transform: uppercase;
  color: #7d7d7d;
}
.progressbar li:before {
  width: 30px;
  height: 30px;
  content: counter(step);
  counter-increment: step;
  line-height: 70px;
  border: 2px solid #7d7d7d;
  /* display: block; */
  text-align: center;
  margin: 0 auto 10px auto;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: white;
}
.progressbar li:after {
  width: 2px;
  height: 58%;
  content: '';
  position: absolute;
  background-color: #7d7d7d;
  /* top: 15px; */
  top: -41%;
  left: 15px;
  z-index: 1;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.done {
  color: #55b776;
}
.progressbar li.done:before {
  border-color: #55b776;
  background-color: #55b776;
}
.progressbar li.done + li:after {
  background-color: #55b776;
}
.progressbar li.active {
  color: #007bff;
}
.progressbar li.active:before {
  border-color: #007bff;
  background-color: #007bff;
}
.progressbar li.active + li:after {
  background-color: #007bff;
}

</style>

<?php
    if($r->request_date != NULL) {
      $class_status_request = "done";
      $title_status_request = "RFP dengan No. $r->no_rfp telah terkirim";
    } else {
      $class_status_request = "active";
      $title_status_request = "Menunggu RFP";
    }

    if($r->approve_date != NULL ) {
      $class_app_dept ="done";
      $title_app_dept= "RFP dengan No. $r->no_rfp telah disetujui oleh Department Head";
    } else {
      if ($class_status_request == "done") {
        $class_app_dept = "active";
      } else {
        $class_app_dept = "";
      }

      $title_app_dept = "Menunggu persetujuan dari Department Head";
    }

    $class_progress = "";
    $title_progress = "Menunggu dikerjakan";
    if($r->receive_date != NULL ) {
      $class_app_it ="done";
      $title_app_it= "RFP dengan No. $r->no_rfp telah disetujui oleh IT";
      $class_progress = "active";
      $title_progress = "RFP dengan No. $r->no_rfp sedang dikerjakan";
    } else {
      if ($class_app_dept == "done") {
        $class_app_it = "active";
      } else {
        $class_app_it = "";
      }
      $title_app_it = "Menunggu persetujuan dari IT";
    }

    if ($r->done_date != NULL ){
      $class_progress = "done";
      $title_progress = "RFP dengan No. $r->no_rfp telah selesai dikerjakan";
      $class_confirmed = "active";
      $nama_requestor = $this->db->where('user_id', $r->request_by)->get(TB_USER)->row()->nama;
      $title_confirmed= "Menunggu konfirmasi penyelesaian dari $nama_requestor";
    } else {
      $class_confirmed = "";      
      $title_confirmed = "Menunggu konfirmasi";
    }

?>

<div class="modal-header">
    <h3 class="modal-title">TRACK <?php echo $r->no_rfp ?></h3>
</div>

<div class="modal-body">
    <ul class="progressbar">
        <li class="<?php echo $class_status_request ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_status_request ?>">
          RFP terkirim
          <div class="ml-4">
          (<?php echo !empty($r->request_date) ? date('d-m-Y', strtotime($r->request_date)) : '' ?> | <?php echo !empty($r->request_date) ? date('H:i:s', strtotime($r->request_date)) : '' ?>)
          </div>
        </li>

        <li class="<?php echo $class_app_dept ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_app_dept ?>">
          Approved Department Head
          <div class="ml-4">
          (<?php echo !empty($r->approve_date) ? date('d-m-Y', strtotime($r->approve_date)) : '' ?> | <?php echo !empty($r->approve_date) ? date('H:i:s', strtotime($r->approve_date)) : '' ?>)
          </div>
        </li>

        <li class="<?php echo $class_app_it ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_app_it ?>">
          Approved IT 
          <div class="ml-4">
          (<?php echo !empty($r->receive_date) ? date('d-m-Y', strtotime($r->receive_date)) : '' ?> | <?php echo !empty($r->receive_date) ? date('H:i:s', strtotime($r->receive_date)) : '' ?>)
          </div>
        </li>

        <?php if ($r->receive_date != NULL && $r->result_status == "PENDING") { ?>

          <li class="<?php echo $class_progress ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_progress ?>">
            ON PROGRESS
            <div class="ml-4">
            (<?php echo !empty($r->receive_date) ? date('d-m-Y', strtotime($r->receive_date)) : '' ?> | <?php echo !empty($r->receive_date) ? date('H:i:s', strtotime($r->receive_date)) : '' ?>)
            </div>
          </li>

          <?php } else if ($r->receive_date != NULL && $r->result_status == "DONE") { ?>

            <li class="<?php echo $class_progress ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_progress ?>">
            DONE
            <div class="ml-4">
            (<?php echo !empty($r->done_date) ? date('d-m-Y', strtotime($r->done_date)) : '' ?> | <?php echo !empty($r->done_date) ? date('H:i:s', strtotime($r->done_date)) : '' ?>)
            </div>
          </li>

          <?php } else {?>

            <li class="<?php echo $class_progress ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_progress ?>">
              PENDING
              <div class="ml-4">
              (<?php echo !empty($r->receive_date) ? date('d-m-Y', strtotime($r->receive_date)) : '' ?> | <?php echo !empty($r->receive_date) ? date('H:i:s', strtotime($r->receive_date)) : '' ?>)
              </div>
            </li>

          <?php } ?>
          

        <li class="<?php echo $class_confirmed?>" data-toggle="tooltip" data-placement="left" title="<?php echo $title_confirmed?>">
          Konfirmasi RFP
          <div class="ml-4">
          (<?php echo !empty($r->confirmed_date) ? date('d-m-Y', strtotime($r->confirmed_date)) : '' ?> | <?php echo !empty($r->confirmed_date) ? date('H:i:s', strtotime($r->confirmed_date)) : '' ?>)
          </div>
        </li>
    </ul>
</div>

<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
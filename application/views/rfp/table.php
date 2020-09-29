<div class="card mb-3" id="table">
    <div class="card-header">
        <button class="btn btn-success btn-sm" id="btn_create" data-id="<?php echo $SESSION_USER_ID ?>" data-toggle="modal" data-target="#modal-create-rfp">
            <i class="far fa-comments"></i> Tulis RFP
        </button>
    </div>
    <div class="card-body">
    <div class="pesan"></div>
    <!-- table table-bordered table-hover -->
        <table class="colapse-table res3" id="tb_detail_rfp" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>#</th>
                <th>REQUEST BY</th>
                <th>JABATAN</th>
                <th>APPROVAL</th>
                <th>NO.RFP</th>
                <th>DATE</th>
                <th>REQUEST STATUS</th>
                <th>RESULT STATUS</th>
                <th>PIC</th>
                <th>OPTION</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-create-rfp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="view-modal-create"></div>
    </div>
</div>

<div class="modal fade" id="modal-edit-rfp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="view-modal-edit"></div>
    </div>
</div>

<div class="modal fade" id="modal-approve-rfp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="view-approve-rfp"></div>
    </div>
</div>

<div class="modal fade" id="modal-reject-rfp">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="view-reject-rfp"></div>
    </div>
</div>

<div class="modal fade" id="modal-rating-rfp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="view-rating-rfp"></div>
    </div>
</div>

<div class="modal fade" id="modal-assign-rfp">
    <div class="modal-dialog modal-lg" style="margin-left: 200px">
        <div class="modal-content" style="width:980px;"id="view-assign-rfp"></div>
    </div>
</div>
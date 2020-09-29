<div class="modal-header">
    <h3 class="modal-title">New Activity</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form method="post" enctype="multipart/form-data" id="frm-create-daily">
        <div class="form-group text-primary">
            <i class="far fa-clock"></i> <?php echo date(' d-m-Y | H:i') ?>
        </div>

        <div class="form-group">
            <label>Aktivitas :</label>
            <input type="textarea" class="form-control" id="activity" style="resize: none" placeholder="Aktivitas... " name="activity"></input>
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
            <label for="PIC">PIC : </label>
            <?php echo strtoupper($this->session->userdata('USER_FULLNAME')) ?>
        </div>
    </form>
    <div class="modal-footer">
        <div class="btn_post_request">
            <a href="javascript:void(0)" onclick="post_request_dr()" class="btn btn-success"><i class="fa fa-check"></i> Add</a>
        </div>
    </div>
</div>
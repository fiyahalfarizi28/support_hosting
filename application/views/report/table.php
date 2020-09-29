<div class="card mb-3" id="table">
    <div class="card-header"><b>REPORT RFM</b></div>

    <div class="card-body">
        <div class="pesan"></div>
        <form class="mb-2" action="" method="post"></form>

        <div class="row">
            <div class="col-md-3">
                <label>Dari Tanggal:</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" ></input>
            </div>

            <div class="col-md-3">
                <label>Sampai Tanggal:</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" ></input>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="request_status">Request Status:</label>
                    <select id="request_status" name="request_status" class="form-control">
                        <option disabled selected="selected" value="">- Pilih Request Status -</option>
                        <option>SEMUANYA</option>
                        <option>ON QUEUE</option>
                        <option>APPROVED</option>
                        <option>ASSIGNED</option>
                        <option>CONFIRMED</option>
                        <option>DONE</option>
                        <option>REJECT</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <a style="margin-top: 35px" href="javascript:void(0)" title="Export To Excel" class="btn btn-primary btn-sm mr-3" onclick="export_to_excel()">
                    <i class="fa fa-print"></i> Export To Excel
                </a>
            </div>

        </div>
    </div>
</div>

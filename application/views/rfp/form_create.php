<div class="modal-header">
    <h4 class="modal-title">TULIS RFP BARU</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form id="frm-create" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
            <div class="row">       
                <div class="col-md-12">
                    <label>REQUEST TYPE :</label>
                    <select name="request_type" id="request_type" class="form-control">
                        <option disabled value="" selected="selected">- REQUEST TYPE -</option>
                            <?php foreach($request_type->result() as $r): ?>
                                <?php if ($r->id == REQUEST_TYPE_PROJECT) { ?>
                                    <option value="<?php echo $r->id ?>"><?php echo $r->request_type ?></option>
                                <?php } ?>
                            <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="panel-group" id="accordion" style="margin-top: 8px">
                <div class="panel panel-default">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_id">APPLICATION :</label>
                                <select id="project_id" class="form-control" name="project_id" style="margin-bottom: 15px" required>
                                    <option disabled value="" selected="selected">- SELECT APPLICATION -</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>PROBLEM TYPE :</label>
                                <select name="problem_type" id="problem_type" class="form-control" required>
                                    <option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>
                                </select>
                            </div>
                        </div>
                     </div>
                </div>

            </div>

            <div class="form-group">
                <label>SUBJECT :<?php $cc ?></label>
                <input type="text" name="subject" class="form-control" placeholder="Subject. . ." required>
            </div>

            <div class="form-group">
                <textarea style="resize: none" name="detail" class="form-control" placeholder="Detail. . ." rows="5" required></textarea>
            </div>
            <div class="form-group text-primary">
                <i class="far fa-clock"></i> <?php echo date('d-m-Y') ?>
            </div>

            <div id="files"></div>

            <div class="row">
                <div class="col-md-6">
                    Attachment: <a href="javascript:void(0)" class="btn btn-warning text-white" onclick="addFile();"><i class="fa fa-paperclip"></i></a>         
                </div>

                <div class="col-md-6 text-right">
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('USER_ID') ?>" readonly>
                    
                    <input type="hidden" name="kode_cabang" value="<?php echo $this->session->userdata('USER_KODE_CABANG') ?>" readonly>
                    
                    <input type="hidden" name="head_id" value="<?php echo $this->session->userdata('USER_INDUK') ?>" readonly>

                    <!-- btn_kirim -->
                    <div class="btn_post_request">
                        <a href="javascript:void(0)" onclick="post_request_rfp()" class="btn btn-success"><i class="fa fa-check"></i> Kirim</a>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>

    var activities = document.getElementById("request_type");
    var activities2 = document.getElementById("project_id");

    activities.addEventListener("change", function() {

        var arrayProblem = <?php echo json_encode($problem_type->result()) ?>;
        var arrayProject = <?php echo json_encode($projectList->result()) ?>;  

        var optionSelected = $("option:selected", this).text();

        $('#problem_type').empty();
        $('#project_id').empty();

        $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');
        $('#project_id').append('<option disabled selected="selected" value="">- SELECT APPLICATION -</option>');

        if (optionSelected == "REQUEST FOR PROJECT") {

            $('#problem_type').empty();
            $('#project_id').empty();

            $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');
            $('#project_id').append('<option disabled selected="selected" value="">- SELECT APPLICATION -</option>');

            arrayProject.forEach( (Project) => {
                if (Project.id > 0) {
                    $('#project_id').append(`<option value="${Project.id}">${Project.project_name}</option>`);
                }   
            });

            arrayProblem.forEach( (problemType) => {
                if (problemType.id > 8 && problemType.id < 11) {
                    $('#problem_type').append(`<option value="${problemType.id}">${problemType.problem_type}</option>`);
                }
            });
        }
    });

    activities2.addEventListener("change", function() {

        var arrayProblem2 = <?php echo json_encode($problem_type->result()) ?>; 

        var optionSelected = $("option:selected", this).text();

        if (optionSelected == "APLIKASI BARU") {

            $('#problem_type').empty();
            
            arrayProblem2.forEach( (problemType) => {
                if (problemType.id > 10) {
                    $('#problem_type').append(`<option value="${problemType.id}">${problemType.problem_type}</option>`);
                }
            });
        } else {
            $('#problem_type').empty();
            $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');

            arrayProblem2.forEach( (problemType) => {
                if (problemType.id > 8 && problemType.id < 11) {
                    $('#problem_type').append(`<option value="${problemType.id}">${problemType.problem_type}</option>`);
                }
            });
        }

    });

    //-----create new rfp post request-------
    function post_request_rfp() {
        // var data = $('#frm-create').serialize();
        var form = $('#frm-create')[0];
        var data = new FormData(form);
        $.ajax({
            type: "post",
            url: "rfp_controller/post_request",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            beforeSend: function() {
                $('.btn_post_request').html('<a href="javascript:void(0)" class="btn btn-secondary"><i class="fas fa-spinner fa-pulse"></i> Proses</a>');
            },
            success: function (res) {
                var isValid = res.isValid,
                    isPesan = res.isPesan;
                if(isValid == 0) {
                    $('.btn_post_request').html('<a href="javascript:void(0)" onclick="post_request()" class="btn btn-success"><i class="fa fa-check"></i> Kirim</a>');
                    $('.pesan').html(isPesan);
                }else {
                    $('.pesan').html(isPesan);
                    $('#modal-create-rfm').modal('hide');
                    $('#modal-create-rfp').modal('hide');
                    reload_table();
                }
            }
        });
    }

</script>   
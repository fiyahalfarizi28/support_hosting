<div class="modal-header">

    <h4 class="modal-title">TULIS RFM BARU</h4>

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

                                <?php if ($r->id == REQUEST_TYPE_MAINTENANCE) { ?>

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



                    <div id="collapseRisk" class="panel-collapse collapse">

                        <div class="panel-body">



                            <div class="form-group">

                                <label for="risk_type">MEMPENGARUHI FINANCIAL :</label>

                                <select id="risk_type" class="form-control" name="risk_type" style="margin-bottom: 15px">

                                    <option disabled selected="selected">- RISK TYPE -</option>

                                    <option value="IYA">IYA</option>

                                    <option value="TIDAK">TIDAK</option>

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

                        <a href="javascript:void(0)" onclick="post_request()" class="btn btn-success"><i class="fa fa-check"></i> Kirim</a>

                    </div>

                </div>

            </div>

        </div>



    </form>

</div>



<script>



    var activities = document.getElementById("request_type");

    var activities2 = document.getElementById("project_id");

    var activities3 = document.getElementById("problem_type");



    activities.addEventListener("change", function() {

        

        var arrayProblem = <?php echo json_encode($problem_type->result()) ?>;

        var arrayProject = <?php echo json_encode($projectList->result()) ?>;  



        var optionSelected = $("option:selected", this).text();



        $('#problem_type').empty();

        $('#project_id').empty();

        

        $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');

        $('#project_id').append('<option disabled selected="selected" value="">- SELECT APPLICATION -</option>');



        if (optionSelected == "REQUEST FOR MAINTENANCE") {

            $('#problem_type').empty();

            $('#project_id').empty();

            $("#collapseRisk").collapse('hide');

            $('#risk_type').prop('disabled', 'disabled');



            $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');

            $('#project_id').append('<option disabled selected="selected" value="">- SELECT APPLICATION -</option>');



            arrayProject.forEach( (Project) => {

                if (Project.id >= 1) {

                    $('#project_id').append(`<option value="${Project.id}">${Project.project_name}</option>`);

                }

            });



            arrayProblem.forEach( (problemType) => {

                if (problemType.id < 6) {

                    $('#problem_type').append(`<option value="${problemType.id}">${problemType.problem_type}</option>`);

                }

            });

        }

    });



    activities2.addEventListener("change", function() {

        var data = $('#project_id').val();

    

        $("#collapseRisk").collapse('hide');

        $('#risk_type').prop('disabled', 'disabled');

        var arrayProblem2 = <?php echo json_encode($problem_type->result()) ?>; 



        var optionSelected = $("option:selected", this).text();



        if  (optionSelected == "LAINNYA") {



            $('#problem_type').empty();

            $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');

            $("#collapseRisk").collapse('hide');

            $('#risk_type').prop('disabled', 'disabled');

            arrayProblem2.forEach( (problemType) => {

                if (problemType.id > 5 && problemType.id < 9) {

                    $('#problem_type').append(`<option value="${problemType.id}">${problemType.problem_type}</option>`);

                }

            });



        } else {

            $('#problem_type').empty();

            $('#problem_type').append('<option disabled selected="selected" value="">- SELECT PROBLEM TYPE -</option>');

            $("#collapseRisk").collapse('hide');

            $('#risk_type').prop('disabled', 'disabled');



            arrayProblem2.forEach( (problemType) => {

                if (problemType.id < 6) {

                    $('#problem_type').append(`<option value="${problemType.id}">${problemType.problem_type}</option>`);

                }

            });

        }

    });

        

    activities3.addEventListener("change", function() {

        var optionSelected = $("option:selected", this).text();

        var selectedProject = $("#project_id").val();

        var flagMicroBPROrCentro = (selectedProject == '6' || selectedProject == '13');



        if (optionSelected == "SUPPORT DATA HUMAN ERROR" && flagMicroBPROrCentro) {

            $("#collapseRisk").collapse('show');

            $('#risk_type').prop('disabled', false);

        } else {    

            $("#collapseRisk").collapse('hide');

            $('#risk_type').prop('disabled', 'disabled');

        }



    });







</script>   
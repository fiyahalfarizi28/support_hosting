<div class="modal-header">
    <h4 class="modal-title">TULIS TASK PROJECT BARU</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
    <form id="frm-create" method="post" enctype="multipart/form-data">
        <div class="pesan"></div>
        
            <div class="form-group">
                <label for="projectFlag">Jenis Project :</label>
                <select id="projectFlag" name="projectFlag" class="form-control">
                    <option disabled selected="selected" value="">- SELECT PROJECT -</option>
                    <option>Penambahan/Perubahan Aplikasi</option>
                    <option>Project/Aplikasi Baru</option>
                </select>
            </div>

            <div id="collapseTanpaRFP" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="project_id">Daftar Project:</label>
                        <select id="project_id" class="form-control" name="project_id" style="margin-bottom: 8px">
                            <option disabled selected="selected" value="">- Pilih Aplikasi -</option>
                            <?php foreach($projectList->result() as $row): ?>
                                <option id="project_id" value=<?php echo $row->id ?> >
                                    <?php echo $row->project_name?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div id="collapseProjectBaru" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="new_project">Nama Aplikasi Baru:</label>
                        <input type="textarea" class="form-control" id="new_project" style="    resize: none" placeholder="Nama Aplikasi Baru... " name="new_project"></input>
                    </div>

                    <div class="form-group">
                        <label for="description">Dekripsi:</label>
                        <input type="textarea" class="form-control" id="description" style="resize: none" placeholder="Deskripsi... " name="description"></input>
                    </div>

                </div>
            </div>

            <div id="collapseAssignTask" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="form-group" id="formTask">
                        <button type="button" class="btn btn-info" id="tambahTask" onclick="addTask()">Tambah Task</button>
                        <div id="task" style="margin: 8px 15px !important;">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 text-right">
                <div class="btn_post_request">
                    <a href="javascript:void(0)" onclick="post_assign_task()" class="btn btn-success"><i class="fa fa-check"></i> Assign</a>
                </div>
            </div>

    </form>
</div>

<script>
    var activities = document.getElementById("projectFlag");
    activities.addEventListener("change", function() {
        var optionSelected = $("option:selected", this).text();
         if (optionSelected == "Penambahan/Perubahan Aplikasi") {
            $("#collapseProjectBaru").collapse('hide');
            $('#new_project').prop('disabled', 'disabled');

            $("#collapseTanpaRFP").collapse('show');
            $('#project_id').prop('disabled', false);
            $("#collapseAssignTask").collapse('show');

        } else {
            $("#collapseTanpaRFP").collapse('hide');
            $('#project_id').prop('disabled', 'disabled');

            $("#collapseProjectBaru").collapse('show');
            $('#new_project').prop('disabled', false);
            $("#collapseAssignTask").collapse('show');
            
        }

    });

    var idField = 0;
    function addTask() {
        idField++;
        
        $.ajax({
            type : 'post',
            url : 'project_controller/add_field_task',
            data :  {
                idfield: idField
            },
            cache: false,
            success : function(res) {
                $("#task").append(res);
            }
        });

    }
</script>
<div class="row" id="<?php echo $idfield ?>" style="margin-top: 8px">

    <div class="col-md-6">

        <!-- INI NANTI DIISI TASK & DESKRIPSI-->



        <div class="row">

            <!-- Task bakal disini-->

            <label for="specificTask[<?php echo $idfield?>]">Task:</label>

            <input type="textarea" class="form-control" style="resize: none" placeholder="Nama Tasknya... " name="specificTask[<?php echo $idfield?>]"></input>

            

        </div>

        <div style ="margin-top: 8px" class="row">

            <!-- Deskripsi bakal disini-->

            <label for="deskripsi[<?php echo $idfield?>]">Dekripsi:</label>

            <input type="textarea" class="form-control" style="resize: none" placeholder="Deskripsi... " name="deskripsi[<?php echo $idfield?>]"></input>

        </div>

    </div>



    <div class="col-md-5">

        <div class="row">

            <!-- INI NANTI DIISI PIC & TARGET DATE-->



            <div class="col-md-6">

                <!-- PIC bakal disini-->

                <label>PIC :</label>

                <select name="assign_pic[<?php echo $idfield?>]" class="form-control">

                    <option value="" disabled selected>PILIH P.I.C</option>

                    <?php foreach($select_pic->result() as $r): ?>

                        <option value="<?php echo $r->user_id ?>"><?php echo $r->nama ?></option>

                    <?php endforeach ?>

                </select>

            </div>



            <div class="col-md-6">

                <!-- Target Date bakal disini-->

                <label>TARGET DATE :</label>

                <input type="date" name="target_date[<?php echo $idfield?>]" class="form-control" ></input>

            </div>

        </div>



        <div class="row" style="margin-left: 2px !important; margin-top: 8px">

            <!-- Choose file buat attachment bakal disini -->

            Attachment:  <a href="javascript:void(0)" class="btn btn-warning text-white" style ="margin-top: -5px; margin-left: 5px; margin-bottom: 5px" onclick="addFile_task(<?php echo $idfield ?>);"><i class="fa fa-paperclip"></i></a>         

            <div id="files<?php echo $idfield ?>"></div>

        </div>

    </div>



    <div class="col-md-1 align-self-center">

        <!-- Button delete bakal disini -->

        <button type="button" style="margin: auto 0 !important;" class="btn btn-danger" onclick="deleteFieldTask(<?php echo $idfield ?>)">x</button>

    </div>



    <script>

        function deleteFieldTask(param) {

            $(`#${param}`).remove();

        }



        var fileId = 0;

        function addFile_task(param) {

            fileId++;

            var html =  '<input type="file" name="attachment'+param+'[]" />'+

                        ' <a href="javascript:void(0)" onclick="javascript:removeElement(\'file-' + fileId + '\'); return false;">'+

                        '<i class="far fa-window-close fa-lg text-danger"></i></a>';

            addElement(`files${param}`, 'p', 'file-' + fileId, html);

        }

    </script>

</div>
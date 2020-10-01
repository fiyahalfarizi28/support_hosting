<?php
    $no = 1;
    $this->db->where(!empty($id_rfm) ? 'rfm_id' : 'task_id', !empty($id_rfm) ? $id_rfm : $task_id);
    $qAtt = $this->db->get(!empty($id_rfm) ? TB_ATTACHMENT_RFM : TB_ATTACHMENT_PROJECT);
    foreach($qAtt->result() as $rAtt){
        $nama_file = $rAtt->filename;
        $explode_file_ext = explode(".", $nama_file);
        $file_ext = $explode_file_ext[1];
        if($file_ext =='jpg' or $file_ext =='jpeg' or $file_ext =='png' or $file_ext =='PNG' or $file_ext =='gif' or $file_ext =='GIF'){
?>
    <span id="name_id<?php echo $rAtt->id ?>">
        <a title="<?php echo $rAtt->filename ?>" target="_blank" href="<?php echo $rAtt->data_file ?>" class=""><i class="far fa-image fa-2x"></i></a>
        <label for='check_remove<?php echo $rAtt->id ?>'>
        </label>
        <input type="checkbox" class="check_remove" id='check_remove<?php echo $rAtt->id?>' name="removeAtt[]" value="<?php echo $rAtt->id?>">
    </span>
<?php }elseif($file_ext =='docx' or $file_ext =='docm' or $file_ext =='dotx' or $file_ext =='dotm'){
?>
    <span id="name_id<?php echo $rAtt->id?>">
        <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file-word fa-2x"></i></a>
    </span>
<?php }elseif($file_ext =='xlsx' or $file_ext =='xlsm' or $file_ext =='xltx' or $file_ext =='xltm' or $file_ext =='xlsb' or $file_ext =='xlam'){
?>
    <span id="name_id<?php echo $rAtt->id?>">
        <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file-excel fa-2x"></i></a>
    </span>
<?php }else{
?>
    <span id="name_id<?php echo $rAtt->id?>">
        <a title="<?php echo $rAtt->filename?>" target="_blank" href="<?php echo $rAtt->data_file?>" class=""><i class="far fa-file fa-2x"></i></a>
    </span>
<?php }
    }
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('rfp_model');
        $this->load->model('auth_model');
    }

	public function index()
	{
        if($this->auth_model->logged_id()) {
            $data['SESSION_USER_ID'] = $this->session->userdata('USER_ID');
            $data['SESSION_USER_JABATAN'] = $this->session->userdata('USER_JABATAN');
            $data['task_project'] = $this->getTask();
            $data['project_activity'] = $this->projectActivity();

            $SESSION_USER_ID = $this->session->userdata('USER_ID');
            $data['SESSION_USER_ID'] = $SESSION_USER_ID;

            $Q = 'SELECT DISTINCT ticket_support.task.project_id AS id, ticket_support.project.project_name AS project_name, ticket_support.project.last_update AS last_update
            FROM ticket_support.task
            INNER JOIN ticket_support.project
            ON ticket_support.task.project_id=ticket_support.project.id;
            ';
            $data['ProjectList'] = $this->db->query($Q)->result();
            
            $array_crud = array(
                'select' => '*',
                'table' => TB_TASK,
            );

            $data['DataTaskList'] = $this->rfp_model->get_crud($array_crud);
            
            if ($this->session->userdata('USER_JABATAN')==='HEAD IT' || $this->session->userdata('USER_JABATAN')==='SUPERVISOR IT' || $this->session->userdata('USER_JABATAN')==='DIREKSI') {
                $this->template->load('template','project/table', $data);
            } else {
                $this->template->load('template','project/daily', $data);
            }
        } else {
            $this->load->view('login/form_login');
        }
    }

    public function btn_create()
    {
        $id = $this->input->post('idx');
        $array_crud = array(
            'table' => TB_RFP,
        );
        $data['rfpList'] = $this->rfp_model->get_crud($array_crud);
        
        $array_crud = array(
            'table' => TB_PROJECT,
        );
        $data['projectList'] = $this->rfp_model->get_crud($array_crud);

        $array_crud = array(
            'table' => TB_USER,
        );
        $data['userList'] = $this->rfp_model->get_crud($array_crud);

        $this->load->view('project/form_create', $data);
    }

    public function btn_activity()
    {
        $id = $this->input->post('idx');
        $SESSION_USER_ID = $this->session->userdata('USER_ID');

        $array_crud = array(
            'table' => TB_PROJECT,
        );
        $data['projectList'] = $this->rfp_model->get_crud($array_crud);

        $array_crud = array(
            'table' => TB_TASK,
            'where' => array(
                'id' => $id
            )
        );
        $row = $this->rfp_model->get_crud($array_crud)->row();
        $data['rows'] = $row;

        if($SESSION_USER_ID === $row->assign_to)
        {
            $data['disabled'] = "";
            $data['readonly'] = "readonly";
            $data['onclick'] = "add_daily_task()";
            $data['btnText'] = "Add";
        }

        $this->load->view('project/add_activity', $data);
    }

    public function add_daily_task()
    {
        if(!$this->auth_model->logged_id())
        {
            $data = array('isValid' => 0, 'isPesan' => '<div class="alert alert-danger">Sesi telah berakhir, silahkan segarkan halaman ini terlebih dahulu. <a href="./">Segarkan</a></div>');
            echo json_encode($data);
            die();
        }
		
        $date_now = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('USER_ID');
        $project_id = $this->input->post('project_id_hidden');
        $task_id = $this->input->post('task_id');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        
        if ($this->input->post('notes') !== "") {
            $done_notes = $this->input->post('notes');
        }
        
        if(empty($status)) {
            $isValid = 0;
            $isPesan = "<div class='alert alert-danger'>Status Pekerjaan Harus Diisi !!!</div>";
        } else {

            $array_crud = array(
                'table' => TB_DAILY_ACTIVITY,
                'where' => array(
                    'user_id' => $this->session->userdata('USER_ID'),
                    'date_activity' => $date_now,
                )
            );

            $sql = $this->rfp_model->get_crud($array_crud);

            if (!empty($task_id)) {
                $array_update_task = array(
                    'status'            => $status,
                    'update_by'         => $this->session->userdata('USER_ID'),
                    'last_update'       => $date_now,
                );
    
                $this->db->where('id', $task_id);
                $update_task = $this->db->update(TB_TASK, $array_update_task);

                $array_update_project = array(
                    'last_update' => $date_now,
                );
    
                $this->db->where('id', $project_id);
                $update_project = $this->db->update(TB_PROJECT, $array_update_project);

            }

            if ($status == STT_DONE)
            {
                $array_update_task = array(
                    'update_by'         => $this->session->userdata('USER_ID'),
                    'done_date'         => $date_now,
                    'last_update'       => $date_now,
                );
    
                $this->db->where('id', $task_id);
                $update_task = $this->db->update(TB_TASK, $array_update_task);

            }

            $array_insert = array(
                'user_id'       => $user_id,
                'date_activity' => $date_now,
                'project_id'    => $project_id,
                'task_id'       => $task_id,
                'status'        => $status,
                'keterangan' 	=> $keterangan,
                'update_by'     => $user_id,
            );
        
            $insert_data = $this->db->insert(TB_DAILY_ACTIVITY, $array_insert);

            if(!$insert_data) {
                $isValid = 0;
                $isPesan = "<div class='alert alert-danger'>Gagal menambahkan daily activity</div>";
                        
                $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                echo json_encode($data);
                die(); 
            } else {
                $isValid = 1;
                $isPesan = "<div class='alert alert-success'>Berhasil menambahkan daily activity</div>";
                
            }
            
        }

        $date_now = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('USER_ID');
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        $project_id = $this->input->post('project_id');
        $task_id = $this->input->post('task_id');

        $data = array(
            'isValid' => $isValid, 
            'isPesan' => $isPesan, 
            'task_id' => $task_id,
            'status' => $status,
            'user_id' => $user_id,
            'keterangan' => $keterangan
        );
        echo json_encode($data);
    }

    public function getTask()
    {
        
        $array_crud = array(
            'table' => TB_TASK,
        );
        return $this->rfp_model->get_crud($array_crud);
    }

    public function set_assign_task()
    {
        $SESSION_USER_ID = $this->session->userdata('USER_ID');
        $date_now = date('Y-m-d H:i:s');
        $table_destination = TB_TASK;
        $extensionList = array("jpg", "jpeg", "png", "bmp", "gif", "JPG", "JPEG", "PNG", "BMP", "GIF", "pdf", "docx", "xlsx", "pptx", "txt", "TXT");

        $specificTask = $this->input->post('specificTask');
        $deskripsi = $this->input->post('deskripsi');
        $assign_pic = $this->input->post('assign_pic');
        $target_date = $this->input->post('target_date');
        
        $rfp_id = null;
        $no_rfp = null;
        $project_id = null;
        $new_project = null;
        $description = null;

        if ($this->input->post('rfp_id') != "" || $this->input->post('rfp_id') != null) {
            $rfp_id = $this->input->post('rfp_id');
            $thisRfp = $this->db->where('id', $rfp_id)->get(TB_RFP)->row();
            $no_rfp = $thisRfp->no_rfp;

            $thisRfp = $this->db->where('id', $rfp_id)->get(TB_RFP)->row();
            $project_id = $thisRfp->project_id;
        } 
        
        if ($this->input->post('project_id') != "" || $this->input->post('project_id') != null) {
            $project_id = $this->input->post('project_id');
        } 
        
        if ($this->input->post('new_project') != "" || $this->input->post('new_project') != null) {
            $new_project = $this->input->post('new_project');
            $description = $this->input->post('description');

            $array_insert = array(
                'project_name'      => $new_project,
                'description'        => $description,
                'create_by'         => $SESSION_USER_ID,
                'create_date'       => $date_now,
                'last_update'       => $date_now,
            );

            $insert_data_project = $this->db->insert(TB_PROJECT, $array_insert);
            $project_id = $this->db->insert_id();
        }

        if(empty($specificTask))
        {
            $isValid = 0;
            $isPesan = "<div class='alert alert-danger'>Task Tidak Boleh Kosong</div>";
            
            $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
            echo json_encode($data);
            die(); 
        }

        $status = array();
        $insertedData = array();

        for ($i = 1; $i <= count($specificTask); $i++)  {
            if (!empty($specificTask[$i])) {
                if(empty($assign_pic[$i]) || empty($target_date[$i]))
                {
                    $isValid = 0;
                    $isPesan = "<div class='alert alert-danger'>Pic Atau Tanggal Target Tidak Boleh Kosong</div>";
                    
                    $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                    $status[] = $data;
                    continue;

                }
                
                $array_insert = array(
                    'rfp_id'            => $rfp_id,
                    'project_id'        => $project_id,
                    'task_name'         => $specificTask[$i],
                    'detail'            => $deskripsi[$i],
                    'assign_to'         => $assign_pic[$i],
                    'assign_date'       => $date_now,
                    'target_date'       => $target_date[$i],
                    'status'            => STT_PENDING,
                    'create_by'         => $SESSION_USER_ID,
                    'create_date'       => $date_now,
                    'update_by'         => $SESSION_USER_ID,
                    'last_update'       => $date_now,
                );

                $insertedData[] = $array_insert;

                $insert_data_task = $this->db->insert(TB_TASK, $array_insert);
                $task_id = $this->db->insert_id();

                if(!$insert_data_task) {
                    $isValid = 0;
                    $isPesan = "<div class='alert alert-danger'>Gagal Menambah Task RFP</div>";
                    
                    $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                    $status[] = $data;
                    continue;
                } else {
                    $isValid = 1;
                    $isPesan = "<div class='alert alert-success'>Berhasil Menambah Task RFP</div>";
                    $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                }

                $data = array('isValid' => $isValid, 'isPesan' => $isPesan);

                if(!empty($_FILES["attachment$i"]['name'])) {
                    $no=1;
                    foreach ($_FILES["attachment$i"]['name'] as $key => $value) {
                        $name = $_FILES["attachment$i"]['name'][$key];
                        $tmp = $_FILES["attachment$i"]['tmp_name'][$key];
                        $size = $_FILES["attachment$i"]['size'][$key];
                        $ext = explode(".", $name);
                        $extensi = end($ext);
                        $maxsize = 1024 * 2000;
                        $path = "upload/";

                        if($size>=$maxsize) {
                            $isValid = 0;
                            $isPesan = "<div class='alert alert-danger'>Attachment $name max 2mb</div>";
                                    
                            $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                            $status[] = $data;
                            continue;
                        } elseif(!in_array($extensi, $extensionList)) {
                            $isValid = 0;
                            $isPesan = "<div class='alert alert-danger'>Format attachment tidak di izinkan</div>";
                                    
                            $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                            $status[] = $data;
                            continue;
                        } else {
                            if(trim($name)!=null) {
                                $explode_name = explode(".", $name);
                                $random_name = round(microtime(true)).'.'.end($explode_name);
                                $new_name = md5(date('YmdHis'))."-".$no++."-".$random_name;

                                $array_insert = array(
                                    'task_id'       => $task_id,
                                    'filename'      => $name,
                                    'full_filename' => $new_name,
                                    'data_file'     => "upload/$new_name",
                                    'assign_to'     => $assign_pic[$i],
                                );
                                $insert_attachment = $this->db->insert(TB_ATTACHMENT_PROJECT, $array_insert);

                                if($insert_attachment) {
                                    move_uploaded_file($tmp, $path.null.$new_name);
                                } else {
                                    $isValid = 0;
                                    $isPesan = "<div class='alert alert-danger'>Attachment gagal terkirim, tidak Terhubung Database.</div>";
                                    
                                    $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                                    $status[] = $data;
                                    continue;
                                }
                            }
                        }
                    }
                }
                
                if(!$insert_data_task) {
                    $isValid = 0;
                    $isPesan = "<div class='alert alert-danger'>Format attachment tidak di izinkan</div>";
                            
                    $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                    $status[] = $data;
                    continue;
                }

                $status[] = $data;
            }
        }

        // $data['specificTask'] = $specificTask;
        // $data['deskripsi'] = $deskripsi;
        // $data['assign_pic'] = $assign_pic;
        // $data['target_date'] = $target_date;
        $data['allStatus'] = $status;
        $data['insertedData'] = $insertedData;

        echo json_encode($data);
    }

    public function add_field_task()
    {
        $data['idfield'] = $this->input->post('idfield');

        $array_crud = array(
            'table' => TB_USER,
            'where' => array(
                'group_menu' => 'IT',
                'flg_block' => 'N',
                )
        );
        $data['select_pic'] = $this->rfp_model->get_crud($array_crud);

        $this->load->view('project/field_task', $data);
    }

    public function projectActivity()
    {
        $array_crud = array(
            'table' => TB_TASK,
            'where' => array(
            'assign_to' => $this->session->userdata('USER_ID'),
            'status !=' => STT_DONE, 
            ),
            'order_by' => 'assign_date',
        );
        return $this->rfp_model->get_crud($array_crud)->result();
    }

}
?>
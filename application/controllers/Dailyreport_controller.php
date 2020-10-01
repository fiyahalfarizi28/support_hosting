<?php
class Dailyreport_controller extends ci_controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->model('rfm_model');
    }
    
    function index()
    {
        if($this->auth_model->logged_id()) {
            $data['SESSION_USER_JABATAN'] = $this->session->userdata('USER_JABATAN');
            $data['SESSION_USER_ID'] = $this->session->userdata('USER_ID');
            
            $array_crud = array(
                'select' => '*',
                'table' => TB_DETAIL,
            );

            $data['rfmList'] = $this->rfm_model->get_crud($array_crud);

            $array_crud = array(
                'select' => '*',
                'table' => TB_DETAIL,
            );

            $data['statusList'] = $this->rfm_model->get_crud($array_crud);

            $data['ITList'] = $this->db->where('divisi_id', 'IT')->get(TB_USER)->result();

			$array_crud = array(
                'select' => '*',
                'table' => TB_PROJECT
            );

            $Q = "SELECT DISTINCT ticket_support.task.project_id AS id, ticket_support.project.project_name AS project_name
            FROM ticket_support.task
            INNER JOIN ticket_support.project
            ON ticket_support.task.project_id=ticket_support.project.id
            WHERE ticket_support.task.assign_to=".$this->session->userdata('USER_ID').";
            ";

            $data['projectList'] = $this->rfm_model->get_crud($array_crud);
            $data['filteredProjectList'] = $this->db->query($Q)->result();

            $array_crud = array(
                'select' => '*',
                'table' => TB_TASK,
            );

            $data['DataTaskList'] = $this->rfm_model->get_crud($array_crud);

			if ($this->session->userdata('USER_JABATAN')==='HEAD IT' || $this->session->userdata('USER_JABATAN')==='SUPERVISOR IT' || $this->session->userdata('USER_JABATAN')==='DIREKSI') {
                $this->template->load('template','daily_report/table', $data);
            } else {
                $data['daily_activities'] = $this->getDailyActivity();
                $this->template->load('template','daily_report/daily', $data);
            }
        } else {
            $this->load->view('login/form_login');
            
        }
    }

    public function btn_create()
    {
        $id = $this->input->post('idx');
        $array_crud = array(
            'select' => '*',
            'table' => TB_DETAIL,
        );

        $data['rfmList'] = $this->rfm_model->get_crud($array_crud);

        $data['ITList'] = $this->db->where('divisi_id', 'IT')->get(TB_USER)->result();

        $array_crud = array(
            'select' => '*',
            'table' => TB_DETAIL,
        );

        $data['statusList'] = $this->rfm_model->get_crud($array_crud);
        
        $array_crud = array(
            'select' => '*',
            'table' => TB_PROJECT
        );

        $Q = "SELECT DISTINCT ticket_support.task.project_id AS id, ticket_support.project.project_name AS project_name
        FROM ticket_support.task
        INNER JOIN ticket_support.project
        ON ticket_support.task.project_id=ticket_support.project.id
        WHERE ticket_support.task.assign_to=".$this->session->userdata('USER_ID').";
        ";

        $data['projectList'] = $this->rfm_model->get_crud($array_crud);
        $data['filteredProjectList'] = $this->db->query($Q)->result();

        $array_crud = array(
            'select' => '*',
            'table' => TB_TASK,
            'where' => array(
                'assign_to' => $this->session->userdata('USER_ID'),
                'status !='    => STT_DONE,
            )
        );

        $data['taskList'] = $this->rfm_model->get_crud($array_crud);

        $array_crud = array(
            'select' => '*',
            'table' => TB_TASK,
        );

        $data['DataTaskList'] = $this->rfm_model->get_crud($array_crud);

        $this->load->view('daily_report/form_create', $data);
    }
    
	public function getDailyActivity()
    {
        
        $array_crud = array(
            'table' => TB_DAILY_ACTIVITY,
            'where' => array(
            'user_id' => $this->session->userdata('USER_ID')
            ),
            'order_by' => "last_update DESC"
        );
        return $this->rfm_model->get_crud($array_crud);
    }
	
	public function post_request_dr()
    {
        if(!$this->auth_model->logged_id())
        {
            $data = array('isValid' => 0, 'isPesan' => '<div class="alert alert-danger">Sesi telah berakhir, silahkan segarkan halaman ini terlebih dahulu. <a href="./">Segarkan</a></div>');
            echo json_encode($data);
            die();
        }
		
        $date_now = date('Y-m-d H:i:s');
        $user_id = $this->session->userdata('USER_ID');
        $project_id = null;
        $task_id = null;
        $rfm_id = null;
        $done_notes = null;
        $comment = null;
        $status = $this->input->post('status');
        $keterangan = $this->input->post('keterangan');
        
        if ($this->input->post('task_id') !== "") {
            $task_id = $this->input->post('task_id');
        }

        if ($this->input->post('rfm_id') !== "") {
            $rfm_id = $this->input->post('rfm_id');
        }

        if ($this->input->post('notes') !== "") {
            $done_notes = $this->input->post('notes');
    }

        if ($this->input->post('penyelesaian') !== "") {
            $comment = $this->input->post('penyelesaian');
        }

        if(empty($task_id) && empty($rfm_id) && empty($keterangan) ) {
            $isValid = 0;
            $isPesan = "<div class='alert alert-danger'>Pilih Jenis Task!!!</div>";
        } elseif(empty($status)) {
            $isValid = 0;
            $isPesan = "<div class='alert alert-danger'>Status Harus Diisi !!!</div>";
        } else {
            $array_crud = array(
                'table' => TB_DAILY_ACTIVITY,
                'where' => array(
                    'user_id' => $this->session->userdata('USER_ID'),
                    'date_activity' => $date_now,
                )
            );
            $sql = $this->rfm_model->get_crud($array_crud);

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

                $no_rfp = $this->db->where('id', $task_id)->get(TB_TASK)->row()->no_rfp;
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
                
                $array_update_rfm = array(
                    'result_status' => $status,
                    'done_notes'    => $done_notes,
                    'done_date'     => $date_now,
                    'request_status' => STT_CONFIRMED,
                );
    
                $this->db->where('id', $rfm_id);
                $update_rfm = $this->db->update(TB_DETAIL, $array_update_rfm);
            }

            $array_insert = array(
                'user_id'       => $user_id,
                'date_activity' => $date_now,
                'project_id'    => $project_id,
                'task_id'       => $task_id,
                'rfm_id'        => $rfm_id,
                'status'        => $status,
                'keterangan' 	=> $keterangan,
                'update_by'     => $user_id,
            );
        
            $insert_data = $this->db->insert(TB_DAILY_ACTIVITY, $array_insert);

            $array_update_rfm = array(
                'result_status' => $status,
                'onprogress_date' => $date_now,
            );

            $this->db->where('id', $rfm_id);
            $update_rfm = $this->db->update(TB_DETAIL, $array_update_rfm);

            if (!empty($comment) && $status == STT_DONE) {
                if (!empty($rfm_id)) {
                    // TODO: Check row in tb comment, if null then insert, if not null then update comment
                    $array_crud = array(
                        'table' => TB_COMMENT_RFM,
                        'where' => array(
                            'id' => $rfm_id,
                        )
                    );
                    
                    $check = $this->rfm_model->get_crud($array_crud)->num_rows();
    
                    if ($check != 0) {
                        $array_update_comment = array(
                            'date_comment' => $date_now,
                            'user'          => $user_id,
                            'comment'       => $comment
                        );

                        $this->db->where('id', $rfm_id);

                        $update_comment = $this->db->update( TB_COMMENT_RFM, $array_update_comment);

                    } else {
                        $array_insert_comment = array(
                            'id'            => $rfm_id,
                            'date_comment'  => $date_now,
                            'user'          => $user_id,
                            'comment'       => $comment
                        );

                        $insert_comment = $this->db->insert(TB_COMMENT_RFM, $array_insert_comment);
                    }

                }
            
            } else if(empty($comment) && $status == STT_DONE) {
                $isValid = 0;
                $isPesan = "<div class='alert alert-danger'>Case Penyelesaian Harus Diisi !!!</div>";
            }

            if(!$insert_data) {
                $isValid = 0;
                $isPesan = "<div class='alert alert-danger'>Gagal menambahkan daily activity</div>";
                        
                $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
                echo json_encode($data);
                die(); 
            }else {
                $isValid = 1;
                $isPesan = "<div class='alert alert-success'>Berhasil menambahkan daily activity</div>";
            }
        }
        $data = array('isValid' => $isValid, 'isPesan' => $isPesan);
        echo json_encode($data);
    }
}
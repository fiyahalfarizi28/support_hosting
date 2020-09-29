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
        $activity = $this->input->post('activity');
        $status = $this->input->post('status');
        
        if(empty($activity) ) {
            $isValid = 0;
            $isPesan = "<div class='alert alert-danger'>Aktivitas Harus Diisi !!!</div>";
        } elseif(empty($status)) {
            $isValid = 0;
            $isPesan = "<div class='alert alert-danger'>Status Aktivitas Harus Diisi !!!</div>";
        } else {
            $array_crud = array(
                'table' => TB_DAILY_ACTIVITY,
                'where' => array(
                    'user_id' => $this->session->userdata('USER_ID'),
                    'date_activity' => $date_now,
                )
            );
            $sql = $this->rfm_model->get_crud($array_crud);
            
            $array_insert = array(
                'user_id'       => $user_id,
                'date_activity' => $date_now,
                'status'        => $status,
                'keterangan' 	=> $activity,
                'update_by'     => $user_id,
            );
        
            $insert_data = $this->db->insert(TB_DAILY_ACTIVITY, $array_insert);

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
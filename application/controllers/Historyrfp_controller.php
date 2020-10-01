<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historyrfp_controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('historyrfp_model');
        $this->load->model('auth_model');
    }

	public function index()
	{
        if($this->auth_model->logged_id()) {
            $data['SESSION_USER_ID'] = $this->session->userdata('USER_ID');
            $this->template->load('template','history/tablerfp',$data);
        } else {
            $this->load->view('login/form_login');
        }
    }
    
    function get_tb_detail()
    {
        $SESSION_USER_ID = $this->session->userdata('USER_ID');
        $SESSION_USER_GROUP_MENU = $this->session->userdata('USER_GROUP_MENU');
        
        $array_crud = array(
            'table' => TB_PARAMETER,
            'where' => array('id' => 'RFM_AKSES_OP_APP_BDG')
        );
        $area_bandung = $this->historyrfp_model->get_crud($array_crud)->row();
        
        $array_crud = array(
            'table' => TB_PARAMETER,
            'where' => array('id' => 'RFM_AKSES_OP_APP_JABODETABEK')
        );
        $area_jabodetabek = $this->historyrfp_model->get_crud($array_crud)->row();
        
        $array_crud = array(
            'table' => TB_PARAMETER,
            'where' => array('id' => 'RFM_AKSES_IT_APP')
        );
        $area_it = $this->historyrfp_model->get_crud($array_crud)->row();
        
        $ex_id_bandung = explode(":", $area_bandung->value);
        $ex_id_jabodetabek = explode(":", $area_jabodetabek->value);
        $ex_id_it = explode(":", $area_it->value);

        $SESSION_UPLINE = $SESSION_USER_ID;

        if(in_array($SESSION_USER_ID, $ex_id_bandung))
        {
            $SESSION_UPLINE = $area_bandung->value;
        }

        if(in_array($SESSION_USER_ID, $ex_id_jabodetabek))
        {
            $SESSION_UPLINE = $area_jabodetabek->value;
        }

        if(in_array($SESSION_USER_ID, $ex_id_it))
        {
            $SESSION_UPLINE = $area_it->value;
        }
        
        $list = $this->historyrfp_model->get_datatables($SESSION_UPLINE);
        $data = array();
        $no = $_POST['start'];
        
        foreach ($list as $field) {

            // problem type
            $array_crud = array(
                'table' => TB_PROBLEM_TYPE,
                'where' => array('id' => $field->problem_type),
            );
            $row_problem_type = $this->historyrfp_model->get_crud($array_crud)->row()->problem_type;

            // request status
            $array_crud = array(
                'table' => TB_REQUEST_TYPE,
                'where' => array(
                    'id' => $field->request_type,
                ),
            );
            $row_request_type = $this->historyrfp_model->get_crud($array_crud)->row()->request_type;

            // nama pic
            if($field->assign_to === NULL) {
                $row_assign_to = '-';
            } else {
                $row_assign_to = $field->nama_assign_to;
            }

            // nama yg harus approve
            $array_crud = array(
                'table' => TB_PARAMETER,
                'where' => array('id' => 'RFM_AKSES_IT_APP'),
            );
            $team_it = $this->historyrfp_model->get_crud($array_crud)->row()->value;

            if($field->request_upline_by != NULL AND $field->request_status === STT_ON_QUEUE) {
                if($field->request_upline_by === $team_it)
                {
                    $app_by = 'IT';
                }
                else
                {
                    $app_by = $field->nama_request_upline_by;
                }
            }else {
                $app_by = 'IT';
            }

            //txt color
            if($field->request_status === STT_ON_QUEUE)
            {
                $txtApprove = "<b class='text-warning'>$field->request_status</b>";
            }
            elseif($field->request_status === STT_VALIDATED)
            {
                $txtApprove = "<b class='text-secondary'>$field->request_status</b>";
            }
            elseif($field->request_status === STT_APPROVED)
            {
                $txtApprove = "<b class='text-primary'>$field->request_status</b>";
            }
            elseif($field->request_status === STT_ASSIGNED)
            {
                $txtApprove = "<b class='text-dark'>$field->request_status</b>";
            }
            elseif($field->request_status === STT_CONFIRMED)
            {
                $txtApprove = "<b class='text-dark'>$field->request_status</b>";
            }
            elseif($field->request_status === STT_DONE)
            {
                $txtApprove = "<b class='text-success'>$field->request_status</b>";
            }
            elseif($field->request_status === STT_REJECT)
            {
                $txtApprove = "<b class='text-danger'>$field->request_status</b>";
            }
            else
            {
                $txtApprove = "$field->request_status";
            }

            //icon rating
            if($field->rates === '1')
            {
                $rates = "<i class='fa fa-star text-warning'></i>";
            }
            elseif($field->rates === '2')
            {
                $rates = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";
            }
            elseif($field->rates === '3')
            {
                $rates = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";
            }
            elseif($field->rates === '4')
            {
                $rates = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";
            }
            elseif($field->rates === '5')
            {
                $rates = "<i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i> <i class='fa fa-star text-warning'></i>";
            }
            else
            {
                $rates = "-";
            }

            if($field->approve_notes != NULL)
            {
                $notes_approve = $field->approve_notes;
            }
            else
            {
                $notes_approve = "-";
            }

            if($field->receive_notes != NULL)
            {
                $notes_receive = $field->receive_notes;
            }
            else
            {
                $notes_receive = "-";
            }

            if($field->done_notes != NULL)
            {
                $notes_done = $field->done_notes;
            }
            else
            {
                $notes_done = "-";
            }

            if($field->reject_notes != NULL OR $field->confirm_notes)
            {
                $notes_reject = $field->reject_notes;
                $confirm_notes = $field->confirm_notes;
            }
            else
            {
                $notes_reject = "-";
                $confirm_notes = "-";
            }

            if($field->project_id != NULL)
            {
                $array_crud = array(
                    'table' => TB_PROJECT,
                    'where' => array('id' => $field->project_id),
                );
                $row_project = $this->historyrfp_model->get_crud($array_crud)->row();
    
                $projectName = $row_project->project_name;
            } else {
                $projectName = "-";
            }

            $no++;
            $row = array();
            $row[] = $field->nama_request_by;
            $row[] = $app_by;
            $row[] = $field->no_rfp;
            $row[] = date('d-m-Y', strtotime($field->request_date));
            $row[] = $txtApprove;
            $row[] = $field->result_status;
            $row[] = $row_assign_to;
            $row[] = $row_problem_type;
            $row[] = $row_request_type;
            $row[] = $field->subject;
            $row[] = $field->rfp_detail;
            $row[] = $rates;
            $row[] = $notes_approve;
            $row[] = $notes_receive;
            $row[] = $notes_done;
            $row[] = $notes_reject;
            $row[] = $confirm_notes;
            $row[] = $field->id;
            $row[] = $field->jabatan_request_by;
            $row[] = $projectName;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->historyrfp_model->count_all(),
            "recordsFiltered" => $this->historyrfp_model->count_filtered($SESSION_UPLINE),
            "data" => $data,
        );
        
        echo json_encode($output);
    }
}
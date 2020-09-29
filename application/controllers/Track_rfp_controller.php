<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_rfp_controller extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('rfp_model');
        $this->load->model('auth_model');
    }

	public function index()
	{
        if($this->auth_model->logged_id()) {
            $data['SESSION_USER_ID'] = $this->session->userdata('USER_ID');
            $data['track_rfp'] = $this->getTrackRFP();

            $array_crud = array(
                'select' => '*',
                'table' => TB_RFP,
            );

            $data['rfpList'] = $this->rfp_model->get_crud($array_crud);
            
            $this->template->load('template','rfp/track_rfp',$data);
        } else {
            $this->load->view('login/form_login');
        }
    }
    
    public function getTrackRFP()
    {
        $array_crud = array(
            'table' => TB_RFP,
            'where' => array(
            'request_by' => $this->session->userdata('USER_ID'),
            'request_status !=' => STT_DONE,
            'result_status !=' => STT_REJECT,
            ),
        );
        return $this->rfp_model->get_crud($array_crud);
        
    }

    public function track_rfp()
    {
        $id = $this->input->post('idx');
        
        $data['no_rfp'] = $id;

        $this->db->where('no_rfp', $id);
        $dataRfp = $this->db->get(TB_RFP)->row();

        $data['r'] = $dataRfp;

        $this->load->view('modal/modal_track_rfp', $data);
    }

}
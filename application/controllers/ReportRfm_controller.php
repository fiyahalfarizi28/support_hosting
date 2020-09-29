<?php
class ReportRfm_controller extends ci_controller{
    
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
            
            // Validasi daftar rfm, bisa dimasukkan ke $array_crud
            $array_crud = array(
                'select' => '*',
                'table' => TB_DETAIL,
            );

            $data['rfmList'] = $this->rfm_model->get_crud($array_crud);

           
            $this->template->load('template','report/table', $data);
        } else {
            $this->load->view('login/form_login');
        }
    }
}
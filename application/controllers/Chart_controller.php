<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Chart_controller extends CI_Controller {

    function __construct() {

        parent::__construct();

        $this->load->model('auth_model');

        $this->load->model('rfm_model');

    }

	public function index()

	{

        if($this->auth_model->logged_id()) {

            $SESSION_USER_ID = $this->session->userdata('USER_ID');

            $data['SESSION_USER_ID'] = $SESSION_USER_ID;

            //===================================================

            $data['applicationList'] = $this->db->get(TB_PROJECT)->result();
            
            $data['problemTypeList'] = $this->db->get(TB_PROBLEM_TYPE)->result();

            $data['userList'] = $this->db->get(TB_USER)->result();

            $this->template->load('template','dashboard/chart',$data);

        }else {

            $this->load->view('login/form_login');

        }

    }

}
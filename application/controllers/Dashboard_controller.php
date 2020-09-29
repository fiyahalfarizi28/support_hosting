<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard_controller extends CI_Controller {

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



            $this->db->where('id', 'RFM_RFP_ID');

            $row_rfp = $this->db->get(TB_PARAMETER)->row()->value;

            $rfp_id = explode(":", $row_rfp);

            array_pop($rfp_id);

            $rfp_id = implode(",",$rfp_id);

    

            $this->db->select("COUNT(*) AS jml_rfm");

            $data['jumlah_rfm'] = $this->db->get(TB_DETAIL)->row()->jml_rfm;

    

            $this->db->select("COUNT(*) AS jml_queue");

            $this->db->where('request_status', STT_ON_QUEUE);

            $data['jumlah_queue'] = $this->db->get(TB_DETAIL)->row()->jml_queue;

    

            $this->db->select("COUNT(*) AS jml_approve");

            $this->db->where('request_status', STT_APPROVED);

            $data['jumlah_approve'] = $this->db->get(TB_DETAIL)->row()->jml_approve;

    

            $this->db->select("COUNT(*) AS jml_progress");

            $this->db->where('request_status', STT_ASSIGNED);

            $data['jumlah_progress'] = $this->db->get(TB_DETAIL)->row()->jml_progress;

    

            $this->db->select("COUNT(*) AS jml_done");

            $this->db->where('request_status', STT_DONE);

            $data['jumlah_done'] = $this->db->get(TB_DETAIL)->row()->jml_done;

    

            $this->db->select("COUNT(*) AS jml_reject");

            $this->db->where('request_status', STT_REJECT);

            $data['jumlah_reject'] = $this->db->get(TB_DETAIL)->row()->jml_reject;



            //=================================================

    

            $this->db->select("COUNT(*) AS jml_rfp");

            $data['jumlah_rfp'] = $this->db->get(TB_RFP)->row()->jml_rfp;

    

            $this->db->select("COUNT(*) AS jml_queue");

            $this->db->where('request_status', STT_ON_QUEUE);

            $data['jumlah_queue_rfp'] = $this->db->get(TB_RFP)->row()->jml_queue;

    

            $this->db->select("COUNT(*) AS jml_approve");

            $this->db->where('request_status', STT_APPROVED);

            $data['jumlah_approve_rfp'] = $this->db->get(TB_RFP)->row()->jml_approve;

    

            $this->db->select("COUNT(*) AS jml_progress");

            $this->db->where('request_status', STT_ASSIGNED);

            $data['jumlah_progress_rfp'] = $this->db->get(TB_RFP)->row()->jml_progress;

    

            $this->db->select("COUNT(*) AS jml_done");

            $this->db->where('request_status', STT_DONE);

            $data['jumlah_done_rfp'] = $this->db->get(TB_RFP)->row()->jml_done;

    

            $this->db->select("COUNT(*) AS jml_reject");

            $this->db->where('request_status', STT_REJECT);

            $data['jumlah_reject_rfp'] = $this->db->get(TB_RFP)->row()->jml_reject;



            //===================================================

                

            $this->template->load('template','dashboard/dashboard',$data);

        }else {

            $this->load->view('login/form_login');

        }

    }



}
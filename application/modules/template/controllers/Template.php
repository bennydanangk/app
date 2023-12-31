<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model("M_template"); //load model mahasiswa
    }


	public function index()
	{
	
		$data['conf'] = $this->M_template->config();
		$data['nama_user'] = 'Fulan';
		$data['nama_menu'] = 'Template';

	$this->load->view('back_end/a_header',$data);
	$this->load->view('back_end/b_navbar',$data);
	$this->load->view('back_end/c_sidebar',$data);
	$this->load->view('back_end/d_content',$data);
	$this->load->view('back_end/e_footer',$data);
	}

}

<?php
defined('BASEPATH') OR exit('No direct sript access allowed');

class Template{
	function __construct()
	{
		$this->ci = &get_instance();
	}

	function admin($template,$data,$modal='')
	{
		$data['master'] = 0;
		$data['master_peg'] = 0;

		$session = $this->ci->session->userdata('logged_in');
		$id_user = $session['user_id'];
		$data['session'] = $this->ci->session->userdata('logged_in');
		$data['user_sess'] =  $this->ci->db->where('emp_nik',$id_user)->get('user_login')->row();
		$layout['content'] = $this->ci->load->view($template, $data, TRUE);
		$layout['navbar'] = $this->ci->load->view('comp/Navbar', $data, TRUE);
		$layout['header'] = $this->ci->load->view('comp/Header', $data, TRUE);
		$layout['footer'] = $this->ci->load->view('comp/Footer', $data, TRUE);
		$layout['loader'] = $this->ci->load->view('comp/LoaderFreeze', $data, TRUE);
		if(!empty($modal)){
			$layout['modal'] = $this->ci->load->view($modal, $data, TRUE);
		}else{
			$layout['modal'] = '';
		}
		$this->ci->load->view('dashboard/main', $layout);
	}


}
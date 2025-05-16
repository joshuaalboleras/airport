<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {
	public function __construct() {
        parent::__construct();
   		$this->load->model(array('model'));
    } 

	public function index() {
		$this->load->view('dashboard');
	} 

	public function home() {
		$this->load->view('home');
	} 

	public function login_process(){
		$password = $this->input->post('password');
		$email_add = $this->input->post('email_add');

		$where = [
			'email_add' => $email_add,
			'password' => $password
		];

		$row = $this->model->getRow('accounts',$where);
		if($row != null){
			$this->session->set_flasdata('id',$row->id);
			$message = base64_encode("Welcome ".$row->fullname.'!');
		} else {
			$message = base64_encode("Email address or password is incorrect!");
		}
		redirect(base_url('users/home/?m='.$message));
	}

	public function registration(){
		$this->load->view('registration');
	}

	public function registration_process() {
		$password = $this->input->post('password');
		$retype = $this->input->post('retype');

		var_dump($this->input->post());exit;

		$data1 = $this->input->post();
		unset($data1['retype']);
		$data1['usertype'] = 'user';
		
		if($password == $retype){
			if($this->model->insertData('accounts',$data1)){
				$this->session->set_flashdata('message','Data successfully saved!');
				$this->session->set_flashdata('icon','success');
			} else {
				$this->session->set_flashdata('message',"There's an error in saving your account.");
				$this->session->set_flashdata('icon','error');
			}
			redirect(base_url('?m='.$message));
		} else {
			$this->session->set_flashdata('fullname',$this->input->post('fullname'));
			$this->session->set_flashdata('email_add',$this->input->post('email_add'));
			$this->session->set_flashdata('password',$this->input->post('password'));
			$this->session->set_flashdata('retype',$this->input->post('retype'));
			$this->session->set_flashdata('gender',$this->input->post('gender'));
			$this->session->set_flashdata('message',"Tanga ka kaajo!");
			$this->session->set_flashdata('icon','error');
			redirect(base_url('users/registration/'));
		}
		
		
	}

}

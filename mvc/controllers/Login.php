<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('user_m');
		$this->load->helper('action');
	}
	public function index(){
		if($this->session->userdata('access') == 1) {
			redirect(base_url('dashboard'));
		}
		$data = [];
		if($_POST){
			$this->form_validation->set_rules('username_post','User Name', 'trim|required|xss_clean|min_length[3]|callback_userRollPremission');
			$this->form_validation->set_rules('password','Password', 'trim|required|xss_clean|min_length[3]|callback_userRollPremission');
			if($this->form_validation->run()==FALSE){
				$this->load->view('login', $data);
			} else {
				redirect(base_url('dashboard'));
			}
		} else {
			$this->load->view('login', $data);
		}
	}

	// callback function for user login
	public function userRollPremission() {
		$username = $this->input->post('username_post');
		$password = $this->input->post('password');
		if($username && $password) {
			if($this->user_m->get_order_by_user($username,$password)) {
				$getRow = $this->user_m->get_order_by_user($username, $password);
				$setArray = ['loginID' => $getRow->id,'user_id' => $getRow->user_id, 'username' =>$getRow->user_name, 'access'=> $getRow->access_type, 'logged_in' => TRUE];
				$this->session->set_userdata($setArray);
				redirect(base_url('dashboard/index'));
				return TRUE;
			}
			$this->form_validation->set_message('userRollPremission', 'Incorrect username and password.');
			return FALSE;
		}
		$this->form_validation->set_message('userRollPremission','The %s is required.');
		return FALSE;
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login/index'));
		$this->session->flashdata('success','Logout Successful');
	}

	// ===========================================================================
	// =========================== forgotPassword ================================
	// ===========================================================================

	public function forgetPassword(){
		$this->load->view('forgotPassword');
	}


	public function forget_password(){
		$this->load->library('email');
		
		$data = [];
		if($_POST){
			$this->form_validation->set_rules('email_address','Email Address','trim|required|callback_rullsforforgetpassword');
			if($this->form_validation->run()==FALSE){
				$this->load->view('forgotPassword',$data);
			} else {
			
				 //send an email
				$email = $this->input->post('email_address');
				$send_to = getSite()->email_address;
				$send_by = getSite()->name;
				

				$getEmailAddress = ($this->user_m->get_order_by_email($email)->email_address);
				if($getEmailAddress) {
					$code = rand('9999999999999','99999999999999999999');
					$rand = $code;
					$data = array('forgot_password' =>$code);
					$update = $this->user_m->get_code_update($email,$data);
					//dump($data);
						
					if($update == TRUE) {
						$config = Array(
							'mailtype' =>'html',
						);
						$this->email->initialize($config);
						$link = base_url('login/reset_password/'.$code);
						//dump($rand);
						//dd($link);
						$message = "Click the following link to reset password : <br>".$link;
						
						$this->email->from(getSite()->email_address,getSite()->name);
						$this->email->to($email);
						$this->email->subject('Reset Password');
						$this->email->message($message);
						//$this->email->send();
						//dd($this->email);
						if($this->email->send()){
							$this->session->set_flashdata('success', 'Please Check Your E-mail Address ! ');
							redirect(base_url('login/index'));
						}else{
							$this->session->set_flashdata('errors', 'This Email address does not exist in our database !');
							redirect(base_url('login/forgetPassword'));
						}
					} else {
						redirect('forgotPassword');
					}
				}else{
					$this->load->view('forgotPassword',$data);
				}
			}
		}
	}


	// callback function for forget password
	public function rullsforforgetpassword(){
		$email_address = $this->input->post('email_address');
		
		if($email_address) {
			$getEmailRow = $this->user_m->get_order_by_email($email_address);
			
			if(count($getEmailRow)) {
				//dd($getEmailRow);
				return TRUE;
			}
			$this->form_validation->set_message('rullsforforgetpassword', 'The %s does not exist in our database !');
			return FALSE;
		}
		$this->form_validation->set_message('rullsforforgetpassword', 'The %s is required.');
		return FALSE;
	}

		// reset password redirect page
	public function reset_password() {
		$code = $this->uri->segment(3);
	
		$chack_code = $this->user_m->chack_all_forgot_code($code);
		if(count($chack_code)) {
			if(($chack_code->forgot_password) == $code){
				$data['code'] = $code;
				$this->load->view('new_Password', $data);// ai vie ta ber korw
			} else {
				$this->session->set_flashdata('errors', 'This url link is already used !');
				redirect(base_url('login/forgetPassword'));
			}
		} else {
			$this->session->set_flashdata('errors', 'This url link is already used !');
			redirect(base_url('login/forgetPassword'));
		}
		
	}
		// update user password
	public function new_password(){
		if ($this->input->post()) {
			$data['code'] = xss_clean($this->input->post('code'));
		}
		
		$username = md5($this->input->post('password1'));
		$password = md5($this->input->post('password2'));
		if($_POST){
			$this->form_validation->set_rules('password1','New Password','trim|required|md5');
			$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password1]|md5');
			if($this->form_validation->run()==FALSE){
				$this->load->view('new_Password', $data);
			}else {
				if($this->user_m->chack_password_code($this->input->post('code'))) {
				
					$attr = array('user_pass' => $username, 'forgot_password' => 0);
					
					$this->user_m->update_user_password($this->input->post('code'),$attr);
					$this->session->set_flashdata('success', 'You Have Successfully Changed Your Password !');
					redirect(base_url('login/index'));
				} else {
				dd('unsuccess');
					$this->session->set_flashdata('errors', 'This Email Address does not exist in our database !');
					redirect(base_url('forgotPassword'));
				}
			}
		}
	}


}

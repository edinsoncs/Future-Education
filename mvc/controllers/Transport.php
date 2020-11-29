<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport extends CI_Controller {
  	//constract_function
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0)
			redirect(base_url('login/index'));
		$this->load->model('transport_m');
	}
  	// defult load function
	public function index(){
		redirect ('dashboard/index');
	}
  	// profile methode function
	public function pages(){
		if($this->session->userdata('access') == 1 || $this->session->userdata('access') == 2 ){
			$data= [];
			$data['title'] = "Transport";
			$data['transport_page']='transport/view';
			$data['get_data'] = $this->transport_m->get_data();
			$this->load->view('dashboard_layout',$data);

		} elseif ($this->session->userdata('access') != 1 || $this->session->userdata('access') != 2) {
			$data= [];
			$data['title'] = "Transport";
			$data['transport_page']='transport/views';
			$data['get_data'] = $this->transport_m->get_data();
			$this->load->view('dashboard_layout',$data);
		}
		else {
			redirect ('dashboard/index');
		}
	}
	// protected rulls for add new
	protected function rulesForAddNew() {
		$config = array(
			array(
				'field'   => 'route_from',
				'label'   => 'Route From',
				'rules'   => 'required'
				),
			array(
				'field'   => 'route_to',
				'label'   => 'Route To',
				'rules'   => 'required'
				),
			array(
				'field'   => 'vehicle_no',
				'label'   => 'Vehicle Number',
				'rules'   => 'required'
				),
			array(
				'field'   => 'departure_time',
				'label'   => 'Departure Time',
				'rules'   => 'required'
				),
			array(
				'field'   => 'yearly_fare',
				'label'   => 'Yearly Fare',
				'rules'   => 'required'
				),
			array(
				'field'   => 'off_day',
				'label'   => 'Off Day',
				'rules'   => 'required'
				)
			);
		return $config;
	}
	// Add new 
	public function add_new(){
		if($_POST) {
			$this->form_validation->set_rules($this->rulesForAddNew());
			if($this->form_validation->run() == FALSE) {
				$data['validation_errors'] = $this->form_validation->verror_array();
				$data['title'] = "Transport";
				$data['transport_page']='transport/view';
				$data['get_data'] = $this->transport_m->get_data();
				$this->load->view('dashboard_layout',$data);
			} else {
				$array = array();
				$getrules = $this->rulesForAddNew();
				foreach ($getrules as $key => $value) {
					$array[$value['field']] = $this->input->post($value['field']);
				}

				$this->transport_m->create_new($array);
				$this->session->set_flashdata('success', 'Create Successfully.');
				redirect(base_url('transport/pages'));
			}
		}
		else {
			redirect(base_url('transport/pages'));
		}	
	}
	// rective data for notice update 
	public function retrive_data_for_update($id=null){
		if($this->input->post('getID')) {
			$get_data = $this->transport_m->get_single_notice($this->input->post('getID'));
			if(count($get_data)) {
				$json = array("confirmation" => 'success','id' => $get_data->id,'route_from' => $get_data->route_from, 'route_to' => $get_data->route_to, 'vehicle_no' => $get_data->vehicle_no, 'departure_time' => $get_data->departure_time, 'yearly_fare' => $get_data->yearly_fare, 'off_day' => $get_data->off_day);
				header("Content-Type: application/json", true);
				echo json_encode($json);
				exit;
			} else {
				$json = array("confirmation" => 'error');
				header("Content-Type: application/json", true);
				echo json_encode($json);
			}
		}
	}
	// data update
	public function data_update(){   
		if($_POST){
			$this->form_validation->set_rules($this->rulesForAddNew());
			if($this->form_validation->run() == FALSE) {
				$data['validation_errors'] = $this->form_validation->verror_array();
				$data['title'] = "Transport";
				$data['transport_page']='transport/view';
				$data['get_data'] = $this->transport_m->get_data();
				$this->load->view('dashboard_layout',$data);
			} else {
				$array = array();
				$getrules = $this->rulesForAddNew();
				foreach ($getrules as $key => $value) {
					$array[$value['field']] = $this->input->post($value['field']);
				}
				$id = $this->input->post('id');
				if ($this->transport_m->update_data($id,$array)) {
					$this->session->set_flashdata('success', ' Update Successfully');
				} else {
					$this->session->set_flashdata('errors', 'Please Fillup Correct Information !');
				}
			}
		}
		else {
			echo 'Error';
		}
	}
	// delete data
	public function delete_data($id = null){
		if($this->session->userdata('access') == 1){
			if($this->transport_m->delete_data($id)){
				$this->session->set_flashdata('success', 'Successfully Deleted');
				redirect(base_url('transport/pages'));
			} else {
				redirect(base_url('dashboard/index'));
			} 
		} else {
			redirect(base_url('login/index'));
		}
	}
}
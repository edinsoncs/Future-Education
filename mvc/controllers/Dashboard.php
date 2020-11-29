<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('access') == 0)
			redirect(base_url('login/index'));
		$this->load->model('user_m');
		$this->load->model('dashboard_m');
		$this->load->model('gread_point_m');
	}

	public function index(){

		if ($this->session->userdata('access') == 4) {

			$get_dept_full_name = $this->dashboard_m->get_basic_info($this->session->userdata('user_id'));
			$get_semester_code_for_credit = $this->dashboard_m->get_semester_code($this->session->userdata('user_id'));

			$get_earn_credit = $this->dashboard_m->get_earn_credit($action ="1", $this->session->userdata('user_id'), $null = 0);
			$get_all_gpa = $this->dashboard_m->get_gpa_point($action ="1", $this->session->userdata('user_id'), $null = 0);
			$get_all_gpa = $get_all_gpa[0]->gpa_point == NULL ? 0 : $get_all_gpa[0]->gpa_point;
			$get_earn_credit = $get_earn_credit[0]->sub_credit == NUll ? 0 : $get_earn_credit[0]->sub_credit;
			$CGPA = 0;
			if($get_all_gpa != 0 && $get_earn_credit != 0) {
				$total_CGPA = (floatval($get_all_gpa) / floatval($get_earn_credit));
				$CGPA = number_format($total_CGPA, 3);
			} else {
				$total_CGPA = 0;
				$CGPA = number_format($total_CGPA, 3);
			}

			$get_last_semester_credit = 0;
			if(count($get_semester_code_for_credit)) {
				$get_last_semester_credit = $this->dashboard_m->get_last_semester_credit($get_semester_code_for_credit->semester_code, $this->session->userdata('user_id'));
			}
			$data=[];
			$data['std_dashboard']= 'dashboard/std_dashboard';
			$data['title'] = "Dashboard";
			$data['required_credit'] = $this->dashboard_m->required_credit($this->session->userdata('user_id'));
			$data['get_waiver'] = $this->dashboard_m->get_waiver($this->session->userdata('user_id'));
			$data['get_earn_credit'] = $get_earn_credit;
			$data['get_cgpa_point'] = $CGPA;
				// basic info && current status
			$data['get_basic_info'] = $this->dashboard_m->get_basic_info($this->session->userdata('user_id'));
			$data['get_degree_objective'] = $this->dashboard_m->get_dept_full_name($get_dept_full_name->std_dept);
			$data['get_running_semester_code'] = $this->dashboard_m->get_semester_code($this->session->userdata('user_id'));
			$data['get_last_semester_credit'] = $get_last_semester_credit;
			$data['get_grade_point_table'] = $this->gread_point_m->get_gread_point();
			$this->load->view('dashboard_layout',$data);
		}
		elseif ($this->session->userdata('access') == 3) {
			$data=[];
			$data['title'] = "Dashboard";
			$data['get_teachers_basic_info'] = $this->dashboard_m->get_teachers_basic_info($this->session->userdata('user_id'));
			$data['std_dashboard']= 'dashboard/tech_dashboard';
			$this->load->view('dashboard_layout',$data);
		}
		elseif ($this->session->userdata('access') == 2 || $this->session->userdata('access') == 5) {
			$data=[];
			$data['authority_dashboard']= 'dashboard/authority_dashboard';
			$data['title'] = "Dashboard";
			$data['get_info'] = $this->dashboard_m->get_authority_info($this->session->userdata('user_id'));
			$data['total_teacher'] 	 = $this->dashboard_m->total_teacher($accessType = 3);
			$data['total_student']	 = $this->dashboard_m->total_student($accessType = 4, $complete = 0);
			$data['total_graduation']	 = $this->dashboard_m->total_graduation($accessType = 4, $complete = 1);
			$data['get_grade_point_table'] = $this->gread_point_m->get_gread_point();
			$this->load->view('dashboard_layout',$data);
		}
		// admin dashboard
		else {
			$data=[];
			$data['admin_dashboard']= 'dashboard/admin_dashboard';
			$data['title'] = "Dashboard";
			$data['datarows'] = $this->gread_point_m->get_gread_point();
			$data['total_authority'] = $this->dashboard_m->total_authority($accessType = 2);
			$data['total_teacher'] 	 = $this->dashboard_m->total_teacher($accessType = 3);
			$data['total_student']	 = $this->dashboard_m->total_student($accessType = 4, $complete = 0);
			$data['total_graduation']	 = $this->dashboard_m->total_graduation($accessType = 4, $complete = 1);
			$this->load->view('dashboard_layout',$data);
		}
	}
}

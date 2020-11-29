<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	University Result Management System
| -----------------------------------------------------
| AUTHOR:			Morning Sun IT 
| -----------------------------------------------------
| EMAIL:			info@morningsunit.com
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY Morning Sun IT
| -----------------------------------------------------
| WEBSITE:			http://morningsunit.com
| -----------------------------------------------------
*/
function __construct() {
	parent::__construct();
	$this->load->library('form_validation');
	$this->load->helper('url');
	$this->load->helper('html');
	$this->load->helper('form');
	$this->load->helper('file');
	if ($this->config->item('installed') != 'no') {
		show_404();

	}

}

protected function rules_database() {
	$rules = array(
		array(
			'field' => 'host',
			'label' => 'Hostname',
			'rules' => 'trim|required|max_length[255]'
			),
		array(
			'field' => 'database',
			'label' => 'database Name',
			'rules' => 'trim|required|max_length[255]|callback_database_unique'
			),
		array(
			'field' => 'user',
			'label' => 'username',
			'rules' => 'trim|required|max_length[255]'
			),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'trim|max_length[255]'
			)
		);
	return $rules;
}


protected function rules_site() {
	$rules = array(
		array(
			'field' => 'site_name',
			'label' => 'Site Name',
			'rules' => 'trim|required|max_length[40]'
			),
		array(
			'field' => 'tag_line',
			'label' => 'Tag Line',
			'rules' => 'trim|required|max_length[80]'
			),
		array(
			'field' => 'grading_scale',
			'label' => 'Grading Scale',
			'rules' => 'trim|required|max_length[4]|numeric'
			),
		array(
			'field' => 'contact_no',
			'label' => 'Contact No',
			'rules' => 'trim|required|max_length[16]'
			),
		array(
			'field' => 'email_address',
			'label' => 'Email',
			'rules' => 'trim|required|max_length[100]|valid_email'
			),
		array(
			'field' => 'location_address',
			'label' => 'Location',
			'rules' => 'trim|required|max_length[250]'
			),
		array(
			'field' => 'display_id',
			'label' => 'Display Id',
			'rules' => 'trim|required|max_length[15]|numeric'
			),
		array(
			'field' => 'user_name',
			'label' => 'User Name',
			'rules' => 'trim|required|max_length[120]'
			),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|max_length[50]'
			),
		array(
			'field' => 'confirm_password',
			'label' => 'Confirm Password',
			'rules' => 'trim|required|max_length[50]|matches[password]'
			),
		);
return $rules;
}

function index() {
	$data = array();
	$data['errors'] = array();
	$data['success'] = array();


	if (phpversion() < "5.3") {
		$data['errors'][] = 'You are running PHP old version!';
	} else {
		$phpversion = phpversion();
		$data['success'][] = ' You are running PHP '.$phpversion;
	}
		// Check Mcrypt PHP exention
	if(!extension_loaded('mcrypt')) {
		$data['errors'][] = 'Mcriypt PHP exention unloaded!';
	} else {
		$data['success'][] = 'Mcriypt PHP exention loaded!';
	}
		// Check Mysql PHP exention
	if(!extension_loaded('mysql')) {
		$data['errors'][] = 'Mysql PHP exention unloaded!';
	} else {
		$data['success'][] = 'Mysql PHP exention loaded!';
	}
		// Check Mysql PHP exention
	if(!extension_loaded('mysqli')) {
		$data['errors'][] = 'Mysqli PHP exention unloaded!';
	} else {
		$data['success'][] = 'Mysqli PHP exention loaded!';
	}
		// Check MBString PHP exention
	if(!extension_loaded('mbstring')) {
		$data['errors'][] = 'MBString PHP exention unloaded!';
	} else {
		$data['success'][] = 'MBString PHP exention loaded!';
	}
		// Check GD PHP exention
	if(!extension_loaded('gd')) {
		$data['errors'][] = 'GD PHP exention unloaded!';
	} else {
		$data['success'][] = 'GD PHP exention loaded!';
	}
		// Check CURL PHP exention
	if(!extension_loaded('curl')) {
		$data['errors'][] = 'CURL PHP exention unloaded!';
	} else {
		$data['success'][] = 'CURL PHP exention loaded!';
	}
		// Check Config Path
	if (@include($this->config->config_path)) {
		@chmod($this->config->config_path, FILE_WRITE_MODE);
		if(is_really_writable($this->config->config_path) == TRUE) {
			$data['success'][] = 'Config file is writable';
		} else {
			$data['errors'][] = 'Config file is unwritable!';
		}
	} else {
		$data['errors'][] = 'Config file is unloaded';
	}

	if (@include($this->config->autoload_path)) {
		@chmod($this->config->autoload_path, FILE_WRITE_MODE);
		if(is_really_writable($this->config->autoload_path) == TRUE) {
			$data['success'][] = 'Autoload file is writable';
		} else {
			$data['errors'][] = 'Autoload file is unwritable!';
		}
	} else {
		$data['errors'][] = 'Autoload file is unloaded';
	}

		// Check Database Path
	if (@include($this->config->database_path)) {
		@chmod($this->config->database_path, FILE_WRITE_MODE);
		if (is_really_writable($this->config->database_path) === FALSE) {
			$data['errors'][] = 'database file is unwritable!';
		} else {
			$data['success'][] = 'Database file is writable';
		}

	} else {
		$data['errors'][] = 'Database file is unloaded';
	}

	$data['checkout'] = 1;
	$data['purchasekey'] = 0;
	$data['database'] = 0;
	$data['site'] = 0;
	$data['done'] = 0;
	if (count($data['errors']) == 0) {
		$data["subview"] = "install/index";
		$this->load->view('_layout_install', $data);
	} else {
		$data["subview"] = "install/index";
		$this->load->view('_layout_install', $data);
	}
}

protected function rulesForPurchacekey(){
	$rules = array(
		array(
			'field' => 'purchasekey',
			'label' => 'Purchase Key',
			'rules' => 'trim|required|max_length[36]|callback_chk_puechacekey'
			)
		);
	return $rules;
}
	// callback function foe puechace key
public function chk_puechacekey(){
	$getKey = $this->input->post('purchasekey');
	if($getKey){
		if($this->verify_envato_purchase_code($getKey) == TRUE){
			$file = APPPATH.'config/purchase'.EXT;
			@chmod($file, FILE_WRITE_MODE);
			$purchase_file = file_get_contents($file);
			write_file($file, $getKey);
			return TRUE;
		}else {
			$this->form_validation->set_message('chk_puechacekey','The purchase key is invilid.');
			return FALSE;
		}
	} else {
		$this->form_validation->set_message('chk_puechacekey','The %s field is required.');
		return FALSE;
	}
}


	function purchasekey(){
		$data['checkout'] = 1;
		$data['purchasekey'] = 1;
		$data['database'] = 0;
		$data['site'] = 0;
		$data['done'] = 0;
		if($_POST) {
			$rules = $this->rulesForPurchacekey();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$data["subview"] = "install/purchasekey";
				$this->load->view('_layout_install', $data);
			} else {
				redirect(base_url("install/database"));
			}
		} else {
			$data["subview"] = "install/purchasekey";
			$this->load->view('_layout_install', $data);
		}
	}

	function database(){
		if($this->get_purchase_code()) {
			$data['checkout'] = 1;
			$data['purchasekey'] = 1;
			$data['database'] = 1;
			$data['site'] = 0;
			$data['done'] = 0;
			if($_POST) {
				$rules = $this->rules_database();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$data["subview"] = "install/database";
					$this->load->view('_layout_install', $data);
				} else {
					$host = $this->input->post('host');
					$user = $this->input->post('user');
					$password = $this->input->post('password');
					$database = $this->input->post('database');

					redirect(base_url("install/site"));
				}
			} else {
				$data["subview"] = "install/database";
				$this->load->view('_layout_install', $data);
			}
		} else {
			redirect(base_url("install/purchasekey"));
		}
	}


	private function do_upload(){
	  $type = explode('.', $_FILES["logo_pic"]["name"]);
	  $type = strtolower($type[count($type)-1]);
	  $url = "./images/".uniqid(rand()).'.'.$type;
	  if(in_array($type, array("jpg", "jpeg", "gif", "png")))
	   if(is_uploaded_file($_FILES["logo_pic"]["tmp_name"]))
	    if(move_uploaded_file($_FILES["logo_pic"]["tmp_name"],$url))
	     return $url;
	   return "";
	 }

	function site(){
		if($this->get_purchase_code()) {

			$data['checkout'] = 1;
			$data['purchasekey'] = 1;
			$data['database'] = 1;
			$data['site'] = 1;
			$data['done'] = 0;
			if($_POST) {
				$this->load->database();
				$this->load->library('session');
				unset($this->db);
				$rules = $this->rules_site();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$data["subview"] = "install/site";
					$this->load->view('_layout_install', $data);
				} else {
					$this->load->helper('form');
					$this->load->helper('url');
					$this->load->model('install_m');
					$this->load->model('user_m');
					$this->load->model('authority_m');
					$sitelogo = $this->do_upload();
					$array = array(
						'name' => $this->input->post("site_name"),
						'tag_line' => $this->input->post("tag_line"),
						'grade_scale' => $this->input->post("grading_scale"),
						'contact_no' => $this->input->post("contact_no"),
						'email_address' => $this->input->post("email_address"),
						'address' => $this->input->post("location_address"),
						'site_logo' => $sitelogo
						);
					$array_admin = array(
						'user_id' 		 => $this->input->post("display_id"),
						'user_full_name' => $this->input->post("site_name"),
						'email_address'  => $this->input->post("email_address"),
						'contact_no' 	 => $this->input->post("contact_no"),
						'user_name' 	 => $this->input->post("user_name"),
						'user_pass' 	 => $this->install_m->hash($this->input->post("password")),
						'access_type' => 1
						);
					
					$select = $this->install_m->select_setting();
					if(count($select)) {
						$update = $this->install_m->update_setting($array, 1);
						$update_admin = $this->authority_m->authority_update_info($array_admin, 1);
						if($update == TRUE && $update_admin) {
							$this->load->library('session');
							$sesdata= array(
								'username'  => $this->input->post('user_name'),
								'password'  => $this->input->post('password'),
								);

							$this->session->set_userdata($sesdata);
							redirect(base_url("install/done"));
						}
					} else {
						$insert = $this->install_m->insert_setting($array);
						$insert_admin = $this->authority_m->authority_user_data($array_admin);
						if($insert == TRUE && $insert_admin == TRUE) {
							$this->load->library('session');
							$sesdata= array(
								'username'  => $this->input->post('user_name'),
								'password'  => $this->input->post('password'),
								);

							$this->session->set_userdata($sesdata);
							redirect(base_url("install/done"));
						}
					}
				}
			} else {
				$data["subview"] = "install/site";
				$this->load->view('_layout_install', $data);
			}
		} else {
			redirect(base_url("install/purchasekey"));
		}
	}

	function done(){
		if($this->get_purchase_code()) {
			$data['checkout'] = 1;
			$data['purchasekey'] = 1;
			$data['database'] = 1;
			$data['site'] = 1;
			$data['done'] = 1;
			$this->load->library('session');
			if($_POST) {
				$this->config->config_update(array("installed" => 'Yes'));
				$this->config->autolod_update(array("libraries" => "array('database','email', 'session','form_validation','upload')"));
				@chmod($this->config->database_path, FILE_READ_MODE);
				@chmod($this->config->config_path, FILE_READ_MODE);
				$this->session->sess_destroy();
				redirect(base_url('login/index'));
			} else {
				$data["subview"] = "install/done";
				$this->load->view('_layout_install', $data);
			}

		}else {
			redirect(base_url("install/purchasekey"));
		}
	}

	function database_unique() {
		error_reporting(0);
		$host = $this->input->post('host');
		$user = $this->input->post('user');
		$password = $this->input->post('password');
		$database = $this->input->post('database');
		
		$config_con['hostname'] = $host;
		$config_con['username'] = $user;
		$config_con['password'] = $password;
		$config_con['database'] = $database;
		$config_con['dbdriver'] = 'mysqli';

		$config_db['default']['hostname'] = $host;
		$config_db['default']['username'] = $user;
		$config_db['default']['password'] = $password;
		$config_db['default']['database'] = $database;
		$config_db['default']['dbdriver'] = 'mysqli';
		
		$this->config->db_config_update($config_db);
		$db_obj = $this->load->database($config_con,TRUE);
		$connected = $db_obj->initialize();
		
		if($connected == FALSE) {
			unset($this->db);
			$config_con['db_debug'] = FALSE;
			$this->form_validation->set_message('database_unique','Database Connection Failed.');
			return FALSE;
		} else {
			unset($this->db);
			$config_con['db_debug'] = FALSE;
			
			$this->load->database($config_con);
			$this->load->dbutil();
			if ($this->dbutil->database_exists($this->db->database)) {
				if ($this->db->table_exists('msit_tb_settings') == FALSE) {
					$id = uniqid();
					$encryption_key = md5("Rohit".$id);
					$this->config->config_update(array('encryption_key'=> $encryption_key));
					$this->load->model('install_m');
					$this->install_m->use_sql_string();
					return TRUE;
				}
				return TRUE;
			} else {
				$this->form_validation->set_message("database_unique", "Database Not Found.");
				return FALSE;
			}
			
		}
	}
	
	function index_validation() {
		$timezone = $this->input->post('timezone');
		@chmod($this->config->index_path, 0777);
		if (is_really_writable($this->config->index_path) === FALSE) {
			$this->form_validation->set_message("index_validation", "Index file is unwritable");
			return FALSE;
		} else {
			$file = $this->config->index_path;
			$current = file_get_contents($file);
			$current = "<?php \ndate_default_timezone_set('". $timezone ."');\n?>\n".$current;
			if(file_put_contents($file, $current)) {
				@chmod($this->config->index_path, 0644);
				return TRUE;
			}
		}
	}

	function verify_envato_purchase_code($code_to_verify) {
		$this->load->library('EnvatoPurchaseCodeVerifier');
		$access_token = 'sK1cQ4zMpdHAYWAUu0bR9LIpwzyLdv6r';
		$purchase = new EnvatoPurchaseCodeVerifier($access_token);
		// $buyer_purchase_code = filter_input(INPUT_POST, 'purchasekey', FILTER_DEFAULT);
		$buyer_purchase_code = $code_to_verify;
		if (!empty($buyer_purchase_code)){
			$verified = $purchase->verified($buyer_purchase_code);
			if ($verified == true){
				return TRUE;
			}else {
				$this->form_validation->set_message('chk_puechacekey','The purchase key is invilid.');
				return FALSE;
			}
		}else {
			$this->form_validation->set_message('chk_puechacekey','The purchase key is invilid.');
			return FALSE;
		}
	}

	function get_purchase_code(){
		$file = APPPATH.'config/purchase'.EXT;
		@chmod($file, FILE_WRITE_MODE);
		$purchase = file_get_contents($file);
		return $this->verify_envato_purchase_code($purchase);
	}
}

	/* End of file install.php */
	/* Location: ./application/controllers/install.php */

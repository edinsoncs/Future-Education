<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Nab Config Class
 *
 * @package		Nab
 * @subpackage	Core Library
 * @category	Config
 * @author		Misael Zapata
 * @link		http://misaelzapata.com
 */

class MY_Config extends CI_Config {

	var $config_path 		= ''; // Set in the constructor below
	var $database_path		= ''; // Set in the constructor below
	var $index_path			= ''; // Set in the constructor below
	var $autoload_path		= ''; // Set in the constructor below

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();
		$this->database_path	= APPPATH.'config/database'.EXT;
		$this->config_path		= APPPATH.'config/config'.EXT;
		$this->autoload_path = APPPATH.'config/autoload'.EXT;
		$tem_index = getcwd();
		$this->index_path = $tem_index."/index.php";
	}

	function config_update($config_array = array())
	{
		if ( ! is_array($config_array) && count($config_array) == 0)
		{
			return FALSE;
		}

		@chmod($this->config_path, FILE_WRITE_MODE);

		// Is the config file writable?
		if ( ! is_really_writable($this->config_path))
		{
			show_error($this->config_path.' does not appear to have the proper file permissions.  Please make the file writeable.');
		}

		// Read the config file as PHP
		require $this->config_path;

		// load the file helper
		$this->CI =& get_instance();
		$this->CI->load->helper('file');

		// Read the config data as a string
		$config_file = read_file($this->config_path);

		// Trim it
		$config_file = trim($config_file);


		// Do we need to add totally new items to the config file?
		if (is_array($config_array))
		{
			
			foreach ($config_array as $key => $val)
			{
		 		$pattern = '/\$config\[\\\''.$key.'\\\'\]\s+=\s+[^\;]+/';
		    	$replace = "\$config['$key'] = '$val'";              
	        	$config_file = preg_replace($pattern, $replace, $config_file);
			}
		}

		if ( ! $fp = fopen($this->config_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
		{
			return FALSE;
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $config_file, strlen($config_file));
		flock($fp, LOCK_UN);
		fclose($fp);

		@chmod($this->config_path, FILE_READ_MODE);

		return TRUE;
	}


	function autolod_update($autolod_array = array()) {
		if ( ! is_array($autolod_array) && count($autolod_array) == 0)
		{
			return FALSE;
		}

		@chmod($this->autoload_path, FILE_WRITE_MODE);

		// Is the config file writable?
		if ( ! is_really_writable($this->autoload_path))
		{
			show_error($this->autoload_path.' does not appear to have the proper file permissions.  Please make the file writeable.');
		}

		// Read the config file as PHP
		require $this->autoload_path;

		// load the file helper
		$this->CI =& get_instance();
		$this->CI->load->helper('file');


		$autoload_file = read_file($this->autoload_path);

		// Trim it
		$autoload_file = trim($autoload_file);


		// Do we need to add totally new items to the config file?
		if (is_array($autolod_array))
		{
			
			foreach ($autolod_array as $key => $val)
			{
		 		$pattern = '/\$autoload\[\\\''.$key.'\\\'\]\s+=\s+[^\;]+/';
		    	$replace = "\$autoload['$key'] = $val";            
	        	$autoload_file = preg_replace($pattern, $replace, $autoload_file);
			}
		}

		if ( ! $fp = fopen($this->autoload_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
		{
			return FALSE;
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $autoload_file, strlen($autoload_file));
		flock($fp, LOCK_UN);
		fclose($fp);

		@chmod($this->autoload_path, FILE_READ_MODE);

		return TRUE;
	}

	// function db_config_update($dbconfig = array(), $remove_values = array())
	function db_config_update($dbconfig)
	{
		// return $dbconfig;
		@chmod($this->database_path, FILE_WRITE_MODE);

		// Is the database file writable?
		if ( ! is_really_writable($this->database_path))
		{
			show_error($this->database_path.' does not appear to have the proper file permissions.  Please make the file writeable.');
		}

		// // load the file helper
		$this->CI =& get_instance();
		$this->CI->load->helper('file');
		// Read the config file as PHP
		require $this->database_path;
		// Now we read the file data as a string
		$config_file = read_file($this->database_path);

		if (count($dbconfig) > 0)
		{

			foreach ($dbconfig['default'] as $key => $val)
			{
			 	$pattern = '/\$db\[\\\''.$active_group.'\\\'\]\[\\\''.$key.'\\\'\]\s+=\s+[^\;]+/';
			    $replace = "\$db['$active_group']['$key'] = '$val'";           
		        $config_file = preg_replace($pattern, $replace, $config_file);
			}
		}

		$config_file = trim($config_file);

		// Write the file
		if ( ! $fp = fopen($this->database_path, FOPEN_WRITE_CREATE_DESTRUCTIVE))
		{	
			return FALSE;
		}

		flock($fp, LOCK_EX);
		fwrite($fp, $config_file, strlen($config_file));
		flock($fp, LOCK_UN);
		fclose($fp);
		@chmod($this->database_path, FILE_READ_MODE);

		return TRUE;
	}

	function config_status()
	{

		$data['install_warnings'] = array();

		// is PHP version ok?
		if (!is_php('5.1.6'))
		{
			$data['install_warnings'][] = 'php version is too old';
		}

		// is config file writable?
		if (is_really_writable($this->config_path) && ! @chmod($this->config_path, FILE_WRITE_MODE))
		{
			$data['install_warnings'][] = 'config.php file is not writable';
		}

		// Is there a database.php file?
		if (@include($this->database_path))
		{
			if ($this->test_mysql_connection($db[$active_group]))
			{
				$this->session->set_userdata('user_database_file', TRUE);
			}
			else
			{
				// Ensure the session isn't remembered from a previous test
				$this->session->set_userdata('user_database_file', FALSE);

				@chmod($this->config->database_path, FILE_WRITE_MODE);

				if (is_really_writable($this->config->database_path) === FALSE)
				{
					$vars['install_warnings'][] = 'database file is not writable';
				}
			}
		}
		else
		{
			$data['install_warnings'][] = 'database config file was not found';
		}

		return $data;
	}
}


/* End of file MY_Config.php */
/* Location: application/core/MY_Config.php */

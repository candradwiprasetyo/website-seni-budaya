<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
		var $template_data = array();
		
		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
	
		function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			return $this->CI->load->view($template, $this->template_data, $return);
		}

		function get_all_new_comments() {
	        $ci =& get_instance();
	        $sql = "SELECT count(tbl_comments.ID) as result FROM `tbl_comments` WHERE `ANSWERED`='0' and COMMENT_TYPE='1'";    
	        $query = $ci->db->query($sql);       
	        $result = null;
	        foreach ($query->result_array() as $row) $result = ($row);
	        $result = $result['result'];
	        //$ci->output->enable_profiler(TRUE);
	        return $result;
	    }
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */
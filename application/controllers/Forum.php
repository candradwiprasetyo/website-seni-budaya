<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Home_model');
	}
 	
	public function index() {
		$list_forum =  $this->Home_model->list_forum();
 		$this->load->view('layout/header');
		$this->load->view('forum', array('list_forum' => $list_forum));
		$this->load->view('layout/footer'); 
		
 	}

}
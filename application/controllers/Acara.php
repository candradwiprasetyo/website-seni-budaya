<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acara extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Home_model');
	}
 	
	public function index() {
		$list_event =  $this->Home_model->list_event();
 		$this->load->view('layout/header');
		$this->load->view('acara', array('list_event' => $list_event));
		$this->load->view('layout/footer'); 
		
 	}

}
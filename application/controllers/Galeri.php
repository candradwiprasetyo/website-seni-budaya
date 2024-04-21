<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galeri extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Home_model');
	}
 	
	public function index() {
		$list_artwork =  $this->Home_model->list_artwork();
 		$this->load->view('layout/header');
		$this->load->view('galeri', array('list_artwork' => $list_artwork));
		$this->load->view('layout/footer'); 
		
 	}

}
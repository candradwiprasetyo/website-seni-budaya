<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kontak extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}
 	
	public function index() {
		
 		$this->load->view('layout/header');
		$this->load->view('kontak');
		$this->load->view('layout/footer'); 
		
 	}

}
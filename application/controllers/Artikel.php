<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artikel extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('Home_model');
	}
 	
	public function index() {
		$list_article =  $this->Home_model->list_article();
 		$this->load->view('layout/header');
		$this->load->view('artikel', array('list_article' => $list_article));
		$this->load->view('layout/footer'); 
		
 	}

}
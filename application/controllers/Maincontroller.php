<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maincontroller extends CI_Controller {

	 function __construct() {
		parent::__construct();

		$this->load->model('main_model');
	}
	 
	
	public function index(){
		$this->load->view('adminsidearea/layouts/header');
        $this->load->view('adminsidearea/mainpage/mainpage');
        $this->load->view('adminsidearea/layouts/footer');
	}
	
	
}

<?php

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct(); //constructor of CL_Model

		$this->load->model('Home_model');
	}

	public function index()
	{ 
		$this->load->view('home_view');
	}
}
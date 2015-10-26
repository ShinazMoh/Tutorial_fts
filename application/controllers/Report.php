<?php

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct(); //constructor of CL_Model

		$this->load->model('report_model');
	}

	public function index()
	{ 
//		$this->load->view('reportView');
		$this->load->view('customerReportView');
	}

	// public function search_age()
	// {
	// 	echo json_encode($this->report_model->search_age());	
	// }

	public function fetch_customers()
	{
		echo json_encode($this->report_model->fetch_customers());
	}

	public function search_address()
	{
		echo json_encode($this->report_model->search_address());	
	}

	public function fetch_name()
	{
		echo json_encode($this->report_model->fetch_name());
	}

}
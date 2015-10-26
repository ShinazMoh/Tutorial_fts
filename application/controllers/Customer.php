<?php

class Customer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('customer_model');
	}

	public function index($error_flag='false')
	{
		$this->load->view('customer_view',array('error_flag' =>$error_flag));
	}

	public function save()
	{
		$data = $this->customer_model->save();	
	
		if($data==false)
		{
			$this->index(); 
		}
		else 
		{
			echo json_encode($data);
		}		
	}

	public function GetData()
	{
		echo json_encode($this->customer_model->GetData());
	}

	public function search_name()
	{
		echo json_encode($this->customer_model->search_name());	
	}

	public function search_customer()
	{
		echo json_encode($this->customer_model->search_customer());	
	}

	public function delete()
	{
		echo json_encode($this->customer_model->DeleteData());
	}

	public function update()
	{
		echo json_encode($this->customer_model->UpdateData());
	}

	
	function fetch_shops()
	{
		echo json_encode($this->customer_model->fetch_shops());
	}
	

}
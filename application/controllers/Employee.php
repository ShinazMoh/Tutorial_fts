<?php

class Employee extends CI_Controller {

	function __construct()
	{
		parent::__construct(); //constructor of CL_Model

		$this->load->model('Employee_model'); //befoew any fucntion is executed the construtor work.. bcuz the constructor triggers before triggering any fucntion in the login modal
	}

	public function index($error_flag='false')
	{ 
		$this->load->view('employee_view',array('error_flag' =>$error_flag));
	}

	public function save()
	{
		$data = $this->home_model->save();	

		if($data==true)
		{
			$this->index('true'); 
		}
	}

	public function getUsers()
	{
		echo json_encode($this->home_model->GetData());	
	}	

	public function pass()
	{
		$this->load->view('search_Form');
	}

	public function search_user()
	{
		echo json_encode($this->home_model->search_user());
	}

	public function update()
	{
		echo json_encode($this->home_model->UpdateData());
	}

	public function delete()
	{
		echo json_encode($this->home_model->DeleteData());
	}

	public function Report()
	{
		
		//redirect('report');
	}

}
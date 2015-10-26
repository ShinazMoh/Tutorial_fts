<?php
//http://localhost/CodeIgniter/index.php/login/display
	/**
	* 
	*/
class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct(); //constructor of CL_Model

		$this->load->model('login_model'); //befoew any fucntion is executed the construtor work.. bcuz the constructor triggers before triggering any fucntion in the login modal
	}

	//only for once fucntion we need to show a messsage in the login page..
	// so we should pass the error msg as parameter.. 
	//but we are using the index() in most of the place.. 
	//but in every place we dnt have aything to send to login page so.. 
	//we use a default parameter so.. in other place we dnt have to send a parameter..   

	public function index($error_flag='false')
	//if we put index as function name... then it will be by default executed
	{ 
		$this->load->view('loginView',array('error_flag' =>$error_flag));
		//if u want to pass asny as parameter then pass it as a array
		//
	}

	public function Submit()
	{	
			$data = $this->login_model->Authenticate();	

			//including the boolean.. the type also checked... if we put ===
			//if we put == then when we check the $data is null.. then it returns to the login page like.. refreshing

			if($data===false)
			{
				//no use of sending anything as para.. due to help of default para 
				//in here we dnt need to pass anthn.. so it will be false
			
				$this->index(); 
			}
			else if($data==null)
			{
				//database has return null bcuz no user is availbe in the name give.. 
				//so we need to show a error on login page.. so were are passing a error 
				//to login page 

				$this->index('true'); //setting the error_flag as true...
			}
			else
			{
				redirect('home');
			}
	}

	public function Forget_Pass()
	{
		$this->load->view('forget_Password');
	}

	public function CheckPass()
	{
		$this->form_validation->set_rules('Password', 'Password', 'required');
		$this->form_validation->set_rules('Re-Password', 'Re-Password', 'required|matches[Password]');
		
		//matches is a fucntion where we can compare two values

		$flag = $this->form_validation->run(); //returns a boolean
		
		if($flag==false)
		{
			$this->Forget_Pass();
		} 	
	}
}
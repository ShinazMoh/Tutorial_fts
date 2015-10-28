<?php

Class Login_model extends CI_model
{

	function Authenticate()
	{

		//way of getting values from post using Codeignitor codes
		//$$this->input->post('Username'); 

		//using php
		//echo $_POST['Username'].'</br>';
		//echo $_POST['Password'];

		$this->form_validation->set_rules('Username', 'Username', 'required');

		$this->form_validation->set_rules('Password', 'Password', 'required');

		//	$this->form_validation->set_rules('Password', 'Password', 'required|min_length[8]');

		//gets all the rules and applies.. and checks whether then validation is true / false	

		$flag = $this->form_validation->run(); //returns a boolean

		if($flag==true)
		{
			$this->db->select('*');
			$this->db->where('username', $_POST['Username']);
			$this->db->where('password', $_POST['Password']);
			$data = $this->db->get('login')->row_array();

			return $data;
		}
		else
		{
			return false;
		}
	}


}
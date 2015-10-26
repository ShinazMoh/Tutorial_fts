<?php

/**
* 
*/
class Employee_model extends CI_Model
{
	
	function save()
	{

		$this->form_validation->set_rules('Username', 'Username', 'required');

		$this->form_validation->set_rules('Age', 'Age', 'required');

		$flag = $this->form_validation->run(); //returns a boolean

		if($flag==true)
		{
			$data =array();
			
			$data['USER_Name']	= $_POST['Username'];
			$data['USER_Name']	= $_POST['Age'];
			$data['USER_Address']	= $_POST['Address'];


			if(isset($_POST['Citizenship']))
			{
				$data['USER_isCitizen'] = $_POST['Citizenship']; 
			}
			else
			{
				$data['USER_isCitizen']	= 0;
			}

			
			$data['USER_PreferredLanguages'] = $_POST['lANG'];

			$this->db->insert('USER',$data);

			return true;
		}
		else
		{
			return false;
		}

	}

	function GetData()
	{
		$this->db->select('USER_Name AS "Name", USER_Age AS "Age", USER_Address AS "Address"');
		$data['detail'] = $this->db->get('USER')->result_array();

		$this->db->select('avg(USER_Age) AS "U_Age"');
		$data['average'] = $this->db->get('USER')->row_array();

		return $data;
	}

	function search_user()
	{
		$this->db->select('USER_ID AS "Id", USER_Name AS "Name", USER_Age AS "Age", USER_Address AS "Address"');
		$this->db->where('USER_Name', $_GET['searchbar']);
		$data = $this->db->get('USER')->row_array();

		return $data;
	}

	function UpdateData()
	{
		$data=array('USER_Name'=> $_POST['username'],'USER_Age'=>$_POST['age'], 'USER_Address' => $_POST['address'], 'USER_isCitizen' => $_POST['citizenship'], 'USER_PreferredLanguages' => $_POST['lang']);
		$this->db->where('USER_ID',$_POST['id']);
		$this->db->update('USER',$data);	
	}

	function DeleteData()
	{
		$this->db->where('USER_ID',$_GET['id']);
		$this->db->delete('USER');
	}

}


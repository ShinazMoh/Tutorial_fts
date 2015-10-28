<?php

/**
* 
*/
class Report_model extends CI_Model
{
	function search_age()
	{
		//URL has different segments.. so we can access the value that is passed in the url by defining the correct id and Id starts ferom the controller onwards
		//Report/search_age/Num
		//the 
		//$this->uri->segment(3); 

		$this->db->select('USER_Age AS "Age"');
		$this->db->like('USER_Age', $this->uri->segment(3));
		return $this->db->get('USER')->result_array();
	}

	function fetch_users()
	{
		$data = array();

		$this->db->select('USER_ID AS "Id", USER_Name AS "Name", USER_Age AS "Age", USER_Address AS "Address"');	

		if(!empty($_POST['name']))
		{
			$this->db->where('USER_Name',$_POST['name']);
		}

		if(!empty($_POST['date']))
		{
			$this->db->where('USER_Timestamp >= ',$_POST['date']);
		}

		if(!empty($_POST['age']))
		{
			$this->db->where('USER_Age',$_POST['age']);
		}

		$data['data'] = $this->db->get('USER')->result_array();
		
		return $data;
	}

	function search_address()
	{
		$this->db->select('CUSTOMER_Address AS "Address"');
		$this->db->like('CUSTOMER_Address', $this->uri->segment(3));
		$data = $this->db->get('CUSTOMER')->result_array();

		return $data;
	}



	function fetch_customers()
	{
		$data = array();

		$this->db->select('CUSTOMER_ID AS "id",CUSTOMER_Name AS "Name", CUSTOMER_Address AS "Address"');	

		if(!empty($_POST['name']))
		{
			$this->db->where('CUSTOMER_Name',$_POST['name']);
		}

		if(!empty($_POST['date']))
		{
			$this->db->where('CUSTOMER_Timestamp >= ',$_POST['date']);
		}

		if(!empty($_POST['address']))
		{
			$this->db->where('CUSTOMER_address',$_POST['address']);
		}

		$data['data'] = $this->db->get('CUSTOMER')->result_array();
		
		return $data;
	}

	function fetch_name()
	{
		$this->db->select('CUSTOMER_Name AS "name"');
		return $this->db->get('CUSTOMER')->result_array();
	}


	

}
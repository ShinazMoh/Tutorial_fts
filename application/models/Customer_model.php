<?php

class Customer_model extends CI_Model
{
	function save()
	{

		$this->form_validation->set_rules('name', 'name', 'required');

		$this->form_validation->set_rules('address', 'address', 'required');

		$flag = $this->form_validation->run();

		if($flag==true)
		{
			$data =array();
			
			$data['CUSTOMER_Name']	= $_POST['name'];
			$data['CUSTOMER_Address']	= $_POST['address'];

			$data['CUSTOMER_Status'] = $_POST['status'];

			$data['CUSTOMER_CreatedUser']	= 'Shinaz';

			$data['SHOP_ID'] = $_POST['shopid'];

			$this->db->insert('CUSTOMER',$data);

			return true;
		}
		else
		{
			return false;
		}

	}

	function GetData()
	{
		$this->db->select('CUSTOMER_Name AS "Name", CUSTOMER_Address AS "Address"');
		$data['detail'] = $this->db->get('CUSTOMER')->result_array();

		return $data;
	}

	function search_name()
	{
		$this->db->select('CUSTOMER_Name AS "Name", CUSTOMER_Address AS "Address"');

		$this->db->like('CUSTOMER_Name', $this->uri->segment(3));

		return $this->db->get('CUSTOMER')->result_array();
	}

	function search_customer()
	{
		$this->db->select('CUSTOMER_ID AS "id", CUSTOMER_Name AS "Name", CUSTOMER_Address AS "Address", CUSTOMER_Status AS "Status", SHOP_ID AS shopid ');
		$this->db->where('CUSTOMER_Name', $_POST['name']);
		$data = $this->db->get('CUSTOMER')->row_array();

		return $data;
	}

	function DeleteData()
	{
		$this->db->where('CUSTOMER_ID',$_POST['id']);
		$this->db->delete('CUSTOMER');
	}

	function UpdateData()
	{

		$data=array('CUSTOMER_Name'=> $_POST['name'],'CUSTOMER_Address'=>$_POST['address'], 'CUSTOMER_Status' => $_POST['status'], 'SHOP_ID' => $_POST['shopid'], 'CUSTOMER_UpdateTimestamp' => date('y-m-d'));
		$this->db->where('CUSTOMER_ID',$_POST['id']);
		$this->db->update('CUSTOMER',$data);	


	}

	function fetch_shops()
	{
		$this->db->select('SHOP_ID AS "id",SHOP_Name AS "name"');
		return $this->db->get('SHOP')->result_array();
	}

}